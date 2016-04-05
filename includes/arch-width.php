<?php

add_filter( 'post_class', 'arch_width_post_classes', 10, 3 );
add_filter( 'hybrid_attr_content', 'arch_grid' );


function arch_width_post_classes( $classes, $class, $post_id ) {

	if ( is_search() || is_single( $post_id ) ) {
		return; }

	$achive_width   = get_post_meta( $post_id, 'arch_width', true );
	$arch_title     = get_post_meta( $post_id, 'arch_title', true );
	$arch_component = get_post_meta( $post_id, 'arch_component', true );
	$arch_height    = get_post_meta( $post_id, 'arch_height', true );

	if ( $achive_width ) {
		$classes[] = 'arch';
		$classes[] = $achive_width;
	}

	if ( $arch_component ) {
		$classes[] = $arch_component;
	}

	if ( $arch_title ) {
		$classes[] = $arch_title;
	}

	if ( 'false' == $arch_height ) {
		$classes[] = 'u-flexed-start';
	}

	return $classes;
}

function arch_grid( $attr ) {

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() ) {
		$attr['class']   .= ' o-grid';
	}
	return $attr;
}
