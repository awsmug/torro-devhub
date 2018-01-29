<?php
/**
 * DevHub: Assets
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Enqueues DevHub scripts and styles.
 *
 * @since 1.0.0
 */
function torro_devhub_devhub_enqueue_assets() {
	$post_types = torro_devhub_devhub_get_post_types();
	$taxonomies = torro_devhub_devhub_get_taxonomies();

	if ( is_search() || is_singular( $post_types ) || is_post_type_archive( $post_types ) || is_tax( $taxonomies ) ) {
		wp_enqueue_style( 'torro-devhub-devhub-style', get_theme_file_uri( '/devhub.css' ), array( 'torro-devhub-style' ), TORRO_DEVHUB_VERSION );

		if ( is_singular() ) {
			// Load syntax highlighter assets if plugin is active.
			if ( wp_script_is( 'syntaxhighlighter-core', 'registered' ) ) {
				wp_enqueue_style( 'syntaxhighlighter-core' );
				wp_enqueue_style( 'syntaxhighlighter-theme-default' );
				wp_enqueue_script( 'syntaxhighlighter-core' );
				wp_enqueue_script( 'syntaxhighlighter-brush-php' );
			}

			wp_enqueue_script( 'torro-devhub-devhub-script', get_theme_file_uri( '/devhub.js' ), array( 'torro-devhub-script' ), TORRO_DEVHUB_VERSION, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'torro_devhub_devhub_enqueue_assets' );
