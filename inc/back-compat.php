<?php
/**
 * Back compatibility functions for WordPress versions prior to 4.7
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Prevents switching to the theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
function torro_devhub_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'torro_devhub_upgrade_notice' );
}
add_action( 'after_switch_theme', 'torro_devhub_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to the theme
 * on WordPress versions prior to 4.7.
 *
 * @since 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function torro_devhub_upgrade_notice() {
	/* translators: %s: WordPress version number */
	$message = sprintf( __( 'Torro DevHub requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'torro-devhub' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function torro_devhub_customize() {
	/* translators: %s: WordPress version number */
	wp_die( esc_html( sprintf( __( 'Torro DevHub requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'torro-devhub' ), $GLOBALS['wp_version'] ) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'torro_devhub_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function torro_devhub_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: WordPress version number */
		wp_die( esc_html( sprintf( __( 'Torro DevHub requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'torro-devhub' ), $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'torro_devhub_preview' );
