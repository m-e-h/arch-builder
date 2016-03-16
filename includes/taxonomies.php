<?php

// require_once dirname(__FILE__) . '/../vendor/extended-taxos.php';
//
//
// add_action( 'init', 'arch_width_taxonomy' );
//
//
// function get_arch_post_width($post = null) {
// 	if ( ! $post = get_post( $post ) )
// 		return false;
//
// 	$_width = get_the_terms( $post->ID, 'arch_post_width' );
//
// 	if ( empty( $_width ) )
// 		return false;
//
// 	$width = reset( $_width );
// 		return $width->slug;
// }
//
// // Register Width Taxonomy
// function arch_width_taxonomy() {
//
// 	register_extended_taxonomy( 'arch_post_width', abe_non_hierarchy_cpts(),
// 	array(
//
// 		'meta_box' => 'dropdown',
// 		'exclusive' => true,
// 		'hierarchical' => false,
// 		'show_in_nav_menus' => false,
// 		'public'            => true,
// 		'show_ui'           => true,
//
// 		'capabilities' => array(
// 			'manage_terms' => 'manage_options',
// 			'edit_terms'   => 'manage_options',
// 			'delete_terms' => 'manage_options',
// 			'assign_terms' => 'edit_posts',
// 		),
// 	), array(
//
// 	    # Override the base names used for labels:
// 	    'singular' => 'Width',
// 	    'plural'   => 'Widths',
// 	    'slug'     => 'width'
//
// 	) );
// }
