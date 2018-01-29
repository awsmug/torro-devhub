<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Handles JavaScript and SVG detection.
 *
 * @since 1.0.0
 */
function torro_devhub_js_svg_detection() {
	?>
	<script>
		(function( html ) {
			function supportsInlineSVG() {
				var div = document.createElement( 'div' );
				div.innerHTML = '<svg/>';
				return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
			}

			html.className = html.className.replace( /(\s*)no-js(\s*)/, '$1js$2' );

			if ( true === supportsInlineSVG() ) {
				html.className = html.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		})( document.documentElement );
	</script>
	<?php
}
add_action( 'wp_head', 'torro_devhub_js_svg_detection', 0 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array Modified classes.
 */
function torro_devhub_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class to indicate the sidebar mode.
	if ( ! torro_devhub_display_sidebar() ) {
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = get_theme_mod( 'sidebar_mode', 'right-sidebar' );
	}

	// Adds a class to indicate the sidebar size.
	$classes[] = 'sidebar-' . get_theme_mod( 'sidebar_size', 'medium' );

	return $classes;
}
add_filter( 'body_class', 'torro_devhub_body_classes' );

/**
 * Adds a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since 1.0.0
 */
function torro_devhub_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'torro_devhub_pingback_header' );

/**
 * Replaces the "[...]" used for automatically generated excerpts with an accessible 'Continue reading' link.
 *
 * @since 1.0.0
 *
 * @return string Accessible 'Continue reading' link prepended with an ellipsis.
 */
function torro_devhub_excerpt_more() {
	$link = sprintf(
		wp_kses(
			/* translators: %s: post title */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'torro-devhub' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title()
	);

	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'torro_devhub_excerpt_more' );

/**
 * Disable core styles for the special 'wp-signup.php' and 'wp-activate.php' pages.
 *
 * @since 1.0.0
 *
 * @param string $name Identifier of the header to load.
 */
function torro_devhub_disable_special_page_styles( $name ) {
	if ( 'wp-signup' === $name ) {
		remove_action( 'wp_head', 'wpmu_signup_stylesheet' );
	} elseif ( 'wp-activate' === $name ) {
		remove_action( 'wp_head', 'wpmu_activate_stylesheet' );
	}
}
add_action( 'get_header', 'torro_devhub_disable_special_page_styles' );

/**
 * Sets up global attachment metadata.
 *
 * This is a utility hook to make the torro_devhub_get_attachment_metadata() function
 * more performant when in the loop.
 *
 * @since 1.0.0
 *
 * @global array $torro_devhub_attachment_metadata Metadata array for the current post.
 *
 * @param WP_Post $post Post object.
 */
function torro_devhub_setup_attachment_metadata( $post ) {
	global $torro_devhub_attachment_metadata;

	if ( 'attachment' === $post->post_type ) {
		$torro_devhub_attachment_metadata = torro_devhub_get_attachment_metadata( $post->ID );
		$torro_devhub_attachment_metadata['_id'] = $post->ID;
	} elseif ( isset( $torro_devhub_attachment_metadata ) ) {
		unset( $torro_devhub_attachment_metadata );
	}
}
add_action( 'the_post', 'torro_devhub_setup_attachment_metadata' );
