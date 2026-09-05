# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

Astro, static output. Assumed rather than re-asked: the user settled this in an earlier session on reasoning that still holds — near-zero client JS on a page where every tile is a video, real components so four page families stay maintainable, and content collections so replacing placeholder work with real work is a content-file edit rather than markup surgery. One word from the user overturns it.

## Users

**Primary — a prospective client evaluating whether Younes can execute a specific piece.** In practice: studio and agency producers, project managers (the role that assigns his work at SILA Digital today), and startup founders. They arrive from a link in a DM, an email, or a job thread, usually on a phone, usually with one format already in mind — "I need a logo animation", "I need a preloader", "I need a 30-second explainer". Their job is to decide in under a minute whether this person can do *their* thing, then to make contact with enough scope attached that the reply is useful.

**Secondary — a motion designer arriving for the plugins.** Different job entirely: does this tool solve a problem I have in After Effects today, what does it cost, how do I install it. They may never look at the portfolio.

The two audiences do not blend. A prospective client should never have to read plugin install instructions to find the work, and a designer arriving for a plugin should be able to get to it in one click from anywhere.

## Product Purpose

Replace a scatter of Google Drive folders, Instagram posts and DM'd links with one owned surface that plays the work.

The current state of the craft — visible in the sample resume supplied as a format reference — is that a motion designer's portfolio is a page of links to other people's platforms. Every link is an exit, a login wall, or a folder of unlabelled MP4s. The work stops being work and becomes a file listing.

Success is: a visitor watches actual motion within seconds of arriving, understands which of the three formats they are looking at, and either sends a scoped enquiry or takes a plugin away with them.

## Positioning

Younes both animates and builds the tools that produce the animation. The portfolio and the plugin catalogue are the same person's output, not a side project bolted onto a CV.

This is materially uncommon: motion designers who ship After Effects extensions are rare, and the combination is provable on the surface itself — the plugin runs inside the software the work was made in. A neighbouring portfolio can claim taste; it cannot truthfully claim it built the tooling.

## Operating Context

The work exists in **three genuinely different delivery formats**, and this is a product fact, not a categorisation convenience. Each has its own native ratio, duration, sound behaviour and evaluation criteria:

1. **Horizontal motion graphics** — broadcast/landscape ratio, seconds to minutes long, frequently has audio, watched deliberately. Explainers, campaign pieces, brand films.
2. **Square loops (1080×1080)** — seconds long, silent, endless. Logo animations, preloaders, small motion pieces. These are evaluated in aggregate — several playing at once — not one at a time.
3. **Web / interaction animation** — animation that shipped inside a website. Preloaders, transitions, interactive states. The artefact is the live site; what the portfolio can show is a capture, so the capture needs its context (which site, which part, what it was built in).

Handoff to developers happens through Lottie/Bodymovin and Rive, which is why the web section can name a handoff format truthfully.

Tools in daily use: After Effects, Rive, Figma, Adobe Illustrator, occasionally Blender.

## Capabilities and Constraints

- Static site, no server. Output stays host-agnostic; **deploy target and domain are deliberately undecided** and must not be baked into the build.
- **The contact form ships unwired** by user decision: a fully working, fully validated front end with no backend endpoint. The submit path must fail honestly and visibly rather than pretending to send.
- Video is self-hosted by default. Each work item may instead declare an external embed, so individual pieces can move to a streaming host later without a layout change.
- Plugins are **mixed distribution**: each declares its own state — free download, paid (external store link), or not yet released. The plugin page must render all three without looking broken in any of them.
- English only.
- **Undecided:** deploy target; domain; contact email; form provider account; social links for the footer.

## Brand Commitments

- The site brands itself **YNS NUR** — nav, page titles, favicon, resume header. (Chosen over "NURR" and over a mark/full-name split.)
- The person is **Younes Nur**.

## Evidence on Hand

**Real:**

- **Orbit** — a radial command wheel for After Effects, built as a functional equivalent of RadialFX with per-effect dialled-in parameters and the ability to capture a look off an already-graded layer. Installs as a CEP extension via PowerShell, no admin rights. Source and documentation at `C:\CLAUDE\orbit-ae` and `C:\CLAUDE\orbit-ae-v2`, including UI screenshots under `docs/`. Release status and price are undecided.
- Six years of motion design experience; current position at SILA Digital (Serbia).

**Not on hand, and must not be fabricated:**

- Every portfolio video and still. All media in the first build is authored placeholder material, marked as such in content and rendered with a visible marker.
- Client names, campaign names, and any live URL in the web section.
- Testimonials, awards, view counts, client logos, availability claims, rates.
- CV specifics — employers beyond SILA Digital, dates, education, certificates. The sample PDF supplied (`AlirezaGharibi-Resume-V3.pdf`) belongs to a different person and was provided **only** to show the expected shape of a resume section. None of its content — name, contact details, employers, education, certificates or links — appears anywhere in the build.

## Product Principles

1. **The work plays, it is not described.** Any viewport that talks about motion instead of showing it has failed. Text serves the video; it never substitutes for it.
2. **Three formats, three treatments.** A landscape film, a square loop and a web preloader are not the same object at different crops. One gallery grid with a filter bar would flatten the one thing that is actually true about this body of work.
3. **Placeholder never poses as real.** Authored demonstration material is legitimate and gets built at full fidelity; a claim a competitor could check — a client, a metric, a testimonial — is not inventable. Everything synthetic is labelled and appears on a replacement list.
4. **An enquiry arrives scoped.** The contact path collects format, budget and timeline, because an unscoped "I like your work" costs two round-trips before it is useful.
5. **Two audiences, one surface, no blending.** Client-facing work and designer-facing tools each reach their goal without passing through the other.

## Accessibility & Inclusion

No user-specific requirement was established. The product-driven baseline: on a site made of autoplaying loops, `prefers-reduced-motion` must be genuinely honoured (poster frame plus an explicit play control, not a slower animation), sound is off until asked for, and every player is fully keyboard-operable — a custom control surface that only responds to a mouse would put the entire portfolio out of reach.
