<?php
/**
 * DevHub Template: Source
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$source_file  = torro_devhub_devhub_get_source_file();
$archive_link = torro_devhub_devhub_get_source_file_archive_link();
$file_link    = torro_devhub_devhub_get_source_file_link();
$source_code  = 'wp-parser-hook' !== get_post_type() ? torro_devhub_devhub_get_source_code() : '';
$line_number  = torro_devhub_devhub_get_line_number();

if ( empty( $source_file ) || empty( $archive_link ) ) {
	return;
}

?>

<div class="source-content">
	<h3><?php esc_html_e( 'Source', 'torro-devhub' ); ?></h3>

	<p>
		<?php esc_html_e( 'File:', 'torro-devhub' ); ?>
		<a href="<?php echo esc_url( $archive_link ); ?>"><?php echo esc_html( $source_file ); ?></a>
	</p>

	<?php if ( ! empty( $source_code ) ) : ?>
		<div class="source-code-container">
			<pre class="brush: php; toolbar: false; first-line: <?php echo esc_attr( $line_number ); ?>"><?php echo htmlentities( $source_code ); // WPCS: XSS OK. ?></pre>
		</div>
		<p class="source-code-links">
			<span>
				<button type="button" class="show-complete-source button button-link"><?php esc_html_e( 'Expand full source code', 'torro-devhub' ); ?></button>
				<button type="button" class="less-complete-source button button-link"><?php esc_html_e( 'Collapse full source code', 'torro-devhub' ); ?></button>
			</span>
			<?php if ( ! empty( $file_link ) ) : ?>
				<span>
					<a href="<?php echo esc_url( $file_link ); ?>" class="button button-link"><?php esc_html_e( 'View on GitHub', 'torro-devhub' ); ?></a>
				</span>
			<?php endif; ?>
		</p>
	<?php elseif ( ! empty( $file_link ) ) : ?>
		<p>
			<a href="<?php echo esc_url( $file_link ); ?>"><?php esc_html_e( 'View on GitHub', 'torro-devhub' ); ?></a>
		</p>
	<?php endif; ?>
</div>
