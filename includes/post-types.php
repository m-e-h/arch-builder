<?php

require_once dirname(__FILE__) . '/../vendor/extended-cpts.php';


add_action( 'init', 'arch_register_post_types' );
function arch_register_post_types() {
	register_extended_post_type( 'article', array(
		'admin_cols' => array(
			'doc_show_content' => array(
				'title'    => 'Content',
				'meta_key' => 'doc_show_content',
				'sortable' => false,
			),
			'width' => array(
	            'taxonomy' => 'arch_post_width',
				'sortable' => false,
			),
		),
	) );
}
