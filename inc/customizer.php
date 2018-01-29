<?php
/**
 * Customizer functions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Registers Customizer functionality.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function torro_devhub_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'torro_devhub_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'torro_devhub_customize_partial_blogdescription',
	) );

	/* Sidebar Settings */

	$wp_customize->add_section( 'sidebars', array(
		'title'           => __( 'Sidebars', 'torro-devhub' ),
		'priority'        => 105,
		'active_callback' => 'torro_devhub_allow_display_sidebar',
	) );

	$wp_customize->add_setting( 'sidebar_mode', array(
		'default'           => 'right-sidebar',
		'transport'         => 'postMessage',
		'validate_callback' => 'torro_devhub_customize_validate_sidebar_mode',
	) );
	$wp_customize->add_control( 'sidebar_mode', array(
		'section'     => 'sidebars',
		'label'       => __( 'Sidebar Mode', 'torro-devhub' ),
		'description' => __( 'Specify if and how the sidebar should be displayed.', 'torro-devhub' ),
		'type'        => 'radio',
		'choices'     => torro_devhub_customize_get_sidebar_mode_choices(),
	) );

	$wp_customize->add_setting( 'sidebar_size', array(
		'default'           => 'medium',
		'transport'         => 'postMessage',
		'validate_callback' => 'torro_devhub_customize_validate_sidebar_size',
	) );
	$wp_customize->add_control( 'sidebar_size', array(
		'section'     => 'sidebars',
		'label'       => __( 'Sidebar Size', 'torro-devhub' ),
		'description' => __( 'Specify the width of the sidebar.', 'torro-devhub' ),
		'type'        => 'radio',
		'choices'     => torro_devhub_customize_get_sidebar_size_choices(),
	) );

	$wp_customize->add_setting( 'blog_sidebar_enabled', array(
		'default'           => '',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'blog_sidebar_enabled', array(
		'section'         => 'sidebars',
		'label'           => __( 'Enable Blog Sidebar?', 'torro-devhub' ),
		'description'     => __( 'If you enable the blog sidebar, it will be shown beside your blog and single post content instead of the primary sidebar.', 'torro-devhub' ),
		'type'            => 'checkbox',
		'active_callback' => 'torro_devhub_allow_display_blog_sidebar',
	) );
	$wp_customize->selective_refresh->add_partial( 'blog_sidebar_enabled', array(
		'selector'            => '#sidebar',
		'render_callback'     => 'torro_devhub_customize_partial_blog_sidebar_enabled',
		'container_inclusive' => true,
	) );

	/* Content Type Settings */

	$wp_customize->add_panel( 'content_types', array(
		'title'    => __( 'Content Types', 'torro-devhub' ),
		'priority' => 140,
	) );

	$public_post_types = get_post_types( array( 'public' => true ), 'objects' );
	foreach ( $public_post_types as $post_type ) {
		$wp_customize->add_section( 'content_type_' . $post_type->name, array(
			'panel'    => 'content_types',
			'title'    => $post_type->label,
		) );

		$wp_customize->add_setting( $post_type->name . '_show_date', array(
			'default'           => in_array( $post_type->name, array( 'post', 'attachment' ), true ) ? '1' : '',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $post_type->name . '_show_date', array(
			'section' => 'content_type_' . $post_type->name,
			'label'   => __( 'Show Date?', 'torro-devhub' ),
			'type'    => 'checkbox',
		) );
		$wp_customize->selective_refresh->add_partial( $post_type->name . '_show_date', array(
			'selector'            => '.type-' . $post_type->name . ' .entry-meta',
			'render_callback'     => 'torro_devhub_customize_partial_entry_meta',
			'container_inclusive' => true,
			'type'                => 'TorroDevHubPostPartial',
		) );

		if ( post_type_supports( $post_type->name, 'author' ) ) {
			$wp_customize->add_setting( $post_type->name . '_show_author', array(
				'default'           => in_array( $post_type->name, array( 'post', 'attachment' ), true ) ? '1' : '',
				'transport'         => 'postMessage',
			) );
			$wp_customize->add_control( $post_type->name . '_show_author', array(
				'section' => 'content_type_' . $post_type->name,
				'label'   => __( 'Show Author Name?', 'torro-devhub' ),
				'type'    => 'checkbox',
			) );
			$wp_customize->selective_refresh->add_partial( $post_type->name . '_show_author', array(
				'selector'            => '.type-' . $post_type->name . ' .entry-meta',
				'render_callback'     => 'torro_devhub_customize_partial_entry_meta',
				'container_inclusive' => true,
				'type'                => 'TorroDevHubPostPartial',
			) );
		}

		if ( 'attachment' === $post_type->name ) {
			foreach ( torro_devhub_get_attachment_metadata_fields() as $field => $label ) {
				$wp_customize->add_setting( 'attachment_show_metadata_' . $field, array(
					'default'           => '1',
					'transport'         => 'postMessage',
				) );
				$wp_customize->add_control( 'attachment_show_metadata_' . $field, array(
					'section' => 'content_type_' . $post_type->name,
					/* translators: %s: metadata field label */
					'label'   => sprintf( __( 'Show %s?', 'torro-devhub' ), $label ),
					'type'    => 'checkbox',
				) );
				$wp_customize->selective_refresh->add_partial( 'attachment_show_metadata_' . $field, array(
					'selector'            => '.type-' . $post_type->name . ' .entry-attachment-meta',
					'render_callback'     => 'torro_devhub_customize_partial_entry_attachment_meta',
					'container_inclusive' => true,
					'type'                => 'TorroDevHubPostPartial',
				) );
			}
		}

		$public_taxonomies = wp_list_filter( get_object_taxonomies( $post_type->name, 'objects' ), array(
			'public' => true,
		) );
		foreach ( $public_taxonomies as $taxonomy ) {
			$wp_customize->add_setting( $post_type->name . '_show_terms_' . $taxonomy->name, array(
				'default'           => '1',
				'transport'         => 'postMessage',
			) );
			$wp_customize->add_control( $post_type->name . '_show_terms_' . $taxonomy->name, array(
				'section' => 'content_type_' . $post_type->name,
				/* translators: %s: taxonomy plural label */
				'label'   => sprintf( _x( 'Show %s?', 'taxonomy', 'torro-devhub' ), $taxonomy->label ),
				'type'    => 'checkbox',
			) );
			$wp_customize->selective_refresh->add_partial( $post_type->name . '_show_terms_' . $taxonomy->name, array(
				'selector'            => '.type-' . $post_type->name . ' .entry-terms',
				'render_callback'     => 'torro_devhub_customize_partial_entry_terms',
				'container_inclusive' => true,
				'type'                => 'TorroDevHubPostPartial',
			) );
		}

		if ( post_type_supports( $post_type->name, 'author' ) ) {
			$wp_customize->add_setting( $post_type->name . '_show_authorbox', array(
				'default'           => 'post' === $post_type->name ? '1' : '',
				'transport'         => 'postMessage',
			) );
			$wp_customize->add_control( $post_type->name . '_show_authorbox', array(
				'section' => 'content_type_' . $post_type->name,
				'label'   => __( 'Show Author Box?', 'torro-devhub' ),
				'type'    => 'checkbox',
			) );
			$wp_customize->selective_refresh->add_partial( $post_type->name . '_show_authorbox', array(
				'selector'            => '.type-' . $post_type->name . ' .entry-authorbox',
				'render_callback'     => 'torro_devhub_customize_partial_entry_authorbox',
				'container_inclusive' => true,
				'type'                => 'TorroDevHubPostPartial',
			) );
		}
	}
}
add_action( 'customize_register', 'torro_devhub_customize_register' );

/**
 * Renders the site title for the selective refresh partial.
 *
 * @since 1.0.0
 */
function torro_devhub_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Renders the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 */
function torro_devhub_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Validates the 'sidebar_mode' customizer setting.
 *
 * @since 1.0.0
 *
 * @param WP_Error $validity Error object to add possible errors to.
 * @param mixed    $value    Value to validate.
 * @return WP_Error Possibly modified error object.
 */
function torro_devhub_customize_validate_sidebar_mode( $validity, $value ) {
	$choices = torro_devhub_customize_get_sidebar_mode_choices();

	if ( ! isset( $choices[ $value ] ) ) {
		$validity->add( 'invalid_choice', __( 'Invalid choice.', 'torro-devhub' ) );
	}

	return $validity;
}

/**
 * Gets the available choices for the 'sidebar_mode' customizer setting.
 *
 * @since 1.0.0
 *
 * @return array Array where values are the keys, and labels are the values.
 */
function torro_devhub_customize_get_sidebar_mode_choices() {
	return array(
		'no-sidebar'    => __( 'No Sidebar', 'torro-devhub' ),
		'left-sidebar'  => __( 'Left Sidebar', 'torro-devhub' ),
		'right-sidebar' => __( 'Right Sidebar', 'torro-devhub' ),
	);
}

/**
 * Validates the 'sidebar_size' customizer setting.
 *
 * @since 1.0.0
 *
 * @param WP_Error $validity Error object to add possible errors to.
 * @param mixed    $value    Value to validate.
 * @return WP_Error Possibly modified error object.
 */
function torro_devhub_customize_validate_sidebar_size( $validity, $value ) {
	$choices = torro_devhub_customize_get_sidebar_size_choices();

	if ( ! isset( $choices[ $value ] ) ) {
		$validity->add( 'invalid_choice', __( 'Invalid choice.', 'torro-devhub' ) );
	}

	return $validity;
}

/**
 * Gets the available choices for the 'sidebar_size' customizer setting.
 *
 * @since 1.0.0
 *
 * @return array Array where values are the keys, and labels are the values.
 */
function torro_devhub_customize_get_sidebar_size_choices() {
	return array(
		'small'  => __( 'Small', 'torro-devhub' ),
		'medium' => __( 'Medium', 'torro-devhub' ),
		'large'  => __( 'Large', 'torro-devhub' ),
	);
}

/**
 * Renders the primary or blog sidebar for the selective refresh partial.
 *
 * @since 1.0.0
 */
function torro_devhub_customize_partial_blog_sidebar_enabled() {
	get_sidebar();
}

/**
 * Renders the entry metadata for a post.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Partial $partial Partial for which the function is invoked.
 * @param array                $context Context for which to render the entry metadata.
 */
function torro_devhub_customize_partial_entry_meta( $partial, $context ) {
	$post_type = null;
	if ( ! empty( $context['post_id'] ) ) {
		$post = get_post( $context['post_id'] );
		if ( $post ) {
			$post_type = $post->post_type;

			$GLOBALS['post'] = $post;
			setup_postdata( $post );
		}
	}

	get_template_part( 'template-parts/content/entry-meta', $post_type );
}

/**
 * Renders the entry attachment metadata for a post.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Partial $partial Partial for which the function is invoked.
 * @param array                $context Context for which to render the entry metadata.
 */
function torro_devhub_customize_partial_entry_attachment_meta( $partial, $context ) {
	if ( ! empty( $context['post_id'] ) ) {
		$post = get_post( $context['post_id'] );
		if ( $post ) {
			$GLOBALS['post'] = $post;
			setup_postdata( $post );
		}
	}

	get_template_part( 'template-parts/content/entry-attachment-meta' );
}

/**
 * Renders the entry terms for a post.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Partial $partial Partial for which the function is invoked.
 * @param array                $context Context for which to render the entry terms.
 */
function torro_devhub_customize_partial_entry_terms( $partial, $context ) {
	$post_type = null;
	if ( ! empty( $context['post_id'] ) ) {
		$post = get_post( $context['post_id'] );
		if ( $post ) {
			$post_type = $post->post_type;

			$GLOBALS['post'] = $post;
			setup_postdata( $post );
		}
	}

	get_template_part( 'template-parts/content/entry-terms', $post_type );
}

/**
 * Renders the entry author box for a post.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Partial $partial Partial for which the function is invoked.
 * @param array                $context Context for which to render the entry author box.
 */
function torro_devhub_customize_partial_entry_authorbox( $partial, $context ) {
	$post_type = null;
	if ( ! empty( $context['post_id'] ) ) {
		$post = get_post( $context['post_id'] );
		if ( $post ) {
			$post_type = $post->post_type;

			$GLOBALS['post'] = $post;
			setup_postdata( $post );
		}
	}

	get_template_part( 'template-parts/content/entry-authorbox', $post_type );
}

/**
 * Enqueues the script for the Customizer controls.
 *
 * @since 1.0.0
 */
function torro_devhub_customize_controls_js() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '': '.min';

	wp_enqueue_script( 'torro-devhub-customize-controls', get_theme_file_uri( '/assets/dist/js/customize-controls' . $min . '.js' ), array( 'customize-controls' ), TORRO_DEVHUB_VERSION, true );
	wp_localize_script( 'torro-devhub-customize-controls', 'themeCustomizeData', array(
		'i18n' => array(
			'blogSidebarEnabledNotice' => __( 'This page doesn&#8217;t support the blog sidebar. Navigate to the blog page or another page that supports it.', 'torro-devhub' ),
		),
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'torro_devhub_customize_controls_js' );

/**
 * Enqueues the script for the Customizer preview.
 *
 * @since 1.0.0
 */
function torro_devhub_customize_preview_js() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '': '.min';

	wp_enqueue_script( 'torro-devhub-customize-preview', get_theme_file_uri( '/assets/dist/js/customize-preview' . $min . '.js' ), array( 'customize-preview', 'customize-selective-refresh' ), TORRO_DEVHUB_VERSION, true );
	wp_localize_script( 'torro-devhub-customize-preview', 'themeCustomizeData', array(
		'sidebarModeChoices' => torro_devhub_customize_get_sidebar_mode_choices(),
		'sidebarSizeChoices' => torro_devhub_customize_get_sidebar_size_choices(),
	) );
}
add_action( 'customize_preview_init', 'torro_devhub_customize_preview_js' );
