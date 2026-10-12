/**
 * Sofreh theme behaviour. No dependencies; loaded deferred.
 *
 * 1. Drawers: the mobile menu and the mobile filters panel.
 * 2. Quantity steppers (− / +) around WooCommerce quantity inputs.
 * 3. Header cart count refresh after changes made in the Cart/Checkout blocks.
 * 4. Persian/Arabic digits typed into phone and postcode fields become ASCII
 *    digits, so WooCommerce's browser-side validation accepts them.
 * 5. Motion: scroll reveal, cart-count bump, header shadow on scroll.
 */
( function () {
	'use strict';

	var l10n = window.sofrehL10n || { increase: '+', decrease: '−' };
	var focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]):not([type="hidden"]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';

	/* ------------------------------------------------------------------ */
	/* 1. Drawers                                                          */
	/* ------------------------------------------------------------------ */

	var backdrop = document.querySelector( '[data-sofreh-backdrop]' );
	var openDrawer = null;
	var lastOpener = null;

	function isDrawerMode( panel ) {
		// A panel only behaves as a drawer when CSS positions it off-canvas
		// (small screens). On wide screens it is part of the page.
		return window.getComputedStyle( panel ).position === 'fixed';
	}

	function setOpeners( id, expanded ) {
		document.querySelectorAll( '[aria-controls="' + id + '"]' ).forEach( function ( el ) {
			el.setAttribute( 'aria-expanded', expanded ? 'true' : 'false' );
		} );
	}

	function open( panel, opener ) {
		if ( ! panel || ! isDrawerMode( panel ) ) {
			return;
		}
		if ( openDrawer ) {
			close( openDrawer, false );
		}
		openDrawer = panel;
		lastOpener = opener || null;
		panel.classList.add( 'is-open' );
		panel.setAttribute( 'role', 'dialog' );
		panel.setAttribute( 'aria-modal', 'true' );
		if ( opener && opener.querySelector( '.screen-reader-text' ) && ! panel.hasAttribute( 'aria-labelledby' ) ) {
			panel.setAttribute( 'aria-label', opener.querySelector( '.screen-reader-text' ).textContent.trim() );
		}
		setOpeners( panel.id, true );
		document.documentElement.classList.add( 'has-open-drawer' );
		if ( backdrop ) {
			backdrop.hidden = false;
		}
		window.requestAnimationFrame( function () {
			var first = panel.querySelector( focusableSelector );
			if ( first ) {
				first.focus();
			}
		} );
	}

	function close( panel, restoreFocus ) {
		if ( ! panel ) {
			return;
		}
		panel.classList.remove( 'is-open' );
		panel.removeAttribute( 'role' );
		panel.removeAttribute( 'aria-modal' );
		setOpeners( panel.id, false );
		document.documentElement.classList.remove( 'has-open-drawer' );
		if ( backdrop ) {
			backdrop.hidden = true;
		}
		if ( openDrawer === panel ) {
			openDrawer = null;
		}
		if ( restoreFocus !== false && lastOpener ) {
			lastOpener.focus();
		}
	}

	document.addEventListener( 'click', function ( event ) {
		var opener = event.target.closest( '[data-sofreh-open]' );
		if ( opener ) {
			event.preventDefault();
			open( document.getElementById( opener.getAttribute( 'data-sofreh-open' ) ), opener );
			return;
		}
		var closer = event.target.closest( '[data-sofreh-close]' );
		if ( closer ) {
			event.preventDefault();
			close( document.getElementById( closer.getAttribute( 'data-sofreh-close' ) ) );
			return;
		}
		if ( openDrawer && event.target === backdrop ) {
			close( openDrawer );
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( ! openDrawer ) {
			return;
		}
		if ( event.key === 'Escape' ) {
			close( openDrawer );
			return;
		}
		if ( event.key === 'Tab' ) {
			var items = Array.prototype.filter.call( openDrawer.querySelectorAll( focusableSelector ), function ( el ) {
				return el.offsetWidth > 0 || el.offsetHeight > 0;
			} );
			if ( ! items.length ) {
				return;
			}
			var first = items[ 0 ];
			var last = items[ items.length - 1 ];
			if ( event.shiftKey && document.activeElement === first ) {
				event.preventDefault();
				last.focus();
			} else if ( ! event.shiftKey && document.activeElement === last ) {
				event.preventDefault();
				first.focus();
			}
		}
	} );

	// Leaving drawer mode (rotating a tablet, resizing) closes the drawer.
	window.addEventListener( 'resize', function () {
		if ( openDrawer && ! isDrawerMode( openDrawer ) ) {
			close( openDrawer, false );
		}
	} );

	/* ------------------------------------------------------------------ */
	/* 2. Quantity steppers                                                */
	/* ------------------------------------------------------------------ */

	function decimals( n ) {
		var s = String( n );
		return s.indexOf( '.' ) === -1 ? 0 : s.length - s.indexOf( '.' ) - 1;
	}

	function makeButton( kind, label ) {
		var b = document.createElement( 'button' );
		b.type = 'button';
		b.className = 'qty-step qty-step--' + kind;
		b.setAttribute( 'aria-label', label );
		b.setAttribute( 'data-qty-step', kind );
		b.textContent = kind === 'plus' ? '+' : '−';
		return b;
	}

	function enhanceQuantities( root ) {
		( root || document ).querySelectorAll( '.quantity' ).forEach( function ( wrap ) {
			var input = wrap.querySelector( 'input.qty' );
			if ( ! input || input.type === 'hidden' || wrap.classList.contains( 'has-steppers' ) ) {
				return;
			}
			wrap.classList.add( 'has-steppers' );
			wrap.insertBefore( makeButton( 'minus', l10n.decrease ), input );
			wrap.appendChild( makeButton( 'plus', l10n.increase ) );
		} );
	}

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '[data-qty-step]' );
		if ( ! button ) {
			return;
		}
		var input = button.parentNode.querySelector( 'input.qty' );
		if ( ! input || input.disabled || input.readOnly ) {
			return;
		}
		var step = parseFloat( input.step );
		if ( ! step || step <= 0 ) {
			step = 1;
		}
		var min = input.min === '' ? 0 : parseFloat( input.min );
		var max = input.max === '' ? Infinity : parseFloat( input.max );
		var value = parseFloat( input.value );
		if ( isNaN( value ) ) {
			value = isNaN( min ) ? 0 : min;
		}
		value += button.getAttribute( 'data-qty-step' ) === 'plus' ? step : -step;
		if ( ! isNaN( min ) ) {
			value = Math.max( value, min );
		}
		value = Math.min( value, max );
		input.value = value.toFixed( decimals( step ) );
		// WooCommerce's cart script enables "Update cart" on these events.
		input.dispatchEvent( new Event( 'input', { bubbles: true } ) );
		input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
	} );

	enhanceQuantities();

	// The classic cart and variation forms re-render their markup via AJAX.
	if ( 'MutationObserver' in window ) {
		var pending = false;
		new MutationObserver( function () {
			if ( pending ) {
				return;
			}
			pending = true;
			window.requestAnimationFrame( function () {
				pending = false;
				enhanceQuantities();
			} );
		} ).observe( document.body, { childList: true, subtree: true } );
	}

	/* ------------------------------------------------------------------ */
	/* 3. Header cart count after Cart/Checkout block changes              */
	/* ------------------------------------------------------------------ */

	function refreshFragments() {
		if ( window.jQuery ) {
			window.jQuery( document.body ).trigger( 'wc_fragment_refresh' );
		}
	}
	document.body.addEventListener( 'wc-blocks_added_to_cart', refreshFragments );
	document.body.addEventListener( 'wc-blocks_removed_from_cart', refreshFragments );

	/* ------------------------------------------------------------------ */
	/* 4. Digits in phone and postcode fields                              */
	/* ------------------------------------------------------------------ */

	// WooCommerce validates these in the browser (the block checkout even
	// blocks the order with "Please enter a valid postcode"), before the
	// server-side normalization in inc/persian.php can run. So digits are
	// converted as they are typed or pasted. Because the theme font draws
	// ASCII digits with Persian shapes, the customer sees no change.
	var digitFields = 'input[type="tel"], input[name$="postcode"], input[id$="-postcode"], input[autocomplete="postal-code"], input[autocomplete="tel"]';
	var nonAsciiDigit = /[\u06F0-\u06F9\u0660-\u0669]/;

	function toAsciiDigits( value ) {
		return value.replace( /[\u06F0-\u06F9\u0660-\u0669]/g, function ( d ) {
			var code = d.charCodeAt( 0 );
			return String( code >= 0x06F0 ? code - 0x06F0 : code - 0x0660 );
		} );
	}

	function isDigitField( el ) {
		return el && el.matches && el.matches( digitFields );
	}

	// Typing and pasting: replace the inserted text before it lands. Using
	// insertText keeps the browser's native input event, which React-based
	// forms (Cart and Checkout blocks) rely on to update their state.
	document.addEventListener( 'beforeinput', function ( event ) {
		if ( ! isDigitField( event.target ) ) {
			return;
		}
		var text = event.data;
		if ( ! text && event.dataTransfer ) {
			text = event.dataTransfer.getData( 'text/plain' );
		}
		if ( ! text || ! nonAsciiDigit.test( text ) ) {
			return;
		}
		event.preventDefault();
		document.execCommand( 'insertText', false, toAsciiDigits( text ) );
	}, true );

	// Fallback for values set without a beforeinput event (autofill, scripts)
	// on classic forms, whose state is the field value itself.
	document.addEventListener( 'input', function ( event ) {
		var field = event.target;
		if ( ! isDigitField( field ) || field.closest( '.wc-block-components-form, .wp-block-woocommerce-checkout, .wp-block-woocommerce-cart' ) ) {
			return;
		}
		var fixed = toAsciiDigits( field.value );
		if ( fixed !== field.value ) {
			var start = field.selectionStart;
			var end = field.selectionEnd;
			field.value = fixed;
			try {
				field.setSelectionRange( start, end );
			} catch ( e ) {} // Not every input type supports selection.
		}
	}, true );

	/* ------------------------------------------------------------------ */
	/* 5. Motion                                                           */
	/* ------------------------------------------------------------------ */

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	// Header shadow once the page scrolls under it.
	var header = document.getElementById( 'masthead' );
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	// Scroll reveal. Only blocks that start below the fold are hidden, so
	// nothing the visitor can already see ever blinks out and back in.
	var revealSelector = [
		'.home-section .section-head',
		'.category-grid > li',
		'.trust-strip li',
		'ul.products > li',
		'.post-grid > *',
		'.woocommerce-tabs',
		'.related > h2',
		'.upsells > h2',
		'.site-footer__grid > *'
	].join( ',' );

	if ( ! reduceMotion && 'IntersectionObserver' in window ) {
		var observer = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-visible' );
					observer.unobserve( entry.target );
				}
			} );
		}, { rootMargin: '0px 0px -8% 0px' } );

		var markReveal = function () {
			var fold = window.innerHeight;
			document.querySelectorAll( revealSelector ).forEach( function ( el ) {
				if ( el.classList.contains( 'reveal' ) || el.getBoundingClientRect().top < fold ) {
					return;
				}
				var index = Array.prototype.indexOf.call( el.parentNode.children, el );
				el.style.setProperty( '--reveal-i', String( index % 4 ) );
				el.classList.add( 'reveal' );
				observer.observe( el );
			} );
		};
		markReveal();
	}

	// Cart count bump whenever the number changes (AJAX add to cart, cart
	// updates, block cart changes). WooCommerce swaps the header link via
	// fragments, so the count is compared across replacements.
	var lastCount = null;
	function readCount() {
		var el = document.querySelector( '.header-cart__count' );
		return el ? el.textContent.trim() : null;
	}
	lastCount = readCount();
	function bumpIfChanged() {
		var now = readCount();
		if ( now !== null && lastCount !== null && now !== lastCount && ! reduceMotion ) {
			var el = document.querySelector( '.header-cart__count' );
			el.classList.remove( 'is-bumped' );
			void el.offsetWidth; // Restart the animation.
			el.classList.add( 'is-bumped' );
		}
		lastCount = now;
	}
	if ( window.jQuery ) {
		window.jQuery( document.body ).on( 'added_to_cart removed_from_cart wc_fragments_refreshed wc_fragments_loaded', bumpIfChanged );
	}
}() );
