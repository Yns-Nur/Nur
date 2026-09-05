/**
 * The CV, structured the way a credit roll already is: a time column, a role,
 * and who it was for.
 *
 * `real: true` marks the handful of facts that are actually established
 * (PRODUCT.md, Evidence on Hand). Everything else is placeholder scaffolding
 * so the section can be evaluated, is marked as such in the interface, and is
 * listed in README.md for replacement. No employer, school, certificate,
 * award or contact detail from the sample PDF appears here — that document
 * belongs to a different person and was supplied only to show the shape.
 */
export interface Credit {
  from: string;
  to: string;
  role: string;
  place: string;
  note: string;
  real: boolean;
}

export const NAME = 'Younes Nur';
export const MARK = 'YNS NUR';
export const TITLE = 'Motion designer';

export const SUMMARY = [
  'Six years animating for screens, mostly in three formats: landscape films, square loops, and animation that ships inside a website.',
  'I also build the tools I animate with — an After Effects extension that puts the commands I reach for most on a wheel under the cursor.',
];

/** Real: the current position and the length of practice. */
export const CREDITS: Credit[] = [
  {
    from: '2024', to: 'Present',
    role: 'Motion designer',
    place: 'SILA Digital',
    note: 'Sole motion designer at a web design studio in Serbia. Animation for client sites, brand pieces and interface motion, handed to developers as Lottie and Rive.',
    real: true,
  },
  {
    from: '2022', to: '2024',
    role: 'Motion designer',
    place: 'Studio — to be filled in',
    note: 'Placeholder entry. Replace with the real position, dates and description.',
    real: false,
  },
  {
    from: '2020', to: '2022',
    role: 'Motion designer, freelance',
    place: 'Independent',
    note: 'Placeholder entry. Replace with the real client mix and range of work.',
    real: false,
  },
];

export const TOOLS = [
  { name: 'After Effects', note: 'Primary. Where nearly all of it is made.', real: true },
  { name: 'Rive', note: 'Interactive state machines for web and product.', real: true },
  { name: 'Figma', note: 'Design handoff, both directions.', real: true },
  { name: 'Illustrator', note: 'Artwork prep and shape work.', real: true },
  { name: 'Blender', note: 'Occasional — 3D elements into 2D pieces.', real: true },
];

export const HANDOFF = [
  { name: 'Lottie / Bodymovin', note: 'Vector animation straight into the page.', real: true },
  { name: 'Rive', note: 'Runtime state machines the developers drive.', real: true },
];

export const CAPABILITIES = [
  { name: 'Horizontal motion graphics', note: 'Explainers, campaign pieces, brand films.', real: true },
  { name: 'Square loops', note: 'Logo animations, preloaders, small motion pieces.', real: true },
  { name: 'Web and interaction animation', note: 'Preloaders, transitions, interactive states.', real: true },
  { name: 'Tooling', note: 'After Effects extensions, built for my own workflow first.', real: true },
];

export const EDUCATION = [
  {
    from: '20XX', to: '20XX',
    role: 'Course or degree — to be filled in',
    place: 'Institution',
    note: 'Placeholder entry. Replace with real education, or delete the block.',
    real: false,
  },
];

/** Contact routes are undecided; the CV states that rather than inventing one. */
export const CONTACT_NOTE = 'Email and social links are not decided yet.';
