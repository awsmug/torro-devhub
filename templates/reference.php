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

global $is_reference_page;

$is_reference_page = true;

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
				<h2><?php esc_html_e( 'Search through the codebase', 'torro-devhub' ); ?></h2>

				<p><?php esc_html_e( 'Enter the name of a function, method, hook, class, trait or interface to learn more.', 'torro-devhub' ); ?></p>
				<?php get_search_form(); ?>

				<p><?php esc_html_e( 'Or browse through the respective lists:', 'torro-devhub' ); ?></p>
				<ul class="inline-list">
					<?php foreach ( torro_devhub_devhub_get_post_types( true, true ) as $post_type => $label ) : ?>
						<li>
							<a href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>"><?php echo esc_html( $label ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
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

$is_reference_page = false;
