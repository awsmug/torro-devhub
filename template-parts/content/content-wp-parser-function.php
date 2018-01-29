<?php
/**
 * Template part for displaying a post of type 'wp-parser-function'
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

if ( function_exists( 'torro_devhub_devhub_get_post_types' ) ) {
	get_template_part( 'template-parts/content/devhub/content', get_post_type() );
} else {
	get_template_part( 'template-parts/content/content' );
}
