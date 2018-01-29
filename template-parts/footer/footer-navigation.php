<?php
/**
 * The template for displaying the footer navigation
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

if ( ! has_nav_menu( 'footer' ) ) {
	return;
}

?>
<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'torro-devhub' ); ?>">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => 'footer-menu',
		'depth'          => 1,
		'container'      => false,
	) );
	?>
</nav><!-- .footer-navigation -->
