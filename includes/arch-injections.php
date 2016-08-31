<?php

add_action( 'init', 'arch_image_sizes', 5 );
add_action( 'pre_get_posts', 'arch_post_order', 1 );
add_filter( 'hybrid_content_template', 'arch_templates' );
add_filter( 'post_class', 'arch_width_post_classes', 10, 3 );
add_filter( 'hybrid_attr_content', 'arch_grid' );
add_filter( 'body_class', 'arch_body_classes' );



function arch_image_sizes() {
	add_image_size( 'arch-hd', 1200, 675, true );
}

function arch_post_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return $query;

	if ( 1 === get_theme_mod( 'arch_front_page', '' ) && $query->is_home() ) {
		$query->set( 'post_type', 'arch' );
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'post_parent', 0 );
	}
	elseif ( is_post_type_archive( arch_post_types() ) ) {
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'post_parent', 0 );
	}
}

/**
 * Add templates to hybrid_get_content_template()
 */
function arch_templates( $template ) {
	if (is_admin())
		return $template;

	// If the post type doesn't support `arch-posts`, bail.
	if ( ! post_type_supports( get_post_type(), 'arch-post' ) || ! members_can_current_user_view_post() || is_search() )
		return $template;

		$arch_component = get_post_meta( get_the_ID(), 'arch_component', true );

		if ( $arch_component && ! is_single( get_the_ID() ) ) {

		 	$template = trailingslashit( arch_builder_plugin()->dir_path ) . "content/{$arch_component}.php";
			$has_template    = locate_template( array( "content/{$arch_component}.php" ) );

			if ( $has_template ) {
				$template = $has_template; }
		}

	return $template;
}



function arch_width_post_classes( $classes, $class, $post_id ) {

	if ( is_admin() || is_search() || is_single( $post_id ) ) {
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

	if ( 'row' === get_arch_block( $post_id ) ) {
		$classes[] = 'u-shadow0 u-br0 u-m0 section-row u-relative u-1of1 u-fluid-xp u-pt3 u-pt4-md u-pb2 u-pb3-md';
	}

	if ( 'tile' === get_arch_block( $post_id ) ) {
		$classes[] = 'tilo u-flex-wrap o-cell u-br u-flex u-flex-col u-shadow1 shadow-hover';
	}

	if ( get_arch_bg( $post_id ) ) {
		$classes[] = get_arch_bg( $post_id );
	}

	if ( 'u-bg-transparent' ===  get_arch_bg( $post_id ) ) {
		$classes[] = 'u-shadow0';
	}

	if ( '1' === $arch_height || 'independent' === $arch_height ) {
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
	if (is_admin())
		return $classes;

	// Adds a class of arch to arch post-types.
	if ( post_type_supports( get_post_type(), 'arch-post' ) ) {
		$classes[] = 'arch';
	}
	return $classes;
}



function arch_grid( $attr ) {
	if (is_admin())
		return $attr;

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() ) {
		$attr['class']   .= ' o-grid';
	}
	return $attr;
}
