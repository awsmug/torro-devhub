<?php
/**
 * The template for displaying the social navigation in the footer
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

if ( ! has_nav_menu( 'social' ) ) {
	return;
}

?>
<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'torro-devhub' ); ?>">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'social',
		'menu_class'     => 'social-links-menu',
		'depth'          => 1,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . torro_devhub_get_svg( 'chain' ),
		'container'      => false,
	) );
	?>
</nav><!-- .social-navigation -->
