/**
 * Packages the built home page into ONE self-contained HTML file for
 * publishing as an Artifact.
 *
 * The Artifact CSP blocks every external request, so CSS, fonts, video and
 * posters are all inlined as data URIs. The home page carries the whole
 * sequence — all three work formats, the tools act, the person act and the end
 * card — so it stands alone; links to the other routes are rewritten to the
 * matching act on the page rather than left to 404.
 *
 *   npm run build && node scripts/make-artifact.mjs
 */
import { readFileSync, writeFileSync, existsSync, statSync } from 'node:fs';
import { join, resolve, extname } from 'node:path';

const DIST = resolve('dist');
const OUT = resolve('artifact/yns-nur-preview.html');

const MIME = {
  '.woff2': 'font/woff2',
  '.mp4': 'video/mp4',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
};

const b64 = (abs) => readFileSync(abs).toString('base64');
const dataUri = (abs) => `data:${MIME[extname(abs)] ?? 'application/octet-stream'};base64,${b64(abs)}`;

/** Resolve a site-absolute URL against dist/. */
const fromDist = (url) => join(DIST, url.replace(/^\//, '').split('?')[0]);

let html = readFileSync(join(DIST, 'index.html'), 'utf8');
const report = { css: 0, fonts: 0, videos: 0, posters: 0, links: 0, scripts: 0 };

/* ---------------------------------------------------------------- styles -- */
html = html.replace(/<link rel="stylesheet" href="([^"]+)"\s*\/?>/g, (_m, href) => {
  const abs = fromDist(href);
  if (!existsSync(abs)) return '';
  let css = readFileSync(abs, 'utf8');

  // Fonts referenced from inside the CSS.
  css = css.replace(/url\((["']?)(\/fonts\/[^)"']+)\1\)/g, (_mm, _q, fontUrl) => {
    const fontAbs = fromDist(fontUrl);
    if (!existsSync(fontAbs)) return `url(${fontUrl})`;
    report.fonts += 1;
    return `url("${dataUri(fontAbs)}")`;
  });

  report.css += 1;
  return `<style>\n${css}\n</style>`;
});

/* --------------------------------------------------------------- scripts -- */
// ClientRouter drives view transitions between routes. There is exactly one
// route here, and it would intercept the rewritten anchors, so it goes.
html = html.replace(
  /<script type="module" src="\/_astro\/ClientRouter[^"]*"><\/script>/g,
  () => { report.scripts += 1; return ''; },
);

html = html.replace(/<script type="module" src="([^"]+)"><\/script>/g, (_m, src) => {
  const abs = fromDist(src);
  if (!existsSync(abs)) return '';
  report.scripts += 1;
  return `<script type="module">\n${readFileSync(abs, 'utf8')}\n</script>`;
});

/* ----------------------------------------------------------------- media -- */
html = html.replace(/poster="(\/media\/[^"]+)"/g, (_m, url) => {
  const abs = fromDist(url);
  if (!existsSync(abs)) return `poster="${url}"`;
  report.posters += 1;
  return `poster="${dataUri(abs)}"`;
});

html = html.replace(/src="(\/media\/[^"]+\.mp4)"/g, (_m, url) => {
  const abs = fromDist(url);
  if (!existsSync(abs)) return `src="${url}"`;
  report.videos += 1;
  return `src="${dataUri(abs)}"`;
});

/* ------------------------------------------------------------------ head -- */
// Nothing external may survive: the icon, the canonical and the font preloads
// all point off-document.
html = html
  .replace(/<link rel="canonical"[^>]*>/g, '')
  .replace(/<link rel="icon"[^>]*>/g, '')
  .replace(/<link rel="preload"[^>]*>/g, '')
  .replace(/<link rel="sitemap"[^>]*>/g, '');

/* ----------------------------------------------------------------- links -- */
// Give the end card an anchor so the contact links have somewhere to land.
html = html.replace('<section class="act act--end"', '<section id="end-card" class="act act--end"');

const ROUTE_TO_ACT = [
  // The credit roll points at "/#reel" so it works from any route; on a single
  // page that leading slash would reload the document.
  [/href="\/#([^"]+)"/g, 'href="#$1"'],
  [/href="\/plugins(\/[^"]*)?"/g, 'href="#tools"'],
  [/href="\/work\/[^"]*"/g, 'href="#reel"'],
  [/href="\/about"/g, 'href="#the-person"'],
  [/href="\/contact"/g, 'href="#end-card"'],
  [/href="\/colophon"/g, 'href="#end-card"'],
  [/href="\/"/g, 'href="#prologue"'],
];

for (const [pattern, replacement] of ROUTE_TO_ACT) {
  html = html.replace(pattern, () => { report.links += 1; return replacement; });
}

/* ------------------------------------------------------- unwrap the shell -- */
// The Artifact host supplies <!doctype>, <html>, <head> and <body>, so this file
// must contain page content only. The body's data-field is preserved on a
// wrapper, because the sticky header reads its act colour from that ancestor.
const headInner = html.match(/<head>([\s\S]*?)<\/head>/)?.[1] ?? '';
const bodyOpen = html.match(/<body([^>]*)>/)?.[1] ?? '';
const bodyInner = html.match(/<body[^>]*>([\s\S]*?)<\/body>/)?.[1] ?? '';

const field = bodyOpen.match(/data-field="([^"]+)"/)?.[1] ?? 'cardinal';

// Keep only the styles and scripts from <head>; drop meta/title/etc.
const headKeep = [
  ...headInner.matchAll(/<style>[\s\S]*?<\/style>/g),
  ...headInner.matchAll(/<script(?![^>]*\bsrc=)[^>]*>[\s\S]*?<\/script>/g),
].map((m) => m[0]).join('\n');

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
${headKeep}
<div data-field="${field}" class="artifact-root">
${bodyInner}
</div>`);

writeFileSync(OUT, out, 'utf8');

const kb = statSync(OUT).size / 1024;
console.log(`wrote ${OUT}`);
console.log(`  ${(kb / 1024).toFixed(2)} MB`);
console.log(`  ${report.css} stylesheets, ${report.fonts} font faces`);
console.log(`  ${report.videos} videos, ${report.posters} posters`);
console.log(`  ${report.scripts} scripts, ${report.links} links rewritten`);

for (const [k, v] of Object.entries(report)) {
  if (v === 0) console.warn(`  WARNING: nothing inlined for "${k}"`);
}
// Check only outside the data URIs — base64 payloads contain "/" freely and
// will happily fake a match.
const withoutData = out.replace(/data:[^"')]+/g, 'data:…');
const stray = withoutData.match(/(?:src|href)="\/[^"]*"/g);
if (stray) {
  console.warn(`  WARNING: site-absolute references survived, CSP will block them:\n    ${stray.join('\n    ')}`);
} else {
  console.log('  no external references remain');
}
