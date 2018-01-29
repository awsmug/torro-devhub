<?php
/**
 * Theme setup
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Registers support for various WordPress features.
 *
 * @since 1.0.0
 */
function torro_devhub_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/**
	 * Filters the arguments for registering custom logo support.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Custom logo arguments.
	 */
	add_theme_support( 'custom-logo', apply_filters( 'torro_devhub_custom_logo_args', array(
		'width'       => 200,
		'height'      => 60,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) ) );

	/**
	 * Filters the arguments for registering custom header support.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Custom header arguments.
	 */
	add_theme_support( 'custom-header', apply_filters( 'torro_devhub_custom_header_args', array(
		'width'              => 1200,
		'height'             => 300,
		'header-text'        => false,
	) ) );

	// TODO: Include video header support.

	/**
	 * Filters the arguments for registering custom background support.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Custom background arguments.
	 */
	add_theme_support( 'custom-background', apply_filters( 'torro_devhub_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// TODO: Add theme support for starter content.

	add_image_size( 'site-width', 1152, 9999 ); // Spans the site maximum width of 72rem, with unlimited height.
	add_image_size( 'content-width', 640, 9999 ); // Spans the content maximum width of 40rem, with unlimited height.

	set_post_thumbnail_size( 640, 360, true ); // 640px is 40rem, which is the site maximum width. 360px makes it 16:9 format.

	add_editor_style();
}
add_action( 'after_setup_theme', 'torro_devhub_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * @since 1.0.0
 *
 * @global int $content_width
 */
function torro_devhub_content_width() {
	global $content_width;

	/**
	 * Filters the theme's content width.
	 *
	 * @since 1.0.0
	 *
	 * @param int $content_width The theme's content width.
	 */
	$content_width = apply_filters( 'torro_devhub_content_width', 640 ); // 640px is 40rem, which is the content maximum width.
}
add_action( 'after_setup_theme', 'torro_devhub_content_width', 0 );

/**
 * Registers the theme's nav menus.
 *
 * @since 1.0.0
 */
function torro_devhub_register_nav_menus() {
	register_nav_menus( array(
		'primary'    => __( 'Primary Menu', 'torro-devhub' ),
		'primary_df' => __( 'Primary Menu (Distraction-Free)', 'torro-devhub' ),
		'social'     => __( 'Social Links Menu', 'torro-devhub' ),
		'footer'     => __( 'Footer Menu', 'torro-devhub' ),
	) );
}
add_action( 'after_setup_theme', 'torro_devhub_register_nav_menus', 11 );

/**
 * Registers the theme's widget areas.
 *
 * @since 1.0.0
 */
function torro_devhub_register_widget_areas() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'torro-devhub' ),
		'id'            => 'primary',
		'description'   => __( 'Add widgets here to appear in the sidebar for your main content.', 'torro-devhub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	$blog_sidebar_description = __( 'Add widgets here to appear in the sidebar for blog posts and archive pages.', 'torro-devhub' );
	if ( ! get_theme_mod( 'blog_sidebar_enabled' ) ) {
		// If core allowed simple HTML here, a link to the respective customizer control would surely help.
		$blog_sidebar_description .= ' ' . __( 'You need to enable the sidebar in the Customizer first.', 'torro-devhub' );
	}

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'torro-devhub' ),
		'id'            => 'blog',
		'description'   => $blog_sidebar_description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	$footer_widget_area_count = torro_devhub_get_footer_widget_area_count();

	for ( $i = 1; $i <= $footer_widget_area_count; $i++ ) {
		register_sidebar( array(
			/* translators: %s: widget area number */
			'name'          => sprintf( __( 'Footer %s', 'torro-devhub' ), number_format_i18n( $i ) ),
			'id'            => 'footer-' . $i,
			'description'   => __( 'Add widgets here to appear in your footer.', 'torro-devhub' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'torro_devhub_register_widget_areas' );

/**
 * Gets the number of footer widget areas the theme has.
 *
 * @since 1.0.0
 *
 * @return int Footer widget area count.
 */
function torro_devhub_get_footer_widget_area_count() {
	/**
	 * Filters the theme's footer widget area count.
	 *
	 * This count determines how many footer widget area columns the theme contains.
	 *
	 * @since 1.0.0
	 *
	 * @param int $count Footer widget area count.
	 */
	return apply_filters( 'torro_devhub_footer_widget_area_count', 3 );
}
