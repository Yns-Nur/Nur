/**
 * The site is one title sequence. These are its acts — the credit roll in the
 * header, the section markers on the page, and the sitemap, all from one list.
 *
 * Timecodes are the sequence's own running order, not a claim about video
 * length.
 */
export type Field = 'cardinal' | 'ink' | 'olive' | 'midnight' | 'ochre' | 'bone';

export interface Act {
  tc: string;
  id: string;
  title: string;
  /** What the act is, in the credit roll's second column. */
  role: string;
  field: Field;
  href: string;
}

export const ACTS: Act[] = [
  { tc: '00:00', id: 'prologue', title: 'Prologue', role: 'Who this is', field: 'cardinal', href: '/#prologue' },
  { tc: '00:18', id: 'reel', title: 'The Reel', role: 'Horizontal motion graphics', field: 'ink', href: '/#reel' },
  { tc: '00:42', id: 'loops', title: 'Loops', role: 'Square, silent, endless', field: 'olive', href: '/#loops' },
  { tc: '01:04', id: 'in-situ', title: 'In Situ', role: 'Animation inside websites', field: 'midnight', href: '/#in-situ' },
  { tc: '01:26', id: 'tools', title: 'Tools', role: 'Plugins for After Effects', field: 'ochre', href: '/plugins' },
  { tc: '01:48', id: 'the-person', title: 'The Person', role: 'Experience and contact', field: 'bone', href: '/about' },
  { tc: '02:06', id: 'end-card', title: 'End Card', role: 'Start a project', field: 'cardinal', href: '/contact' },
];

export const actById = (id: string) => ACTS.find((a) => a.id === id)!;
