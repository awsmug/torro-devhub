<?php
/**
 * Template part for displaying post taxonomy terms
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$separator = _x( ', ', 'list item separator', 'torro-devhub' );

$terms = array();
if ( torro_devhub_display_post_taxonomy_terms( 'category' ) ) {
	$term_list = get_the_category_list( esc_html( $separator ), '', $post->ID );

	if ( ! empty( $term_list ) ) {
		$terms[] = array(
			'slug'             => 'category',
			'class'            => 'category-links term-links',
			/* translators: %s: list of terms */
			'placeholder_text' => __( 'Posted in %s', 'torro-devhub' ),
			'list'             => $term_list,
		);
	}
}
if ( torro_devhub_display_post_taxonomy_terms( 'post_tag' ) ) {
	$term_list = get_the_tag_list( '', esc_html( $separator ), '', $post->ID );

	if ( ! empty( $term_list ) ) {
		$terms[] = array(
			'slug'             => 'post_tag',
			'class'            => 'tag-links term-links',
			/* translators: %s: list of terms */
			'placeholder_text' => __( 'Tagged %s', 'torro-devhub' ),
			'list'             => $term_list,
		);
	}
}

?>
<div class="entry-terms">
	<?php foreach ( $terms as $taxonomy_terms ) : ?>
		<span class="<?php echo esc_attr( $taxonomy_terms['class'] ); ?>">
			<?php
			printf(
				esc_html( $taxonomy_terms['placeholder_text'] ),
				$taxonomy_terms['list'] // WPCS: XSS OK.
			);
			?>
		</span>
	<?php endforeach; ?>
</div>
