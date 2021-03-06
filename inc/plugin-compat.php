<?php
/**
 * Plugin compatibility functions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Jetpack compatibility.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/plugin-compat/jetpack.php';
}

/**
 * Easy Digital Downloads compatibility.
 */
if ( function_exists( 'EDD' ) ) {
	require get_template_directory() . '/inc/plugin-compat/easy-digital-downloads.php';
}

/**
 * WP Subtitle compatibility.
 */
if ( function_exists( 'the_subtitle' ) ) {
	require get_template_directory() . '/inc/plugin-compat/wp-subtitle.php';
}

/**
 * WP Ajaxify Comments compatibility.
 */
if ( defined( 'WPAC_PLUGIN_NAME' ) ) {
	require get_template_directory() . '/inc/plugin-compat/wp-ajaxify-comments.php';
}

/**
 * Gutenberg compatibility.
 */
if ( defined( 'GUTENBERG_VERSION' ) ) {
	require get_template_directory() . '/inc/plugin-compat/gutenberg.php';
}

/**
 * Torro Forms compatibility.
 */
if ( function_exists( 'torro' ) ) {
	require get_template_directory() . '/inc/plugin-compat/torro-forms.php';
}
