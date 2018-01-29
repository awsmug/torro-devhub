<?php
/**
 * WP Subtitle compatibility functions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Prints the subtitle for any post.
 *
 * @since 1.0.0
 */
function torro_devhub_wp_subtitle_print_post_subtitle() {
	if ( is_singular() ) {
		the_subtitle( '<p class="entry-subtitle">', '</p>' );
	} else {
		the_subtitle( '<p class="entry-subtitle"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
	}
}
add_action( 'torro_devhub_after_entry_title', 'torro_devhub_wp_subtitle_print_post_subtitle' );
