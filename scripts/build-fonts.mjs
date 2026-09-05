/**
 * Subsets and converts the licensed desktop fonts into web-ready woff2.
 *
 * Source files live outside the repo (E:\fonts) and are NOT committed — only
 * the generated, Latin-subset woff2 files under public/fonts/ are.
 *
 * LICENSING: Suisse Int'l, F37 Zagma Mono and Hitmarker Condensed are
 * commercial faces. A webfont licence must be cleared before this site is
 * published. See README.md.
 *
 *   npm run fonts
 */
import { execFileSync } from 'node:child_process';
import { mkdirSync, copyFileSync, existsSync, statSync } from 'node:fs';
import { join, resolve } from 'node:path';

const SRC = 'E:\\fonts';
const OUT = resolve('public/fonts');

// Latin basic + Latin-1 + general punctuation + arrows + the few symbols the
// interface actually sets. Keeps each face well under 30 kB.
const UNICODES = 'U+0020-007E,U+00A0-00FF,U+2018-201D,U+2013,U+2014,U+2026,U+2022,U+00D7,U+2192,U+2190,U+2191,U+2193,U+2212,U+00B7';

/** @type {{from: string, to: string, copy?: boolean}[]} */
const FACES = [
  // Display — condensed black caps for act titles and the wordmark.
  {
    from: join(SRC, 'AE Fuels Social/AE Fuels Social/Hitmarker/HitmarkerCondensed-Black.woff2'),
    to: 'hitmarker-condensed-black.woff2',
    copy: true, // already woff2; subsetting a woff2 in place is not worth the risk
  },
  // Body / UI — Suisse Int'l.
  { from: join(SRC, 'Transbridge/Transbridge/SuisseIntl/SuisseIntl-Regular.otf'), to: 'suisse-intl-400.woff2' },
  { from: join(SRC, 'Transbridge/Transbridge/SuisseIntl/SuisseIntl-Medium.otf'), to: 'suisse-intl-500.woff2' },
  { from: join(SRC, 'Transbridge/Transbridge/SuisseIntl/SuisseIntl-Bold.otf'), to: 'suisse-intl-700.woff2' },
  // Mono — timecodes, credits, technical labels.
  { from: join(SRC, 'Transbridge/Transbridge/F37 Zagma Mono/F37ZagmaMono-Light.otf'), to: 'zagma-mono-300.woff2' },
  { from: join(SRC, 'Transbridge/Transbridge/F37 Zagma Mono/F37ZagmaMono-Regular.otf'), to: 'zagma-mono-400.woff2' },
  { from: join(SRC, 'Transbridge/Transbridge/F37 Zagma Mono/F37ZagmaMono-Bold.otf'), to: 'zagma-mono-700.woff2' },
];

mkdirSync(OUT, { recursive: true });

let ok = 0;
let missing = 0;

for (const face of FACES) {
  const dest = join(OUT, face.to);

  if (!existsSync(face.from)) {
    console.warn(`  MISSING  ${face.to}  <- ${face.from}`);
    missing += 1;
    continue;
  }

  if (face.copy) {
    copyFileSync(face.from, dest);
  } else {
    execFileSync('python', [
      '-m', 'fontTools.subset', face.from,
      `--unicodes=${UNICODES}`,
      '--layout-features=kern,liga,calt,tnum,case',
      '--flavor=woff2',
      '--desubroutinize',
      `--output-file=${dest}`,
    ], { stdio: 'inherit' });
  }

  console.log(`  ok  ${face.to}  ${(statSync(dest).size / 1024).toFixed(1)} kB`);
  ok += 1;
}

console.log(`\n${ok} face(s) written to public/fonts${missing ? `, ${missing} missing` : ''}.`);
if (missing) {
  console.log('Missing sources are expected on a machine without the E:\\fonts library;');
  console.log('the committed woff2 files in public/fonts are what the site actually loads.');
}
