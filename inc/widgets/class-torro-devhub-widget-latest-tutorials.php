<?php
/**
 * Widget API: Torro_DevHub_Widget_Latest_Tutorials class
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Class used to implement a Latest Tutorials widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Torro_DevHub_Widget_Latest_Tutorials extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_latest_ct_tutorials',
			'description'                 => __( 'Your site&#8217;s latest tutorials.', 'torro-devhub' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'latest-ct-tutorials', __( 'Latest Tutorials', 'torro-devhub' ), $widget_ops );
		$this->alt_option_name = 'widget_latest_ct_tutorials';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		$query = new WP_Query( array(
			'posts_per_page' => $number,
			'post_type'      => 'ct_tutorial',
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		if ( ! $query->have_posts() ) {
			return;
		}
		?>
		<?php
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul>
			<?php foreach ( $query->posts as $tutorial ) : ?>
				<?php
				$post_title = get_the_title( $tutorial->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)', 'torro-devhub' );
				?>
				<li>
					<a href="<?php the_permalink( $tutorial->ID ); ?>"><?php echo $title; ?></a>
					<small>(<span class="screen-reader-text"><?php esc_html_e( 'published on', 'torro-devhub' ); ?> </span><?php echo get_the_date( '', $tutorial->ID ); ?>)</small>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'torro-devhub' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of tutorials to show:', 'torro-devhub' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}
