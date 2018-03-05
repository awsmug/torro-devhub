<?php
/**
 * Template part for displaying a post header of post type 'ct_tutorial'
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$support_slug = get_post_type();
if ( 'attachment' === $support_slug ) {
	if ( wp_attachment_is( 'audio' ) ) {
		$support_slug .= ':audio';
	} elseif ( wp_attachment_is( 'video' ) ) {
		$support_slug .= ':video';
	}
}

?>
<header class="entry-header">

	<?php
	/**
	 * Fires immediately before the title of any post will be printed.
	 *
	 * @since 1.0.0
	 *
	 * @param string $post_type Post type of the current post.
	 */
	do_action( 'torro_devhub_before_entry_title', get_post_type() );

	if ( is_singular( get_post_type() ) ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} elseif ( is_front_page() ) {
		the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}

	/**
	 * Fires immediately after the title of any post has been printed.
	 *
	 * @since 1.0.0
	 *
	 * @param string $post_type Post type of the current post.
	 */
	do_action( 'torro_devhub_after_entry_title', get_post_type() );
	?>

	<?php
	if ( ! is_front_page() ) {
		get_template_part( 'template-parts/content/entry-meta', get_post_type() );
	}
	?>

	<?php if ( post_type_supports( $support_slug, 'thumbnail' ) && has_post_thumbnail() ) : ?>
		<div class="wp-post-image-wrap">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

</header><!-- .entry-header -->
