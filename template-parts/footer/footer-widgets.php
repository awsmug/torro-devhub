<?php
/**
 * The template for displaying site info in the footer
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

if ( torro_devhub_is_distraction_free() ) {
	return;
}

$footer_widget_area_count = torro_devhub_get_footer_widget_area_count();

$has_active = false;
for( $i = 1; $i <= $footer_widget_area_count; $i++ ) {
	if ( is_active_sidebar( 'footer-' . $i ) ) {
		$has_active = true;
		break;
	}
}

if ( ! $has_active ) {
	return;
}
?>
<aside class="footer-widgets" aria-label="<?php esc_attr_e( 'Footer', 'torro-devhub' ); ?>">
	<?php
	for ( $i = 1; $i <= $footer_widget_area_count; $i++ ) {
		if ( ! is_active_sidebar( 'footer-' . $i ) ) {
			continue;
		}
		?>
		<div class="widget-column">
			<?php dynamic_sidebar( 'footer-' . $i ); ?>
		</div>
		<?php
	}
	?>
</aside><!-- .widget-area -->
