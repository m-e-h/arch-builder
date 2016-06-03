<?php

add_action( 'init', 'arch_image_sizes', 5 );
add_action( 'pre_get_posts', 'arch_post_order', 1 );
add_filter( 'hybrid_content_template', 'arch_templates' );
add_filter( 'hybrid_get_theme_layout', 'arch_archive_layout' );
add_filter( 'post_class', 'arch_width_post_classes', 10, 3 );
add_filter( 'hybrid_attr_content', 'arch_grid' );
add_filter( 'body_class', 'arch_body_classes' );



function arch_image_sizes() {
	add_image_size( 'arch-hd', 1200, 675, true );
}

function arch_post_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return; }
	if ( is_post_type_archive( arch_post_types() ) ) {
			$query->set( 'order', 'ASC' );
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'post_parent', 0 );
	}
}

/**
 * Add templates to hybrid_get_content_template()
 */
function arch_templates( $template ) {

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() || is_singular( arch_post_types() ) ) {

		$arch_component = get_post_meta( get_the_ID(), 'arch_component', true );

		if ( $arch_component && ! is_single( get_the_ID() ) ) {

		 	$template = trailingslashit( arch_builder_plugin()->dir_path ) . "content/{$arch_component}.php";
			$has_template    = locate_template( array( "content/{$arch_component}.php" ) );

			if ( $has_template ) {
				$template = $has_template; }
		}
	}

	return $template;
}



function arch_archive_layout( $layout ) {

	$archive_layout = '';
	if ( is_post_type_archive() ) {
		global $cptarchives;

		$archive_layout = hybrid_get_post_layout( $cptarchives->get_archive_id() );
	}
	return $archive_layout && 'default' !== $archive_layout ? $archive_layout : $layout;
}



function arch_width_post_classes( $classes, $class, $post_id ) {

	if ( is_search() || is_single( $post_id ) ) {
		return $classes; }

	$arch_layout  = get_post_meta( $post_id, 'arch_layout', true );
	$archive_width   = get_post_meta( $post_id, 'arch_width', true );
	$arch_title     = get_post_meta( $post_id, 'arch_title', true );
	$arch_component = get_post_meta( $post_id, 'arch_component', true );
	$arch_height    = get_post_meta( $post_id, 'arch_height', true );

	if ( $archive_width ) {
		$classes[] = "arch-{$archive_width}";
	}

	if ( $arch_component ) {
		$classes[] = "arch-{$arch_component}";
	}

	if ( $arch_title ) {
		$classes[] = "arch-{$arch_title}";
	}

	if ( 'flag' === get_arch_block( $post_id ) ) {
		$classes[] = 'u-flex';
	}

	if ( '1' === $arch_height || 'false' === $arch_height ) {
		$classes[] = 'u-flexed-start';
	} else {
		$classes[] = 'u-flexed-stretch';
	}

	return $classes;
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function arch_body_classes( $classes ) {
	// Adds a class of arch to arch post-types.
	if ( is_post_type_archive( arch_post_types() ) || is_singular( arch_post_types() ) ) {
		$classes[] = 'arch';
	}
	return $classes;
}



function arch_grid( $attr ) {

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() ) {
		$attr['class']   .= ' o-grid';
	}
	return $attr;
}
