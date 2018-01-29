<?php
/**
 * The template for displaying search forms
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) );

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'torro-devhub' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'torro-devhub' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<?php if ( 0 === strpos( $_SERVER['REQUEST_URI'], '/reference' ) || ! empty( $_GET['reference'] ) ) : ?>
		<input type="hidden" name="reference" value="1">
	<?php endif; ?>
	<button type="submit" class="search-submit"><?php echo torro_devhub_get_svg( 'search' ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'torro-devhub' ); ?></span></button>
</form>
