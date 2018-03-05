<?php
/**
 * Template part for displaying a post of post type 'ct_tutorial'
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/content/entry-header', get_post_type() ); ?>

	<div class="entry-content">
		<?php
		if ( is_singular( get_post_type() ) ) {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'torro-devhub' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'torro-devhub' ),
				'after'  => '</div>',
			) );
		} else {
			the_excerpt();
		}
		?>
	</div><!-- .entry-content -->

	<?php
	if ( ! is_front_page() ) {
		get_template_part( 'template-parts/content/entry-footer', get_post_type() );
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->
