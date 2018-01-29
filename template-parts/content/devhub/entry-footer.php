<?php
/**
 * Template part for displaying a DevHub post footer
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$source_file = torro_devhub_devhub_get_source_file();
$line_number = torro_devhub_devhub_get_line_number();
$source_link = torro_devhub_devhub_get_source_file_link();

?>
<footer class="entry-footer">

	<div class="sourcefile">
		<?php esc_html_e( 'Source:', 'torro-devhub' ); ?>

		<?php if ( $source_link ) : ?>
			<a href="<?php echo esc_url( $source_link ); ?>"><?php echo esc_html( $source_file . ':' . $line_number ); ?></a>
		<?php else : ?>
			<?php echo esc_html( $source_file . ':' . $line_number ); ?>
		<?php endif; ?>
	</div>

</footer><!-- .entry-footer -->
