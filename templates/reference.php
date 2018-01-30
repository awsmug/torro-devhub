<?php
/**
 * Template Name: Reference Page
 *
 * The reference page template displays a search form.
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

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

			?>
			<div class="page-search-form">
				<p><?php esc_html_e( 'Enter the name of a function, method, hook, class, trait or interface to learn more about it.', 'torro-devhub' ); ?></p>
				<?php get_search_form(); ?>
			</div>
			<?php

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
