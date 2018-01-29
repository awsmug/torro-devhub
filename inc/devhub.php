<?php
/**
 * DevHub: Integration with PHPDoc Parser
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

if ( class_exists( 'WP_Parser\Plugin' ) ) {
	require get_template_directory() . '/inc/devhub/definitions.php';
	require get_template_directory() . '/inc/devhub/search.php';
	require get_template_directory() . '/inc/devhub/assets.php';
	require get_template_directory() . '/inc/devhub/formatting.php';
	require get_template_directory() . '/inc/devhub/template-hooks.php';
	require get_template_directory() . '/inc/devhub/template-functions.php';
	require get_template_directory() . '/inc/devhub/customizer.php';
}
