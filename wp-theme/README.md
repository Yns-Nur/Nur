# Sofreh (سفره): Persian WooCommerce theme for home & kitchen stores

Two installable packages:

| Folder | What it is |
|---|---|
| [`sofreh/`](sofreh) | The theme (v2.1.0): a classic (PHP) WordPress theme with `theme.json`, RTL-first and phone-first, fully Persian, integrated with WooCommerce through hooks only. |
| [`sofreh-phone-accounts/`](sofreh-phone-accounts) | Companion plugin (v1.2.0): «ساخت حساب» (create an account) before ordering, with the mobile number as the username; or buy as a guest with just a mobile number, and once the payment succeeds an account is created automatically; the order confirmation shows the tracking code with the account confirmation and login details beside it; tracking by code + mobile. |

Account creation is store *functionality*, so it lives in a plugin. If it were
in the theme, switching themes would silently break checkout and logins, and
WordPress/WooCommerce guidelines keep such features out of themes. The theme
styles everything the plugin outputs.

Build the zips with `./build.sh` (writes `dist/sofreh.zip` and
`dist/sofreh-phone-accounts.zip`). Every source file, labelled by its path, is
also collected in [`SOURCE.md`](SOURCE.md).

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
  ships **zero** files under `/woocommerce`: wrappers, toolbar and sort links,
  card media, badges, the buy box and buy bar, breadcrumbs, filters and notes are
  all added with documented hooks/filters (`inc/woocommerce.php`).
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
  browser. The theme normalises digits on the server and in the browser.
- *Gotchas found in source and handled:* from WooCommerce 7.8 the cart-fragments
  script is no longer enqueued everywhere (the theme enqueues it for the header
  and tab-bar cart). From 8.4, an order that belongs to an account is hidden from
  not-logged-in visitors on the confirmation page (the plugin signs the new
  customer in, exactly as WooCommerce's own checkout sign-up does). The guest →
  user session migration reloads session data from the database (the plugin
  writes the credentials only *after* signing in). Manual sign-up can't make the
  email optional: `wc_create_new_customer()` rejects an empty email before any
  filter runs, so the sign-up form asks for mobile + email + password.

**Design process and reasoning (v2 redesign)**

The redesign was done with the *impeccable* design skill: a product brief
([`PRODUCT.md`](PRODUCT.md)), three distinct concepts shown for approval, then a
build against the approved direction, a design-pattern detector pass, and an
independent finish review from screenshots. You chose **Concept C, "the
marketplace standard"**, for an everyday, mid-range store with ~80% phone
traffic, with Digikala as the craft benchmark (its familiarity, never its
branding). The direction is recorded in `.impeccable/surfaces/sofreh.md`.

- *Convention as the commitment.* Iranian shoppers already know the marketplace
  layout, so the theme uses it rather than inventing one: search-first header,
  category mega menu (desktop) and drawer (phone), a swipeable banner, round
  category shortcuts, a special-offers band, a newest shelf, a numbered
  best-seller list, a product page with gallery | details | sticky buy box, and
  a bottom tab bar on phones. Quality shows in spacing, hierarchy, states and
  speed, not in decoration.
- *Phone first.* The tab bar keeps home, categories, cart and account under the
  thumb; the product page has a buy bar above it that appears once the buy box
  scrolls away; listings use a sort *select* + filters drawer on phones and sort
  links + a filter column on desktop.
- *Its own colours (v2.1).* The first version's red-on-grey read too much like
  Digikala, so the layout stayed and the identity moved to a Persian jewel
  palette: **lapis** (لاجوردی, `#2D48C0`) for actions, links, the wordmark and
  every "current" state; **saffron** (زعفرانی, `#FAAB35`) only for offers:
  discount tags, the cart count, the small star before section titles;
  **plum** (`#67237A`) as the deep partner in the banner and the offers band;
  all on a warm porcelain ground (`#F7F4EF`) with indigo-tinted ink. Red is now
  used for errors only. White on lapis is 7.5:1, ink on saffron 8.6:1, lapis
  links 6.8:1 on the ground: every text pair passes WCAG AA.
- *Signature details.* A fine khatam (8-point star) line pattern from Persian
  tilework under the banner and the lapis→plum offers band; a saffron khatam
  star before each section title; a thin saffron–plum–lapis line along the top
  of the header; discount tags in saffron with dark type, squared at one end
  like a price tag. Small, consistent, and nothing like a red marketplace.
- *Type.* **Vazirmatn** only (OFL, bundled and self-hosted, no third-party
  requests), body line height 1.8, never letter-spaced. Its "FD" cut draws ASCII
  digits as Persian through its `ss01` set, which the theme switches on
  explicitly, so the store reads Persian while orders and data keep ASCII digits.
  Fields where Latin digits are expected (email, URL, password, SKU) use plain
  Vazirmatn.
- *Prices.* The discount badge («۱۶٪», read out as «۱۶٪ تخفیف») sits beside the
  price, as on Iranian marketplaces, not over the photo. Variable products whose
  options cost different amounts show "از <lowest price>" (From …) instead of a
  two-price range that wraps badly in narrow cards. The chosen option's own price
  still appears when it is picked.
- *Motion, moderate and purposeful:* the banner swipes (and auto-advances every
  6 s, pausing on hover, focus, touch or the pause button); a product image
  flies to the cart on add-to-cart and the cart count bumps; the mega menu opens
  with hover intent; drawers slide. Nothing else moves. Under
  `prefers-reduced-motion` the banner doesn't auto-advance and the flights and
  bumps are skipped.

---

## 2. Structure

```
wp-theme/
├── README.md · SOURCE.md · PRODUCT.md     this file · all code by path · design brief
├── build.sh                               builds dist/*.zip
├── .impeccable/                           design records: surface brief, review screenshots
├── sofreh/                                THE THEME
│   ├── style.css                          theme header (required by WordPress)
│   ├── theme.json                         palette, fonts (Vazirmatn), sizes, buttons → also styles WooCommerce blocks
│   ├── functions.php                      bootstrap; loads inc/woocommerce.php only when WooCommerce is active
│   ├── header.php                         search-first header, category mega menu, phone drawer, bottom tab bar
│   ├── footer.php                         back-to-top, footer widgets/menu, contact details
│   ├── front-page.php                     home: banner, categories, product strips, promises, page content/posts
│   ├── index.php page.php single.php search.php 404.php searchform.php sidebar.php comments.php
│   ├── inc/
│   │   ├── setup.php                      theme supports, WooCommerce support, menus, widget areas
│   │   ├── enqueue.php                    assets (deferred JS, preloaded font, cart fragments)
│   │   ├── woocommerce.php                all WooCommerce integration (hooks/filters only)
│   │   ├── persian.php                    Persian/Arabic → ASCII digits for phone/postcode (classic, account, Store API)
│   │   ├── customizer.php                 Appearance → Customize → Sofreh theme (banner slides, sections, promises…)
│   │   ├── template-tags.php              category queries and tree (mega menu / drawer), menu fallback, helpers
│   │   └── icons.php                      inline SVG icon set
│   ├── template-parts/home/               hero.php (banner carousel) categories.php products.php trust.php
│   ├── template-parts/content/            card.php none.php category-links.php
│   ├── assets/css/                        main.css (base, header, home, motion) · woocommerce.css · editor.css
│   ├── assets/js/theme.js                 drawers, mega menu, carousel, shelves, fly-to-cart, buy bar, steppers, digits
│   ├── assets/fonts/                      Vazirmatn FD 400/500/700 + Vazirmatn 400 (woff2) + OFL.txt
│   ├── languages/                         sofreh.pot · fa_IR.po/.mo/.l10n.php
│   ├── sample-data/sample-products.csv    SAMPLE catalogue (every item marked «نمونه», SKUs SAMPLE-*)
│   └── screenshot.png · readme.txt
└── sofreh-phone-accounts/                 THE PLUGIN
    ├── sofreh-phone-accounts.php          header, HPOS + blocks compatibility, bootstrap
    ├── includes/class-sofreh-phone-accounts.php
    ├── assets/                            copy-button JS, fallback CSS for other themes
    ├── languages/                         .pot · fa_IR .po/.mo/.l10n.php
    └── readme.txt
```

---

## 3. Setup

The only genuine dependency is **WooCommerce** (for the store). The theme works
as a Persian blog theme without it. The phone-accounts plugin is optional but is
what provides phone checkout, automatic accounts after payment and
mobile-number sign-up.

1. **Persian first.** Settings → General → *Site Language: فارسی*, then
   Dashboard → Updates → *Update translations*. This downloads the official
   WordPress and WooCommerce Persian packs from translate.wordpress.org and
   makes WordPress output `dir="rtl"`. Doing this *before* installing
   WooCommerce makes it create its pages (Shop, Cart, Checkout, My account) with
   Persian titles. Otherwise rename them.
2. **Theme.** Appearance → Themes → Add New → Upload `sofreh.zip` → Activate.
3. **WooCommerce.** Install and activate it. In WooCommerce → Settings → General
   set *Currency: Iranian toman (IRT)* or *Rial (IRR)*, *Number of decimals: 0*,
   store address and selling location (Iran). Keep *Currency position* on
   **Left** or **Left with space** (WooCommerce's default): in right-to-left
   text that prints «۲٬۷۵۰٬۰۰۰ تومان», while the *Right* options print the
   currency before the number (checked in the test store). A Persian thousands
   separator (`٬`) is optional. Add shipping zones and payment methods; Iranian bank
   gateways are separate plugins and are not part of this theme.
4. **Phone checkout and accounts.** Plugins → Add New → Upload
   `sofreh-phone-accounts.zip` → Activate. Activation:
   - enables guest checkout and turns off WooCommerce's own checkout sign-up
     (accounts are created automatically instead, never by redirecting to a
     registration page);
   - makes the phone field required (labelled "mobile number");
   - turns on «ساخت حساب» on the My Account page, with the username generated
     (it becomes the mobile number) and the password chosen by the customer;
   - creates a *Track your order* page (`[sofreh_order_tracking]`).

   **How accounts are made.** Customers can create an account first: My Account
   shows «ورود» and «ساخت حساب» tabs, the header reads «ورود | ساخت حساب», and
   checkout offers «ساخت حساب» with a link that returns to the checkout after
   sign-up. Or they buy as a guest: the order is remembered in their browser
   session, and **only when the order is paid** is an account created with the
   mobile number, the order attached, the customer signed in, and the login
   details shown beside the tracking code on the confirmation page. "Paid" is
   WooCommerce's own definition: the gateway reports payment complete, or the
   order reaches *Processing*/*Completed*.
   - Bank gateways that send the customer back after paying: the account is
     created on that return, then shown on the confirmation page.
   - Cash on delivery: WooCommerce marks the order *Processing* at checkout, so
     the account is created then.
   - Bank transfer (*On hold*): no account yet; the confirmation says it will be
     created once the payment is confirmed. When you mark the order
     *Processing*, the account is created, and the customer sees their login
     details the next time they open the confirmation page in the browser they
     ordered from (a fresh password is set at that moment, since nobody has
     seen one yet).
   - Failed or cancelled payments never create accounts.
   - A mobile number that already has an account: the order is not attached to
     it, and the confirmation suggests signing in.

   The classic checkout (`[woocommerce_checkout]`) makes email optional; the
   Checkout block always asks for an email (a WooCommerce limitation). Manual
   sign-up asks for mobile, email and password: WooCommerce's own sign-up
   (`wc_create_new_customer()`) rejects an empty email before any filter runs,
   and replacing its handler would also bypass captcha/anti-spam plugins that
   hook into it, so the email stays required there. The login field is
   relabelled «شماره موبایل یا ایمیل».

5. **Customize.** Appearance → Customize → *Sofreh theme*:
   - *Banner 1–3*: heading, text, button label, link, background (lapis, plum
     or saffron) and image. A slide shows only when it has a heading; with one
     slide there are no carousel controls.
   - *Home page*: which sections show (categories, special offers, newest, best
     sellers, promises) and how many products per strip.
   - *Store promises*: empty on a fresh install, so the store never claims a
     policy it didn't write; the strip appears once you enter them (examples
     are shown as placeholders).
   - Product-page note, announcement bar, footer text and contact details.

   Menus: assign a *Primary menu* (shown beside the category button; until then
   the top product categories are shown). The category mega menu and the phone
   drawer are built from your WooCommerce categories (two levels, in
   category order). Widgets: *Shop filters* for the listing filter panel (empty =
   category list), footer columns for links or an e-Namad badge (Custom HTML
   widget).
6. **Categories and products** are entirely yours. For a preview, import
   `sofreh/sample-data/sample-products.csv` via Products → Import; delete the
   sample items (SKU prefix `SAMPLE-`, tag «محصول نمونه») before launch. The
   best-seller list appears once products have real sales; the special-offers
   strip appears once products are on sale.
7. Recommended: a Jalali date plugin if you want Persian-calendar dates; the
   theme uses standard WordPress date functions.

---

## 4. Testing checklist and results

**Test environment:** WordPress 7.1.3 + WooCommerce 11.2.1 (built from its
GitHub source, including the Blocks bundle) on PHP 8.3, SQLite database
integration, Chromium via Playwright at 1366, 820 and 390 px wide. All results
below are from the **final v2.1 code** (theme 2.1.0, plugin 1.2.0; everything
re-run after the palette and account changes).

**Limitations of that environment.** These are the reasons some items are still
listed as needing a live site:
- translate.wordpress.org was unreachable, so the official fa_IR packs for
  WordPress and WooCommerce could not be installed. Some WooCommerce strings
  therefore appear in English in test screenshots ("has been added to your
  cart", "(optional)", "Shipment", "Reviews", the privacy text, English month
  names). They come from WooCommerce/WordPress, not the theme; the theme's and
  plugin's own strings are all translated. A **test-only** stub set the core
  text direction to RTL and translated common WooCommerce storefront strings; it
  is not part of the deliverable.
- SQLite instead of MySQL/MariaDB: WooCommerce's stock-reservation query
  (`LOCK IN SHARE MODE`) fails on SQLite, so stock holding during checkout was
  disabled in the test site only (test-only mu-plugin, also not delivered).
- WooCommerce was built from source. Two missing build artefacts (admin
  `feature-config.php`, the `wc-sanitize` script) were generated for the test
  site; WooCommerce's admin UI JavaScript was not built.
- No mail server and no real bank. Payments were tested with cash on delivery,
  WooCommerce's bank transfer (on hold, then marked paid), and a **test-only
  mock bank gateway** that behaves like an Iranian redirect gateway: checkout
  sends the buyer to a bank page with Pay / Cancel, which returns to the order
  confirmation, plus a cookie-less server-to-server "payment confirmed"
  callback. The mock gateway lives only in the test site and is not delivered.

### Verified by automated tests (all passing on the final code)

| Area | Check | Result |
|---|---|---|
| Install | Theme activates with WooCommerce active; works without WooCommerce (blog fallback) | ✅ |
| Install | **Theme Check** (official plugin) | ✅ no errors or warnings; only optional block-theme "recommended" notes |
| Code | **PHPCS**: WordPress Coding Standards + PHP 7.4+ compatibility, theme and plugin | ✅ 0 errors, 0 warnings |
| Code | `php -l` on every PHP file; `node --check` on every JS file | ✅ |
| Design | impeccable design detector on all changed CSS/PHP/JS | ✅ 0 findings |
| Design | New palette: every text pair computed against WCAG (lapis on white 7.5:1, on ground 6.8:1; white on lapis 7.5:1; ink on saffron 8.6:1; muted on ground 5.5:1; error on white 6.6:1); banner in all three tones (lapis, plum, saffron) checked by screenshot | ✅ |
| Design | Independent finish review from screenshots (fresh reviewer, no build context) | ✅ its 8 material fixes applied: price reading order (WooCommerce's `<bdi>` was being stripped by `wp_kses_post`), "From" price unit, no default store promises, compact phone cart, one panel level on store pages, notice focus ring and select2 arrow, SVG stars and remove icon, account icon in the phone header. One declined, see Setup step 4 (sign-up email). |
| RTL | `<html dir="rtl" lang="fa-IR">`; layout mirrors (gallery/details/buy box order, drawers from the right, chevrons, badges, carousel direction incl. RTL scroll offsets) | ✅ (screenshots reviewed) |
| Persian | All theme and plugin UI strings translated (0 missing); Persian digits in prices including struck-through prices; Latin digits kept in SKU/email/password | ✅ |
| Responsive | 15 page types × 3 widths (1366/820/390): **no horizontal overflow, no JS errors** (home, shop, category, sub-category, simple & variable product, product search, no results, cart, checkout, account, tracking, post, 404) | ✅ 45/45 |
| Accessibility | **axe-core** (WCAG 2.0/2.1 A & AA + best practice), 15 pages incl. filled cart and checkout, desktop and mobile | ✅ 0 violations (after fixing link contrast on the grey ground and the checkout heading order) |
| Accessibility | Phone menu drawer: `aria-expanded`, focus moves in, Tab trapped, Esc closes, focus returns; filter drawer closes on backdrop tap | ✅ |
| Categories | Category shortcuts, mega menu, drawer tree, chips and filter panel all come from WooCommerce categories (13 sample categories, 2 levels) | ✅ |
| Product | AJAX add to cart from listings updates header and tab-bar counts; quantity −/+ steppers; variable product stays disabled until an option is chosen | ✅ |
| Cart (classic) | Stepper enables "Update cart"; update works; counts refresh | ✅ |
| Cart (block) | Renders, items listed, counts refresh after block changes | ✅ |
| Checkout (classic) | Order placed with phone and postcode typed in **Persian digits**; stored as ASCII | ✅ |
| Checkout (block) | Same with the Checkout block | ✅ |
| Account | **«ساخت حساب»**: My Account opens on «ورود», the «ساخت حساب» tab shows the sign-up form (button «ساخت حساب»), mobile typed in Persian digits → username = mobile (ASCII), signed in; sign out → sign in with the Persian-digit mobile; a taken mobile and an invalid mobile are rejected with Persian errors; edit address with Persian digits; orders list | ✅ |
| Account | **«ساخت حساب» from checkout**: the checkout note links to the sign-up tab, and after signing up the customer is back on the checkout, signed in, with the mobile pre-filled | ✅ |
| Paid-only accounts | **Bank gateway, paid**: after checkout (order *Pending*) no account exists; after paying at the bank, the account is created, the order attached, the buyer signed in, and the confirmation shows the tracking code and the account confirmation side by side; the shown password signs in | ✅ |
| Paid-only accounts | **Bank gateway, payment failed**: order *Failed*, no account, no account block | ✅ |
| Paid-only accounts | **Bank transfer**: order *On hold*, no account, confirmation says the account is created after payment; store marks it *Processing* → account created; buyer reloads the confirmation → login details shown, and they sign in | ✅ |
| Paid-only accounts | **Server-to-server confirmation** (no browser cookies) → account created; buyer opens the confirmation → login details shown; the same link opened in another browser shows no password | ✅ |
| Phone accounts | Cash on delivery: guest is **not redirected** to registration; phone required; account created when the order becomes *Processing*; order attached; customer signed in; confirmation shows tracking code + username (mobile) + password with working copy buttons; still shown after reload | ✅ classic (no email) and block (with email) |
| Phone accounts | Sign out → sign in with the mobile in **Persian digits** + generated password; "complete your account" prompt; order in My Account | ✅ |
| Phone accounts | Guest order with a mobile that already has an account: order placed, **not** attached to that account, tracking code shown with a sign-in suggestion | ✅ |
| Phone accounts | Tracking page: finds order with Persian-digit code and `+98 …` phone; wrong phone gives a generic error and discloses nothing | ✅ |

### Still to check on a live store (not verifiable here)

- [ ] Real fa_IR language packs: every WooCommerce/WordPress string in Persian,
      including the Cart/Checkout **block** strings.
- [ ] MySQL/MariaDB with stock reservation enabled.
- [ ] Your real bank gateway plugin: it must mark the order paid through
      WooCommerce (`payment_complete()` or a *Processing* status), as standard
      gateways do. Then check the return to the confirmation page shows the
      login details (this relies on the WooCommerce session cookie surviving
      the bank round trip; the mock gateway proved the flow, a real bank must
      still be tried). Gateways that only confirm later by callback are covered
      by the "shown on next visit" path.
- [ ] Order emails, including WooCommerce's "new account" email for
      auto-created accounts that have an email address.
- [ ] Page caching / CDN: exclude cart, checkout, my-account and the
      order-received page (standard WooCommerce advice; the credentials card is
      per-customer).
- [ ] Safari/iOS and Firefox (tests ran in Chromium only), and a real phone for
      the banner swipe and tab bar with the iOS home indicator.
- [ ] WooCommerce admin screens (not built in the test environment).
- [ ] Screen-reader pass (axe is automated; a manual NVDA/VoiceOver check is
      still worth doing).
- [ ] Your real product photos: the layout was checked with plain placeholder
      artwork.
- [ ] Password recovery for phone-only accounts: an account created at checkout
      without an email can't use "Lost password" (it sends an email). Add an SMS
      login/OTP plugin, or reset such passwords from Users in the admin.

### Security notes on the phone-account flow

- The generated password is shown once to the signed-in buyer, kept only in
  their WooCommerce session for 30 minutes, never stored on the order, never
  logged or emailed; WordPress stores only its hash.
- An existing account with the same number is never attached to a guest's
  order, so placing an order never grants access to someone else's account.
  Whether a number has an account is not secret: the sign-up form says so (as
  WooCommerce's own form does for emails), and the confirmation page suggests
  signing in.
- Tracking requires both the order number and the matching mobile number and
  shows no addresses. There is no rate limiting; add it at the firewall/host
  level if order numbers are sequential and guessable on your store.
- All input is sanitised and all output escaped (checked by PHPCS's WordPress
  security sniffs); forms use WooCommerce's own nonces.
