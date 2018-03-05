<?php
/**
 * The template for displaying search forms
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

global $is_reference_page;

$unique_id = esc_attr( uniqid( 'search-form-' ) );

$post_types = torro_devhub_devhub_get_post_types();
$taxonomies = torro_devhub_devhub_get_taxonomies();

$is_reference = false;
if ( ! empty( $is_reference_page ) || ! empty( $_GET['reference'] ) || is_singular( $post_types ) || is_post_type_archive( $post_types ) || is_tax( $taxonomies ) ) {
	$is_reference = true;
}

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'torro-devhub' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'torro-devhub' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo torro_devhub_get_svg( 'search' ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'torro-devhub' ); ?></span></button>
	<?php if ( ! empty( $is_reference_page ) ) : ?>
		<div class="search-post-type">
			<?php $active_post_types = ( ! empty( $_GET['post_type'] ) && is_array( $_GET['post_type'] ) ) ? $_GET['post_type'] : array(); ?>
			<span><?php esc_html_e( 'Filter by type:', 'torro-devhub' ); ?></span>
			<?php foreach ( torro_devhub_devhub_get_post_types( true, true ) as $post_type => $label ) : ?>
				<label>
					<input type="checkbox" name="post_type[]" value="<?php echo esc_attr( $post_type ); ?>"<?php echo in_array( $post_type, $active_post_types, true ) ? ' checked' : ''; ?>>
					<?php echo esc_html( $label ); ?>
				</label>
			<?php endforeach; ?>
		</div>
	<?php elseif ( ! empty( $is_reference ) ) : ?>
		<input type="hidden" name="reference" value="1">
	<?php endif; ?>
</form>
