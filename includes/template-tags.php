<?php

function arch_post_types() {
	return get_post_types_by_support( 'arch-post' );
}

function is_arch_post() {
	return in_array( get_post_type( get_the_ID(), arch_post_types() ) );
}

function arch_is_home() {
	return is_home() && 1 == get_theme_mod( 'arch_front_page', '' );
}

function arch_title() {
	$arch_title = get_post_meta( get_the_ID(), 'arch_title', true );
	if ( 'no-title' === $arch_title ) {
		return;
	} elseif ( 'no-link-title' === $arch_title ) { ?>
		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' ); ?>
		</header>
	<?php } else { ?>
		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</header><?php
}
}

function arch_excerpt() {
	$arch_excerpt = get_post_meta( get_the_ID(), 'arch_excerpt', true );
	if ( 'none' === $arch_excerpt || ! hybrid_post_has_content() ) {
		return;
	} ?>
	<div <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php 'content' === $arch_excerpt ? the_content() : the_excerpt(); ?>
	</div>
	<?php
}

// Set default components.
if ( ! function_exists( 'arch_title_choices' ) ) {

	function arch_title_choices() {
		return array(
			'' 				=> ' ',
			'link-title'   	=> 'Linked Title',
			'no-link-title' => 'Title (no link)',
			'no-title'  	=> 'Hide Title',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_excerpt_choices' ) ) {

	function arch_excerpt_choices() {
		return array(
			'' 				=> ' ',
			'excerpt'   	=> 'Excerpt',
			'content' 		=> 'Content',
			'none' 			=> 'None',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_block_choices' ) ) {

	function arch_block_choices() {
		return array(
			'' 			=> ' ',
			'card'   	=> 'Card',
			'flag'   	=> 'Flag',
			'tabs'      => 'Tab Group',
			'accordion' => 'Accordion Group',
			'slides'  	=> 'Slideshow Group',
		);
	}
}

	// Set default widths.
if ( ! function_exists( 'arch_width_options' ) ) {

	function arch_width_options() {
		return array(
			'' 				=> ' ',
			'u-1of1-md'    	=> '1/1',
			'u-1of4-md'   	=> '1/4',
			'u-1of3-md'   	=> '1/3',
			'u-1of2-md'   	=> '1/2',
			'u-2of3-md'   	=> '2/3',
			'u-3of4-md'   	=> '3/4',
		);
	}
}

function get_arch_block( $post_id ) {
	return get_post_meta( $post_id, 'arch_component', true );
}

function get_arch_bg( $post_id ) {
	return get_post_meta( $post_id, 'arch_bg_color', true );
}




function my_searchwp_exclude( $ids, $engine, $terms ) {
	$entries_to_exclude = get_posts(
		array(
			'post_type' => 'any',
			'key' => 'arch_title',
			'value' => 'no-link-title',
			'compare' => '=',
		)
	);
	$ids = array_unique( array_merge( $ids, array_map( 'absint', $entries_to_exclude ) ) );
	return $ids;
}
add_filter( 'searchwp_exclude', 'my_searchwp_exclude', 10, 3 );
