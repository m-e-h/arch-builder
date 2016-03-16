<?php

add_action( 'cmb2_admin_init', 'arch_register_metaboxes' );

function arch_register_metaboxes() {
	$prefix = 'arch_';

	/**
	 * Excerpt/Content metabox.
	 */
	$arch_block_meta = new_cmb2_box( array(
		'id'            => $prefix . 'block_meta',
		'title'         => __( 'Archive Display', 'arch' ),
		'object_types'  => abe_non_hierarchy_cpts(),
		'context'       => 'side',
		'priority'      => 'default',
		//'show_names'    => false,
	) );

	$arch_block_meta->add_field( array(
		'name'       => __( 'Full Content', 'arch' ),
		'desc'       => __( 'Show the full content rather than excerpt. (Full content is always shown on single pages)', 'arch' ),
		'id'         => $prefix . 'show_content',
		'type'       => 'radio_inline',
		'default'    => 'excerpt',
		'options'    => array(
			'excerpt'   => __( 'Excerpt', 'arch' ),
			'content'   => __( 'Content', 'arch' ),
			'none'      => __( 'Title Only', 'arch' ),
		),
	) );

	$arch_block_meta->add_field( array(
		'name'             => __( 'Width', 'arch' ),
		'desc'             => __( 'Width on archive page. (Full width is always shown on single posts)', 'arch' ),
		'id'               => $prefix . 'post_width',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => arch_width_options,
	) );
}


// Set default widths
if ( ! function_exists( 'arch_width_options' ) ) {

	function arch_width_options() {
		return array(
			'u-1of1-md'      => '1/1',
			'u-1of4-md'      => '1/4',
			'u-1of3-md'      => '1/3',
			'u-1of2-md'      => '1/2',
			'u-2of3-md'      => '2/3',
			'u-3of4-md'      => '3/4',
		);
	}
}
