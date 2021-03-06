<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

get_header();

?>

	<main id="main" class="site-main">

		<header class="page-header">
			<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'torro-devhub' ); ?></h1>
		</header><!-- .page-header -->

		<div class="404-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'torro-devhub' ); ?></p>

			<?php get_search_form(); ?>

			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'torro-devhub' ); ?></h2>
				<ul>
				<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
				?>
				</ul>
			</div><!-- .widget -->

		</div><!-- .404-content -->

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
