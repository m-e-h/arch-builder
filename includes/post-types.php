<?php

//require_once dirname(__FILE__) . '/../vendor/extended-cpts.php';


add_action( 'init', 'arch_register_post_types' );


function arch_register_post_types() {
$arr = abe_non_hierarchy_cpts();
foreach ($arr as $value) {
	register_extended_post_type( $value, array(
		'admin_cols' => array(
			'arch_show_content' => array(
				'title'    => 'Content',
				'meta_key' => 'arch_show_content',
				'sortable' => false,
			),
			'width' => array(
				'title'    => 'Width',
				'meta_key' => 'arch_post_width',
				'sortable' => false,
			),
		),
	) );

}
}
