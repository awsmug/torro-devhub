<?php
/**
 * The template for displaying archive pages
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

get_header();

?>

	<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="archive-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) : the_post();

				if ( torro_devhub_use_post_format_templates() ) :
					get_template_part( 'template-parts/content/content-' . get_post_type(), get_post_format() );
				else :
					get_template_part( 'template-parts/content/content', get_post_type() );
				endif;

			endwhile;

			$args = array();
			if ( is_tax( torro_devhub_devhub_get_taxonomies() ) || is_post_type_archive( torro_devhub_devhub_get_post_types() ) ) {
				$args['prev_text'] = __( 'See more', 'torro-devhub' );
				$args['next_text'] = __( 'Go back', 'torro-devhub' );
			}

			the_posts_navigation( $args );

		else :

			get_template_part( 'template-parts/content/none' );

		endif; ?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
