<?php
/**
 * Template part for displaying attachment metadata
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$metadata = torro_devhub_get_attachment_metadata();

?>
<ul class="entry-attachment-meta">
	<?php foreach ( torro_devhub_get_attachment_metadata_fields() as $field => $label ) : ?>
		<?php if ( torro_devhub_display_attachment_metadata( $field ) ) : ?>
			<li class="<?php echo esc_attr( 'attachment-metadata-' . str_replace( '_', '-', $field ) ); ?>">
				<?php
				$output = $label . ': ';
				if ( ! empty( $metadata[ $field ] ) ) {
					$output .= $metadata[ $field ];
				} elseif ( ! empty( $metadata['image_meta'][ $field ] ) ) {
					$output .= $metadata['image_meta'][ $field ];
				}

				echo wp_kses( $output, array(
					'sup' => array(),
					'sub' => array(),
				) );
				?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul><!-- .entry-attachment-meta -->
