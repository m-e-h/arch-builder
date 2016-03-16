<?php

add_filter( 'post_class', 'arch_width_post_classes', 10, 3 );



function arch_width_post_classes($classes, $class, $post_id) {
	$achive_width       = get_post_meta( $post_id, 'arch_post_width', true );
	if ($achive_width && ! is_search() && ! is_single($post_id))
		$classes[]      = $achive_width;

    return $classes;
}
