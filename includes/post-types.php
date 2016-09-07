<?php

add_action( 'init', 'arch_posts_register_post_types' );

function arch_posts_register_post_types() {

	/* Register the Home Post post type. */

	register_post_type(
		'arch',
		array(
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-layout',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => true,
			'has_archive'         => 'arch_posts',
			'query_var'           => 'arch_post',
			'capability_type'     => 'arch_post',
			'map_meta_cap'        => true,

			/* Capabilities. */
			'capabilities' => array(

				// meta caps (don't assign these to roles)
				'edit_post'              => 'edit_arch_post',
				'read_post'              => 'read_arch_post',
				'delete_post'            => 'delete_arch_post',

				// primitive/meta caps
				'create_posts'           => 'create_arch_posts',

				// primitive caps used outside of map_meta_cap()
				'edit_posts'             => 'edit_arch_posts',
				'edit_others_posts'      => 'manage_arch_posts',
				'publish_posts'          => 'manage_arch_posts',
				'read_private_posts'     => 'read',

				// primitive caps used inside of map_meta_cap()
				'read'                   => 'read',
				'delete_posts'           => 'manage_arch_posts',
				'delete_private_posts'   => 'manage_arch_posts',
				'delete_published_posts' => 'manage_arch_posts',
				'delete_others_posts'    => 'manage_arch_posts',
				'edit_private_posts'     => 'edit_arch_posts',
				'edit_published_posts'   => 'edit_arch_posts'
			),

			/* The rewrite handles the URL structure. */
			'rewrite' => array(
				'slug'       => 'home-posts',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
				'ep_mask'    => EP_PERMALINK,
			),

			/* What features the post type supports. */
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'page-attributes',
				'archive',
				'arch-post',
			),

			/* Labels used when displaying the posts. */
			'labels' => array(
				'name'               => __( 'Home Posts',         	'arch' ),
				'singular_name'      => __( 'Home Post',          	'arch' ),
				'menu_name'          => __( 'Home Posts',         	'arch' ),
				'name_admin_bar'     => __( 'Home Post',          	'arch' ),
				'add_new'            => __( 'Add New',          	'arch' ),
				'add_new_item'       => __( 'Add New Home Post',  	'arch' ),
				'edit_item'          => __( 'Edit Home Post',     	'arch' ),
				'new_item'           => __( 'New Home Post',      	'arch' ),
				'view_item'          => __( 'View Home Post',     	'arch' ),
				'search_items'       => __( 'Search Home Posts', 	'arch' ),
				'not_found'          => __( 'Not found',          	'arch' ),
				'not_found_in_trash' => __( 'Not found in trash', 	'arch' ),
				'all_items'          => __( 'Home Posts',      		'arch' ),
			)
		)
	);
}
