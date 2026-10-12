=== Sofreh Phone Accounts ===
Contributors: yns-nur
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.4
Requires Plugins: woocommerce
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Buy with a mobile number; the customer account is created automatically and its
login details are shown on the order confirmation page.

== Description ==

* Checkout never sends a signed-out customer to a registration page: anyone can
  buy straight away.
* The mobile number is required and becomes the username. Persian/Arabic digits,
  spaces and +98 / 0098 prefixes are accepted and stored as 09XXXXXXXXX.
* When the order is placed, a customer account is created with a generated
  password, the order is attached to it, the checkout addresses are saved to it
  and the customer is signed in (as WooCommerce does for its own checkout
  sign-up).
* The order confirmation page shows the order tracking code, the username and
  the password, with copy buttons, and links to complete the account.
* The password is kept only in that customer's session for 30 minutes. It is
  never stored with the order, never written to a log and never sent by email
  or SMS; WordPress stores only its hash.
* If an account with the number already exists, the order is NOT attached to it
  and nothing about it is revealed; the page simply suggests signing in.
* Customers sign in later with the mobile number (any digit form) and the
  password, and are reminded on their dashboard to complete their account.
* A [sofreh_order_tracking] form (a "Track your order" page is created on
  activation) shows status, date, total and items for a tracking code + mobile
  number pair. Addresses and other personal details are never shown there.

Works with the classic checkout shortcode and the Checkout block. On the Checkout
block WooCommerce always asks for an email address (it cannot be made optional
there); on the classic checkout the email becomes optional.

== Installation ==

1. Upload the plugin folder to wp-content/plugins/ (or the zip via Plugins → Add
   New → Upload) and activate it. WooCommerce must be active.
2. Activation turns on guest checkout, turns off WooCommerce's own "create an
   account" checkout option (accounts are created automatically instead) and
   creates the "Track your order" page.
3. Add the tracking page to a menu if you like.

== Changelog ==

= 1.0.0 =
* First release.
