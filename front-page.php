<?php
/**
 * The template for displaying the front page
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

global $is_reference_page;

get_header();

$featured_tutorials_query = new WP_Query( array(
	'posts_per_page' => 5,
	'post_type'      => 'ct_tutorial',
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'tax_query'      => array(
		array(
			'taxonomy' => 'ct_tutorial_tag',
			'field'    => 'slug',
			'terms'    => 'featured',
		),
	),
) );

$latest_tutorials_query = new WP_Query( array(
	'posts_per_page' => 5,
	'post_type'      => 'ct_tutorial',
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
) );

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

			<?php if ( $featured_tutorials_query->have_posts() ) : ?>
				<div class="featured-tutorials">
					<h2><?php esc_html_e( 'Get started with extending Torro Forms', 'torro-devhub' ); ?></h2>

					<?php
					while( $featured_tutorials_query->have_posts() ) : $featured_tutorials_query->the_post();
						get_template_part( 'template-parts/content/content', get_post_type() );
					endwhile;

					wp_reset_postdata();
					?>
				</div>
			<?php endif; ?>

			<?php if ( $latest_tutorials_query->have_posts() ) : ?>
				<div class="latest-tutorials">
					<h2><?php esc_html_e( 'Read the latest tutorials', 'torro-devhub' ); ?></h2>

					<ul>
					<?php
					while( $latest_tutorials_query->have_posts() ) : $latest_tutorials_query->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<small>(<span class="screen-reader-text"><?php esc_html_e( 'published on', 'torro-devhub' ); ?> </span><?php echo get_the_date(); ?>)</small>
						</li>
						<?php
					endwhile;

					wp_reset_postdata();
					?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="page-search-form">
				<h2><?php esc_html_e( 'Browse the Reference', 'torro-devhub' ); ?></h2>

				<p><?php esc_html_e( 'Enter the name of a function, method, hook, class, trait or interface to learn more.', 'torro-devhub' ); ?></p>
				<?php
				$is_reference_page = true;
				get_search_form();
				$is_reference_page = false;
				?>

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
