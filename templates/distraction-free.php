<?php
/**
 * Template Name: Distraction Free Page
 *
 * Distraction-free template that uses the distraction-free primary navigation
 * and displays neither a sidebar nor footer widgets.
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

// This file should match the `singular.php` template exactly.
get_header();

?>

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			if ( torro_devhub_use_post_format_templates() ) :
				get_template_part( 'template-parts/content/content-' . get_post_type(), get_post_format() );
			else :
				get_template_part( 'template-parts/content/content', get_post_type() );
			endif;

			if ( torro_devhub_display_post_navigation() ) :
				the_post_navigation();
			endif;

			if ( torro_devhub_display_post_comments() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
