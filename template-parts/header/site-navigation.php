<?php
/**
 * The template for displaying the primary site navigation in the header
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$menu_slug = torro_devhub_get_navigation_name();

if ( ! has_nav_menu( $menu_slug ) ) {
	return;
}

?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'torro-devhub' ); ?>">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<?php
		echo torro_devhub_get_svg( 'bars' );
		echo torro_devhub_get_svg( 'close' );
		esc_html_e( 'Menu', 'torro-devhub' );
		?>
	</button>
	<?php
	wp_nav_menu( array(
		'theme_location' => $menu_slug,
		'menu_id'        => 'primary-menu',
		'container'      => false,
	) );
	?>
</nav><!-- #site-navigation -->
