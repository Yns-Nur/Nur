# Sofreh (سفره): Persian WooCommerce theme for home & kitchen stores

Two installable packages:

| Folder | What it is |
|---|---|
| [`sofreh/`](sofreh) | The theme: a classic (PHP) WordPress theme with `theme.json`, RTL-first, fully Persian, integrated with WooCommerce through hooks only. |
| [`sofreh-phone-accounts/`](sofreh-phone-accounts) | Companion plugin: buy with a mobile number, account created automatically, credentials and tracking code on the order confirmation page, tracking by code + mobile. |

Account creation is store *functionality*, so it lives in a plugin. If it were
in the theme, switching themes would silently break checkout and logins, and
WordPress/WooCommerce guidelines keep such features out of themes. The theme
styles everything the plugin outputs.

Build the zips with `./build.sh` (writes `dist/sofreh.zip` and
`dist/sofreh-phone-accounts.zip`).

---

## 1. Research summary

Sources: WooCommerce's own developer docs as shipped in the WooCommerce
repository at tag 11.2.1 (`docs/theming/…`), the WooCommerce and WordPress source
code at the versions tested, and WooCommerce's public server-requirements page.
`developer.wordpress.org` and `developer.woocommerce.com` could not be fetched
from the build environment (DNS/egress blocked), so WordPress Theme Handbook
requirements were checked against the **official Theme Check plugin** (cloned
from GitHub) instead of the handbook pages.

**Versions and prerequisites (verified from source headers)**

| | Version tested | Its stated requirement |
|---|---|---|
| WordPress | 7.1.3 | PHP 7.4+ (8.3+ recommended) |
| WooCommerce | 11.2.1 | `Requires at least: 7.0`, `Requires PHP: 7.4` |
| Theme / plugin header | `Requires at least: 6.7`, `Tested up to: 7.1`, `Requires PHP: 7.4`, `WC tested up to: 11.2` | |

WooCommerce's server-recommendations page currently recommends PHP 8.3+,
MySQL 8.0+/MariaDB 10.6+, HTTPS and a 256 MB memory limit, and a raise of the
PHP minimum to 8.1 is proposed for WooCommerce 11.5.

**What the docs and source say, and how the theme follows it**

- *Integration:* WooCommerce recommends the **hook method** over `woocommerce.php`
  or template overrides ("more robust than overriding the templates"). The theme
  ships **zero** files under `/woocommerce`: wrappers, toolbar, card media, badges,
  breadcrumbs, filters and notes are all added with documented hooks/filters
  (`inc/woocommerce.php`).
- *Support declaration:* `add_theme_support( 'woocommerce', … )` on
  `after_setup_theme`, with image widths and `product_grid` limits, plus the
  zoom/lightbox/slider gallery supports (all off by default for themes that
  declare support).
- *Styles:* `woocommerce_enqueue_styles` disables the general/layout/smallscreen
  sheets; the theme styles every classic element itself. WooCommerce Blocks keep
  their own CSS. The blocks docs ask themes to style Cart/Checkout blocks through
  **global styles** and avoid targeting block internals, so colours, type and
  buttons come from `theme.json`, and only the documented hooks
  (`.wc-block-cart__submit-container`, the order-summary quantity badge) are
  touched.
- *RTL:* WooCommerce registers RTL variants of its own styles; the theme is
  written with CSS logical properties, so one stylesheet serves RTL and LTR (no
  `rtl.css` needed).
- *Persian/Iran specifics found in source:* the `IRT` (Toman) and `IRR` (Rial)
  currencies and the Iranian provinces are built in. WooCommerce validates phones
  and postcodes against ASCII digits only (`WC_Validation::is_postcode()` returns
  `false` before its filter runs), so Persian-keyboard input fails. The
  `woocommerce_validate_phone` filter (new in 11.0) and the Store API both route
  through that validation; the Checkout block also validates postcodes in the
  browser.
- *Gotchas found in source and handled:* from WooCommerce 7.8 the cart-fragments
  script is no longer enqueued everywhere (the theme enqueues it for the header
  cart). From 8.4, an order that belongs to an account is hidden from
  not-logged-in visitors on the confirmation page (the plugin signs the new
  customer in, exactly as WooCommerce's own checkout sign-up does). The guest →
  user session migration reloads session data from the database (the plugin
  writes the credentials only *after* signing in).

**Design reasoning**

Minimalist and calm, so the products carry the page. Warm ivory paper, one deep
*firuzeh* (Persian turquoise) for actions, copper for small accents and a
pomegranate red reserved for sale prices. All text pairs pass WCAG AA (body
6.5:1, actions 7.5:1, sale 6.9:1). The single decorative motif is the **iwan
arch**, used for category tiles and the hero frame. Type is **Vazirmatn**
(OFL, bundled and self-hosted, no third-party requests), set with a tall
Persian line height and never letter-spaced. Its "FD" cut draws ASCII digits as
Persian digits through its `ss01` set, which the theme switches on explicitly
(left to the browser, isolated numbers such as old prices fell back to Latin
shapes). So the store reads Persian while orders and data keep ASCII digits.

Motion is deliberately limited and one-off: below-the-fold blocks rise in as
they are scrolled to, the hero settles on load, controls give press feedback,
cards lift on hover, the cart count bumps when it changes, and drawers slide.
Nothing loops or autoplays, nothing is hidden without JavaScript, and everything
is off under `prefers-reduced-motion`.

---

## 2. Structure

```
wp-theme/
├── build.sh                         builds dist/*.zip
├── sofreh/                          THE THEME
│   ├── style.css                    theme header (required by WordPress)
│   ├── theme.json                   palette, fonts (Vazirmatn), sizes, buttons → also styles WooCommerce blocks
│   ├── functions.php                bootstrap; loads inc/woocommerce.php only when WooCommerce is active
│   ├── header.php / footer.php      sticky header, product search, account & cart links, mobile drawer
│   ├── front-page.php               home: hero, categories, promises, product sections, page content/posts
│   ├── index.php page.php single.php search.php 404.php searchform.php sidebar.php comments.php
│   ├── inc/
│   │   ├── setup.php                theme supports, WooCommerce support, menus, widget areas
│   │   ├── enqueue.php              assets (deferred JS, preloaded font)
│   │   ├── woocommerce.php          all WooCommerce integration (hooks/filters only)
│   │   ├── persian.php              Persian/Arabic → ASCII digits for phone/postcode (classic, account, Store API)
│   │   ├── customizer.php           Appearance → Customize → Sofreh theme
│   │   ├── template-tags.php        category queries, menu fallback, small helpers
│   │   └── icons.php                inline SVG icon set
│   ├── template-parts/home/         hero.php categories.php trust.php products.php
│   ├── template-parts/content/      card.php none.php category-links.php
│   ├── assets/css/                  main.css (base, layout, motion) · woocommerce.css · editor.css
│   ├── assets/js/theme.js           drawers, quantity steppers, digit input, reveal, cart bump
│   ├── assets/fonts/                Vazirmatn FD 400/500/700 + Vazirmatn 400 (woff2) + OFL.txt
│   ├── languages/                   sofreh.pot · fa_IR.po/.mo/.l10n.php
│   ├── sample-data/sample-products.csv   SAMPLE catalogue (every item marked «نمونه», SKUs SAMPLE-*)
│   ├── screenshot.png · readme.txt
└── sofreh-phone-accounts/           THE PLUGIN
    ├── sofreh-phone-accounts.php    header, HPOS + blocks compatibility, bootstrap
    ├── includes/class-sofreh-phone-accounts.php
    ├── assets/                      copy-button JS, fallback CSS for other themes
    ├── languages/                   .pot · fa_IR .po/.mo/.l10n.php
    └── readme.txt
```

---

## 3. Setup

1. **Persian first.** Settings → General → *Site Language: فارسی*, then
   Dashboard → Updates → *Update translations*. This downloads the official
   WordPress and WooCommerce Persian packs from translate.wordpress.org and
   makes WordPress output `dir="rtl"`. Doing this *before* installing
   WooCommerce makes it create its pages (Shop, Cart, Checkout, My account) with
   Persian titles. Otherwise rename them.
2. **Theme.** Appearance → Themes → Add New → Upload `sofreh.zip` → Activate.
3. **WooCommerce.** Install and activate it (the only genuine dependency for the
   store). Then in WooCommerce → Settings → General set *Currency: Iranian toman
   (IRT)* or *Rial (IRR)*, *Number of decimals: 0*, store address and selling
   location (Iran). A Persian thousands separator (`٬`) is optional.
   Add shipping zones and payment methods for your store; Iranian bank gateways
   are separate plugins and are not part of this theme.
4. **Phone checkout (optional but intended).** Plugins → Add New → Upload
   `sofreh-phone-accounts.zip` → Activate. Activation enables guest checkout,
   turns off WooCommerce's own checkout sign-up and creates a *Track your order*
   page; the phone field becomes required.
   The classic checkout (`[woocommerce_checkout]`) makes email optional; the
   Checkout block always asks for an email (a WooCommerce limitation).
5. **Customize.** Appearance → Customize → *Sofreh theme*: hero text and image,
   which home sections show, the **store promises** (rewrite them to match your
   real policies, or clear them), product-page note, footer and contact details.
   Menus: assign a *Primary menu* (until then the top product categories are
   shown). Widgets: *Shop filters* for listing filters (empty = category list),
   footer columns for links or an e-Namad badge (Custom HTML widget).
6. **Categories and products** are entirely yours. For a preview, import
   `sofreh/sample-data/sample-products.csv` via Products → Import; delete the
   sample items (SKU prefix `SAMPLE-`, tag «محصول نمونه») before launch.
7. Recommended: a Jalali date plugin if you want Persian-calendar dates; the
   theme uses standard WordPress date functions.

---

## 4. Testing checklist and results

**Test environment:** WordPress 7.1.3 + WooCommerce 11.2.1 (built from its
GitHub source, including the Blocks bundle) on PHP 8.3, SQLite database
integration, Chromium via Playwright at 1366, 820 and 390 px wide.

**Limitations of that environment.** These are the reasons some items are still
listed as needing a live site:
- translate.wordpress.org was unreachable, so the official fa_IR packs could not
  be installed. To render real Persian text lengths in RTL, a **test-only** stub
  set the core text direction to RTL and translated ~100 common WooCommerce
  storefront strings. It is not part of the deliverable. Block Cart/Checkout
  strings (which come from JavaScript translation files) stayed English in tests.
- SQLite instead of MySQL/MariaDB: WooCommerce's stock-reservation query
  (`LOCK IN SHARE MODE`) fails on SQLite, so stock holding during checkout was
  disabled in the test site only.
- WooCommerce was built from source. Two missing build artefacts (admin
  `feature-config.php`, the `wc-sanitize` script) were generated for the test
  site; WooCommerce's admin UI JavaScript was not built.
- No mail server, no real payment gateway (cash on delivery was used).

### Verified by automated tests (all passing on the final code)

| Area | Check | Result |
|---|---|---|
| Install | Theme activates with WooCommerce active; works without WooCommerce (blog fallback) | ✅ |
| Install | **Theme Check** (official plugin) | ✅ pass; only optional block-theme "recommended" notes remain |
| Code | **PHPCS**: WordPress Coding Standards + PHP 7.4+ compatibility, theme and plugin | ✅ 0 errors, 0 warnings |
| Code | `php -l` on every PHP file; `node --check` on every JS file | ✅ |
| Code | PHP notices/warnings from theme or plugin in `debug.log` during all flows | ✅ none |
| RTL | `<html dir="rtl" lang="fa-IR">`; layout mirrors (sidebar on the right, drawers from the right, breadcrumb chevrons, badges, gallery controls) | ✅ (screenshots reviewed) |
| Persian | All theme UI strings translated (113 theme strings, 39 plugin strings, 0 missing); Persian digits in prices including struck-through prices | ✅ |
| Responsive | 14 page types × 3 widths: **no horizontal overflow, no JS errors** (home, shop, category, sub-category, simple & variable product, product search, site search, no results, empty cart, account, tracking, post, 404) | ✅ 42/42 |
| Accessibility | **axe-core** (WCAG 2.0/2.1 A & AA + best practice), 11 pages, desktop and mobile | ✅ 0 violations (after fixing: icon-only account link name on mobile, duplicate search landmarks, 404 numerals contrast) |
| Accessibility | Mobile menu drawer: `aria-expanded`, focus moves in, Tab trapped, Esc closes, focus returns; filter drawer closes on backdrop tap | ✅ |
| Categories | Home category tiles, header menu fallback, chips and sidebar all come from WooCommerce categories (13 sample categories, 2 levels) | ✅ |
| Product | AJAX add to cart from listings updates header count; quantity −/+ steppers; variable product stays disabled until an option is chosen | ✅ |
| Cart (classic) | Stepper enables "Update cart"; update works; header count refreshes | ✅ |
| Cart (block) | Renders, items listed, header count refreshes after block changes | ✅ |
| Checkout (classic) | Order placed with phone and postcode typed in **Persian digits**; stored as ASCII | ✅ |
| Checkout (block) | Same with the Checkout block (a real bug found and fixed: the block rejected Persian-digit postcodes in the browser) | ✅ |
| Account | Register (a bug found and fixed: with a pasted password the strength meter shifted the button and swallowed the first click), dashboard, edit address with Persian digits, orders list | ✅ |
| Phone accounts | Guest is **not redirected** to registration, even with WooCommerce's guest-checkout setting off; phone required; account auto-created; order attached; customer signed in; confirmation page shows tracking code + username (mobile) + password with working copy buttons | ✅ classic and block |
| Phone accounts | Sign out → sign in with the mobile typed in **Persian digits** + generated password; "complete your account" prompt; order in My Account | ✅ |
| Phone accounts | Tracking page: finds order with Persian-digit code and `+98 …` phone; wrong phone gives a generic error and discloses nothing | ✅ |
| Phone accounts | Unit-level checks of normalization filters (Store API request rewrite, classic posted data, non-store REST routes untouched) | ✅ |
| Motion | Below-the-fold content revealed after scrolling (0 left hidden); `prefers-reduced-motion`: nothing hidden, 0 animations; JavaScript off: nothing hidden; print shows everything | ✅ |

### Still to check on a live store (not verifiable here)

- [ ] Real fa_IR language packs: every WooCommerce/WordPress string in Persian,
      including the Cart/Checkout **block** strings.
- [ ] MySQL/MariaDB with stock reservation enabled.
- [ ] Your payment gateway(s): redirect and return to the confirmation page; the
      credentials card must still appear (it relies on the WooCommerce session
      surviving the gateway round trip).
- [ ] Order emails, including WooCommerce's "new account" email for
      auto-created accounts that have an email address.
- [ ] Page caching / CDN: exclude cart, checkout, my-account and the
      order-received page (standard WooCommerce advice; the credentials card is
      per-customer).
- [ ] Safari/iOS and Firefox (tests ran in Chromium only).
- [ ] WooCommerce admin screens (not built in the test environment).
- [ ] Screen-reader pass (axe is automated; a manual NVDA/VoiceOver check is
      still worth doing).

### Security notes on the phone-account flow

- The generated password is shown once to the signed-in buyer, kept only in
  their WooCommerce session for 30 minutes, never stored on the order, never
  logged or emailed; WordPress stores only its hash.
- An existing account with the same number is never attached to the order, and
  the page doesn't reveal whether such an account exists.
- Tracking requires both the order number and the matching mobile number and
  shows no addresses. There is no rate limiting; add it at the firewall/host
  level if order numbers are sequential and guessable on your store.
