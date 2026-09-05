# YNS NUR — portfolio and plugin site

Motion design portfolio for **Younes Nur**, built as a title sequence: sections
are acts with timecodes, the navigation is the credit roll, and the CV is set as
what a credit roll already is.

Astro, static output, no server. Deployed to GitHub Pages — see
[PUBLISHING.md](PUBLISHING.md) for how to put it online and how to update it.

```bash
npm install
npm run dev        # http://localhost:4321
npm run build      # -> dist/
npm run preview
```

---

## Structure

| Route | What it is |
|---|---|
| `/` | The full sequence — prologue, reel, loops, in situ, tools, the person, end card |
| `/work/[slug]` | A single piece, in its native ratio |
| `/plugins` | The tool catalogue |
| `/plugins/[slug]` | One tool: what it does, how it installs, how to get it |
| `/about` | The CV, set as a credit roll. Prints properly. |
| `/contact` | Scoped enquiry form |
| `/colophon` | What the site is made of and what on it is not real |

Acts are defined once in `src/data/acts.ts` and drive the header, the footer and
the 404.

---

## Shipping it as an Artifact

An Artifact is a single HTML file with every external request blocked, so the
site has to be folded into one document with its CSS, fonts and video inlined.

```bash
npm run build && npm run artifact        # -> artifact/yns-nur-site.html
```

`scripts/make-artifact-site.mjs` keeps **all 32 routes**: each built page becomes
a `<template>`, a hash router (`#/plugins/orbit`) swaps them into `#stage`, and
every media file is inlined once into a lookup keyed by its site path rather than
once per page that shows it. After each swap the router dispatches
`astro:page-load` — the same event the view-transition router fires — so the
header, the players and the contact form re-wire themselves with no extra code.
ClientRouter is dropped, since there are no real URLs left for it to fetch.

The older `scripts/make-artifact.mjs` ships the home page **alone** and rewrites
every route link to an anchor on it. It stays for the case where one scrolling
page is the point; it cannot show `/plugins/orbit` or `/contact`.

---

## Replacing the placeholder work

**Every moving image on this site is authored placeholder material.** None of it
is client work. Each one is marked `PLACEHOLDER` in the interface.

To swap in a real piece:

1. Drop the video and a poster image into `public/media/`.
2. Edit the matching file in `src/content/…` — point `media.src` and
   `media.poster` at the new files, set the real `width`/`height`, and set
   `placeholder: false` to remove the mark.
3. Nothing else changes. No markup edits.

A piece can move to a streaming host instead by setting `media.embed`.

### The full replacement list

| What | Where | Count |
|---|---|---|
| Horizontal films | `src/content/horizontal/*.md` + `public/media/placeholder/horizontal/` | 6 |
| Square loops | `src/content/loops/*.md` + `public/media/placeholder/loops/` | 12 |
| Web animation captures | `src/content/web/*.md` + `public/media/placeholder/web/` | 4 |
| Plugin clips | `public/media/placeholder/plugins/` | 4 |
| Plugin entries (all but Orbit) | `src/content/plugins/{stagger,ease-lab,plate}.md` | 3 |
| Earlier CV positions | `src/data/resume.ts` → `CREDITS` where `real: false` | 2 |
| Education | `src/data/resume.ts` → `EDUCATION` | 1 |
| Social links | `src/components/SiteFooter.astro` | — |
| Contact email / form endpoint | `src/pages/contact.astro` | — |
| Live URLs for web pieces | `url:` field in `src/content/web/*.md` | 4 |
| Domain | `site:` in `astro.config.mjs` | — |

### What on the site is real

- **Orbit** — the After Effects extension. Real, unreleased, price undecided.
- Six years of practice, and the current position at SILA Digital.
- The tools (After Effects, Rive, Figma, Illustrator, Blender) and the handoff
  formats (Lottie, Rive).

Nothing else claims to be. There are no client names, campaign names,
testimonials, metrics, awards or live URLs anywhere, because none were on hand.

> The sample PDF supplied during briefing (`AlirezaGharibi-Resume-V3.pdf`)
> belongs to a different person and was used **only** to establish the expected
> shape of a CV section. None of its content appears anywhere in this build.

---

## The contact form does not send

By decision, not oversight. No endpoint is configured, so the form validates for
real and then says plainly that it cannot deliver, and hands the visitor their
composed enquiry to take elsewhere. It never pretends to have sent anything.

To wire it up, post `src/pages/contact.astro`'s `FormData` to whichever endpoint
gets chosen, and replace the "not sent" branch with a real success state.

---

## Fonts — licence before publishing

Three commercial faces are self-hosted from `public/fonts/`:

| Role | Face |
|---|---|
| Display | Hitmarker Condensed Black |
| Text | Suisse Int'l (400/500/700) |
| Mono | F37 Zagma Mono (300/400/700) |

**Web licences must be cleared before this site goes public.** The originals
live outside the repo; `npm run fonts` re-subsets them from `E:\fonts` and
writes Latin-subset woff2 into `public/fonts/` (~118 kB for all seven cuts).

Faces marked TRIAL in the source library were evaluated and are usable here on
the understanding that licences get bought before launch.

---

## Regenerating the placeholder media

```bash
python scripts/make_placeholders.py            # all 26 clips
python scripts/make_placeholders.py loops      # one group
python scripts/make_placeholders.py hard-split # one clip
```

Requires Python with Pillow, and ffmpeg on PATH. Frames are rasterised as flat
fields and torn-edge silhouettes, then encoded to MP4 with a mid-frame WebP
poster. The whole library is about 1.1 MB.

---

## Accessibility notes

- `prefers-reduced-motion` is honoured properly: loops rest on their poster
  behind a real play control rather than playing more slowly.
- Sound is off until asked for; landscape pieces never autoplay.
- Players are fully keyboard operable — space/k to play, arrows to seek, m to
  mute.
- The staccato reveal only arms itself when scripting is live, so the work is
  never hidden behind a script that failed to run.
