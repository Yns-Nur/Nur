=== Sofreh ===
Contributors: yns-nur
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: e-commerce, rtl-language-support, translation-ready, custom-logo, custom-menu, featured-images, footer-widgets, right-sidebar, theme-options, threaded-comments, wide-blocks, block-styles

A Persian, right-to-left WooCommerce theme for home and kitchen stores.

== Description ==

Sofreh (سفره) is a minimalist storefront theme designed right-to-left first, for
Persian shops that sell home and kitchen goods. Categories are browsed in arched
frames (the iwan arch is the theme's one decorative motif), product pages put
price, stock and the add-to-cart button first, and the classic and block-based
cart, checkout and account pages are styled to match.

* WooCommerce integration through hooks only: no template overrides to fall out
  of date.
* Persian (fa_IR) translation included; WooCommerce and WordPress strings come
  from their official language packs.
* Persian digits everywhere via the bundled Vazirmatn FD typeface, while stored
  data stays in ASCII digits.
* Phone numbers and postcodes typed on a Persian keyboard are accepted on the
  classic checkout, the Checkout block and the account address form.
* Product categories, menus and home page sections come from the store itself;
  nothing is hard-coded.
* Restrained motion (scroll reveal, hover and press feedback, cart count bump)
  that switches off under "reduce motion".
* Keyboard-accessible drawers for the mobile menu and filters; WCAG AA colour
  contrast.

For phone-number checkout with automatic account creation, install the
companion plugin "Sofreh Phone Accounts" (shipped alongside this theme).

== Installation ==

1. Set the site language to فارسی (Settings → General) and update translations
   (Dashboard → Updates) so WordPress and WooCommerce are in Persian.
2. Upload the theme (Appearance → Themes → Add New → Upload) and activate it.
3. Install and activate WooCommerce, then set currency (Toman or Rial) and the
   store address in WooCommerce → Settings.
4. Adjust the home page, promises strip, product page note and contact details
   in Appearance → Customize → Sofreh theme.
5. Optional: import sample-data/sample-products.csv with WooCommerce's product
   importer to preview the theme. Every sample item is marked "(نمونه)".

== Frequently Asked Questions ==

= Does the theme require WooCommerce? =

No, it works as a Persian blog theme without it. The store features appear once
WooCommerce is active.

= Can I show Jalali (Persian calendar) dates? =

The theme uses WordPress's date functions, so a Jalali date plugin works with it.

== Changelog ==

= 1.0.0 =
* First release.

== Copyright ==

Sofreh WordPress Theme, Copyright 2026 Younes Nur.
Sofreh is distributed under the terms of the GNU GPL v2 or later.

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 2 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

Sofreh bundles the following third-party resources:

Vazirmatn font, Copyright 2015 The Vazirmatn Project Authors
License: SIL Open Font License 1.1 (assets/fonts/OFL.txt)
Source: https://github.com/rastikerdar/vazirmatn

Icons: drawn for this theme, GPLv2 or later.

Screenshot: the product and hero images shown are placeholder artwork made for
this theme (GPLv2 or later); they are not included as theme assets.
