<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Global used to access sidebar registration data.
 *
 * @global array $wp_registered_sidebars Associative array of registered sidebars.
 */
global $wp_registered_sidebars;

if ( ! torro_devhub_display_sidebar() ) {
	return;
}

$sidebar_slug = torro_devhub_get_sidebar_name();

if ( ! is_active_sidebar( $sidebar_slug ) ) {
	return;
}

$sidebar_title = __( 'Primary Sidebar', 'torro-devhub' );
if ( isset( $wp_registered_sidebars[ $sidebar_slug ] ) ) {
	$sidebar_title = $wp_registered_sidebars[ $sidebar_slug ]['name'];
}

?>

	<aside id="sidebar" class="site-sidebar widget-area" aria-label="<?php echo esc_attr( $sidebar_title ); ?>">
		<?php dynamic_sidebar( $sidebar_slug ); ?>
	</aside><!-- #sidebar -->
