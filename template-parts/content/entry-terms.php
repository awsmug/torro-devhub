<?php
/**
 * Template part for displaying post taxonomy terms
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$taxonomies = wp_list_filter( get_object_taxonomies( $post, 'objects' ), array(
	'public' => true,
) );

$terms = array();
foreach ( $taxonomies as $taxonomy ) {
	if ( ! torro_devhub_display_post_taxonomy_terms( $taxonomy->name ) ) {
		continue;
	}

	if ( 'post_tag' === $taxonomy->name ) {
		$class = 'tag-links term-links';
	} else {
		$class = str_replace( '_', '-', $taxonomy->name ) . ' term-links';
	}

	if ( $taxonomy->hierarchical ) {
		/* translators: %s: list of terms */
		$placeholder_text = __( 'Posted in %s', 'torro-devhub' );
	} else {
		/* translators: %s: list of terms */
		$placeholder_text = __( 'Tagged %s', 'torro-devhub' );
	}

	$separator = _x( ', ', 'list item separator', 'torro-devhub' );

	if ( 'category' === $taxonomy->name ) {
		$term_list = get_the_category_list( esc_html( $separator ), '', $post->ID );
	} elseif ( 'post_tag' === $taxonomy->name ) {
		$term_list = get_the_tag_list( '', esc_html( $separator ), '', $post->ID );
	} else {
		$term_list = get_the_term_list( $post->ID, $taxonomy->name, '', esc_html( $separator ), '' );
	}

	if ( empty( $term_list ) ) {
		continue;
	}

	$terms[] = array(
		'slug'             => $taxonomy->name,
		'class'            => $class,
		'placeholder_text' => $placeholder_text,
		'list'             => $term_list,
	);
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
