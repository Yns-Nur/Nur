---
name: YNS NUR
description: A Saul Bass title-sequence portfolio — flat saturated act-fields, black cut-paper silhouettes and mono timecode credits for a motion designer's reel, loops, web work and After Effects tools.
colors:
  cardinal: "#c7431c"
  ochre: "#c6852b"
  olive: "#6f7357"
  midnight: "#33505f"
  ink: "#14100e"
  ink-soft: "#2a2320"
  bone: "#ede7da"
  bone-dim: "#d6cfbe"
typography:
  display:
    fontFamily: "'Hitmarker Condensed', 'Haettenschweiler', 'Arial Narrow', sans-serif"
    fontSize: "clamp(3.4rem, 13vw, 12.5rem)"
    fontWeight: 900
    lineHeight: 0.82
    letterSpacing: "0.005em"
  headline:
    fontFamily: "'Hitmarker Condensed', 'Haettenschweiler', 'Arial Narrow', sans-serif"
    fontSize: "clamp(2.6rem, 8.5vw, 7.5rem)"
    fontWeight: 900
    lineHeight: 0.82
    letterSpacing: "0.005em"
  title:
    fontFamily: "'Hitmarker Condensed', 'Haettenschweiler', 'Arial Narrow', sans-serif"
    fontSize: "clamp(1.7rem, 3.6vw, 3.1rem)"
    fontWeight: 900
    lineHeight: 0.9
  body:
    fontFamily: "'Suisse Intl', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif"
    fontSize: "1.0625rem"
    fontWeight: 400
    lineHeight: 1.55
  label:
    fontFamily: "'Zagma Mono', ui-monospace, 'SFMono-Regular', Menlo, Consolas, monospace"
    fontSize: "0.75rem"
    fontWeight: 700
    letterSpacing: "0.16em"
rounded:
  none: "0"
spacing:
  xs: "0.5rem"
  s: "0.875rem"
  m: "1.75rem"
  l: "3.25rem"
  xl: "5.5rem"
  gutter: "clamp(1.25rem, 4.5vw, 4.5rem)"
components:
  button-primary:
    backgroundColor: "{colors.ink}"
    textColor: "{colors.cardinal}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.95em 1.6em"
  button-primary-hover:
    backgroundColor: "{colors.ink}"
    textColor: "{colors.cardinal}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.95em 1.6em"
  button-ghost:
    backgroundColor: "transparent"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.95em 1.6em"
  input-field:
    backgroundColor: "transparent"
    textColor: "{colors.ink}"
    typography: "{typography.body}"
    rounded: "{rounded.none}"
    padding: "0.85em 1em"
---

# Design System: YNS NUR

## Overview

**Creative North Star: "The Saul Bass Title Sequence"**

YNS NUR is built as a title sequence for a person, not a portfolio grid. The direction contract at the top of `src/layouts/Base.astro` states the thesis directly: sections are acts with timecodes, the site navigation is a credit roll, and the CV page is set as what a credit roll already is. The build explicitly refuses "the near-black grid of hover-to-play thumbnails every motion portfolio ships" — there is no card wall, no uniform dark chrome, no thumbnail-then-modal pattern anywhere in the codebase.

The mechanism that carries the whole idea is `[data-field]`: each act of the page sits on one flat, saturated field colour (cardinal, ink, olive, midnight, ochre, bone), reassigning `--field` / `--on-field` / `--silhouette` / `--accent` for everything inside it. There is no gradient, no photographic imagery, and no drop shadow used decoratively — depth and illustration both come from the same device, hand-cut black silhouette shapes (`CutPaper.astro`) laid directly on the field. A silkscreen noise texture sits over the entire viewport via a fixed, `mix-blend-mode: multiply` pseudo-element, so every field — however saturated — reads as printed paper, not a digital gradient.

Type is condensed caps at display scale for names and act titles, a plain grotesque for reading text, and a monospace for every piece of "credit" information — timecodes, labels, act roles. Motion is stepped, not eased: reveals animate with `steps(4, end)`, arriving in cuts rather than glides, and the one recurring interactive gesture across the whole system is a control skewing on hover (`transform: skewX(-7deg)`) rather than changing colour.

**Key Characteristics:**
- One saturated flat field per act, swapped via a single `[data-field]` attribute, never a gradient or photograph
- Black cut-paper silhouettes as the only illustration device (`CutPaper.astro`'s eight hand-authored torn shapes)
- Condensed uppercase display type set off-baseline; mono type for every credit-like fact (timecodes, labels, roles)
- Hover/focus feedback is a skew, not a colour change, on primary controls (`.slab`, form inputs)
- Zero border-radius anywhere in the codebase — every edge is square
- Reveals animate in discrete `steps()`, never with a standard ease curve

## Colors

The palette is six flat, printable field colours plus two near-achromatic extremes; nothing is a tint or gradient of anything else — each is its own hex value in `src/styles/tokens.css`.

### Primary
- **Cardinal** (`#c7431c`): The signature field and default accent. It opens the sequence (Prologue), closes it (End Card, Contact), and is the `--accent` value on three of the six fields (cardinal, olive, bone). It is also the fixed background of `PlaceholderMark`'s overlay tag on every field, so the placeholder marker reads identically no matter which act it sits on.

### Secondary
- **Ochre** (`#c6852b`): Its own field (Tools/`In Situ` neighbour "Tools" act) and the `--accent` on the Midnight field — the one case where a field colour is reused as another field's accent rather than staying purely local.

### Tertiary
- **Olive** (`#6f7357`): The Loops act's field only. Never appears as an accent elsewhere.
- **Midnight** (`#33505f`): The In Situ act's field only. One of two fields where `--on-field` is bone (light-on-dark) rather than ink.

### Neutral
- **Ink** (`#14100e`): Global `<body>` background/text default, the default `--on-field` on four of six fields, and the default `--silhouette` colour.
- **Bone** (`#ede7da`): The Bone act field (The Person section), the global `<body>` text colour, and the `--on-field` on the two dark fields (ink, midnight).
- **Ink Soft** (`#2a2320`): Declared in tokens but not referenced by any current selector — a reserved darker neutral.
- **Bone Dim** (`#d6cfbe`): Declared in tokens but not referenced by any current selector — a reserved dimmer paper tone.

### Named Rules
**The Field Swap Rule.** Every `.act` section (and the footer, independently, always `data-field="ink"`) carries its own `[data-field]` attribute, which reassigns `--field`, `--on-field`, `--accent`, and sometimes `--silhouette` for everything nested inside it. No component hard-codes a field colour; every themed surface reads `var(--field)` / `var(--on-field)` / `var(--accent)` so it repaints correctly under whichever act it lands in.

**The Legible Silhouette Rule.** The direction contract states silhouettes "stay black," but the tokens do not literally hold that line: `--silhouette` defaults to ink and is only overridden to bone on the two fields where ink would vanish against a dark background — `[data-field='ink']` and `[data-field='midnight']`. On the four lighter/mid-saturation fields (cardinal, olive, ochre, bone) silhouettes stay ink. The invariant that actually holds is "silhouettes stay legible against the field," not "silhouettes stay black."

## Typography

**Display Font:** Hitmarker Condensed Black, self-hosted at `/fonts/hitmarker-condensed-black.woff2`, loaded at `font-weight: 900` only (with `'Haettenschweiler', 'Arial Narrow', sans-serif` fallback).
**Body Font:** Suisse Int'l, self-hosted at 400/500/700 in `/fonts/suisse-intl-{400,500,700}.woff2`.
**Label/Mono Font:** F37 Zagma Mono, self-hosted at 300/400/700 in `/fonts/zagma-mono-{300,400,700}.woff2`.

All three are named as commercial faces on the Colophon page (`src/pages/colophon.astro`), which states plainly: "All three are commercial faces. Web licences must be cleared before this site is published." This is a real, unresolved launch blocker, not a stylistic note.

**Character:** A condensed, near-brutalist display face for the name and act titles reads as printed film-credit lettering; a plain, humanist grotesque carries every sentence of reading text without adding its own personality; a monospace carries every fact that behaves like metadata — timecodes, act roles, form labels, plugin distribution states — so "credit information" is typographically distinct from prose at a glance.

### Hierarchy
- **Display** (900, `clamp(3.4rem, 13vw, 12.5rem)`, line-height 0.82): The name on the Prologue and the CV page (`.display`). Always uppercase, letter-spacing 0.005em.
- **Headline** (900, `clamp(2.6rem, 8.5vw, 7.5rem)`, line-height 0.82): Act titles (`.act-title`), set by `ActHead.astro` at the top of every section.
- **Title** (900, `clamp(1.7rem, 3.6vw, 3.1rem)`, line-height 0.9): Card- and figure-level titles (`.title`), e.g. reel/plugin captions.
- **Lead** (400, `clamp(1.05rem, 1.55vw, 1.35rem)`, line-height 1.4, max-width 34ch, `text-wrap: balance`): The one-sentence pitch under a display headline (`.lead`).
- **Body** (400, `1.0625rem`, line-height 1.55): Default reading text; `.prose` caps measure at `62ch` (`--measure`).
- **Label** (700, `0.75rem`, letter-spacing 0.16em, uppercase, mono): Buttons, form field labels, plugin distribution state, credit-roll titles (`.label`).
- **Micro** (400, `0.6875rem`, letter-spacing 0.16em, uppercase, mono, colour `--on-field-dim`): Secondary metadata — kind tags, captions, footer notes (`.micro`).
- **Timecode** (700, mono, tabular numerals, letter-spacing 0.045em, colour `--accent`): The `00:00`-style act markers (`.tc`) — the only text role that is colour-accented by default rather than neutral.

### Named Rules
**The Off-Baseline Rule.** `.off-baseline > *:nth-child(even)` nudges every second line of a multi-line display heading down `0.055em` — "the line never lies down flat," per the source comment. Used on the Prologue name, CV name, contact and end-card titles.

**The Credit-Information-Is-Mono Rule.** Any text that functions like a film credit — a timecode, an act role, a form label, a distribution state, a spec value — is set in Zagma Mono, uppercase, tracked. Any text that functions like prose or a proper name is not.

## Layout

The page is built as a stack of full-bleed `.act` sections (`padding: var(--act-pad-y) var(--gutter)`, no shared max-width container of its own) with an inner `.wrap` (`max-width: 96rem`, centred) applied per-section where content needs a measure. `--gutter` is `clamp(1.25rem, 4.5vw, 4.5rem)` and `--act-pad-y` is `clamp(4.5rem, 11vh, 9rem)`, so horizontal and vertical breathing room both scale with viewport rather than snapping at fixed breakpoints.

The vertical rhythm scale is five steps — `--stack-xs` (0.5rem), `--stack-s` (0.875rem), `--stack-m` (1.75rem), `--stack-l` (3.25rem), `--stack-xl` (5.5rem) — used consistently for margins between headings, blocks and grid gaps rather than one-off values.

Responsive behaviour is grid-based and breakpoint-driven with a recurring `62rem` ("desktop") threshold for two-column layouts (prologue, person, CV columns, contact form) and a `55rem`/`48rem`/`40rem` set for grids of cards (web captures, plugin cards, loop tiles, form rows). Below `62rem` the header's credit-roll navigation collapses into a full-screen overlay panel triggered by a hamburger-style toggle; above it, the roll displays inline as a horizontal list in the sticky header.

The header (`SiteHeader.astro`) is `position: sticky; top: 0`, painted in whatever field the page opened on (the `field` prop passed to `Base.astro`), and does not re-theme as the visitor scrolls through the page's other act fields below it — it is fixed to the entry field for the whole page, not per-act.

## Elevation & Depth

The system is flat by design — no `box-shadow` is used for ambient elevation anywhere. Where a offset shadow does appear, it functions as an illustrated object shadow (paper sitting slightly off the field), always a hard-edged, non-blurred offset in a darkened mix of ink, never a soft ambient glow:

### Shadow Vocabulary
- **Cut-paper lift** (`box-shadow: 14px 14px 0 color-mix(in srgb, var(--ink) 55%, transparent)` on the prologue video frame, `10px 10px 0 color-mix(in srgb, var(--ink) 45%, transparent)` on the `WebCapture` device chrome): A hard, unblurred offset that reads as a cut piece of paper sitting proud of the field behind it — never a diffuse drop shadow.
- **Inset rule box** (`box-shadow: inset 0 0 0 var(--rule) var(--on-field)` — used on `.slab--ghost`, the person aside, the CV note, the contact status box, choice inputs, the tools note): A hairline inset border standing in for a card outline; this is the system's only "container" affordance and it is always a 2px inset stroke, never a filled panel with its own elevation.
- **Card hover lift** (`PluginCard`: `8px 8px 0 var(--on-field)` added on hover/focus alongside a `translate(-4px, -4px)`): The one place a shadow appears only on interaction rather than at rest — the plugin card physically shifts and a hard offset shadow appears behind it, reinforcing the skew-on-hover language with a paper-lift instead.

### Named Rules
**The No-Blur Rule.** Every shadow in the system uses `0` blur radius. Depth is conveyed as a flat offset duplicate of the shape, consistent with the cut-paper illustration language — never a soft, photographic shadow.

## Shapes

Every corner in the codebase is square: `border-radius` is set to `0` explicitly on form inputs and range-slider thumbs, and is simply never set anywhere else (there is no radius scale, and no rounded surface exists in the built site). The one recurring non-rectangular geometry is the authored cut-paper silhouette set in `CutPaper.astro` — eight hand-drawn irregular shapes (`arm`, `disc`, `cone`, `bars`, `arrow`, `rule`, `aperture`, `wheel`), each an intentionally torn/irregular outline rather than a clean geometric icon. These silhouettes are the system's only illustration device; there are no icon-font glyphs and no photographic imagery in the built pages.

## Components

### Buttons (`.slab`)
- **Shape:** Square corners, no radius, generous padding (`0.95em 1.6em`).
- **Primary:** `background: var(--on-field)`, `color: var(--field)` — i.e. the button always inverts the field it sits in, so it never needs its own fixed colour token.
- **Hover / Focus:** `transform: skewX(-7deg)` only — background and text colour never change. `:active` adds `translateY(2px)` on top of the skew.
- **Ghost (`.slab--ghost`):** Transparent background, `box-shadow: inset 0 0 0 2px var(--on-field)` in place of a fill; same skew-only hover behaviour.
- **Accent (`.slab--accent`):** `background: var(--accent)`, `color: var(--field)` — the one `.slab` variant that carries a fixed accent fill rather than inverting the field; not observed in current page usage but defined in `global.css`.

### Radio Choices (`.choice`, contact form format picker)
- **Style:** An inset-stroke box (`box-shadow: inset 0 0 0 2px var(--on-field)`) around a mono label and hint text; the native radio input is visually hidden.
- **Selected state:** Unlike `.slab`, this control fully inverts on `:checked` — `background: var(--on-field); color: var(--field)` — and skews `-4deg` at the same time. This is the one control in the system whose active/selected state recolours rather than relying on skew alone; the skew-only rule holds for hover/press feedback, not for a persistent "this is chosen" state.
- **Focus:** Standard global focus ring (`outline: 4px solid var(--accent)`, offset 3px) on the visually-hidden input, shown when it is keyboard-focused.

### Cards / Containers
- **Corner Style:** Square, no radius.
- **Background:** `PluginCard` (`.pc`): `color-mix(in srgb, var(--on-field) 8%, transparent)` fill plus an inset 2px stroke; on hover/focus the whole card shifts `-4px, -4px` and gains a hard `8px 8px 0` offset shadow in `--on-field`.
- **Border:** 2px inset stroke (`--rule`) is the default container treatment across the CV note, contact status box, tools note, and person aside; a heavier 4px rule (`--rule-heavy`) marks act headers and top-level dividers.
- **Internal Padding:** `clamp(1rem, 2vw, 1.5rem)` on plugin cards; `var(--stack-m)` (1.75rem) on note/aside boxes.

### Inputs / Fields (`.field__input`)
- **Style:** Transparent background, 2px solid border in `--on-field`, `border-radius: 0`, `0.85em 1em` padding.
- **Focus:** Departs from the global focus ring — `outline: none`, replaced by `transform: skewX(-2deg)` plus an inset 2px `box-shadow` in `--on-field`. This keeps text inputs inside the "controls skew" language rather than using the accent-outline treatment used everywhere else.
- **Error / Invalid:** `:user-invalid` sets `border-color: var(--accent)` and an inset accent box-shadow, and reveals a `.field__error` message. This is the one place in the system where a form control does recolour rather than only skewing — reserved for the invalid state specifically.

### Navigation (`SiteHeader.astro`)
- **Style:** Sticky header painted in the page's entry field colour, 2px bottom rule. Wordmark ("YNS NUR" in display type, "Younes Nur" in micro mono beneath) on the left; the credit-roll act list on the right, inline as a horizontal list above `62rem`.
- **Default/hover/active states:** No colour change on any nav item, hover, or current-page state. Instead, a hand-drawn, irregular rule (`clip-path: polygon(...)` under `::after`) scales in from `scaleX(0)` to `scaleX(1)` beneath the item — on hover, focus-visible, or `aria-current="page"`. This is the header's own explicit version of the "no colour change on the live element" rule (stated directly in a source comment).
- **Mobile treatment:** Below `62rem`, the roll becomes a fixed full-viewport overlay panel (same field colour, opened via a hamburger button whose three bars animate into an X), listing each act as a two-column row (timecode / title+role) instead of the desktop's inline strip.

### Distribution State Badge (`PluginState.astro`)
The clearest expression of the system's "state = shape" idea, but not a pure one: state is primarily conveyed by swapping the `CutPaper` silhouette — `free` → arrow, `paid` → disc, `unreleased` → closed aperture — rather than by a coloured pill or badge shape. However, each state also carries its own `currentColor` tint (`free` → `--accent`, `paid` → `--on-field`, `unreleased` → `--on-field-dim` at 75% shape opacity), so the badge is shape-led but not colour-blind: the direction contract's "never by recolouring a badge" claim describes the dominant signal (shape) accurately but not the full implementation, which layers a secondary tonal shift on top.

### Placeholder Mark (`PlaceholderMark.astro`)
A fixed-position tag (`.ph--over`, bottom-right of a media frame) or inline chip (`.ph--inline`) marking authored demonstration media as not-real. Unlike every other coloured surface in the system, it does **not** theme to the local field: `.ph--over` is always `background: var(--cardinal); color: var(--bone)`, so the placeholder marker reads identically and unmistakably regardless of which act field it appears on.

### Video Players (`ReelPlayer`, `LoopTile`, `WebCapture`, `PluginCard`)
Four related but distinct player shells, all built on the same underlying transport logic in `src/scripts/media.ts`:
- **`ReelPlayer`** (horizontal work): starts muted, on user action, with a full transport bar (play/pause, scrub, time, optional mute, fullscreen) once playing; fully keyboard-operable (space/k to play-pause, arrows to seek, m to mute) once the player has focus.
- **`LoopTile`** / **`WebCapture`** / **`PluginCard`**: silent, looping, autoplay-on-intersection via a shared `IntersectionObserver` (`160px` root margin, `0.15` threshold) that plays when scrolled into view and pauses when scrolled out; under `prefers-reduced-motion: reduce` they never autoplay and instead show an explicit play button over the poster frame.
- **`WebCapture`** additionally wraps its screen in a hand-styled "browser chrome" (`.cap__device`) — three small square dots and a URL bar rendered as a flat cut-paper object with a hard offset shadow, deliberately not a glossy device mockup.

## Do's and Don'ts

### Do:
- **Do** theme every surface through `var(--field)` / `var(--on-field)` / `var(--accent)` / `var(--silhouette)`, never a hard-coded hex, so a component repaints correctly under any `[data-field]` ancestor.
- **Do** use `steps(4, end)` (`--steps-cut`) for reveal animation and `cubic-bezier(0.16, 0.9, 0.2, 1)` (`--ease-slam`) for skew/press transitions — never a standard linear or ease-in-out curve, per the "Bass cuts; he does not tween" comment in `tokens.css`.
- **Do** keep every corner square (`border-radius: 0`); there is no radius scale to draw from.
- **Do** set credit-like metadata (timecodes, roles, labels, spec values) in Zagma Mono, uppercase, letter-spaced; keep prose in Suisse Int'l.
- **Do** gate any hide-until-revealed content behind the `.cuts` class added by the inline head script, and give it a working default appearance with `.cuts` absent — a portfolio that depends on an observer firing to show its work is one failed script load from empty (verbatim rationale in `global.css`).
- **Do** honour `prefers-reduced-motion`: replace autoplay with poster-plus-explicit-play-control, not merely a slower or shorter animation.

### Don't:
- **Don't** recolour `.slab` buttons or `.field__input` on hover/focus — the system's default interaction feedback is a `skewX` transform, not a colour or background change.
- **Don't** add a soft, blurred `box-shadow` anywhere — every shadow in the system is a hard `0`-blur offset duplicate, in keeping with the cut-paper illustration language.
- **Don't** assume "silhouette = black": `--silhouette` is bone (light) on the two dark fields (`ink`, `midnight`) and ink (dark) on the four lighter fields. The invariant is legibility against the field, not a fixed colour.
- **Don't** invent client names, testimonials, metrics, or real URLs anywhere in new content — every current media item, employer beyond SILA Digital, and web-section URL is placeholder by product decision and must carry a `PlaceholderMark`.
- **Don't** wire the contact form to an endpoint or make it appear to send — it is intentionally unwired; its honest failure state (compose-and-copy, never "sent") is a product decision, not a bug to fix silently.
