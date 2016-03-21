<?php

add_filter( 'manage_posts_columns' , 'arch_add_cpt_columns' );
add_action( 'manage_pages_custom_column', 'arch_manage_cpt_columns', 10, 2 );
add_filter( 'register_post_type_args', 'arch_cpt_args', 10, 2 );

function arch_cpt_args($args, $post_type) {

	if ( in_array($post_type, arch_post_types())) {
        $args['hierarchical'] = true;

		if ( 'post' === $post_type ) {
	        $args['labels']  = array(
				'name'                  => _x( 'Posts', 'Post General Name', 'arch_builder' ),
				'singular_name'         => _x( 'Post', 'Post Singular Name', 'arch_builder' ),
				'menu_name'             => __( 'Posts', 'arch_builder' ),
				'name_admin_bar'        => __( 'Post', 'arch_builder' ),
				'archives'              => __( 'Post Archives', 'arch_builder' ),
				'all_items'             => __( 'All Posts', 'arch_builder' ),
				'add_new_item'          => __( 'Add New Post', 'arch_builder' ),
				'add_new'               => __( 'Add New', 'arch_builder' ),
				'new_item'              => __( 'New Post', 'arch_builder' ),
				'edit_item'             => __( 'Edit Post', 'arch_builder' ),
				'update_item'           => __( 'Update Post', 'arch_builder' ),
				'view_item'             => __( 'View Post', 'arch_builder' ),
				'search_items'          => __( 'Search Post', 'arch_builder' ),
				'not_found'             => __( 'No posts found.', 'arch_builder' ),
				'not_found_in_trash'    => __( 'No posts found in trash.', 'arch_builder' ),
				'featured_image'        => __( 'Featured Image', 'arch_builder' ),
				'set_featured_image'    => __( 'Set featured image', 'arch_builder' ),
				'remove_featured_image' => __( 'Remove featured image', 'arch_builder' ),
				'use_featured_image'    => __( 'Use as featured image', 'arch_builder' ),
				'insert_into_item'      => __( 'Insert into post', 'arch_builder' ),
				'uploaded_to_this_item' => __( 'Uploaded to this post', 'arch_builder' ),
				'items_list'            => __( 'Posts list', 'arch_builder' ),
				'items_list_navigation' => __( 'Posts list navigation', 'arch_builder' ),
				'filter_items_list'     => __( 'Filter posts list', 'arch_builder' ),
			);
	    }
	}

    return $args;
}


function arch_add_cpt_columns($columns) {
	if ( !in_array(get_post_type(), arch_post_types()))
		return $columns;
	return array_merge($columns,
		array('arch_component' => __('Type'),
		    'arch_excerpt' =>__( 'Content'),
			'arch_width' => __('Width')
		)
	);
}


function arch_manage_cpt_columns( $column, $post_id ) {
	if ( !in_array(get_post_type(), arch_post_types()))
		return;
	global $post;

	switch( $column ) {

		case 'arch_component' :

			$arch_component = get_post_meta( $post_id, 'arch_component', true );

			if ( empty( $arch_component ) )
				echo __( '_' );

			else
				echo esc_html( $arch_component );

			break;

		case 'arch_excerpt' :

			$arch_excerpt = get_post_meta( $post_id, 'arch_excerpt', true );

			if ( empty( $arch_excerpt ) )
				echo __( '_' );

			else
				echo esc_html( $arch_excerpt );
			break;

		case 'arch_width' :

			$arch_width = get_post_meta( $post_id, 'arch_width', true );

			if ( empty( $arch_width ) )
				echo __( '_' );

			else
				echo esc_html( $arch_width );

			break;

		default :
			break;
	}
}
