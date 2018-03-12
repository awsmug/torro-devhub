<?php
/**
 * Torro DevHub functions and definitions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

define( 'TORRO_DEVHUB_VERSION', '1.0.0' );

/**
 * Loads the theme's textdomain.
 *
 * @since 1.0.0
 */
function torro_devhub_load_textdomain() {
	load_theme_textdomain( 'torro-devhub', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'torro_devhub_load_textdomain', 0 );

/**
 * The theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Theme setup.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Asset management functions.
 */
require get_template_directory() . '/inc/assets.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Additional theme functions to use from within templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * DevHub functionality.
 */
require get_template_directory() . '/inc/devhub.php';

/**
 * Plugin compatibility.
 */
require get_template_directory() . '/inc/plugin-compat.php';

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets/class-torro-devhub-widget-featured-tutorials.php';
require get_template_directory() . '/inc/widgets/class-torro-devhub-widget-latest-tutorials.php';
