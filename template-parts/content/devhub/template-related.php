<?php
/**
 * DevHub Template: Related
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$uses       = torro_devhub_devhub_get_uses();
$extends    = torro_devhub_devhub_get_extends();
$implements = torro_devhub_devhub_get_implements();

$used_by        = torro_devhub_devhub_get_used_by();
$extended_by    = torro_devhub_devhub_get_extended_by();
$implemented_by = torro_devhub_devhub_get_implemented_by();

if ( empty( $uses ) && empty( $extends ) && empty( $implements ) && empty( $used_by ) && empty( $extended_by ) && empty( $implemented_by ) ) {
	return;
}

?>

<div class="related">
	<h2><?php esc_html_e( 'Related', 'torro-devhub' ); ?></h2>

	<?php if ( ! empty( $uses ) ) : ?>
		<div class="uses">
			<h3><?php esc_html_e( 'Uses', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $uses as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $extends ) ) : ?>
		<div class="extends">
			<h3><?php esc_html_e( 'Extends', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $extends as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $implements ) ) : ?>
		<div class="implements">
			<h3><?php esc_html_e( 'Implements', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $implements as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $used_by ) ) : ?>
		<div class="used-by">
			<h3><?php esc_html_e( 'Used By', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $used_by as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $extended_by ) ) : ?>
		<div class="extended-by">
			<h3><?php esc_html_e( 'Extended By', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $extended_by as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $implemented_by ) ) : ?>
		<div class="implemented-by">
			<h3><?php esc_html_e( 'Implemented By', 'torro-devhub' ); ?></h3>

			<ul>
				<?php foreach ( $implemented_by as $post ) : ?>
					<li>
						<span><?php echo esc_html( torro_devhub_devhub_get_source_file( $post ) ); ?>:</span>
						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?><?php echo in_array( $post->post_type, array( 'wp-parser-function', 'wp-parser-method' ), true ) ? '()' : ''; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
