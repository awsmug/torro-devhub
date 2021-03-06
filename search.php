<?php
/**
 * The template for displaying search results pages
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
				<h1><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'torro-devhub' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content/content-search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/none' );

		endif; ?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
