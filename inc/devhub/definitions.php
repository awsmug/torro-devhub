<?php
/**
 * DevHub: Definitions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Gets all DevHub post types.
 *
 * @since 1.0.0
 *
 * @param bool $with_labels   Optional. Whether to include a plural label for each post type. Default false.
 * @param bool $existing_only Optional. Whether to only include post types that are registered. Default false.
 * @return array List of post types, or map of $post_type => $label pairs if $with_labels is true.
 */
function torro_devhub_devhub_get_post_types( $with_labels = false, $existing_only = false ) {
	$post_types = array(
		'wp-parser-class',
		'wp-parser-trait',
		'wp-parser-interface',
		'wp-parser-function',
		'wp-parser-method',
		'wp-parser-hook',
	);

	if ( $existing_only ) {
		$post_types = array_filter( $post_types, 'post_type_exists' );
	}

	if ( $with_labels ) {
		return torro_devhub_devhub_get_post_type_labels( $post_types );
	}

	return $post_types;
}

/**
 * Gets post type labels for DevHub post types.
 *
 * @since 1.0.0
 *
 * @param array $post_types List of post types.
 * @return array Map of $post_type => $label pairs.
 */
function torro_devhub_devhub_get_post_type_labels( $post_types ) {
	$post_type_labels = array(
		'wp-parser-class'     => _x( 'Classes', 'post type general name', 'torro-devhub' ),
		'wp-parser-trait'     => _x( 'Traits', 'post type general name', 'torro-devhub' ),
		'wp-parser-interface' => _x( 'Interfaces', 'post type general name', 'torro-devhub' ),
		'wp-parser-function'  => _x( 'Functions', 'post type general name', 'torro-devhub' ),
		'wp-parser-method'    => _x( 'Methods', 'post type general name', 'torro-devhub' ),
		'wp-parser-hook'      => _x( 'Hooks', 'post type general name', 'torro-devhub' ),
	);

	return array_intersect_key( $post_type_labels, array_flip( $post_types ) );
}

/**
 * Adjusts post type registration arguments for DevHub post types.
 *
 * @since 1.0.0
 *
 * @param array  $args      Post type registration arguments.
 * @param string $post_type Post type.
 * @return array Modified post type registration arguments.
 */
function torro_devhub_devhub_adjust_post_type_registrations( $args, $post_type ) {
	if ( ! in_array( $post_type, torro_devhub_devhub_get_post_types(), true ) ) {
		return $args;
	}

	$prefix = '';
	if ( get_theme_mod( 'devhub_use_prefix', true ) ) {
		$prefix = _x( 'reference', 'rewrite slug', 'torro-devhub' ) . '/';
	}

	switch ( $post_type ) {
		case 'wp-parser-class':
			add_rewrite_rule( $prefix . _x( 'classes', 'rewrite slug', 'torro-devhub' ) . '/page/([0-9]{1,})/?$', 'index.php?post_type=wp-parser-class&paged=$matches[1]', 'top' );
			add_rewrite_rule( $prefix . _x( 'classes', 'rewrite slug', 'torro-devhub' ) . '/([^/]+)/([^/]+)/?$', 'index.php?post_type=wp-parser-method&name=$matches[1]-$matches[2]', 'top' );

			$args['labels'] = array(
				'name'                  => _x( 'Classes', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Class', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'class', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Class', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Class', 'torro-devhub' ),
				'new_item'              => __( 'New Class', 'torro-devhub' ),
				'view_item'             => __( 'View Class', 'torro-devhub' ),
				'view_items'            => __( 'View Classes', 'torro-devhub' ),
				'search_items'          => __( 'Search Classes', 'torro-devhub' ),
				'not_found'             => __( 'No classes found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No classes found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Class:', 'torro-devhub' ),
				'all_items'             => __( 'All Classes', 'torro-devhub' ),
				'archives'              => __( 'Class Archives', 'torro-devhub' ),
				'attributes'            => __( 'Class Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into class', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this class', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter classes list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Classes list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Classes list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'classes', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'classes', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-trait':
			add_rewrite_rule( $prefix . _x( 'traits', 'rewrite slug', 'torro-devhub' ) . '/page/([0-9]{1,})/?$', 'index.php?post_type=wp-parser-trait&paged=$matches[1]', 'top' );
			add_rewrite_rule( $prefix . _x( 'traits', 'rewrite slug', 'torro-devhub' ) . '/([^/]+)/([^/]+)/?$', 'index.php?post_type=wp-parser-method&name=$matches[1]-$matches[2]', 'top' );

			$args['labels'] = array(
				'name'                  => _x( 'Traits', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Trait', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'trait', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Trait', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Trait', 'torro-devhub' ),
				'new_item'              => __( 'New Trait', 'torro-devhub' ),
				'view_item'             => __( 'View Trait', 'torro-devhub' ),
				'view_items'            => __( 'View Traits', 'torro-devhub' ),
				'search_items'          => __( 'Search Traits', 'torro-devhub' ),
				'not_found'             => __( 'No traits found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No traits found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Trait:', 'torro-devhub' ),
				'all_items'             => __( 'All Traits', 'torro-devhub' ),
				'archives'              => __( 'Trait Archives', 'torro-devhub' ),
				'attributes'            => __( 'Trait Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into trait', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this trait', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter traits list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Traits list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Traits list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'traits', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'traits', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-interface':
			add_rewrite_rule( $prefix . _x( 'interfaces', 'rewrite slug', 'torro-devhub' ) . '/page/([0-9]{1,})/?$', 'index.php?post_type=wp-parser-interface&paged=$matches[1]', 'top' );
			add_rewrite_rule( $prefix . _x( 'interfaces', 'rewrite slug', 'torro-devhub' ) . '/([^/]+)/([^/]+)/?$', 'index.php?post_type=wp-parser-method&name=$matches[1]-$matches[2]', 'top' );

			$args['labels'] = array(
				'name'                  => _x( 'Interfaces', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Interface', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'interface', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Interface', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Interface', 'torro-devhub' ),
				'new_item'              => __( 'New Interface', 'torro-devhub' ),
				'view_item'             => __( 'View Interface', 'torro-devhub' ),
				'view_items'            => __( 'View Interfaces', 'torro-devhub' ),
				'search_items'          => __( 'Search Interfaces', 'torro-devhub' ),
				'not_found'             => __( 'No interfaces found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No interfaces found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Interface:', 'torro-devhub' ),
				'all_items'             => __( 'All Interfaces', 'torro-devhub' ),
				'archives'              => __( 'Interface Archives', 'torro-devhub' ),
				'attributes'            => __( 'Interface Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into interface', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this interface', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter interfaces list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Interfaces list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Interfaces list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'interfaces', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'interfaces', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-function':
			$args['labels'] = array(
				'name'                  => _x( 'Functions', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Function', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'function', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Function', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Function', 'torro-devhub' ),
				'new_item'              => __( 'New Function', 'torro-devhub' ),
				'view_item'             => __( 'View Function', 'torro-devhub' ),
				'view_items'            => __( 'View Functions', 'torro-devhub' ),
				'search_items'          => __( 'Search Functions', 'torro-devhub' ),
				'not_found'             => __( 'No functions found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No functions found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Function:', 'torro-devhub' ),
				'all_items'             => __( 'All Functions', 'torro-devhub' ),
				'archives'              => __( 'Function Archives', 'torro-devhub' ),
				'attributes'            => __( 'Function Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into function', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this function', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter functions list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Functions list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Functions list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'functions', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'functions', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-method':
			$args['labels'] = array(
				'name'                  => _x( 'Methods', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Method', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'method', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Method', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Method', 'torro-devhub' ),
				'new_item'              => __( 'New Method', 'torro-devhub' ),
				'view_item'             => __( 'View Method', 'torro-devhub' ),
				'view_items'            => __( 'View Methods', 'torro-devhub' ),
				'search_items'          => __( 'Search Methods', 'torro-devhub' ),
				'not_found'             => __( 'No methods found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No methods found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Method:', 'torro-devhub' ),
				'all_items'             => __( 'All Methods', 'torro-devhub' ),
				'archives'              => __( 'Method Archives', 'torro-devhub' ),
				'attributes'            => __( 'Method Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into method', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this method', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter methods list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Methods list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Methods list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'methods', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'methods', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-hook':
			$args['labels'] = array(
				'name'                  => _x( 'Hooks', 'post type general name', 'torro-devhub' ),
				'singular_name'         => _x( 'Hook', 'post type singular name', 'torro-devhub' ),
				'add_new'               => _x( 'Add New', 'hook', 'torro-devhub' ),
				'add_new_item'          => __( 'Add New Hook', 'torro-devhub' ),
				'edit_item'             => __( 'Edit Hook', 'torro-devhub' ),
				'new_item'              => __( 'New Hook', 'torro-devhub' ),
				'view_item'             => __( 'View Hook', 'torro-devhub' ),
				'view_items'            => __( 'View Hooks', 'torro-devhub' ),
				'search_items'          => __( 'Search Hooks', 'torro-devhub' ),
				'not_found'             => __( 'No hooks found.', 'torro-devhub' ),
				'not_found_in_trash'    => __( 'No hooks found in Trash.', 'torro-devhub' ),
				'parent_item_colon'     => __( 'Parent Hook:', 'torro-devhub' ),
				'all_items'             => __( 'All Hooks', 'torro-devhub' ),
				'archives'              => __( 'Hook Archives', 'torro-devhub' ),
				'attributes'            => __( 'Hook Attributes', 'torro-devhub' ),
				'insert_into_item'      => __( 'Insert into hook', 'torro-devhub' ),
				'uploaded_to_this_item' => __( 'Uploaded to this hook', 'torro-devhub' ),
				'filter_items_list'     => __( 'Filter hooks list', 'torro-devhub' ),
				'items_list_navigation' => __( 'Hooks list navigation', 'torro-devhub' ),
				'items_list'            => __( 'Hooks list', 'torro-devhub' ),
			);
			if ( ! empty( $args['has_archive'] ) ) {
				$args['has_archive'] = $prefix . _x( 'hooks', 'rewrite slug', 'torro-devhub' );
			}
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'hooks', 'rewrite slug', 'torro-devhub' );
			}
			break;
	}

	return $args;
}
add_filter( 'register_post_type_args', 'torro_devhub_devhub_adjust_post_type_registrations', 10, 2 );

/**
 * Gets all DevHub taxonomies.
 *
 * @since 1.0.0
 *
 * @param bool $with_labels   Optional. Whether to include a plural label for each taxonomy. Default false.
 * @param bool $existing_only Optional. Whether to only include taxonomies that are registered. Default false.
 * @return array List of taxonomies, or map of $taxonomy => $label pairs if $with_labels is true.
 */
function torro_devhub_devhub_get_taxonomies( $with_labels = false, $existing_only = false ) {
	$taxonomies = array(
		'wp-parser-source-file',
		'wp-parser-package',
		'wp-parser-since',
		'wp-parser-namespace',
	);

	if ( $existing_only ) {
		$taxonomies = array_filter( $taxonomies, 'taxonomy_exists' );
	}

	if ( $with_labels ) {
		return torro_devhub_devhub_get_taxonomy_labels( $taxonomies );
	}

	return $taxonomies;
}

/**
 * Gets taxonomy labels for DevHub taxonomies.
 *
 * @since 1.0.0
 *
 * @param array $taxonomies List of taxonomies.
 * @return array Map of $taxonomy => $label pairs.
 */
function torro_devhub_devhub_get_taxonomy_labels( $taxonomies ) {
	$taxonomy_labels = array(
		'wp-parser-source-file' => _x( 'Files', 'taxonomy general name', 'torro-devhub' ),
		'wp-parser-package'     => _x( '@package', 'taxonomy general name', 'torro-devhub' ),
		'wp-parser-since'       => _x( '@since', 'taxonomy general name', 'torro-devhub' ),
		'wp-parser-namespace'   => _x( 'Namespaces', 'taxonomy general name', 'torro-devhub' ),
	);

	return array_intersect_key( $taxonomy_labels, array_flip( $taxonomies ) );
}

/**
 * Adjusts taxonomy registration arguments for DevHub taxonomies.
 *
 * @since 1.0.0
 *
 * @param array  $args      Taxonomy registration arguments.
 * @param string $taxonomy Taxonomy.
 * @return array Modified taxonomy registration arguments.
 */
function torro_devhub_devhub_adjust_taxonomy_registrations( $args, $taxonomy ) {
	if ( ! in_array( $taxonomy, torro_devhub_devhub_get_taxonomies(), true ) ) {
		return $args;
	}

	$prefix = '';
	if ( get_theme_mod( 'devhub_use_prefix', true ) ) {
		$prefix = _x( 'reference', 'rewrite slug', 'torro-devhub' ) . '/';
	}

	switch ( $taxonomy ) {
		case 'wp-parser-source-file':
			$args['labels'] = array(
				'name'                       => _x( 'Files', 'taxonomy general name', 'torro-devhub' ),
				'singular_name'              => _x( 'File', 'taxonomy singular name', 'torro-devhub' ),
				'search_items'               => __( 'Search Files', 'torro-devhub' ),
				'popular_items'              => __( 'Popular Files', 'torro-devhub' ),
				'all_items'                  => __( 'All Files', 'torro-devhub' ),
				'parent_item'                => __( 'Parent File', 'torro-devhub' ),
				'parent_item_colon'          => __( 'Parent File:', 'torro-devhub' ),
				'edit_item'                  => __( 'Edit File', 'torro-devhub' ),
				'view_item'                  => __( 'View File', 'torro-devhub' ),
				'update_item'                => __( 'Update File', 'torro-devhub' ),
				'add_new_item'               => __( 'Add New File', 'torro-devhub' ),
				'new_item_name'              => __( 'New File Name', 'torro-devhub' ),
				'separate_items_with_commas' => __( 'Separate files with commas', 'torro-devhub' ),
				'add_or_remove_items'        => __( 'Add or remove files', 'torro-devhub' ),
				'choose_from_most_used'      => __( 'Choose from the most used files', 'torro-devhub' ),
				'not_found'                  => __( 'No files found.', 'torro-devhub' ),
				'no_terms'                   => __( 'No files', 'torro-devhub' ),
				'items_list_navigation'      => __( 'Files list navigation', 'torro-devhub' ),
				'items_list'                 => __( 'Files list', 'torro-devhub' ),
				'most_used'                  => _x( 'Most Used', 'files', 'torro-devhub' ),
				'back_to_items'              => __( '&larr; Back to Files', 'torro-devhub' ),
			);
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'files', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-package':
			$args['label'] = _x( '@package', 'taxonomy general name', 'torro-devhub' );
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'package', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-since':
			$args['label'] = _x( '@since', 'taxonomy general name', 'torro-devhub' );
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front'] = false;
				$args['rewrite']['slug']       = $prefix . _x( 'since', 'rewrite slug', 'torro-devhub' );
			}
			break;
		case 'wp-parser-namespace':
			$args['labels'] = array(
				'name'                       => _x( 'Namespaces', 'taxonomy general name', 'torro-devhub' ),
				'singular_name'              => _x( 'Namespace', 'taxonomy singular name', 'torro-devhub' ),
				'search_items'               => __( 'Search Namespaces', 'torro-devhub' ),
				'popular_items'              => __( 'Popular Namespaces', 'torro-devhub' ),
				'all_items'                  => __( 'All Namespaces', 'torro-devhub' ),
				'parent_item'                => __( 'Parent Namespace', 'torro-devhub' ),
				'parent_item_colon'          => __( 'Parent Namespace:', 'torro-devhub' ),
				'edit_item'                  => __( 'Edit Namespace', 'torro-devhub' ),
				'view_item'                  => __( 'View Namespace', 'torro-devhub' ),
				'update_item'                => __( 'Update Namespace', 'torro-devhub' ),
				'add_new_item'               => __( 'Add New Namespace', 'torro-devhub' ),
				'new_item_name'              => __( 'New Namespace Name', 'torro-devhub' ),
				'separate_items_with_commas' => __( 'Separate namespaces with commas', 'torro-devhub' ),
				'add_or_remove_items'        => __( 'Add or remove namespaces', 'torro-devhub' ),
				'choose_from_most_used'      => __( 'Choose from the most used namespaces', 'torro-devhub' ),
				'not_found'                  => __( 'No namespaces found.', 'torro-devhub' ),
				'no_terms'                   => __( 'No namespaces', 'torro-devhub' ),
				'items_list_navigation'      => __( 'Namespaces list navigation', 'torro-devhub' ),
				'items_list'                 => __( 'Namespaces list', 'torro-devhub' ),
				'most_used'                  => _x( 'Most Used', 'namespaces', 'torro-devhub' ),
				'back_to_items'              => __( '&larr; Back to Namespaces', 'torro-devhub' ),
			);
			if ( ! empty( $args['rewrite']['slug'] ) ) {
				$args['rewrite']['with_front']   = false;
				$args['rewrite']['slug']         = $prefix . _x( 'namespaces', 'rewrite slug', 'torro-devhub' );
				$args['rewrite']['hierarchical'] = true;
			}
			break;
	}

	return $args;
}
add_filter( 'register_taxonomy_args', 'torro_devhub_devhub_adjust_taxonomy_registrations', 10, 2 );

/**
 * Adjusts permalinks for methods, to include their respective parent.
 *
 * @since 1.0.0
 *
 * @param string  $link The original permalink.
 * @param WP_Post $post Post object.
 * @return string The modified permalink.
 */
function torro_devhub_devhub_adjust_method_permalinks( $link, $post ) {
	global $wp_rewrite;

	if ( 'wp-parser-method' !== $post->post_type || 0 === (int) $post->post_parent ) {
		return $link;
	}

	if ( ! $wp_rewrite->using_permalinks() ) {
		return $link;
	}

	$parent = get_post( $post->post_parent );
	if ( ! $parent ) {
		return $link;
	}

	if ( 0 !== strpos( $post->post_name, $parent->post_name . '-' ) ) {
		return $link;
	}

	$method_name = str_replace( $parent->post_name . '-', '', $post->post_name );

	switch ( $parent->post_type ) {
		case 'wp-parser-class':
			$type = _x( 'classes', 'rewrite slug', 'torro-devhub' );
			break;
		case 'wp-parser-trait':
			$type = _x( 'traits', 'rewrite slug', 'torro-devhub' );
			break;
		case 'wp-parser-interface':
			$type = _x( 'interfaces', 'rewrite slug', 'torro-devhub' );
			break;
		default:
			return $link;
	}

	$prefix = '';
	if ( get_theme_mod( 'devhub_use_prefix', true ) ) {
		$prefix = _x( 'reference', 'rewrite slug', 'torro-devhub' ) . '/';
	}

	$link = home_url( user_trailingslashit( $prefix . $type . '/' . $parent->post_name . '/' . $method_name ) );

	return $link;
}
add_filter( 'post_type_link', 'torro_devhub_devhub_adjust_method_permalinks', 10, 2 );
