/**
 * Sofreh theme behaviour. No dependencies; loaded deferred.
 *
 * 1. Drawers: the mobile menu and the mobile filters panel.
 * 2. Desktop category menu.
 * 3. Banner carousel and sideways product shelves.
 * 4. Add to cart: the product image flies to the cart, the count bumps.
 * 5. Product page: sticky buy bar on phones.
 * 6. Quantity steppers (− / +) around WooCommerce quantity inputs.
 * 7. Persian/Arabic digits typed into phone and postcode fields become ASCII.
 * 8. Header shadow on scroll; cart counts after Cart/Checkout block changes.
 *
 * Everything degrades to working HTML: the carousel and shelves scroll
 * natively, the drawer category list uses <details>, the forms post.
 */
( function () {
	'use strict';

	var l10n = window.sofrehL10n || { increase: '+', decrease: '−', pause: 'Pause', play: 'Play' };
	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var isRtl = document.documentElement.dir === 'rtl';
	var focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]):not([type="hidden"]), select:not([disabled]), textarea:not([disabled]), summary, [tabindex]:not([tabindex="-1"])';

	/* ------------------------------------------------------------------ */
	/* 1. Drawers                                                          */
	/* ------------------------------------------------------------------ */

	var backdrop = document.querySelector( '[data-sofreh-backdrop]' );
	var openDrawer = null;
	var lastOpener = null;

	function isDrawerMode( panel ) {
		return window.getComputedStyle( panel ).position === 'fixed';
	}

	function setOpeners( id, expanded ) {
		document.querySelectorAll( '[aria-controls="' + id + '"][data-sofreh-open]' ).forEach( function ( el ) {
			el.setAttribute( 'aria-expanded', expanded ? 'true' : 'false' );
		} );
	}

	function openPanel( panel, opener ) {
		if ( ! panel || ! isDrawerMode( panel ) ) {
			return;
		}
		if ( openDrawer ) {
			closePanel( openDrawer, false );
		}
		openDrawer = panel;
		lastOpener = opener || null;
		panel.classList.add( 'is-open' );
		panel.setAttribute( 'role', 'dialog' );
		panel.setAttribute( 'aria-modal', 'true' );
		if ( ! panel.hasAttribute( 'aria-labelledby' ) ) {
			var title = panel.querySelector( '.site-drawer__title' );
			if ( title ) {
				panel.setAttribute( 'aria-label', title.textContent.trim() );
			}
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

	function closePanel( panel, restoreFocus ) {
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
			openPanel( document.getElementById( opener.getAttribute( 'data-sofreh-open' ) ), opener );
			return;
		}
		var closer = event.target.closest( '[data-sofreh-close]' );
		if ( closer ) {
			event.preventDefault();
			closePanel( document.getElementById( closer.getAttribute( 'data-sofreh-close' ) ) );
			return;
		}
		if ( openDrawer && event.target === backdrop ) {
			closePanel( openDrawer );
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( ! openDrawer ) {
			return;
		}
		if ( event.key === 'Escape' ) {
			closePanel( openDrawer );
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

	window.addEventListener( 'resize', function () {
		if ( openDrawer && ! isDrawerMode( openDrawer ) ) {
			closePanel( openDrawer, false );
		}
	} );

	/* ------------------------------------------------------------------ */
	/* 2. Desktop category menu                                            */
	/* ------------------------------------------------------------------ */

	var mega = document.querySelector( '.mega' );
	if ( mega ) {
		var megaToggle = mega.querySelector( '.mega__toggle' );
		var megaPanel = mega.querySelector( '.mega__panel' );
		var hoverTimer = null;

		var openedAt = 0;
		var setMega = function ( open ) {
			if ( open && megaPanel.hidden ) {
				openedAt = Date.now();
			}
			megaPanel.hidden = ! open;
			megaToggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		};

		megaToggle.addEventListener( 'click', function () {
			// A click right after hover opened the menu means "open", not "close".
			if ( ! megaPanel.hidden && Date.now() - openedAt < 600 ) {
				return;
			}
			setMega( megaPanel.hidden );
		} );
		// Hover intent for mouse users; a short delay stops the menu flashing
		// open when the pointer only crosses the button.
		mega.addEventListener( 'mouseenter', function () {
			window.clearTimeout( hoverTimer );
			hoverTimer = window.setTimeout( function () {
				setMega( true );
			}, 120 );
		} );
		mega.addEventListener( 'mouseleave', function () {
			window.clearTimeout( hoverTimer );
			hoverTimer = window.setTimeout( function () {
				setMega( false );
			}, 160 );
		} );
		megaPanel.addEventListener( 'mouseenter', function () {
			window.clearTimeout( hoverTimer );
		} );
		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && ! megaPanel.hidden ) {
				setMega( false );
				megaToggle.focus();
			}
		} );
		document.addEventListener( 'focusin', function ( event ) {
			if ( ! megaPanel.hidden && ! mega.contains( event.target ) ) {
				setMega( false );
			}
		} );
		document.addEventListener( 'click', function ( event ) {
			if ( ! megaPanel.hidden && ! mega.contains( event.target ) ) {
				setMega( false );
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/* 3. Banner carousel and product shelves                              */
	/* ------------------------------------------------------------------ */

	// Scroll position of slide i in a horizontally scrolling track, in the
	// track's writing direction (RTL tracks scroll into negative values).
	function slideOffset( track, i ) {
		return ( isRtl ? -1 : 1 ) * track.clientWidth * i;
	}

	document.querySelectorAll( '[data-sofreh-carousel]' ).forEach( function ( carousel ) {
		var track = carousel.querySelector( '.banner__track' );
		var slides = track ? track.children : [];
		if ( ! track || slides.length < 2 ) {
			return;
		}
		var dots = carousel.querySelectorAll( '[data-carousel-to]' );
		var pauseButton = carousel.querySelector( '[data-carousel="pause"]' );
		var current = 0;
		var timer = null;
		var userPaused = reduceMotion;
		var hovering = false;

		function go( i ) {
			current = ( i + slides.length ) % slides.length;
			track.scrollTo( { left: slideOffset( track, current ), behavior: reduceMotion ? 'auto' : 'smooth' } );
		}

		function syncDots() {
			var i = Math.round( Math.abs( track.scrollLeft ) / track.clientWidth );
			current = Math.max( 0, Math.min( slides.length - 1, i ) );
			dots.forEach( function ( dot, n ) {
				dot.classList.toggle( 'is-current', n === current );
				dot.setAttribute( 'aria-current', n === current ? 'true' : 'false' );
			} );
		}

		function schedule() {
			window.clearInterval( timer );
			if ( userPaused || hovering ) {
				return;
			}
			timer = window.setInterval( function () {
				go( current + 1 );
			}, 6000 );
		}

		var scrollTimer = null;
		track.addEventListener( 'scroll', function () {
			window.clearTimeout( scrollTimer );
			scrollTimer = window.setTimeout( syncDots, 80 );
		}, { passive: true } );

		carousel.addEventListener( 'click', function ( event ) {
			var dot = event.target.closest( '[data-carousel-to]' );
			if ( dot ) {
				go( parseInt( dot.getAttribute( 'data-carousel-to' ), 10 ) );
				schedule();
				return;
			}
			var nav = event.target.closest( '[data-carousel]' );
			if ( ! nav ) {
				return;
			}
			var action = nav.getAttribute( 'data-carousel' );
			if ( action === 'next' ) {
				go( current + 1 );
				schedule();
			} else if ( action === 'prev' ) {
				go( current - 1 );
				schedule();
			} else if ( action === 'pause' ) {
				userPaused = ! userPaused;
				nav.setAttribute( 'aria-pressed', userPaused ? 'true' : 'false' );
				schedule();
			}
		} );

		// Autoplay pauses while the visitor is pointing at, touching or
		// focused inside the banner, and never starts under reduced motion.
		carousel.addEventListener( 'mouseenter', function () {
			hovering = true;
			schedule();
		} );
		carousel.addEventListener( 'mouseleave', function () {
			hovering = false;
			schedule();
		} );
		carousel.addEventListener( 'focusin', function () {
			hovering = true;
			schedule();
		} );
		carousel.addEventListener( 'focusout', function () {
			hovering = false;
			schedule();
		} );
		track.addEventListener( 'touchstart', function () {
			hovering = true;
			schedule();
		}, { passive: true } );
		track.addEventListener( 'touchend', function () {
			hovering = false;
			schedule();
		}, { passive: true } );

		if ( pauseButton ) {
			pauseButton.setAttribute( 'aria-pressed', userPaused ? 'true' : 'false' );
			if ( reduceMotion ) {
				pauseButton.hidden = true;
			}
		}
		syncDots();
		schedule();
	} );

	document.querySelectorAll( '[data-sofreh-scroller]' ).forEach( function ( shelf ) {
		var list = shelf.querySelector( 'ul.products' );
		var prev = shelf.querySelector( '[data-scroll="prev"]' );
		var next = shelf.querySelector( '[data-scroll="next"]' );
		if ( ! list || ! prev || ! next ) {
			return;
		}
		function update() {
			var max = list.scrollWidth - list.clientWidth;
			var pos = Math.abs( list.scrollLeft );
			prev.disabled = pos < 4;
			next.disabled = pos > max - 4;
		}
		function by( direction ) {
			var step = list.clientWidth * 0.8 * direction * ( isRtl ? -1 : 1 );
			list.scrollBy( { left: step, behavior: reduceMotion ? 'auto' : 'smooth' } );
		}
		prev.addEventListener( 'click', function () {
			by( -1 );
		} );
		next.addEventListener( 'click', function () {
			by( 1 );
		} );
		list.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	} );

	/* ------------------------------------------------------------------ */
	/* 4. Add to cart: flight and count bump                               */
	/* ------------------------------------------------------------------ */

	function visibleCartTarget() {
		var candidates = document.querySelectorAll( '.tabbar-cart .tabbar__icon, .header-cart' );
		for ( var i = 0; i < candidates.length; i++ ) {
			var r = candidates[ i ].getBoundingClientRect();
			if ( r.width > 0 && r.height > 0 ) {
				return candidates[ i ];
			}
		}
		return null;
	}

	// The image of the product whose button was pressed flies into the cart.
	function flyToCart( sourceImg ) {
		var target = visibleCartTarget();
		if ( reduceMotion || ! sourceImg || ! target || ! sourceImg.animate ) {
			return;
		}
		var from = sourceImg.getBoundingClientRect();
		var to = target.getBoundingClientRect();
		if ( ! from.width ) {
			return;
		}
		var ghost = sourceImg.cloneNode( false );
		ghost.removeAttribute( 'srcset' );
		ghost.removeAttribute( 'sizes' );
		ghost.className = 'fly-to-cart';
		ghost.setAttribute( 'alt', '' );
		ghost.style.left = from.left + 'px';
		ghost.style.top = from.top + 'px';
		ghost.style.width = from.width + 'px';
		ghost.style.height = from.height + 'px';
		document.body.appendChild( ghost );
		var dx = ( to.left + to.width / 2 ) - ( from.left + from.width / 2 );
		var dy = ( to.top + to.height / 2 ) - ( from.top + from.height / 2 );
		var animation = ghost.animate( [
			{ transform: 'translate(0, 0) scale(1)', opacity: 1, borderRadius: '10px' },
			{ transform: 'translate(' + ( dx * 0.45 ) + 'px, ' + ( dy * 0.2 - 60 ) + 'px) scale(0.55)', opacity: 1, borderRadius: '30%', offset: 0.45 },
			{ transform: 'translate(' + dx + 'px, ' + dy + 'px) scale(0.12)', opacity: 0.3, borderRadius: '50%' },
		], { duration: 700, easing: 'cubic-bezier(0.4, 0, 0.2, 1)' } );
		animation.onfinish = function () {
			ghost.remove();
		};
	}

	var pendingFlight = null;
	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.add_to_cart_button.ajax_add_to_cart' );
		if ( button ) {
			var card = button.closest( 'li.product' );
			pendingFlight = card ? card.querySelector( '.product-card__media img' ) : null;
		}
	}, true );

	var lastCount = null;
	function readCount() {
		var el = document.querySelector( '.cart-count' );
		return el ? el.textContent.trim() : null;
	}
	lastCount = readCount();

	function bumpIfChanged() {
		var now = readCount();
		if ( now !== null && lastCount !== null && now !== lastCount && ! reduceMotion ) {
			document.querySelectorAll( '.cart-count' ).forEach( function ( el ) {
				el.classList.remove( 'is-bumped' );
				void el.offsetWidth; // Restart the animation.
				el.classList.add( 'is-bumped' );
			} );
		}
		lastCount = now;
	}

	if ( window.jQuery ) {
		window.jQuery( document.body ).on( 'added_to_cart', function () {
			flyToCart( pendingFlight );
			pendingFlight = null;
			window.setTimeout( bumpIfChanged, reduceMotion ? 0 : 600 );
		} );
		window.jQuery( document.body ).on( 'removed_from_cart wc_fragments_refreshed wc_fragments_loaded', bumpIfChanged );
	}

	/* ------------------------------------------------------------------ */
	/* 5. Product page: sticky buy bar (phones)                            */
	/* ------------------------------------------------------------------ */

	var buyBar = document.querySelector( '[data-sofreh-buybar]' );
	var buyBox = document.getElementById( 'buy-box' );
	if ( buyBar && buyBox && 'IntersectionObserver' in window ) {
		new IntersectionObserver( function ( entries ) {
			// Show the bar only once the buy box has scrolled up and away.
			var e = entries[ 0 ];
			buyBar.hidden = e.isIntersecting || e.boundingClientRect.top > 0;
		} ).observe( buyBox );

		buyBar.addEventListener( 'click', function ( event ) {
			var button = event.target.closest( '[data-sofreh-buy]' );
			if ( ! button ) {
				return;
			}
			var real = buyBox.querySelector( '.single_add_to_cart_button' );
			if ( button.getAttribute( 'data-sofreh-buy' ) === 'add' && real && ! real.disabled && ! real.classList.contains( 'disabled' ) ) {
				real.click();
			} else {
				buyBox.scrollIntoView( { behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' } );
				var firstChoice = buyBox.querySelector( 'select, input.qty' );
				if ( firstChoice ) {
					window.setTimeout( function () {
						firstChoice.focus( { preventScroll: true } );
					}, reduceMotion ? 0 : 400 );
				}
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/* 6. Quantity steppers                                                */
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
			wrap.insertBefore( makeButton( 'plus', l10n.increase ), input );
			wrap.appendChild( makeButton( 'minus', l10n.decrease ) );
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
	/* 7. Digits in phone and postcode fields                              */
	/* ------------------------------------------------------------------ */

	// WooCommerce validates these in the browser (the block checkout even
	// blocks the order with "Please enter a valid postcode"), before the
	// server-side normalization in inc/persian.php can run. So digits are
	// converted as they are typed or pasted. The theme font draws ASCII
	// digits with Persian shapes, so the customer sees no change.
	var digitFields = 'input[type="tel"], input[name$="postcode"], input[id$="-postcode"], input[autocomplete="postal-code"], input[autocomplete="tel"], input[name="sofreh_pa_mobile"]';
	var nonAsciiDigit = /[۰-۹٠-٩]/;

	function toAsciiDigits( value ) {
		return value.replace( /[۰-۹٠-٩]/g, function ( d ) {
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
	/* 8. Header shadow; cart counts after block cart changes              */
	/* ------------------------------------------------------------------ */

	var header = document.getElementById( 'masthead' );
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 4 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	function refreshFragments() {
		if ( window.jQuery ) {
			window.jQuery( document.body ).trigger( 'wc_fragment_refresh' );
		}
	}
	document.body.addEventListener( 'wc-blocks_added_to_cart', refreshFragments );
	document.body.addEventListener( 'wc-blocks_removed_from_cart', refreshFragments );
}() );
