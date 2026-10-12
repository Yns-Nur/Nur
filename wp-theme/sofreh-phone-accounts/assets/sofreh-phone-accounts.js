/**
 * Copy buttons on the order confirmation and tracking pages.
 */
( function () {
	'use strict';

	var l10n = window.sofrehPA || { copied: 'Copied' };
	var live = document.createElement( 'div' );
	live.className = 'screen-reader-text';
	live.setAttribute( 'aria-live', 'polite' );
	document.body.appendChild( live );

	function copyText( text ) {
		if ( navigator.clipboard && window.isSecureContext ) {
			return navigator.clipboard.writeText( text );
		}
		// Fallback for http:// and older browsers.
		return new Promise( function ( resolve, reject ) {
			var area = document.createElement( 'textarea' );
			area.value = text;
			area.setAttribute( 'readonly', '' );
			area.style.position = 'fixed';
			area.style.opacity = '0';
			document.body.appendChild( area );
			area.select();
			var ok = document.execCommand( 'copy' );
			document.body.removeChild( area );
			if ( ok ) {
				resolve();
			} else {
				reject();
			}
		} );
	}

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.sofreh-pa-copy' );
		if ( ! button ) {
			return;
		}
		copyText( button.getAttribute( 'data-copy' ) ).then( function () {
			button.classList.add( 'is-copied' );
			live.textContent = l10n.copied;
			window.setTimeout( function () {
				button.classList.remove( 'is-copied' );
				live.textContent = '';
			}, 1800 );
		} ).catch( function () {
			// Copy blocked: select the value so it can be copied by hand.
			var code = button.parentNode.querySelector( 'code' );
			if ( code && window.getSelection ) {
				var range = document.createRange();
				range.selectNodeContents( code );
				window.getSelection().removeAllRanges();
				window.getSelection().addRange( range );
			}
		} );
	} );
}() );
