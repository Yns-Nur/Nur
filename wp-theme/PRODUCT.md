# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

WordPress + WooCommerce, delivered as an installable classic (PHP) theme with `theme.json`, plus a companion plugin for phone-number accounts. Fixed by the original brief: the theme must be built for WordPress and WooCommerce, use supported APIs and hooks, and avoid template overrides and core edits. Tested against WordPress 7.1 and WooCommerce 11.2.

## Users

**Primary: an everyday Iranian household shopper buying home and kitchen goods.** Cookware, tableware, storage and home basics for regular use, at mid-range prices, where value and trust decide the purchase. About 80% arrive on a phone (confirmed by the user), so the phone is the primary device; desktop is the minority case. Their job is to find the right item in the right category quickly, judge price and quality from the product page, and pay without friction or a registration detour.

**Secondary: the store owner/merchant**, who has no fixed brand yet and configures the store through WordPress (logo, menus, categories, products, Customizer), and must never need code to run it.

## Product Purpose

A complete, installable Persian storefront theme for a multi-category home and kitchen shop: homepage, category and shop listings, product pages, search, cart, checkout and customer account, all in Persian and right-to-left, coherent with each other, and working correctly with WooCommerce. Success: a phone shopper browses categories, finds and evaluates a product, and completes a purchase using only their mobile number, then receives their order tracking code and login details on the confirmation page.

## Positioning

A store theme made Persian-first rather than translated: right-to-left layout, Persian typography and digits throughout, and checkout built around the mobile number, the identifier Iranian shoppers actually use. Buying never requires creating an account first («ساخت حساب» is there for those who want it); for a guest the account is created automatically once the payment succeeds, and the confirmation page hands the customer their tracking code with the account confirmation, username (mobile) and password beside it.

## Operating Context

- Customers arrive mostly on phones, often via shared links, and type on Persian keyboards (Persian digits in phone and postcode fields must be accepted).
- Prices are in Toman or Rial (WooCommerce supports both); Iranian provinces are built into WooCommerce.
- WooCommerce's Persian strings come from the official translate.wordpress.org language packs; the theme ships its own fa_IR translation.
- Cart and checkout may be either WooCommerce's block-based pages (the default on new stores) or the classic shortcode pages; both must look and work right.

## Capabilities and Constraints

- Multiple product categories managed in WooCommerce; nothing in the catalog is hard-coded. Illustrative products and categories are sample content and must be marked as such.
- **Accounts:** account creation is offered in the login section, labelled «ساخت حساب» (My Account tabs, header link, checkout note), so customers can create an account before ordering. A customer who orders while not logged in gets an account created automatically **only after the payment succeeds** (order paid per WooCommerce), with the mobile number as username and a generated password, shown on the order confirmation page beside the order tracking code. Unpaid, failed or cancelled orders create no account. They can sign in later and complete their details.
- Accessibility (WCAG AA), performance, and secure coding are required by the brief.
- No fixed brand, name or logo yet: the theme must work with whatever the merchant sets in WordPress.
- **Undecided:** store name, logo, real product photography, payment gateway, shipping methods, the store's actual policies (delivery, returns, support).

## Brand Commitments

- No store name or logo yet ("keep generic"): the theme works with whatever name/logo the merchant sets in WordPress.
- **Standing visual preference (chosen by the user, 2026-10-12):** the familiar Iranian marketplace convention, played straight and executed at full craft. Benchmark for craft and familiarity: **Digikala**. Match its quality bar and conventions (prominent search, banner, category circles, deals strip, dense but clean product cards, mobile bottom tab bar), never its branding: no Digikala name, logo, exact brand red or proprietary assets. The user asked for it to look "normal" and familiar, and better made.
- **Own identity (user request, 2026-10-12, v2.1):** keep the marketplace layout, but the store must be clearly distinct from Digikala, with a palette that feels beautiful, elegant, premium and lively. Chosen: a Persian jewel palette of lapis (actions, brand), saffron (offers) and plum (depth) on a warm porcelain ground, red for errors only, plus a fine khatam (8-point star) motif. Never drift back to a red-led storefront.
- Minimalist overall, with a moderate amount of purposeful interactive animation (user request).

## Evidence on Hand

- Sample catalogue (CSV) of 16 simple products and one variable product in 13 categories, every item marked «نمونه» (sample). No real product photography exists; any imagery is placeholder and must be labeled.
- **Not on hand, must not be fabricated:** store policies (delivery times, return periods, guarantees), reviews, customer counts, ratings, press, partner logos, e-Namad status. Any promise text is merchant-editable and must default to something the merchant is told to verify.

## Product Principles

1. **The phone is the store.** Every flow is designed for one thumb on a phone first; desktop extends it.
2. **Persian-native, not translated.** RTL, Persian type and digits, Persian-keyboard input everywhere a customer types.
3. **Buy first, account later.** No registration wall; the account comes with the paid purchase, and its details are handed over at once.
4. **Show the goods honestly.** Price, stock and what you get are clear; no invented claims.
5. **WooCommerce stays WooCommerce.** Hooks and supported APIs only, so updates and plugins keep working.

## Accessibility & Inclusion

WCAG 2.1 AA (required by the brief and WooCommerce's theme guidelines): contrast, keyboard operation, focus visibility, accessible names, reduced-motion support.
