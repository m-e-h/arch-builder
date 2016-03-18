<?php

require_once dirname(__FILE__) . '/../vendor/extended-cpts.php';


add_action( 'init', 'arch_register_post_types' );


function arch_register_post_types() {
$arr = abe_non_hierarchy_cpts();
foreach ($arr as $value) {
	register_extended_post_type( $value, array(
		'admin_cols' => array(
			'arch_component' => array(
				'title'    => 'Type',
				'meta_key' => 'arch_component',
				'sortable' => false,
			),
			'arch_excerpt' => array(
				'title'    => 'Content',
				'meta_key' => 'arch_excerpt',
				'sortable' => false,
			),
			'arch_width' => array(
				'title'    => 'Width',
				'meta_key' => 'arch_width',
				'sortable' => false,
			),
		),
		'supports' => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'post-formats',
			'page-attributes',
			'theme-layouts',
			'archive',
		),
	) );

}
}
