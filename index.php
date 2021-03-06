<?php
/**
 * The main template file
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

get_header();

?>

	<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header class="page-header">
					<h1><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			while ( have_posts() ) : the_post();

				if ( torro_devhub_use_post_format_templates() ) :
					get_template_part( 'template-parts/content/content-' . get_post_type(), get_post_format() );
				else :
					get_template_part( 'template-parts/content/content', get_post_type() );
				endif;

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/none' );

		endif; ?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
