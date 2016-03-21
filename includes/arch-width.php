<?php

add_filter( 'post_class', 'arch_width_post_classes', 10, 3 );
add_filter( 'hybrid_attr_content', 'arch_grid' );


function arch_width_post_classes($classes, $class, $post_id) {
	$achive_width       = get_post_meta( $post_id, 'arch_width', true );
	if ($achive_width && ! is_search() && ! is_single($post_id))
		$classes[]      = $achive_width;

    return $classes;
}

function arch_grid($attr) {

    if ( is_post_type_archive( arch_post_types() ) || arch_is_home() ) {
        $attr['class']   .= " o-grid";
    }
	return $attr;
}
