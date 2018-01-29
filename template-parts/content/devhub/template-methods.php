<?php
/**
 * DevHub Template: Methods
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$methods = torro_devhub_devhub_get_methods();

if ( empty( $methods ) ) {
	return;
}

?>

<div class="methods">
	<h2><?php esc_html_e( 'Methods', 'torro-devhub' ); ?></h2>

	<ul>
		<?php foreach ( $methods as $post ) : ?>
			<?php
			$title = get_the_title( $post );
			$i     = strrpos( $title, ':' );
			$pos   = $i ? $i + 1 : 0;
			$title = substr( $title, $pos );

			$excerpt = apply_filters( 'get_the_excerpt', $post->post_excerpt, $post );

			$tags            = get_post_meta( $post->ID, '_wp-parser_tags', true );
			$deprecated_tags = wp_filter_object_list( $tags, array( 'name' => 'deprecated' ) );
			?>
			<li>
				<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo $title; // WPCS: XSS OK. ?></a>
				<?php if ( ! empty( $excerpt ) ) : ?>
					&mdash;
					<?php echo sanitize_text_field( $excerpt ); // WPCS: XSS OK. ?>
				<?php endif; ?>
				<?php if ( ! empty( $deprecated_tags ) ) : ?>
					&mdash;
					<span class="deprecated-method"><?php esc_html_e( 'deprecated', 'torro-devhub' ); ?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
