<?php
/**
 * The template for displaying site info in the footer
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

?>
<div class="site-info">
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'torro-devhub' ) ); ?>"><?php
		/* translators: %s: CMS name, i.e. WordPress. */
		printf( esc_html__( 'Proudly powered by %s', 'torro-devhub' ), 'WordPress' );
	?></a>
	<span class="sep"> | </span>
	<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf( esc_html__( 'Theme: %1$s by %2$s.', 'torro-devhub' ), 'Torro DevHub', '<a href="http://developer.torro-forms.com">Felix Arntz</a>' );
	?>
</div><!-- .site-info -->
