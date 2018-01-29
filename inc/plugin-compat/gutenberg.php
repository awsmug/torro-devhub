<?php
/**
 * Gutenberg compatibility functions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Registers support for various Gutenberg features.
 *
 * @since 1.0.0
 */
function torro_devhub_gutenberg_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', array(
		'#ffffff',
		'#f1f1f1',
		'#222222',
		'#404040',
		'#8f98a1',
		'#e6e6e6',
		'#21759b',
	) );
}
add_action( 'after_setup_theme', 'torro_devhub_gutenberg_setup' );
