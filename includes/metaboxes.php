<?php
require_once dirname(__FILE__) . '/../vendor/cmb2/init.php';


add_action( 'cmb2_admin_init', 'arch_register_metaboxes' );

function arch_register_metaboxes() {
	$prefix = 'doc_';

/**
 * Excerpt/Content metabox.
 */
$arch_excerpt_meta = new_cmb2_box( array(
	'id'            => $prefix . 'excerpt_meta',
	'title'         => __( 'Full Content', 'cmb2' ),
	'object_types'  => array( 'post','deacon' ),
	'context'       => 'side',
	'priority'      => 'default',
	'show_names' => false,
) );

$arch_excerpt_meta->add_field( array(
	'name'       => __( 'Full Content', 'cmb2' ),
	'desc'       => __( 'Show the full content rather than excerpt. (Full content is always shown on single pages)', 'cmb2' ),
	'id'         => $prefix . 'show_content',
	'type'       => 'radio_inline',
	'default'    => 'excerpt',
	'options'    => array(
		'excerpt' => __( 'Excerpt', 'cmb2' ),
		'content'   => __( 'Content', 'cmb2' ),
		'none'   => __( 'Title Only', 'cmb2' ),
	),
) );
}
