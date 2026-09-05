/**
 * Writes the content collection entries.
 *
 * Everything here except `plugins/orbit.md` is PLACEHOLDER material describing
 * the authored demonstration clips in public/media/placeholder. No client
 * name, campaign, metric, testimonial or live URL appears anywhere — those are
 * not on hand and must not be invented (PRODUCT.md, Evidence on Hand).
 *
 *   node scripts/make-content.mjs
 */
import { mkdirSync, writeFileSync } from 'node:fs';
import { join, resolve } from 'node:path';

const ROOT = resolve('src/content');

const fm = (obj, body) => {
  const yaml = (v, indent = 0) => {
    const pad = '  '.repeat(indent);
    if (Array.isArray(v)) {
      return '\n' + v.map((item) => {
        if (typeof item === 'object') {
          const inner = Object.entries(item).map(([k, x]) => `${pad}    ${k}: ${JSON.stringify(x)}`).join('\n');
          return `${pad}  -\n${inner}`;
        }
        return `${pad}  - ${JSON.stringify(item)}`;
      }).join('\n');
    }
    if (v && typeof v === 'object') {
      return '\n' + Object.entries(v).map(([k, x]) => `${pad}  ${k}: ${JSON.stringify(x)}`).join('\n');
    }
    return ' ' + (typeof v === 'string' ? JSON.stringify(v) : v);
  };
  const head = Object.entries(obj).map(([k, v]) => `${k}:${yaml(v)}`).join('\n');
  return `---\n${head}\n---\n\n${body.trim()}\n`;
};

const write = (group, slug, data, body) => {
  const dir = join(ROOT, group);
  mkdirSync(dir, { recursive: true });
  writeFileSync(join(dir, `${slug}.md`), fm(data, body), 'utf8');
};

const M = (group, name, width, height) => ({
  src: `/media/placeholder/${group}/${name}.mp4`,
  poster: `/media/placeholder/${group}/${name}.webp`,
  width,
  height,
});

// ------------------------------------------------------ horizontal (16:9) --
const HORIZONTAL = [
  ['reach-out', 'Reach Out', '00:38', 'Lead animation, design', ['After Effects', 'Illustrator'], 'Brand film', true,
    'A single arm crosses the frame in eight cuts. The sun behind it holds still while everything else moves, so the eye has one fixed thing to measure the motion against.'],
  ['skyline-build', 'Skyline Build', '00:24', 'Animation', ['After Effects'], 'Explainer', true,
    'Nine columns rise on the beat, each one landing a frame after the last. The light sweeps the opposite way so the build never reads as a single block.'],
  ['hard-split', 'Hard Split', '00:16', 'Design, animation', ['After Effects', 'Illustrator'], 'Title card', false,
    'The field splits and holds the gap open for exactly four frames. Everything the piece has to say happens in that gap.'],
  ['the-witness', 'The Witness', '00:21', 'Animation', ['After Effects'], 'Campaign piece', true,
    'A ring contracts around an iris that tracks left and right. Nothing else in the frame moves, which is what makes the tracking read as attention rather than decoration.'],
  ['stack-argument', 'Stack Argument', '00:32', 'Design, animation', ['After Effects', 'Figma'], 'Explainer', true,
    'Six slabs stack one per beat, each narrower than the one beneath it. The rule underneath stays put so the stack has something to be measured against.'],
  ['long-wave', 'Long Wave', '00:19', 'Animation', ['After Effects'], 'Loop for broadcast', false,
    'Eleven columns run a travelling wave across a black field. Cut on the horizon line so the top and bottom halves read as two different pieces of the same motion.'],
];

HORIZONTAL.forEach(([slug, title, duration, role, tools, kind, sound, body], i) => {
  write('horizontal', slug, {
    title, order: i + 1, year: 2026, duration, ratio: '16:9', role, tools, kind, sound,
    placeholder: true, media: M('horizontal', slug, 1920, 1080),
  }, body);
});

// ------------------------------------------------------------ loops (1:1) --
const LOOPS = [
  ['orbit-mark', 'Orbit Mark', 'Logo animation', 'Three blades step around a fixed centre. Eight positions, no in-betweens.'],
  ['aperture-lock', 'Aperture Lock', 'Preloader', 'Six leaves close and open on a twelve-step cycle. The centre dot never moves.'],
  ['pulse-eye', 'Pulse Eye', 'Logo animation', 'A ring breathes while the pupil drifts against it.'],
  ['wave-form', 'Wave Form', 'Loop', 'A travelling wave across eleven columns, cut on the centre line.'],
  ['stack-build', 'Stack Build', 'Logo animation', 'Slabs arrive one per beat and hold. The rule underneath carries the weight.'],
  ['spin-cut', 'Spin Cut', 'Preloader', 'Blades rotate in eight discrete stops — a stepped spin, never a smooth one.'],
  ['shutter-pass', 'Shutter Pass', 'Transition', 'A six-leaf shutter passing through, usable as a cut between two states.'],
  ['signal-run', 'Signal Run', 'Loop', 'Arrows march the frame at four sizes so the row never reads as a pattern.'],
  ['split-mark', 'Split Mark', 'Logo animation', 'The field opens on a four-step beat and closes on the same count.'],
  ['hand-off', 'Hand Off', 'Short piece', 'The arm reaches, the disc rises to meet it, and the loop closes on contact.'],
  ['wheel-turn', 'Wheel Turn', 'Loop', 'Eight segments, one lit at a time, stepping around the ring.'],
  ['rise-fall', 'Rise Fall', 'Loop', 'Columns grow and collapse against a fixed ground line.'],
];

LOOPS.forEach(([slug, title, kind, body], i) => {
  write('loops', slug, {
    title, order: i + 1, year: 2026, duration: '00:03', ratio: '1:1', kind,
    placeholder: true, media: M('loops', slug, 1080, 1080),
  }, body);
});

// -------------------------------------------------------------------- web --
const WEB = [
  ['ring-preloader', 'Ring Preloader', 'Preloader', 'Lottie', '00:04',
    'A six-leaf aperture that holds the first paint. Exported as Lottie so it starts before the rest of the bundle arrives.'],
  ['progress-reveal', 'Progress Reveal', 'Loading state', 'Lottie', '00:04',
    'A ten-step bar with real tick marks. Stepped rather than smooth, so a stall reads as a stall instead of a slow crawl.'],
  ['menu-overlay', 'Menu Overlay', 'Navigation', 'Rive', '00:04',
    'Three rules fold into a cross. Built as a Rive state machine so the developers drive it from one boolean.'],
  ['section-transition', 'Section Transition', 'Page transition', 'CSS', '00:04',
    'Arrows carry the eye across the cut while the next section is still mounting.'],
];

WEB.forEach(([slug, title, part, handoff, duration, body], i) => {
  write('web', slug, {
    title, order: i + 1, year: 2026, part, handoff, duration, ratio: '16:10',
    placeholder: true, media: M('web', slug, 1600, 1000),
  }, body);
});

// ---------------------------------------------------------------- plugins --
write('plugins', 'orbit', {
  title: 'Orbit',
  order: 1,
  tagline: 'A radial command wheel for After Effects.',
  state: 'unreleased',
  host: 'After Effects',
  placeholder: false,
  features: [
    { title: 'Effects on a wheel', body: 'Commands sit on a radial wheel under the cursor instead of down a menu, so the throw distance to any of them is the same.' },
    { title: 'Parameters already dialled in', body: 'Each effect carries its own tuned parameters rather than arriving at defaults you then have to fix.' },
    { title: 'Capture a look off a layer', body: 'Pick up the treatment from a layer that is already graded and carry it to another.' },
  ],
  install: [
    'Runs as a CEP extension inside After Effects.',
    'Installs from PowerShell. No administrator rights are needed.',
  ],
  media: { ...M('plugins', 'radial-wheel', 1600, 1000), poster: '/media/placeholder/plugins/radial-wheel.webp' },
}, `
Orbit is a functional equivalent of a radial effect wheel, built because
reaching a menu breaks the rhythm of animating. It is real and working; the
release date and price are not decided yet.

The clip on this page is a placeholder animation, not a screen capture of the
plugin.
`);

const PLUGIN_STUBS = [
  ['stagger', 'Stagger', 'Offset a selection across time without touching a single keyframe.', 'free', 'stagger-tool',
    [['Offset by index', 'Spread a selection across a duration you set, in the order you picked them.'],
     ['Falloff curves', 'Shape how the delay accumulates across the selection.'],
     ['Reverse and ping-pong', 'Run the offset back the other way, or out from the centre.']]],
  ['ease-lab', 'Ease Lab', 'Build, name and reuse easing curves across a project.', 'paid', 'curve-tool',
    [['Named curves', 'Save a curve once and apply it by name anywhere in the project.'],
     ['Paste onto a selection', 'Apply one curve across every selected keyframe pair at once.'],
     ['Library export', 'Move a curve set between projects and machines.']]],
  ['plate', 'Plate', 'Set up render plates and hand-off exports in one panel.', 'unreleased', 'plate-tool',
    [['Format presets', 'Landscape, square and vertical plates from one composition.'],
     ['Lottie and Rive checks', 'Flag the layer types that will not survive the handoff before you export.'],
     ['Batch queue', 'Queue every plate in one pass.']]],
];

PLUGIN_STUBS.forEach(([slug, title, tagline, state, mediaName, features], i) => {
  write('plugins', slug, {
    title,
    order: i + 2,
    tagline,
    state,
    ...(state === 'paid' ? { price: 'Price not set' } : {}),
    host: 'After Effects',
    placeholder: true,
    features: features.map(([t, b]) => ({ title: t, body: b })),
    install: ['Runs as a CEP extension inside After Effects.'],
    media: M('plugins', mediaName, 1600, 1000),
  }, `
This is a placeholder entry. It exists so the plugin page can be evaluated with
more than one tool in it, and so all three distribution states — free, paid and
unreleased — render. Replace it with a real plugin, or delete the file.
`);
});

console.log('content written');
