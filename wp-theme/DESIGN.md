---
name: Sofreh
description: A Persian, phone-first WooCommerce storefront in the familiar Iranian marketplace convention, built to full craft.
colors:
  accent: "#d1352f"
  accent-deep: "#b32a25"
  accent-soft: "#fdecea"
  teal: "#1f6f6a"
  banner-ink: "#2a2f37"
  ground: "#f3f4f6"
  surface: "#ffffff"
  line: "#e6e8eb"
  line-strong: "#d3d6db"
  ink: "#1f2328"
  muted: "#62666d"
  placeholder: "#6f737a"
  success: "#1a7f45"
  success-soft: "#e7f5ec"
  success-ink: "#155c34"
  info-soft: "#eaf1fb"
  info-ink: "#1d3f6b"
  error-ink: "#8c211d"
  warning-soft: "#fff4e0"
  warning-ink: "#7a4d00"
  star: "#f0a62b"
  focus: "#1f6fd1"
typography:
  display:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "clamp(1.35rem, 1rem + 1.8vw, 2.4rem)"
    fontWeight: 700
    lineHeight: 1.4
    fontFeature: '"ss01"'
  headline:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "clamp(1.35rem, 1.1rem + 1vw, 1.75rem)"
    fontWeight: 700
    lineHeight: 1.5
    fontFeature: '"ss01"'
  title:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "clamp(1rem, 0.9rem + 0.4vw, 1.2rem)"
    fontWeight: 700
    lineHeight: 1.5
    fontFeature: '"ss01"'
  body:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.8
    fontFeature: '"ss01"'
  body-small:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.875rem"
    fontWeight: 400
    lineHeight: 1.8
    fontFeature: '"ss01"'
  product-name:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.8125rem"
    fontWeight: 500
    lineHeight: 1.75
    fontFeature: '"ss01"'
  price:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.9375rem"
    fontWeight: 700
    fontFeature: '"ss01", "tnum"'
  price-lead:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "1.375rem"
    fontWeight: 700
    fontFeature: '"ss01", "tnum"'
  button:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.9375rem"
    fontWeight: 700
    lineHeight: 1.5
    fontFeature: '"ss01"'
  label:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.8125rem"
    fontWeight: 500
    lineHeight: 1.5
    fontFeature: '"ss01"'
  badge:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.75rem"
    fontWeight: 700
    lineHeight: 1.8
    fontFeature: '"ss01"'
  tab-label:
    fontFamily: '"Vazirmatn FD", Tahoma, "Segoe UI", sans-serif'
    fontSize: "0.6875rem"
    fontWeight: 500
    fontFeature: '"ss01"'
  latin-data:
    fontFamily: '"Vazirmatn", Tahoma, "Segoe UI", sans-serif'
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.5
    fontFeature: "normal"
rounded:
  sm: "6px"
  md: "10px"
  lg: "16px"
  pill: "999px"
  round: "50%"
spacing:
  gutter: "clamp(12px, 3vw, 24px)"
  gap: "clamp(12px, 2vw, 20px)"
  frame-inline: "clamp(14px, 2vw, 20px)"
  panel: "clamp(16px, 2.5vw, 24px)"
  panel-reading: "clamp(16px, 3vw, 32px)"
  cell: "14px 14px 16px"
  cell-phone: "10px 10px 12px"
components:
  button-primary:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    typography: "{typography.button}"
    rounded: "{rounded.sm}"
    padding: "0.55em 1.25em"
    height: "44px"
  button-primary-hover:
    backgroundColor: "{colors.accent-deep}"
    textColor: "{colors.surface}"
  button-ghost:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.button}"
    rounded: "{rounded.sm}"
    padding: "0.55em 1.25em"
    height: "44px"
  button-card:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.sm}"
    padding: "0 10px"
    height: "38px"
    width: "100%"
  button-card-hover:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
  button-buy:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    typography: "{typography.button}"
    rounded: "{rounded.sm}"
    height: "48px"
  button-place-order:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    rounded: "{rounded.sm}"
    height: "52px"
    width: "100%"
  input:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.body}"
    rounded: "{rounded.sm}"
    padding: "0.55em 0.9em"
    height: "46px"
  input-search:
    backgroundColor: "{colors.ground}"
    textColor: "{colors.ink}"
    typography: "{typography.body}"
    rounded: "{rounded.md}"
    padding: "0 44px 0 14px"
    height: "48px"
  chip:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.pill}"
    padding: "4px 14px"
    height: "38px"
  badge-discount:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    typography: "{typography.badge}"
    rounded: "{rounded.pill}"
    padding: "1px 7px"
  badge-soldout:
    backgroundColor: "{colors.muted}"
    textColor: "{colors.surface}"
    typography: "{typography.badge}"
    rounded: "{rounded.pill}"
    padding: "1px 8px"
  cart-count:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    typography: "{typography.badge}"
    rounded: "{rounded.pill}"
    padding: "0 4px"
    size: "18px"
  panel:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.lg}"
    padding: "{spacing.panel}"
  product-cell:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    padding: "{spacing.cell}"
  product-media:
    backgroundColor: "{colors.ground}"
    rounded: "{rounded.sm}"
  deals-frame:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    rounded: "{rounded.lg}"
    padding: "16px 0"
  buy-box:
    backgroundColor: "{colors.ground}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: "16px"
  buy-bar:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    padding: "10px clamp(12px, 3vw, 24px)"
  header:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    height: "72px"
  tabbar:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.muted}"
    typography: "{typography.tab-label}"
    height: "64px"
  tabbar-item-current:
    textColor: "{colors.accent}"
  banner:
    backgroundColor: "{colors.teal}"
    textColor: "{colors.surface}"
    typography: "{typography.display}"
    rounded: "{rounded.lg}"
    padding: "clamp(20px, 4vw, 56px)"
    height: "clamp(200px, 30vw, 340px)"
  banner-button:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.button}"
    rounded: "{rounded.sm}"
    padding: "0 18px"
    height: "42px"
  category-circle:
    backgroundColor: "{colors.ground}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.round}"
    size: "clamp(64px, 16vw, 92px)"
  qty-stepper:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.accent}"
    rounded: "{rounded.sm}"
    height: "46px"
  notice-success:
    backgroundColor: "{colors.success-soft}"
    textColor: "{colors.success-ink}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
  notice-info:
    backgroundColor: "{colors.info-soft}"
    textColor: "{colors.info-ink}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
  notice-error:
    backgroundColor: "{colors.accent-soft}"
    textColor: "{colors.error-ink}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
---

# Design System: Sofreh

## Overview

**Creative North Star: "The Well-Kept Marketplace"**

Sofreh is the Iranian online marketplace every shopper already knows, played straight: a search field up front, a swipeable banner, a row of round category shortcuts, a red strip of special offers, dense product cells with the discount beside the price, and a tab bar under the thumb. The benchmark for familiarity and finish is Digikala; the store never borrows its name, logo, exact red or assets. Convention is the commitment. Nothing here is a concept layout or a decorative world, so quality has to show in the things shoppers feel without naming: price rows that line up across a shelf, Persian digits everywhere, 44px targets, honest empty states, and speed.

The material is plain and cool: white panels laid on a light grey ground, one coral-red that means buying and saving, deep ink text with a quiet grey for everything secondary, 1px hairlines, and round-capped line icons. Density is marketplace density, not editorial air: product cells sit edge to edge, divided by hairlines, and panels are separated by a single 12–20px gap. The phone is the store (about 80% of visits): every layout is designed at 390px first, and desktop extends it with a search-led header, a category mega menu, shelf arrows, and a sticky buy box.

Motion is moderate and purposeful. There is one authored moment, add to cart: the product's own image arcs into the cart and the count bumps. Around it sit a few working motions: a banner that swipes and autoplays but yields to the shopper, a hover-intent category menu, and drawers that slide in from the reading edge. Everything else is short state feedback, and all of it switches off under reduced motion.

**Key Characteristics:**
- Familiar marketplace structure, executed precisely; no invented layouts.
- White panels on a cool grey ground, one container level deep.
- One red for actions and offers; a deeper red for reading links.
- Vazirmatn throughout, Persian digits through `ss01`, line-height 1.8.
- Phone-first shell: two-row header, bottom tab bar, phone buy bar.
- One authored motion moment (add to cart), and nothing moves under reduced motion.

## Colors

A cool, nearly colourless field (white on light grey, ink text) with one confident coral-red doing the commercial work.

### Primary
- **Offer Red** (#d1352f): primary buttons and add to cart, the discount pill, the special-offers strip, the cart count, the text wordmark, the current tab-bar item, sort link and product tab, the mega-menu underline, "View all" links, required-field asterisks and invalid-field borders. White on Offer Red is 4.93:1. As text it reads 4.93:1 on white but only 4.48:1 on the grey ground.
- **Deep Offer Red** (#b32a25): hover and focus for primary buttons, and the colour of running text links (6.41:1 on white, 5.83:1 on the ground). Links turn ink on hover.
- **Blush Wash** (#fdecea): error notices, weak-password meter, remove-button and quantity-stepper hover fills.

### Tertiary
- **Banner Teal** (#1f6f6a): one of three banner backgrounds, and the default for the first slide. White text on it is 5.93:1.
- **Banner Charcoal** (#2a2f37): the second banner tone. The third tone is Offer Red.

### Neutral
- **Cool Shelf Grey** (#f3f4f6): the page ground under every panel; also image wells, the header search field, the buy box, the review form well, table header cells and icon-button hover fills.
- **Panel White** (#ffffff): every panel, frame, header, tab bar, drawer and product cell.
- **Hairline** (#e6e8eb): dividers between product cells, table rows, drawer sections and header edges.
- **Control Rule** (#d3d6db): the stroke on inputs, ghost buttons, chips, the quantity stepper and the card add-to-cart button; also the unfilled stars.
- **Ink** (#1f2328): all primary text, headings, prices, ranking numerals, the current pagination page, and the announcement and store-notice bars.
- **Quiet Grey** (#62666d): secondary text such as breadcrumbs, result counts, old prices, the currency name, footer links, inactive tabs and the sold-out badge (5.77:1 on white).
- **Placeholder Grey** (#6f737a): input placeholders only (4.76:1 on white).

### Functional
- **In-Stock Green** (#1a7f45) with **Mint Wash** (#e7f5ec) and **Deep Green Ink** (#155c34): stock status, success notices, the order-received banner and the tracking-code row of the confirmation card.
- **Info Wash** (#eaf1fb) with **Info Navy** (#1d3f6b): info notices and the phone-login hint.
- **Error Maroon** (#8c211d): text on Blush Wash in error notices and failed order statuses.
- **Caution Wash** (#fff4e0) with **Caution Brown** (#7a4d00): the "medium" password meter and the save-your-password warning.
- **Rating Amber** (#f0a62b): the filled part of star ratings, nothing else.
- **Focus Blue** (#1f6fd1): the 2px focus outline and the field focus border with its soft 3px ring.

### Named Rules
**The Red Means Buying Rule.** Offer Red marks only what moves a purchase or shows where you are: actions, discounts, the offers strip, the cart count and current-state indicators. Sale prices stay ink and headings stay ink. The only large red fields are the offers strip and the merchant's optional red banner slide.

**The Deep Red for Reading Rule.** Offer Red is used as text only on white. Any red text that sits on the grey ground, and every running text link, uses Deep Offer Red.

**The Teal Stays in the Banner Rule.** Banner Teal and Banner Charcoal are banner backgrounds and nothing else. They never appear on buttons, text or interface chrome.

## Typography

**Display Font:** Vazirmatn FD (with Tahoma, Segoe UI, sans-serif)
**Body Font:** Vazirmatn FD (with Tahoma, Segoe UI, sans-serif)
**Label/Mono Font:** plain Vazirmatn (with Tahoma, Segoe UI, sans-serif) for fields and values that hold Latin data

**Character:** One family, set like a working store rather than a magazine. Vazirmatn's open Persian forms carry everything from banner headlines to 11px tab labels, and the hierarchy comes from size and weight steps (Regular 400, Medium 500, Bold 700), never from a second face.

### Hierarchy
- **Display** (Bold, clamp(1.35rem → 2.4rem), 1.4): banner headlines only. The first slide's headline is the page's h2, and the rest are paragraphs.
- **Headline** (Bold, clamp(1.35rem → 1.75rem), 1.5): page titles (h1). Product titles use a close step (clamp(1.1rem → 1.45rem), 1.6).
- **Title** (Bold, clamp(1rem → 1.2rem), 1.5): shelf, ranking and archive section titles. Panel headings inside store pages are 1.05rem Bold.
- **Body** (Regular, 1rem, 1.8): all running text, with headings balanced (`text-wrap: balance`). Reading pages cap at 860px, and descriptions at 72ch.
- **Body small** (Regular, 0.875rem): descriptions, meta, menu links and footer text.
- **Product name** (Medium, 0.8125rem, 1.75): product cells, clamped to exactly two lines (3.5em) so every cell's price row starts at the same height.
- **Price** (Bold, 0.9375rem in cells, 1.375rem in the buy box, 1.0625rem in the buy bar, tabular figures): always ink. Old prices are Quiet Grey Regular at 0.8em, struck through. The currency name is Quiet Grey Regular at 0.78em.
- **Label** (Medium, 0.8125rem): category-circle names, sort links, breadcrumbs, promise lines and chips. Form labels step up to 0.9375rem Medium.
- **Badge** (Bold, 0.75rem, 1.8): discount, sold-out and cart-count pills.
- **Tab label** (Medium, 0.6875rem): bottom tab bar captions under 24px icons.
- **Ranking numeral** (Bold, 1.75rem, line-height 1, Ink): best-seller positions.

### Named Rules
**The Persian Digits Rule.** Everything a shopper reads uses Vazirmatn FD with `ss01` switched on explicitly, so ASCII digits draw as Persian even when isolated (an old price, a badge). Stored data keeps ASCII digits. Fields and values that hold Latin data (email, URL, password, SKU, tracking code, generated credentials) switch to plain Vazirmatn with features off, set LTR and isolated. Phone and postcode fields stay in the Persian-digit face and convert typed Persian digits to ASCII.

**The No Tracking Rule.** Persian text never gets letter-spacing or a text transform. Emphasis comes from weight (500 or 700) or size.

## Layout

The page is a single centred column, at most 1336px wide, with a fluid gutter (12–24px). Content arrives as stacked white panels separated by one fluid gap (12–20px), from the banner down to the footer. Inside a panel, horizontal frame padding is 14–20px, panel padding is 16–24px (16–32px on reading pages), and product cells pad 14px (10px on phones).

**Phone shell (960px and below).** The header becomes two rows: menu, store name and account/cart icons on top, and a full-width 44px search field below. The desktop category row disappears into a drawer. A 64px tab bar (home, categories, cart, account) is fixed to the bottom edge plus the safe-area inset, and the body reserves that height. Anything else fixed to the bottom (the product buy bar, WooCommerce's store notice) stacks directly above the tab bar.

**Desktop.** The 72px header runs brand, then a search field up to 640px wide, then account and cart. Below it, a 44px category row holds the mega-menu toggle, a short vertical rule and the primary menu. Product listings get a 280px sticky filters panel beside the grid. Shelves gain arrow buttons (hover devices at 961px and up).

**Product grids.** Four columns, three at 1100px and below, two at 700px and below. Beside the filters panel the grid auto-fills cells of at least 210px. Home shelves scroll sideways with cells of 158–200px (42vw on phones) and snap to start.

**Product page.** Gallery and summary sit at 0.9fr to 1.5fr. Above 1180px the summary splits again into facts and a 260–320px buy box that sticks under the header. At 1180px the buy box drops under the facts, and at 760px everything stacks into separate white panels with the phone buy bar.

**Store pages.** Cart, checkout, account and order pages have no outer panel. Each part is its own panel on the ground: cart items, then totals at 380px; checkout details at 1.4fr beside the order review at 1fr (stacked at 900px); the account menu at 250px beside the content (stacked at 860px).

### Named Rules
**The One Container Level Rule.** A white panel sits on the grey ground, and that is the only level of container. Zones inside a panel are separated by hairlines or set in a Cool Shelf Grey well. A white, shadowed card never sits inside another white panel.

**The Thumb Zone Rule.** Below 961px the bottom 64px (plus safe area) belongs to the tab bar. Fixed elements stack above it, never over it, and touch targets stay at 44px or more (drawer rows are 48px).

## Elevation & Depth

Depth is mostly tonal: white panels lifted off a grey ground, with a whisper of shadow so the panel edge holds on low-contrast screens. Real shadow is kept for things that float over content: drawers, dropdowns, the mega menu, shelf arrows and the flying cart image. Hairlines between product cells are drawn as 1px shadows so the panel's outer edge stays clean, and cells lift on hover.

### Shadow Vocabulary
- **Resting panel** (`box-shadow: 0 1px 2px rgb(31 35 40 / 6%)`): every white panel and frame on the ground.
- **Floating** (`box-shadow: 0 2px 6px rgb(31 35 40 / 6%), 0 12px 32px -12px rgb(31 35 40 / 18%)`): drawers, the filters drawer, sub-menus, shelf arrows, the skip link and the flying cart image.
- **Cell lift on hover** (`box-shadow: 0 0 0 1px #e6e8eb, 0 12px 32px -14px rgb(31 35 40 / 28%)`): a product cell under the pointer.
- **Mega panel drop** (`box-shadow: 0 24px 40px -24px rgb(31 35 40 / 35%)`): the full-width category panel under the header.
- **Edge shadows** (header when scrolled: `0 1px 0 #e6e8eb, 0 8px 20px -16px rgb(31 35 40 / 40%)`; tab bar and buy bar: the same idea pointing up): fixed bars over scrolling content.

### Named Rules
**The Two Shadows Rule.** Anything resting on the ground gets the resting shadow, and anything floating over content gets the floating pair. Full-width bars and the mega panel use its edge variants. Shadow never stands in for emphasis.

## Shapes

The corners are softly rounded and step up with size. Small (6px) goes on things you press or type into, and on images inside cells: buttons, inputs, the quantity stepper, product media, thumbnails. Medium (10px) goes on inner frames and notices: the buy box, gallery images, notices, payment-method rows, header action hovers, and the outer ends of the offers-strip row. Large (16px) goes on panels: every frame, the banner, store panels, the filters sidebar and the confirmation card. Pills (999px) are for counts and short labels: discount and sold-out badges, chips, the cart count, carousel dots and order-status tags. Full circles are reserved for category shortcuts and for round controls that are not text buttons: banner previous/next/pause, shelf arrows, the gallery zoom, cart remove buttons and avatars.

Product cells themselves are square-cornered. The rounding belongs to the grid's panel, and cells divide it with hairlines. Strokes are 1px throughout. The only heavier lines are state indicators: the 2px underline on the current tab, sort link and mega toggle, and the 3px top bar on the current tab-bar item.

Icons come from one inline line set: a 24px grid, round caps and joins, `currentColor` strokes (1.6, in the inline set and in the CSS masks for the remove cross, select chevron, check and quantity plus/minus; stars are filled shapes). They are always decorative (`aria-hidden`), and the control carries its own name.

## Components

### Buttons
Solid, compact and unmistakable.
- **Shape:** gently rounded (6px), at least 44px tall, Bold 0.9375rem.
- **Primary:** Offer Red with white text, padding 0.55em × 1.25em. It deepens to Deep Offer Red on hover and presses to 98% scale. Single-product add to cart is 48px, proceed to checkout 50px, and place order 52px and full width.
- **Ghost:** white with a Control Rule border and ink text. The border turns ink on hover. Used for filters, coupon and update-cart actions, and notice actions.
- **Card add to cart:** full-width 38px ghost at 0.8125rem that fills Offer Red with white text on hover, so a shelf of cards reads quietly until one is chosen. While loading it fills red, its label hides and a white ring spins.
- **Disabled:** 50% opacity, not-allowed cursor.
- **Icon buttons:** 44 × 44px, transparent, with a Cool Shelf Grey fill on hover.

### Chips
- **Style:** white pills, 38px tall, with a Control Rule border, ink label (0.8125rem) and a muted count. They scroll sideways in one row under archive titles.
- **State:** the border and text go ink on hover. Chips are navigation links, not toggles.

### Cards / Containers
- **Corner Style:** panels at 16px; inner wells at 10px.
- **Background:** Panel White on the Cool Shelf Grey ground; inner wells in Cool Shelf Grey.
- **Shadow Strategy:** the resting panel shadow only (see Elevation & Depth).
- **Border:** none on panels. Hairlines divide the inside.
- **Internal Padding:** 16–24px for store panels, 16px vertical with 14–20px inline for shelf frames.

### Product Card
The dense marketplace cell, built so a whole row scans as one line.
- **Media:** a square image on Cool Shelf Grey, 6px corners. It zooms to 104% over 0.4s on hover. Only the sold-out badge (Quiet Grey pill) sits on the photo, at its top end corner.
- **Name:** Medium 0.8125rem, two lines exactly.
- **Price row:** the discount pill (the rounded percentage in Persian digits, e.g. «۱۶٪», with "16% off" for screen readers) sits at the row's start. The current price (Bold, ink, tabular) sits at the row's end. The old price takes its own full-width line beneath, aligned to the end. Cells with no old price keep that line empty, so prices align across the row.
- **Variable products:** when options cost different amounts, the cell shows «از» plus the lowest price instead of a two-price range. Products on sale with no computable percentage show a "Sale" pill.
- **Action:** the card add-to-cart button pinned to the bottom of the cell.

### Inputs / Fields
- **Style:** white, 46px tall, a 1px Control Rule stroke, 6px corners, inherited font, Offer Red caret. Selects carry a drawn chevron at the inline end.
- **Focus:** the border turns Focus Blue with a soft 3px Focus Blue ring at 18%. Every other control gets a 2px Focus Blue outline offset by 2px.
- **Error:** the invalid field's border turns Offer Red, with a 0.8125rem Offer Red message beneath.
- **Latin data:** email, URL and password fields are LTR in plain Vazirmatn. They stay right-aligned while showing their Persian placeholder.
- **Search:** the header search is a borderless Cool Shelf Grey field (10px corners, 48px desktop, 44px phone) with the search icon at its start. It turns white on focus.
- **Quantity stepper:** one 6px-cornered white control with the number in Bold, flanked by 38px plus and minus steps (line-icon masks, not typed characters) in Offer Red with a Blush Wash hover. It takes the field focus ring as a group.
- **Password meter:** a reserved slot under the field, so its appearance never moves the submit button.

### Navigation
- **Header:** white, sticky, separated by a hairline. It gains a soft edge shadow once the page scrolls. The text wordmark is Offer Red Bold (1.6rem, 1.35rem on phones). A merchant logo replaces it at up to 44px tall.
- **Account and cart:** guests on desktop see a bordered "Log in | Sign up" action. On phones it shrinks to the user icon, with its label kept for screen readers. The cart is a bag icon whose count sits on the bag's top corner as an 18px Offer Red pill with a 2px white knock-out ring, hidden at zero.
- **Category mega menu (desktop):** a "Product categories" toggle with a grid icon and a 2px Offer Red underline when hovered or open. The full-width white panel drops 6px into place (0.22s). Columns auto-fill at 190px or more, with each parent category in ink Bold over its children in Quiet Grey.
- **Drawer (phone):** slides in from the reading edge, up to 360px wide (86vw), over a 45% dark backdrop, with focus trapped and Escape to close. Categories form a `<details>` tree with 48px rows. The chevron rotates on open and "All products" is set in Offer Red.
- **Bottom tab bar (phone):** four equal items (home, categories, cart, account), each a 24px icon over a tab label in Quiet Grey. The current item turns Offer Red with a 28 × 3px bar on its top edge. The cart item carries the same count pill.
- **Footer:** a white band with a hairline top, muted links that turn ink on hover, the store name in Offer Red, and a small bordered "Back to top" action.

### Banner Carousel
- Full-container frame with 16px corners. Each slide sets a white Display headline, a short line at 88% white (40ch max) and a white 42px button in ink on Banner Teal, Banner Charcoal or Offer Red, with an optional square product image beside it. On phones the copy sits low and the image shrinks.
- Native scroll-snap means it swipes with no script. The script adds dots in a translucent dark capsule (the current dot stretches from 8px to 22px), white round previous/next buttons (above 700px), and a pause/play button.
- Autoplay advances every 6s. It pauses while the pointer, a touch or keyboard focus is inside, and stays paused once the shopper presses pause. Under reduced motion it never starts and the pause button is hidden.

### Category Shortcuts
- One white panel holding a row of round images (64–92px circles on Cool Shelf Grey) with Medium 0.8125rem names under them. The row scrolls sideways on phones. A category without an image shows its initial in Offer Red.
- On hover the circle rises 3px and gains a thin Control Rule ring.

### Shelves, Offers Strip and Ranking
- **Shelf frame:** a white panel with a title row (Title on the start side, a "View all" link in Offer Red Bold with a chevron that nudges forward on hover) over a sideways-scrolling row of product cells divided by hairlines.
- **Special-offers strip:** the same frame filled with Offer Red. The title and "View all" turn white, and the white cells stand apart by 4px gaps of red, with the row's two outer ends rounded at 10px.
- **Best-seller ranking:** a numbered list in three columns (one at 900px and below). Each row shows a large ink numeral, a 72px thumbnail, a two-line name and the price, with hairlines between rows. The name turns Offer Red on hover. It appears only when products have actually sold.

### Store Promises Strip
- One white panel with up to four promises, each a 28px line icon in ink over a Quiet Grey Medium line (two by two with the icon beside the line on phones). Every promise is empty by default, and an empty promise is hidden, so the store states only what the merchant writes. The product page's store note works the same way.

### Listing Toolbar and Filters
- The archive title sits in its own white panel with the category chips. The toolbar attaches to the top of the product grid's panel: on desktop, sort options as a row of links (current one Offer Red Bold with a 2px underline) and the result count at the end. On phones the toolbar shows WooCommerce's native sort select on Cool Shelf Grey and a ghost "Filters" button that opens the filters panel as a drawer.

### Product Page
- **Gallery:** 10px-cornered images, a round white zoom button, and 64px thumbnails at 70% opacity that sharpen with an ink border when active.
- **Facts:** title, rating, short description and meta (the SKU in Latin-digit type), divided by hairlines.
- **Buy box:** a Cool Shelf Grey well (10px corners, 16px padding) that sticks under the header on wide screens. The discount pill sits beside the price (1.375rem, old price first), followed by stock in In-Stock Green, options, the quantity stepper with a 48px add to cart, and the optional store note.
- **Phone buy bar:** fixed above the tab bar once the buy box scrolls away. It slides up into place over 0.3s and shows the price on one side and a primary button (at least 46% wide, 46px) on the other. The button presses the real add to cart, or scrolls to the options when a choice is needed.
- **Tabs:** a sticky row of text tabs with an Offer Red underline on the current one.

### Store Pages, Tables and Notices
- **Panels:** every part of cart, checkout, account and order received is its own white panel. Tables inside a panel drop their own frame.
- **Phone cart rows:** a compact grid with the 72px photo at the start, the name and unit price beside it, and a round remove button at the end. The quantity stepper and the Bold line total share the last row.
- **Responsive tables:** at 760px and below, rows become label/value lines, each value labelled in Quiet Grey.
- **Payment methods:** 10px-cornered rows with a hairline border that turns ink when chosen.
- **Notices:** 10px-cornered washes (Mint Wash, Info Wash or Blush Wash) with dark text of the same hue and links in the same colour, Bold. They fade in over 0.3s and carry no focus ring when WooCommerce moves focus to them.

### Phone-Account Confirmation Card
- A 16px-cornered card with a hairline border, in rows. The tracking row is Mint Wash with a round In-Stock Green check that pops in. The tracking code and credentials sit in dashed-border Latin-digit boxes (user-select: all) with a copy button whose label crossfades to a green "Copied". A Caution Wash line asks the customer to save the password. The card rises 12px into place over 0.5s.

### Add to Cart (signature motion)
- On an AJAX add to cart, a copy of that card's product image flies from the card to whichever cart is visible (the tab bar on phones, the header on desktop). It takes 700ms on `cubic-bezier(0.4, 0, 0.2, 1)`, arcs up 60px, shrinks to 12%, and rounds from 10px to a circle. The cart count then bumps (scale 1.4, then 0.92, settling over 0.5s). Both are skipped under reduced motion.

## Do's and Don'ts

### Do:
- **Do** set every content block as its own white panel (16px corners, resting shadow) on the Cool Shelf Grey ground, separated by the 12–20px gap.
- **Do** keep Offer Red (#d1352f) for actions, discounts, the offers strip, the cart count and current-state indicators, and use Deep Offer Red (#b32a25) for text links and for any red text on the grey ground.
- **Do** build the price row as discount pill at the start, current price at the end, and old price on its own line beneath, and reserve that line when there is no old price.
- **Do** show a variable product with differing option prices as «از» plus the lowest price.
- **Do** print product prices through `sofreh_kses_price()` so WooCommerce's `<bdi>` survives and the amount reads «۲٬۷۵۰٬۰۰۰ تومان», number then currency. Keep WooCommerce's currency position on Left or Left with space.
- **Do** render every number a shopper reads in Vazirmatn FD with `ss01` on, and switch Latin-data fields (email, URL, password, SKU, codes) to plain Vazirmatn, LTR.
- **Do** draw icons from the theme's inline line-icon set, or as CSS masks of the same round-capped paths.
- **Do** keep touch targets at 44px or more and stack every fixed bottom element above the 64px tab bar on phones.
- **Do** leave store promises and the product note empty until the merchant writes them; empty ones stay hidden.
- **Do** switch all motion off under `prefers-reduced-motion`: no autoplay (pause button hidden), no image flight, no count bump, instant scrolling.

### Don't:
- **Don't** use Digikala's name, logo, exact brand red or proprietary assets. Match its conventions and quality bar only.
- **Don't** escape price HTML with `wp_kses_post()`, which strips `<bdi>` and moves the currency name to the wrong side, and don't switch WooCommerce's currency position to Right.
- **Don't** put a white, shadowed card inside a white panel. Inner zones use hairlines or a Cool Shelf Grey well.
- **Don't** put the discount badge over the product photo. It belongs in the price row (or beside the buy-box price), and only the sold-out badge sits on the image.
- **Don't** colour sale prices, headings or large areas red. The offers strip and an optional red banner slide are the only red fields.
- **Don't** use Banner Teal or Banner Charcoal anywhere but a banner background.
- **Don't** use Unicode glyphs or emoji (★, ×, ✓, typed plus and minus) as icons.
- **Don't** add letter-spacing or text transforms to Persian text.
- **Don't** add motion beyond the set above. In particular, no scroll-triggered entrances on sections and no autoplay that ignores pointer, touch, focus or the pause button.
