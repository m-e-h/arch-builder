<?php
add_action( 'init', 'arch_post_type' );

// Register Custom Post Type
function arch_post_type() {

	$labels = array(
		'name'                  => _x( 'Arch Posts', 'Post Type General Name', 'arch_builder' ),
		'singular_name'         => _x( 'Arch Post', 'Post Type Singular Name', 'arch_builder' ),
		'menu_name'             => __( 'Arch Posts', 'arch_builder' ),
		'name_admin_bar'        => __( 'Arch Posts', 'arch_builder' ),
		'archives'              => __( 'Arch Archives', 'arch_builder' ),
		'parent_item_colon'     => __( 'Parent Item:', 'arch_builder' ),
		'all_items'             => __( 'All Items', 'arch_builder' ),
		'add_new_item'          => __( 'Add New Item', 'arch_builder' ),
		'add_new'               => __( 'Add New', 'arch_builder' ),
		'new_item'              => __( 'New Item', 'arch_builder' ),
		'edit_item'             => __( 'Edit Item', 'arch_builder' ),
		'update_item'           => __( 'Update Item', 'arch_builder' ),
		'view_item'             => __( 'View Item', 'arch_builder' ),
		'search_items'          => __( 'Search Item', 'arch_builder' ),
		'not_found'             => __( 'Not found', 'arch_builder' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'arch_builder' ),
		'featured_image'        => __( 'Featured Image', 'arch_builder' ),
		'set_featured_image'    => __( 'Set featured image', 'arch_builder' ),
		'remove_featured_image' => __( 'Remove featured image', 'arch_builder' ),
		'use_featured_image'    => __( 'Use as featured image', 'arch_builder' ),
		'insert_into_item'      => __( 'Insert into item', 'arch_builder' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'arch_builder' ),
		'items_list'            => __( 'Items list', 'arch_builder' ),
		'items_list_navigation' => __( 'Items list navigation', 'arch_builder' ),
		'filter_items_list'     => __( 'Filter items list', 'arch_builder' ),
	);
	$args = array(
		'label'                 => __( 'Arch Post', 'arch_builder' ),
		'description'           => __( 'Arch Builder', 'arch_builder' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'archive', 'arch-post' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-layout',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'arch', $args );

}
