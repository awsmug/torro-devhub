/**
 * File navbar.js.
 *
 * Handles the fixed navigation bar.
 */

class Navbar {
	constructor( containerId, options ) {
		this.container = document.getElementById( containerId );
		this.options   = options || {};
	}

	initialize() {
		if ( ! this.container ) {
			return;
		}

		this.initializeFixedNavbar();
	}

	initializeFixedNavbar() {
		const container = this.container;
		const containerOffset = container.offsetTop;

		function fixNavbar() {
			const currentOffset = ( document.body.classList.contains( 'admin-bar' ) && document.body.clientWidth <= 600 ) ? containerOffset + 46 : containerOffset;

			if ( window.scrollY >= currentOffset ) {
				document.body.style.paddingTop = `${container.offsetHeight}px`;
				document.body.classList.add( 'has-fixed-navbar' );
			} else {
				document.body.style.paddingTop = 0;
				document.body.classList.remove( 'has-fixed-navbar' );
			}
		}

		window.addEventListener( 'scroll', fixNavbar );
		window.addEventListener( 'resize', fixNavbar );
	}
}

export default Navbar;
