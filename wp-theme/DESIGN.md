---
name: Sofreh
description: A Persian, phone-first WooCommerce storefront in the familiar Iranian marketplace convention, in its own lapis, saffron and plum, built to full craft.
colors:
  accent: "#2d48c0"
  accent-deep: "#1e339b"
  accent-soft: "#e9f0ff"
  saffron: "#faab35"
  saffron-soft: "#fff0d0"
  plum: "#67237a"
  ground: "#f7f4ef"
  surface: "#ffffff"
  line: "#eae6df"
  line-strong: "#d6d0c7"
  ink: "#191d34"
  muted: "#5e6275"
  error: "#b32228"
  error-soft: "#ffece9"
  error-ink: "#8c211d"
  success: "#1a7f45"
  success-soft: "#e7f5ec"
  success-ink: "#155c34"
  info-soft: "#e9f0ff"
  info-ink: "#1d3f6b"
  warning-soft: "#fff4e0"
  warning-ink: "#7a4d00"
  star: "#faab35"
  focus: "#1e339b"
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
  code:
    fontFamily: 'ui-monospace, "SFMono-Regular", Menlo, Consolas, monospace'
    fontSize: "0.9em"
    fontFeature: "normal"
rounded:
  xs: "4px"
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
    backgroundColor: "{colors.saffron}"
    textColor: "{colors.ink}"
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
    backgroundColor: "{colors.saffron}"
    textColor: "{colors.ink}"
    typography: "{typography.badge}"
    rounded: "{rounded.pill}"
    padding: "0 4px"
    size: "18px"
  section-star:
    backgroundColor: "{colors.saffron}"
    size: "14px"
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
  tabbar-marker:
    backgroundColor: "{colors.accent}"
    rounded: "{rounded.xs}"
    width: "24px"
    height: "4px"
  banner:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.surface}"
    typography: "{typography.display}"
    rounded: "{rounded.lg}"
    padding: "clamp(20px, 4vw, 56px)"
    height: "clamp(200px, 30vw, 340px)"
  banner-plum:
    backgroundColor: "{colors.plum}"
    textColor: "{colors.surface}"
  banner-saffron:
    backgroundColor: "{colors.saffron}"
    textColor: "{colors.ink}"
  banner-button:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    typography: "{typography.button}"
    rounded: "{rounded.sm}"
    padding: "0 18px"
    height: "42px"
  banner-button-saffron:
    backgroundColor: "{colors.ink}"
    textColor: "{colors.surface}"
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
  auth-panel:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.lg}"
    padding: "clamp(8px, 2vw, 16px) clamp(16px, 3vw, 28px) clamp(20px, 3vw, 28px)"
    width: "560px"
  auth-tab:
    textColor: "{colors.muted}"
    padding: "0 12px"
    height: "52px"
  auth-tab-selected:
    textColor: "{colors.accent}"
  confirmation-card:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.lg}"
  confirmation-tracking-row:
    backgroundColor: "{colors.success-soft}"
    textColor: "{colors.ink}"
    padding: "clamp(16px, 2.5vw, 22px)"
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
    backgroundColor: "{colors.error-soft}"
    textColor: "{colors.error-ink}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
---

# Design System: Sofreh

## Overview

**Creative North Star: "The Well-Kept Marketplace"**

Sofreh is the Iranian online marketplace every shopper already knows, played straight: a search field up front, a swipeable banner, a row of round category shortcuts, a band of special offers, dense product cells with the discount beside the price, and a tab bar under the thumb. The benchmark for familiarity and finish is Digikala, but the store never borrows its name, logo, red or assets, and its own colours set it clearly apart. Convention is the commitment. Nothing here is a concept layout, so quality has to show in the things shoppers feel without naming: price rows that line up across a shelf, Persian digits everywhere, 44px targets, honest empty states, and speed.

The material is warm and plain, set with a few jewels. White panels sit on a warm porcelain ground. Lapis means acting: buttons, links and where you are. Saffron means saving: discount tags and the cart count. Plum is lapis's deep partner in the banner and the offers band. Text is an indigo-tinted ink with a quiet slate for everything secondary, divided by 1px warm hairlines and marked with round-capped line icons. Red has left the storefront and now marks errors only. One Persian ornament carries the identity: the khatam, the eight-point star of Iranian tilework. It appears as a fine line lattice over the banner and the offers band, and as a small solid saffron star before every section title. A 3px saffron, plum and lapis rule along the top of the header echoes it. Density is marketplace density, not editorial air: product cells sit edge to edge, divided by hairlines, and a single 12–20px gap separates the panels. The phone is the store (about 80% of visits): every layout is designed at 390px first, and desktop extends it with a search-led header, a category mega menu, shelf arrows, and a sticky buy box.

Motion is moderate and purposeful. There is one authored moment, add to cart: the product's own image arcs into the cart and the count bumps. Around it sit a few working motions: a banner that swipes and autoplays but yields to the shopper, a hover-intent category menu, and drawers that slide in from the reading edge. Everything else is short state feedback, and all of it switches off under reduced motion. The ornament never moves.

**Key Characteristics:**
- Familiar marketplace structure, executed precisely; no invented layouts.
- White panels on a warm porcelain ground, one container level deep.
- Lapis for actions and current state, saffron for offers, plum for depth; red for errors only.
- One ornament, the khatam: a fine line lattice on the banner and offers band, and a saffron star before every section title.
- Vazirmatn throughout, Persian digits through `ss01`, line-height 1.8.
- Phone-first shell: two-row header, bottom tab bar, phone buy bar.
- One authored motion moment (add to cart), and nothing moves under reduced motion.

## Colors

A warm porcelain field set with Persian jewels: lapis does the work, saffron marks the savings, plum gives depth, and red is kept for errors. All contrast figures below are WCAG 2.x ratios measured on the solid colours.

### Primary
- **Lapis** (#2d48c0): primary buttons and add to cart (including the card button's hover and loading fill), running text links, the text wordmark and the footer store name. It also marks current state: the current tab-bar item's icon, bold label and 24 × 4px top marker, the current sort link, product tab, sign-in tab and filter category, and the mega-menu underline. Lapis is also used for "View all" links, the quantity steps, the price-slider range and handle, checkbox and radio fills, the category initial, the text caret, text selection, the account-created check, and names hovered in the mega menu, ranking, cart and widgets. White on Lapis is 7.50:1. As text it reads 7.50:1 on white, 6.84:1 on the porcelain ground and 6.56:1 on Lapis Wash.
- **Deep Lapis** (#1e339b): the hover and focus fill of primary buttons, the hover colour of links and the wordmark, the current My Account menu item (9.18:1 on Lapis Wash), and the shadow end of the lapis banner tone. White on it is 10.49:1. The focus colour shares this value.
- **Lapis Wash** (#e9f0ff): the quantity-step hover fill and the current My Account menu item on desktop. The info notice background shares this value.

### Secondary
- **Saffron** (#faab35): offers and small marks. It fills the discount tag and the cart count, both with Indigo Ink type (8.64:1), and draws the 14px khatam star before every section title. It also forms the filled rating stars and the sticky-post star (as `star`), the saffron banner tone, the saffron end of the header rule, and the "account after payment" dot. Saffron is never text. Against white it measures only 1.92:1, so it is always a fill under ink or a decorative mark.
- **Saffron Cream** (#fff0d0): the 5px halo around the waiting dot on the confirmation card, and nothing else.

### Tertiary
- **Plum** (#67237a): the deep jewel partner. It is the plum banner tone, the far end of the offers band and the middle of the header rule. White on Plum is 10.01:1. It never appears on buttons, text or interface chrome.

### Jewel Fields
The banner tones and the offers band are gradients of the jewels under the khatam lattice. Their intermediate stops are literals in the stylesheet, not tokens.
- **Lapis banner** (the default first slide): `radial-gradient(120% 140% at 100% 0%, #4562dc 0%, Lapis 42%, Deep Lapis 100%)` under the light lattice. The white headline is 5.21:1 at the highlight stop and 7.50:1 on Lapis. The 95%-white line beneath it is 6.94:1 on Lapis and 4.87:1 against the bare highlight stop in the top-right corner.
- **Plum banner**: `radial-gradient(120% 140% at 100% 0%, #8a3aa0 0%, Plum 50%, #4a1859 100%)` under the light lattice. White is 6.58:1 at the highlight, and the 95% line is 6.10:1 there.
- **Saffron banner**: `radial-gradient(120% 140% at 100% 0%, #ffc56a 0%, Saffron 55%, #f29a1f 100%)` under the dark lattice. The headline turns Indigo Ink (7.43:1 at the darkest stop, 10.62:1 at the highlight), the line is ink at 82% (5.38:1 at the darkest stop), and the button inverts to ink with white type (16.58:1).
- **Offers band**: `linear-gradient(110deg, Lapis 0%, #4a37b0 48%, Plum 100%)` under the light lattice. The white title and "View all" read 7.50:1 at the lapis end, 8.52:1 at the violet midpoint and 10.01:1 at the plum end.
- **Khatam lattice**: a 64px tile holding one eight-point star (20px outer radius) at its centre and quarter stars at its corners, so the stars form a diagonal lattice. Strokes are 1px: white at 13% on lapis and plum (`--pattern-light`), and Indigo Ink at 9% on saffron (`--pattern-dark`). They are hairlines, far too faint to carry or spoil legibility.
- **Header rule**: 3px, `linear-gradient(90deg, Saffron, Plum 45%, Lapis)`, so Lapis sits on the right, above the wordmark in RTL, and Saffron sits on the left. It is decorative only.

### Neutral
- **Porcelain** (#f7f4ef): the page ground under every panel. It also fills image wells, the header search field, the buy box, the review form well, table header cells, the cart actions row, credential boxes, `<pre>` blocks and icon-button hover fills.
- **Panel White** (#ffffff): every panel, frame, header, tab bar, drawer, product cell, the sign-in panel and the confirmation card.
- **Warm Hairline** (#eae6df): dividers between product cells, table rows, drawer sections and confirmation-card rows, the header's bottom edge and the sign-in tabs' baseline.
- **Control Rule** (#d6d0c7): the stroke on inputs, ghost buttons, chips, the quantity stepper, the card add-to-cart button, the guest header action, copy buttons, "Back to top", and the dashed code boxes. It also colours the unfilled stars and the category circle's hover ring.
- **Indigo Ink** (#191d34): all primary text, headings, prices and ranking numerals, the current pagination page, the announcement and store-notice bars, everything written on Saffron, and the saffron banner's button. 16.58:1 on white, 15.11:1 on Porcelain.
- **Quiet Slate** (#5e6275): secondary text such as breadcrumbs, result counts, old prices, the currency name, footer links, help text and switch lines. It also colours inactive tab-bar, product and sign-in tabs, and fills the sold-out badge (white on it 6.03:1). 6.03:1 on white, 5.50:1 on Porcelain.
- **Placeholders** use Muted Slate (#5e6275): 6.03:1 on white, 5.50:1 in the Porcelain header search at rest (the field turns white on focus).

### Functional
- **Error Red** (#b32228) with **Error Blush** (#ffece9) and **Error Maroon** (#8c211d): errors only. Error Red marks required-field asterisks, invalid-field borders and inline messages (6.61:1 on white, 6.03:1 on Porcelain), out-of-stock stock text, and the remove button's hover (a red cross on Error Blush, 5.80:1). Error Maroon on Error Blush (7.84:1) carries error notices, the weak-password meter, and failed, cancelled and refunded order statuses.
- **In-Stock Green** (#1a7f45) with **Mint Wash** (#e7f5ec) and **Deep Green Ink** (#155c34): stock status (5.04:1 on white, 4.60:1 in the Porcelain buy box), success notices (7.15:1), the order-received banner, the strong-password meter, processing and completed statuses, and the tracking row of the confirmation card. That row's help text is a darker green (#2d5b40, 6.96:1).
- **Info Wash** (#e9f0ff) with **Info Navy** (#1d3f6b): info notices (9.30:1), the checkout account note and the phone-login hint.
- **Caution Wash** (#fff4e0) with **Caution Brown** (#7a4d00): the "medium" password meter and the save-your-password warning (6.67:1).
- **Rating Saffron** (`star`, #faab35): the filled part of star ratings and the sticky-post star. It is the Saffron value under its own name.
- **Focus Lapis** (`focus`, #1e339b): the 2px focus outline, offset by 2px (10.49:1 on white, 9.56:1 on Porcelain, 5.47:1 on the saffron banner), and the border of a focused field, which also gets a 3px Lapis ring at 20%. Where the outline falls on a jewel field (the offers band's header and arrows, lapis and plum banner slides), it turns white (5.21:1 or better); inside the band's white cells it stays Focus Lapis.

### Named Rules
**The Lapis Means Acting Rule.** Lapis marks what you can press and where you are: buttons, links, the wordmark, current tabs, sort links and filters. Sale prices and headings stay ink. The only large lapis fields are the lapis banner tone and the offers band.

**The Saffron Means Saving Rule.** Saffron belongs to offers and small marks: discount tags, the cart count, the section star, rating stars and the saffron banner tone. It is always a fill or a mark, never text, and anything written on it is Indigo Ink.

**The Red Means Error Rule.** Error Red and its washes appear only where something is wrong, unavailable or being removed: required asterisks, invalid fields, error notices, out-of-stock, failed statuses and the remove hover. No action, offer, price or ornament is red.

**The Plum Stays Deep Rule.** Plum is a field colour for the banner, the offers band and the middle of the header rule. It never appears on buttons, text or interface chrome.

## Typography

**Display Font:** Vazirmatn FD (with Tahoma, Segoe UI, sans-serif)
**Body Font:** Vazirmatn FD (with Tahoma, Segoe UI, sans-serif)
**Label/Mono Font:** plain Vazirmatn (with Tahoma, Segoe UI, sans-serif) for fields and values that hold Latin data. The system monospace stack (ui-monospace, SFMono-Regular, Menlo, Consolas, monospace) is used only inside `<code>`, `<kbd>` and `<pre>`.

**Character:** One family, set like a working store rather than a magazine. Vazirmatn's open Persian forms carry everything from banner headlines to 11px tab labels. The hierarchy comes from steps in size and weight (Regular 400, Medium 500, Bold 700), never from a second face.

### Hierarchy
- **Display** (Bold, clamp(1.35rem → 2.4rem), 1.4): banner headlines only. The first slide's headline is the page's h2, and the rest are paragraphs.
- **Headline** (Bold, clamp(1.35rem → 1.75rem), 1.5): page titles (h1). Product titles use a close step (clamp(1.1rem → 1.45rem), 1.6).
- **Title** (Bold, clamp(1rem → 1.2rem), 1.5): shelf, offers, ranking and blog section titles, each led by the saffron khatam star. Archive titles sit one step up (clamp(1.15rem → 1.45rem)). Panel headings inside store pages are 1.05rem Bold, and the sign-in tabs are 1rem Bold.
- **Body** (Regular, 1rem, 1.8): all running text, with headings balanced (`text-wrap: balance`). Reading pages cap at 860px, and descriptions at 72ch.
- **Body small** (Regular, 0.875rem): descriptions, meta, menu links, footer text and the sign-in switch lines.
- **Product name** (Medium, 0.8125rem, 1.75): product cells, clamped to exactly two lines (3.5em) so every cell's price row starts at the same height.
- **Price** (Bold, tabular figures; 0.9375rem in cells, 1.375rem in the buy box, 1.0625rem in the buy bar): always ink. Old prices are Quiet Slate Regular at 0.8em, struck through. The currency name is Quiet Slate Regular at 0.78em.
- **Label** (Medium, 0.8125rem): category-circle names, sort links, breadcrumbs, promise lines and chips. Form labels step up to 0.9375rem Medium.
- **Badge** (Bold, 0.75rem, 1.8): the discount tag, the sold-out badge and the cart count.
- **Tab label** (Medium, 0.6875rem): bottom tab bar captions under 24px icons.
- **Ranking numeral** (Bold, 1.75rem, line-height 1, Indigo Ink): best-seller positions.
- **Code** (system monospace, 0.9em, features off): `<code>`, `<kbd>` and `<pre>` only, set LTR and isolated. `<pre>` sits in a Porcelain well with 6px corners.

### Named Rules
**The Persian Digits Rule.** Everything a shopper reads uses Vazirmatn FD with `ss01` switched on explicitly, so ASCII digits draw as Persian even when isolated (an old price, a badge). Stored data keeps ASCII digits. Fields and values that hold Latin data (email, URL, password, SKU, tracking code, generated credentials) switch to plain Vazirmatn with features off, set LTR and isolated. Phone and postcode fields stay in the Persian-digit face and convert typed Persian digits to ASCII.

**The No Tracking Rule.** Persian text never gets letter-spacing or a text transform. Emphasis comes from weight (500 or 700) or size.

## Layout

The page is a single centred column, at most 1336px wide, with a fluid gutter (12–24px). Content arrives as stacked white panels separated by one fluid gap (12–20px), from the banner down to the footer. Inside a panel, horizontal frame padding is 14–20px, panel padding is 16–24px (16–32px on reading pages), and product cells pad 14px (10px on phones).

**Phone shell (960px and below).** The header becomes two rows: menu, store name and account/cart icons on top, and a full-width 44px search field below. The 3px jewel rule runs above both rows. The desktop category row disappears into a drawer. A 64px tab bar (home, categories, cart, account) is fixed to the bottom edge plus the safe-area inset, and the body reserves that height. Anything else fixed to the bottom (the product buy bar, WooCommerce's store notice) stacks directly above the tab bar.

**Desktop.** Under the 3px jewel rule, the 72px header runs brand, then a search field up to 640px wide, then account and cart. Below it, a 44px category row holds the mega-menu toggle, a short vertical rule and the primary menu. Product listings get a 280px sticky filters panel beside the grid. Shelves gain arrow buttons (hover devices at 961px and up).

**Product grids.** Four columns, three at 1100px and below, two at 700px and below. Beside the filters panel the grid auto-fills cells of at least 210px. Home shelves scroll sideways with cells of 158–200px (42vw on phones) and snap to start.

**Product page.** Gallery and summary sit at 0.9fr to 1.5fr. Above 1180px the summary splits again into facts and a 260–320px buy box that sticks under the header. At 1180px the buy box drops under the facts, and at 760px everything stacks into separate white panels with the phone buy bar.

**Store pages.** Cart, checkout, account and order pages have no outer panel. Each part is its own panel on the ground:
- the cart items, then the totals at 380px;
- the checkout details at 1.4fr beside the order review at 1fr (stacked at 900px);
- the account menu at 250px beside the content (stacked at 860px).

With the script, the sign-in page is one centred panel, at most 560px wide, holding both forms under two tabs. Without it, the login and sign-up forms sit side by side (stacked at 860px). On the order-received page, the confirmation card puts the tracking code (1fr) beside the account confirmation (1.2fr) at 900px and up, and stacks them on phones.

### Named Rules
**The One Container Level Rule.** A white panel sits on the porcelain ground, and that is the only level of container. Zones inside a panel are separated by hairlines or set in a Porcelain well. A white, shadowed card never sits inside another white panel.

**The Thumb Zone Rule.** Below 961px the bottom 64px (plus safe area) belongs to the tab bar. Fixed elements stack above it, never over it, and touch targets stay at 44px or more (drawer rows are 48px).

## Elevation & Depth

Depth is mostly tonal: white panels lifted off a porcelain ground, with a whisper of shadow so the panel edge holds on low-contrast screens. Real shadow is kept for things that float over content: drawers, dropdowns, the mega menu, shelf arrows and the flying cart image. Hairlines between product cells are drawn as 1px shadows so the panel's outer edge stays clean, and cells lift on hover. Every shadow is tinted from Indigo Ink (rgb 25 29 52), so depth carries the ink's indigo rather than a neutral grey.

### Shadow Vocabulary
- **Resting panel** (`box-shadow: 0 1px 2px rgb(25 29 52 / 6%)`): every white panel and frame on the ground, including the sign-in panel and the confirmation card.
- **Floating** (`box-shadow: 0 2px 6px rgb(25 29 52 / 6%), 0 12px 32px -12px rgb(25 29 52 / 18%)`): drawers, the filters drawer, sub-menus, shelf arrows, the skip link and the flying cart image.
- **Cell lift on hover** (`box-shadow: 0 0 0 1px #eae6df, 0 12px 32px -14px rgb(25 29 52 / 28%)`): a product cell under the pointer.
- **Mega panel drop** (`box-shadow: 0 24px 40px -24px rgb(25 29 52 / 35%)`): the full-width category panel under the header.
- **Edge shadows**: fixed bars over scrolling content. The header when scrolled uses `0 1px 0 #eae6df, 0 8px 20px -16px rgb(25 29 52 / 40%)`. The tab bar uses `0 -1px 0 #eae6df, 0 -8px 24px -18px rgb(25 29 52 / 40%)`, and the buy bar the same idea at -10px, 45%.

### Named Rules
**The Two Shadows Rule.** Anything resting on the ground gets the resting shadow, and anything floating over content gets the floating pair. Full-width bars and the mega panel use its edge variants. Shadow never stands in for emphasis.

## Shapes

The corners are softly rounded and step up with size:
- **Small (6px)** goes on things you press or type into, and on images inside cells: buttons, inputs, the quantity stepper, product media, thumbnails.
- **Medium (10px)** goes on inner frames and notices: the buy box, gallery images, notices, payment-method rows, credential wells, header action hovers, and the outer ends of the offers-band row.
- **Large (16px)** goes on panels: every frame, the banner, store panels, the filters sidebar, the sign-in panel and the confirmation card.
- **Pills (999px)** are for counts and short labels: the sold-out badge, chips, the cart count, carousel dots and order-status tags.
- **The discount tag** is the one shaped label: a pill whose inner end (the side facing the price) is squared to 4px, like a price tag.
- **Full circles** are reserved for category shortcuts, for round controls that are not text buttons (banner previous/next/pause, shelf arrows, the gallery zoom, cart remove buttons) and avatars, and for the confirmation card's status marks (the 44px tracking check, the 24px account check, the 10px waiting dot).

Product cells themselves are square-cornered. The rounding belongs to the grid's panel, and cells divide it with hairlines. Strokes are 1px throughout. The only heavier lines are state indicators and the header rule:
- a 2px underline on the current sort link, product tab, mega toggle and (on phones) account-menu item;
- a 3px underline on the selected sign-in tab;
- a 24 × 4px lapis marker, its lower corners rounded to 4px, and a bold label on the current tab-bar item (not hue alone);
- the 3px jewel rule along the top of the header.

The one ornament is geometric. The khatam is an eight-point star, drawn two ways: as 1px outlines repeating on a 64px lattice, and as a small solid mark (a 24-unit star drawn at 14px) before section titles. It is flat, static and never enlarged into an illustration.

Icons come from one inline line set: a 24px grid, round caps and joins, and `currentColor` strokes of 1.6. The same strokes appear in the inline set and in the CSS masks for the remove cross, select chevron, check and quantity plus/minus; stars are filled shapes. Icons are always decorative (`aria-hidden`), and the control carries its own name.

### Named Rules
**The One Ornament Rule.** The khatam is the store's only motif. It appears in three places: the lattice on banner slides, the lattice on the offers band, and the saffron star before section titles. The header's jewel rule is its companion. No other pattern, flourish or illustration joins it, and it never animates.

## Components

### Buttons
Solid, compact and unmistakable.
- **Shape:** gently rounded (6px), at least 44px tall, Bold 0.9375rem.
- **Primary:** Lapis with white text (7.50:1), padding 0.55em × 1.25em. It deepens to Deep Lapis on hover and presses to 98% scale. Single-product add to cart is 48px, proceed to checkout 50px, and place order 52px and full width. The sign-in and sign-up submits are full width.
- **Ghost:** white with a Control Rule border and ink text. The border turns ink on hover. Used for filters, coupon and update-cart actions, notice actions and "Go to my account".
- **Card add to cart:** a full-width 38px ghost at 0.8125rem that fills Lapis with white text on hover, so a shelf of cards reads quietly until one is chosen. While loading it fills Lapis, its label hides and a white ring spins.
- **Disabled:** 50% opacity, not-allowed cursor.
- **Icon buttons:** 44 × 44px, transparent, with a Porcelain fill on hover.

### Chips
- **Style:** white pills, 38px tall, with a Control Rule border, an ink label (0.8125rem) and a Quiet Slate count. They scroll sideways in one row under archive titles.
- **State:** the border and text go ink on hover. Chips are navigation links, not toggles.

### Cards / Containers
- **Corner Style:** panels at 16px; inner wells at 10px.
- **Background:** Panel White on the Porcelain ground; inner wells in Porcelain.
- **Shadow Strategy:** the resting panel shadow only (see Elevation & Depth).
- **Border:** none on panels. Hairlines divide the inside.
- **Internal Padding:** 16–24px for store panels; shelf frames take 16px vertically and 14–20px inline.

### Product Card
The dense marketplace cell, built so a whole row scans as one line.
- **Media:** a square image on Porcelain, 6px corners. It zooms to 104% over 0.4s on hover. Only the sold-out badge (a Quiet Slate pill with white text) sits on the photo, at its top end corner.
- **Name:** Medium 0.8125rem, two lines exactly.
- **Price row:** the saffron discount tag sits at the row's start, set in Indigo Ink Bold with the rounded percentage in Persian digits (e.g. «۱۶٪») and "16% off" for screen readers. The current price (Bold, ink, tabular) sits at the row's end. The old price takes its own full-width line beneath, aligned to the end. Cells with no old price keep that line empty, so prices align across the row.
- **Variable products:** when options cost different amounts, the cell shows «از» plus the lowest price instead of a two-price range. Products on sale with no computable percentage show the same saffron tag reading "Sale".
- **Action:** the card add-to-cart button pinned to the bottom of the cell.

### Inputs / Fields
- **Style:** white, 46px tall, a 1px Control Rule stroke, 6px corners, inherited font, Lapis caret. Selects carry a drawn chevron at the inline end. Checkboxes and radios fill Lapis.
- **Focus:** the border turns Focus Lapis with a soft 3px Lapis ring at 20%. Every other control gets a 2px Focus Lapis outline offset by 2px.
- **Error:** required asterisks are Error Red. An invalid field's border turns Error Red, with a 0.8125rem Error Red message beneath.
- **Latin data:** email, URL and password fields are LTR in plain Vazirmatn. They stay right-aligned while showing their Persian placeholder.
- **Search:** the header search is a borderless Porcelain field (10px corners, 48px on desktop, 44px on phones) with the search icon at its start. It turns white on focus.
- **Quantity stepper:** one 6px-cornered white control with the number in Bold, flanked by 38px plus and minus steps (line-icon masks, not typed characters) in Lapis, with a Lapis Wash hover. It takes the field focus ring as a group.
- **Password meter:** a reserved slot under the field, so its appearance never moves the submit button.

### Navigation
- **Header:** white and sticky, crowned by the 3px jewel rule and separated from the page by a hairline. It gains a soft edge shadow once the page scrolls. The text wordmark is Lapis Bold (1.6rem, 1.35rem on phones) and deepens on hover. A merchant logo replaces it at up to 44px tall.
- **Account and cart:** guests on desktop see a bordered «ورود | ساخت حساب» (Log in | Create account) action. On phones it shrinks to the user icon, with its label kept for screen readers. The cart is a bag icon whose count sits on the bag's top corner as an 18px Saffron pill with an Indigo Ink count (8.64:1) and a 2px white knock-out ring, hidden at zero.
- **Category mega menu (desktop):** a "Product categories" toggle with a grid icon and a 2px Lapis underline when hovered or open. The full-width white panel drops 6px into place (0.22s). Columns auto-fill at 190px or more, with each parent category in ink Bold (Lapis on hover) over its children in Quiet Slate.
- **Drawer (phone):** slides in from the reading edge, up to 360px wide (86vw), over a 45% dark backdrop, with focus trapped and Escape to close. Categories form a `<details>` tree with 48px rows. The chevron rotates on open, and "All products" is set in Lapis.
- **Bottom tab bar (phone):** four equal items (home, categories, cart, account), each a 24px icon over a Quiet Slate tab label. The current item turns Lapis and carries a 24 × 4px Saffron marker on its top edge. The cart item carries the same saffron count pill.
- **Account menu:** a 250px list in which the current item is Deep Lapis Bold on Lapis Wash. On phones the menu becomes one sideways-scrolling row, and the current item takes a 2px Lapis underline instead.
- **Footer:** a white band with a hairline top, muted links that turn ink on hover, the store name in Lapis, and a small bordered "Back to top" action.

### Banner Carousel
- **Frame and slides:** a full-container frame with 16px corners. Each slide is one jewel tone under the khatam lattice: Lapis (the default), Plum or Saffron. The merchant picks the tone per slide; tones saved by theme 2.0 map teal to Lapis, dark to Plum and red to Saffron.
- **Copy:** a Display headline, a short line (40ch max) and a 42px button, with an optional square product image beside them. On Lapis and Plum the headline is white, the line is 95% white and the button is white with ink text. On Saffron the headline is ink, the line is ink at 82% and the button is ink with white text. On phones the copy sits low and the image shrinks.
- **Controls:** native scroll-snap means it swipes with no script. The script adds dots in a translucent dark capsule (the current dot stretches from 8px to 22px), white round previous/next buttons (above 700px), and a pause/play button. Focus outlines on the Lapis and Plum slides are white.
- **Autoplay:** advances every 6s. It pauses while the pointer, a touch or keyboard focus is inside, and stays paused once the shopper presses pause. Under reduced motion it never starts and the pause button is hidden.

### Category Shortcuts
- One white panel holding a row of round images (64–92px circles on Porcelain) with Medium 0.8125rem names under them. The row scrolls sideways on phones. A category without an image shows its initial in Lapis (6.84:1 on Porcelain).
- On hover the circle rises 3px and gains a thin Control Rule ring.

### Shelves, Offers Band and Ranking
- **Section title:** every home section title (shelves, offers, best sellers, blog) is led by a 14px solid Saffron khatam star, 8px before the text.
- **Shelf frame:** a white panel whose title row holds the starred Title on the start side and a "View all" link in Lapis Bold, with a chevron that nudges forward on hover. Below it, a sideways-scrolling row of product cells divided by hairlines.
- **Special-offers band:** the same frame filled with the Lapis-to-Plum gradient under the light khatam lattice. The title and "View all" turn white, the star stays saffron, and the "View all" focus outline turns white against the band. The white cells stand apart by 4px gaps of the band, with the row's two outer ends rounded at 10px.
- **Best-seller ranking:** a numbered list in three columns (one at 900px and below). Each row shows a large ink numeral, a 72px thumbnail, a two-line name and the price, with hairlines between rows. The name turns Lapis on hover. The ranking appears only when products have actually sold.

### Store Promises Strip
- One white panel with up to four promises, each a 28px ink line icon over a Quiet Slate Medium line (two by two with the icon beside the line on phones). Every promise is empty by default, and an empty promise is hidden, so the store states only what the merchant writes. The product page's store note works the same way.

### Listing Toolbar and Filters
- The archive title sits in its own white panel with the category chips. The toolbar attaches to the top of the product grid's panel.
- **Desktop toolbar:** sort options as a row of links, the current one in Lapis Bold with a 2px underline, and the result count at the end.
- **Phone toolbar:** WooCommerce's native sort select on Porcelain, and a ghost "Filters" button that opens the filters panel as a drawer.
- **Filters panel:** the current category and chosen attributes are Lapis Bold, and the price slider's range and handle are Lapis.

### Product Page
- **Gallery:** 10px-cornered images, a round white zoom button, and 64px thumbnails at 70% opacity that sharpen with an ink border when active.
- **Facts:** title, rating (with a Lapis review link), short description and meta (the SKU in Latin-digit type), divided by hairlines.
- **Buy box:** a Porcelain well (10px corners, 16px padding) that sticks under the header on wide screens. It holds, in order:
  - the saffron discount tag beside the price (1.375rem, old price first);
  - stock in In-Stock Green, or Error Red when out of stock;
  - the options;
  - the quantity stepper with a 48px add to cart;
  - the optional store note.
- **Phone buy bar:** fixed above the tab bar once the buy box scrolls away. It slides up into place over 0.3s and shows the price on one side and a primary button (at least 46% wide, 46px) on the other. The button presses the real add to cart, or scrolls to the options when a choice is needed.
- **Tabs:** a sticky row of text tabs with a 2px Lapis underline on the current one.

### Store Pages, Tables and Notices
- **Panels:** every part of cart, checkout, account and order received is its own white panel. Tables inside a panel drop their own frame.
- **Phone cart rows:** a compact grid with the 72px photo at the start, the name and unit price beside it, and a round remove button at the end. The remove button is a Quiet Slate cross that turns Error Red on Error Blush when hovered. The quantity stepper and the Bold line total share the last row.
- **Responsive tables:** at 760px and below, rows become label/value lines, each value labelled in Quiet Slate.
- **Payment methods:** 10px-cornered rows with a hairline border that turns ink when chosen.
- **Notices:** 10px-cornered washes (Mint Wash, Info Wash or Error Blush) with dark text of the same hue, and links in that colour, Bold. They fade in over 0.3s and carry no focus ring when WooCommerce moves focus to them.

### Sign-in and Create Account
- **Account tabs:** with the script, the My Account sign-in becomes one white panel (16px corners, resting shadow, at most 560px wide, centred) over WooCommerce's own login and sign-up forms.
  - **Tab row:** «ورود» (Log in) and «ساخت حساب» (Create account) split it in two equal halves, 52px tall, 1rem Bold, on a hairline baseline. Unselected tabs are Quiet Slate and turn ink on hover. The selected tab is Lapis with a 3px Lapis underline.
  - **Semantics:** the tabs form a real tablist (tab, tabpanel, `aria-selected`, roving `tabindex`). The arrow keys switch between the two in either direction, and Home and End jump to each end. WooCommerce's form headings stay for screen readers.
  - **Opening tab:** «ساخت حساب» after a failed sign-up or with `?action=register`, otherwise «ورود».
- **Switch lines:** under each form, a centred 0.875rem Quiet Slate line ("No account yet? Create account" / "Already have an account? Log in") with its link in Lapis Bold. The link changes the tab and focuses it. Without the script, both forms simply stay visible.
- **Where the choice appears:** the tabs and switch lines appear only when sign-up is enabled, and never on checkout. There, a signed-out customer instead sees an Info Wash note offering «ساخت حساب» (Bold link) first, or simply placing the order, after which the account is created once payment is confirmed. The header's guest link carries the same choice: «ورود | ساخت حساب».

### Phone-Account Confirmation Card
- **Card:** a white panel (16px corners, resting shadow, no border) that rises 12px into place over 0.5s.
- **Tracking row:** a Mint Wash row with a 44px round In-Stock Green check that pops in. It holds the tracking title, help text in #2d5b40 and the large tracking code with its copy button.
- **Account row:** when there is an account state to report, the card splits. At 900px and up the tracking row (1fr, its content stacked) sits beside the account row (1.2fr) with a vertical hairline between them; on phones they stack with a hairline.
- **Status marks:** the account heading leads with one of two marks.
  - A 24px Lapis circle with a white check, popping in after 0.35s, before «حساب کاربری شما ساخته شد».
  - A 10px Saffron dot with a 5px Saffron Cream halo before «حساب کاربری پس از پرداخت ساخته می‌شود».
- **Credentials:** the username and password sit in 10px Porcelain wells as dashed-border Latin-digit code boxes (`user-select: all`). Each has a copy button whose label crossfades to a green "Copied". A Caution Wash line asks the customer to save the password. The actions are a primary "Complete your account" and a ghost "Go to my account".

### Add to Cart (signature motion)
- On an AJAX add to cart, a copy of that card's product image flies from the card to whichever cart is visible (the tab bar on phones, the header on desktop). It takes 700ms on `cubic-bezier(0.4, 0, 0.2, 1)`, arcs up 60px, shrinks to 12%, and rounds from 10px to a circle. The saffron cart count then bumps (scale 1.4, then 0.92, settling over 0.5s). Both are skipped under reduced motion.

## Do's and Don'ts

### Do:
- **Do** set every content block as its own white panel (16px corners, resting shadow) on the Porcelain (#f7f4ef) ground, separated by the 12–20px gap.
- **Do** keep Lapis (#2d48c0) for actions, links, the wordmark and current-state indicators, and Deep Lapis (#1e339b) for their hover and focus.
- **Do** keep Saffron (#faab35) for discount tags, the cart count, the section star and rating stars, always with Indigo Ink (#191d34) on it.
- **Do** keep Error Red (#b32228) and its washes for errors only: required asterisks, invalid fields, out-of-stock, the remove hover, error notices and failed statuses.
- **Do** lay the khatam lattice (64px tile, 1px strokes, white at 13% on lapis and plum, ink at 9% on saffron) over banner slides and the offers band, and lead every section title with the 14px saffron khatam star.
- **Do** tint the resting, floating and edge shadows from Indigo Ink (`rgb(25 29 52 / x)`).
- **Do** build the price row as the discount tag at the start, the current price at the end, and the old price on its own line beneath. Reserve that line when there is no old price.
- **Do** show a variable product with differing option prices as «از» plus the lowest price.
- **Do** print product prices through `sofreh_kses_price()`, so WooCommerce's `<bdi>` survives and the amount reads «۲٬۷۵۰٬۰۰۰ تومان», number then currency. Keep WooCommerce's currency position on Left or Left with space.
- **Do** render every number a shopper reads in Vazirmatn FD with `ss01` on, and switch Latin-data fields (email, URL, password, SKU, codes) to plain Vazirmatn, LTR.
- **Do** offer the account as «ورود» / «ساخت حساب» over WooCommerce's own forms, in the My Account tabs, the header guest link and the checkout note.
- **Do** draw icons from the theme's inline line-icon set, or as CSS masks of the same round-capped paths.
- **Do** keep touch targets at 44px or more, and stack every fixed bottom element above the 64px tab bar on phones.
- **Do** leave store promises and the product note empty until the merchant writes them; empty ones stay hidden.
- **Do** switch all motion off under `prefers-reduced-motion`: no autoplay (pause button hidden), no image flight, no count bump, instant scrolling.

### Don't:
- **Don't** use Digikala's name, logo, red or proprietary assets. Match its conventions and quality bar only, and never drift back to a red-led storefront.
- **Don't** escape price HTML with `wp_kses_post()`, which strips `<bdi>` and moves the currency name to the wrong side, and don't switch WooCommerce's currency position to Right.
- **Don't** put a white, shadowed card inside a white panel. Inner zones use hairlines or a Porcelain well.
- **Don't** put the discount tag over the product photo. It belongs in the price row (or beside the buy-box price), and only the sold-out badge sits on the image.
- **Don't** colour an action, offer, price, heading or ornament red.
- **Don't** set text in Saffron or put white on it (1.92:1). Saffron is a fill under ink or a mark.
- **Don't** colour sale prices, headings or large areas Lapis. The lapis banner tone and the offers band are the only lapis fields.
- **Don't** use Plum on buttons, text or interface chrome.
- **Don't** add a second motif, enlarge the khatam into an illustration, or animate it.
- **Don't** use Unicode glyphs or emoji (★, ×, ✓, typed plus and minus) as icons.
- **Don't** add letter-spacing or text transforms to Persian text.
- **Don't** add motion beyond the set above. In particular, no scroll-triggered entrances on sections and no autoplay that ignores pointer, touch, focus or the pause button.
