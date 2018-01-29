<?php
/**
 * DevHub Template: Params
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$params = torro_devhub_devhub_get_params();

if ( empty( $params ) ) {
	return;
}

?>
<div class="parameters">
	<h3><?php esc_html_e( 'Parameters', 'torro-devhub' ); ?></h3>

	<dl>
		<?php foreach ( $params as $param ) : ?>
			<?php if ( ! empty( $param['variable'] ) ) : ?>
				<dt><?php echo esc_html( $param['variable'] ); ?></dt>
			<?php endif; ?>
			<dd>
				<p class="desc">
					<?php if ( ! empty( $param['types'] ) ) : ?>
						<span class="type">
							<?php
							/* translators: %s: parameter type */
							printf( esc_html__( '(%s)', 'torro-devhub' ), wp_kses_post( $param['types'] ) );
							?>
						</span>
					<?php endif; ?>
					<?php if ( ! empty( $param['required'] ) && 'wp-parser-hook' !== get_post_type() ) : ?>
						<span class="required"><?php esc_html_e( '(Required)', 'torro-devhub' ); ?></span>
					<?php else : ?>
						<span class="required"><?php esc_html_e( '(Optional)', 'torro-devhub' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $param['content'] ) ) : ?>
						<span class="description"><?php echo wp_kses_post( $param['content'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php if ( ! empty( $param['default'] ) ) : ?>
					<p class="default"><?php esc_html_e( 'Default value:', 'torro-devhub' ); ?> <?php echo esc_html( $param['default'] ); ?></p>
				<?php endif; ?>
			</dd>
		<?php endforeach; ?>
	</dl>
</div>
