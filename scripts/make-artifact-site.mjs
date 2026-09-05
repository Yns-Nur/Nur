/**
 * Packages the ENTIRE built site into ONE self-contained HTML file for
 * publishing as an Artifact.
 *
 * Where make-artifact.mjs ships the home page alone and folds every route into
 * an anchor on it, this one keeps all 32 routes: each built page becomes a
 * <template>, a hash router swaps them in, and the site's own scripts re-run on
 * each swap because they already listen for `astro:page-load`.
 *
 * The Artifact CSP blocks every external request, so CSS, fonts, video and
 * posters are inlined. Media is inlined ONCE into a lookup keyed by its site
 * path — the same clip appears on the reel and on its work page, and paying for
 * it twice would double the file.
 *
 *   npm run build && node scripts/make-artifact-site.mjs
 */
import { readFileSync, writeFileSync, existsSync, statSync, mkdirSync } from 'node:fs';
import { join, resolve, extname, relative, dirname } from 'node:path';
import { glob } from 'node:fs/promises';

const DIST = resolve('dist');
const OUT = resolve('artifact/yns-nur-site.html');

const MIME = {
  '.woff2': 'font/woff2',
  '.mp4': 'video/mp4',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
};

const dataUri = (abs) =>
  `data:${MIME[extname(abs)] ?? 'application/octet-stream'};base64,${readFileSync(abs).toString('base64')}`;

/** Resolve a site-absolute URL against dist/. */
const fromDist = (url) => join(DIST, url.replace(/^\//, '').split('?')[0]);

const report = { pages: 0, css: 0, fonts: 0, media: 0, scripts: 0, links: 0 };

/* ------------------------------------------------------------- the pages -- */
const files = [];
for await (const f of glob('**/*.html', { cwd: DIST })) files.push(f);

// Home first so its route is the document's opening frame, the rest by depth
// then name, which keeps the template block readable.
files.sort((a, b) => (a === 'index.html' ? -1 : b === 'index.html' ? 1 : a.localeCompare(b)));

/** dist-relative file path -> site route ('index.html' -> '/'). */
const toRoute = (file) => {
  const url = '/' + file.split('\\').join('/').replace(/index\.html$/, '').replace(/\.html$/, '');
  return url === '/' ? '/' : url.replace(/\/$/, '');
};

const cssOrder = [];           // href, first-seen order
const cssSeen = new Set();
const modOrder = [];           // src, first-seen order
const modSeen = new Set();
const headStyles = new Map();  // content -> true, deduped inline <style> from <head>
const media = new Map();       // site path -> data URI

const pages = files.map((file) => {
  const route = toRoute(file);
  const html = readFileSync(join(DIST, file), 'utf8');

  const head = html.match(/<head>([\s\S]*?)<\/head>/)?.[1] ?? '';
  const bodyOpen = html.match(/<body([^>]*)>/)?.[1] ?? '';
  let body = html.match(/<body[^>]*>([\s\S]*?)<\/body>/)?.[1] ?? '';

  const title = (head.match(/<title>([\s\S]*?)<\/title>/)?.[1] ?? 'YNS NUR').trim();
  const field = bodyOpen.match(/data-field="([^"]+)"/)?.[1] ?? 'cardinal';

  for (const m of head.matchAll(/<link rel="stylesheet" href="([^"]+)"\s*\/?>/g)) {
    if (!cssSeen.has(m[1])) { cssSeen.add(m[1]); cssOrder.push(m[1]); }
  }

  for (const m of head.matchAll(/<style>([\s\S]*?)<\/style>/g)) headStyles.set(m[1], true);

  // ClientRouter drives real navigations between real URLs. There are none
  // here — the hash router below takes its place.
  for (const m of html.matchAll(/<script type="module" src="([^"]+)"><\/script>/g)) {
    if (m[1].includes('ClientRouter')) continue;
    if (!modSeen.has(m[1])) { modSeen.add(m[1]); modOrder.push(m[1]); }
  }

  // Scripts live in <body> in the build; they are hoisted out of the templates
  // and emitted once, or every swap would re-inject them.
  body = body.replace(/<script[^>]*>[\s\S]*?<\/script>/g, '');

  /* --- media: recorded once, referenced by path ----------------------- */
  const claim = (url) => {
    const abs = fromDist(url);
    if (!existsSync(abs)) return false;
    if (!media.has(url)) media.set(url, dataUri(abs));
    return true;
  };

  body = body
    .replace(/poster="(\/media\/[^"]+)"/g, (m, url) => (claim(url) ? `data-poster="${url}"` : m))
    .replace(/src="(\/media\/[^"]+)"/g, (m, url) => (claim(url) ? `data-src="${url}"` : m));

  /* --- links: every route becomes a hash route ------------------------ */
  const count = (replacement) => () => { report.links += 1; return replacement; };

  body = body
    // "/#reel" — the credit roll's cross-route anchors.
    .replace(/href="\/#([^"]+)"/g, (_m, a) => { report.links += 1; return `href="#/#${a}"`; })
    // A bare in-page anchor is qualified with the route it sits on, so the
    // address always says which page you are on.
    .replace(/href="#([^/][^"]*)"/g, (_m, a) => { report.links += 1; return `href="#${route}#${a}"`; })
    .replace(/href="\/"/g, count('href="#/"'))
    .replace(/href="(\/(?:work|plugins|about|contact|colophon)[^"]*)"/g, (_m, p) => {
      report.links += 1;
      return `href="#${p.replace(/\/$/, '')}"`;
    });

  report.pages += 1;
  return { route, title, field, body };
});

/* ----------------------------------------------------------------- css --- */
const styles = cssOrder
  .map((href) => {
    const abs = fromDist(href);
    if (!existsSync(abs)) return '';
    let css = readFileSync(abs, 'utf8');
    css = css.replace(/url\((["']?)(\/fonts\/[^)"']+)\1\)/g, (_m, _q, fontUrl) => {
      const fontAbs = fromDist(fontUrl);
      if (!existsSync(fontAbs)) return `url(${fontUrl})`;
      report.fonts += 1;
      return `url("${dataUri(fontAbs)}")`;
    });
    report.css += 1;
    return `<style>\n${css}\n</style>`;
  })
  .join('\n');

const inlineStyles = [...headStyles.keys()].map((c) => `<style>${c}</style>`).join('\n');

/* -------------------------------------------------------------- scripts -- */
const modules = modOrder
  .map((src) => {
    const abs = fromDist(src);
    if (!existsSync(abs)) return '';
    report.scripts += 1;
    return `<script type="module">\n${readFileSync(abs, 'utf8')}\n</script>`;
  })
  .join('\n');

/* ------------------------------------------------------------ templates -- */
const templates = pages
  .map(
    (p) =>
      `<template data-route="${p.route}" data-field="${p.field}" data-title="${p.title.replace(/"/g, '&quot;')}">\n${p.body}\n</template>`,
  )
  .join('\n');

report.media = media.size;
const mediaJson = JSON.stringify(Object.fromEntries(media));

/* --------------------------------------------------------------- router -- */
const router = `<script>
(() => {
  const MEDIA = ${mediaJson};
  const stage = document.getElementById('stage');
  const routes = new Map();
  for (const t of document.querySelectorAll('template[data-route]')) routes.set(t.dataset.route, t);

  const parse = () => {
    const raw = location.hash.slice(1);            // "/plugins/orbit#specs"
    if (!raw.startsWith('/')) return { route: '/', anchor: '' };
    const cut = raw.indexOf('#');
    return cut === -1
      ? { route: raw, anchor: '' }
      : { route: raw.slice(0, cut) || '/', anchor: raw.slice(cut + 1) };
  };

  let current = null;

  const render = (route) => {
    const tpl = routes.get(route) ?? routes.get('/404') ?? routes.get('/');
    const frag = tpl.content.cloneNode(true);

    // Media is held once and handed to each clone that asks for it. This runs
    // before the fragment is in the document, so a <video> starts resource
    // selection with its <source> already pointing at the data URI.
    for (const el of frag.querySelectorAll('[data-src]')) {
      const uri = MEDIA[el.dataset.src];
      if (uri) el.src = uri;
    }
    for (const el of frag.querySelectorAll('[data-poster]')) {
      const uri = MEDIA[el.dataset.poster];
      if (uri) el.poster = uri;
    }

    stage.replaceChildren(frag);
    stage.dataset.field = tpl.dataset.field;
    document.title = tpl.dataset.title;

    current = route;
    // The site's own scripts re-initialise on this event after a view
    // transition; a swap here is the same thing by another route.
    document.dispatchEvent(new Event('astro:page-load'));
  };

  const go = () => {
    const { route, anchor } = parse();
    const swapped = route !== current;
    if (swapped) render(route);
    const target = anchor && stage.querySelector('#' + CSS.escape(anchor));
    if (target) target.scrollIntoView({ behavior: swapped ? 'auto' : 'smooth', block: 'start' });
    else if (swapped) window.scrollTo(0, 0);
  };

  addEventListener('hashchange', go);
  go();
})();
</script>`;

/* ------------------------------------------------------------- assemble -- */
/**
 * This file ships without a <head> of its own, so it cannot declare a charset.
 * Escaping non-ASCII to numeric entities makes the markup correct whatever the
 * host serves it as. Entities are NOT decoded inside <style> or <script>, so
 * those blocks are handed through untouched.
 */
const escapeOutsideCode = (markup) =>
  markup
    .split(/(<style[\s\S]*?<\/style>|<script[\s\S]*?<\/script>)/g)
    .map((chunk, i) =>
      i % 2 === 1 ? chunk : chunk.replace(/[^\x00-\x7F]/g, (ch) => `&#${ch.codePointAt(0)};`),
    )
    .join('');

const out = escapeOutsideCode(`<title>YNS NUR — Younes Nur, motion designer</title>
${styles}
${inlineStyles}
${templates}
<div id="stage" class="artifact-root" data-field="cardinal"></div>
${router}
${modules}`);

mkdirSync(dirname(OUT), { recursive: true });
writeFileSync(OUT, out, 'utf8');

/* --------------------------------------------------------------- report -- */
const mb = statSync(OUT).size / 1024 / 1024;
console.log(`wrote ${relative(process.cwd(), OUT)}`);
console.log(`  ${mb.toFixed(2)} MB`);
console.log(`  ${report.pages} routes, ${report.links} links rewritten`);
console.log(`  ${report.css} stylesheets, ${report.fonts} font faces`);
console.log(`  ${report.media} media files inlined once each`);
console.log(`  ${report.scripts} scripts`);

for (const [k, v] of Object.entries(report)) {
  if (v === 0) console.warn(`  WARNING: nothing collected for "${k}"`);
}

// Check only outside the data URIs — base64 payloads contain "/" freely and
// will happily fake a match.
const withoutData = out.replace(/data:[^"')]+/g, 'data:…');
// The lookbehind keeps `data-src="/media/…"` — a key into MEDIA, resolved in
// JS — from reading as a live request.
const stray = withoutData.match(/(?<![-\w])(?:src|href|poster)="\/[^"]*"/g);
if (stray) {
  console.warn(`  WARNING: site-absolute references survived, CSP will block them:`);
  for (const s of [...new Set(stray)]) console.warn(`    ${s}`);
} else {
  console.log('  no external references remain');
}

// Every hash route an anchor points at must have a template behind it.
const known = new Set(pages.map((p) => p.route));
const dangling = [...new Set((out.match(/href="#\/[^"]*"/g) ?? []))]
  .map((h) => h.slice(7, -1).split('#')[0])
  .map((r) => (r === '' ? '/' : r))
  .filter((r) => !known.has(r));
if (dangling.length) console.warn(`  WARNING: links to missing routes: ${dangling.join(', ')}`);
else console.log(`  every link lands on a real route`);
