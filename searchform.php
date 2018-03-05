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

$devhub_post_types = torro_devhub_devhub_get_post_types( false, true );
$devhub_taxonomies = torro_devhub_devhub_get_taxonomies( false, true );

$active_post_types        = ( ! empty( $_GET['post_type'] ) && is_array( $_GET['post_type'] ) ) ? $_GET['post_type'] : array();
$active_devhub_post_types = array_intersect( $active_post_types, $devhub_post_types );

$is_reference = false;
if ( ! empty( $is_reference_page ) || ! empty( $active_devhub_post_types ) || is_singular( $devhub_post_types ) || is_post_type_archive( $devhub_post_types ) || is_tax( $devhub_taxonomies ) ) {
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
			<fieldset>
				<legend><?php esc_html_e( 'Filter by type:', 'torro-devhub' ); ?></legend>
				<?php foreach ( torro_devhub_devhub_get_post_type_labels( $devhub_post_types ) as $post_type => $label ) : ?>
					<label>
						<input type="checkbox" name="post_type[]" value="<?php echo esc_attr( $post_type ); ?>"<?php echo in_array( $post_type, $active_post_types, true ) ? ' checked' : ''; ?>>
						<?php echo esc_html( $label ); ?>
					</label>
				<?php endforeach; ?>
			</fieldset>
		</div>
	<?php elseif ( ! empty( $is_reference ) ) : ?>
		<?php foreach ( $devhub_post_types as $post_type ) : ?>
			<input type="hidden" name="post_type[]" value="<?php echo esc_attr( $post_type ); ?>">
		<?php endforeach; ?>
	<?php elseif ( is_post_type_archive( 'ct_tutorial' ) || is_front_page() ) : ?>
		<input type="hidden" name="post_type[]" value="ct_tutorial">
	<?php endif; ?>
</form>
