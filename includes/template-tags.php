<?php

function arch_post_types() {
	$cpts = array( 'arch' );

	if ( has_filter( 'arch_add_post_types' ) ) {
		$cpts = apply_filters( 'arch_add_post_types', $cpts );
	}

	return $cpts;
}


function arch_is_home() {
	return apply_filters( 'arch_is_home', in_array( 'post', arch_post_types(), true ) && is_home() );
}

function arch_title() {
	$arch_title = get_post_meta( get_the_ID(), 'arch_title', true );
	if ( 'no-title' === $arch_title ) {
		return; }

	if ( 'no-link-title' === $arch_title ) {
		the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' );
	} else {
		the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' );
	}
}

function arch_excerpt() {
	$arch_excerpt = get_post_meta( get_the_ID(), 'arch_excerpt', true );
	if ( 'none' === $arch_excerpt || ! hybrid_post_has_content()) {
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
			'' 				=> 'Default',
			'link-title'   	=> 'Linked Title',
			'no-link-title' => 'Title (no link)',
			'slides'  		=> 'Hide Title',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_excerpt_choices' ) ) {

	function arch_excerpt_choices() {
		return array(
			'' 				=> 'Default',
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
			'' 			=> 'Default',
			'card'   	=> 'Card',
			'flag'   	=> 'Flag',
			'tabs'      => 'Tab Group',
			'accordion' => 'Accordion Group',
			'slides'  	=> 'Slideshow Group',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_layout_choices' ) ) {

	function arch_layout_choices() {
		return array(
			'' 				=> 'Default',
			'flag'   		=> 'Flag (horizontal)',
			'no-link-title' => 'Card (vertical/square)',
		);
	}
}

	// Set default widths.
if ( ! function_exists( 'arch_width_options' ) ) {

	function arch_width_options() {
		return array(
		'' 				=> 'Default',
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
