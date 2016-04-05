<?php
add_filter( 'manage_posts_columns', 'arch_add_cpt_columns' );
add_action( 'manage_pages_custom_column', 'arch_manage_cpt_columns', 10, 2 );
add_filter( 'register_post_type_args', 'arch_cpt_args', 10, 2 );
add_action( 'bulk_edit_custom_box', 'arch_bulk_quick_edit_custom_box', 10, 2 );
add_action( 'quick_edit_custom_box', 'arch_bulk_quick_edit_custom_box', 10, 2 );


function arch_bulk_quick_edit_custom_box( $column_name, $post_type ) {

	if ( in_array( $post_type, arch_post_types() ) && $column_name == 'arch_component' ) {

		?><fieldset class="inline-edit-col-center">
			<div class="inline-edit-col">
				<label class="inline-edit-component alignleft">
					<span class="title"><svg class="arch-quick-icon" viewBox="0 0 24 24" width="18" height="18" fill="currentcolor"><path d="M22 17c0 2.76-2.24 5-5 5s-5-2.24-5-5 2.24-5 5-5 5 2.24 5 5zM6.5 6.5h3.8L7 1 1 11h5.5V6.5zm9.5 4.085V8H8v8h2.585c.433-2.783 2.632-4.982 5.415-5.415z"/></svg> Type </span>
						<select name="arch_component" class="arch_component" >
							<option value=""><?php _e( ' ' ); ?></option>
							<option value="card"><?php _e( 'Card' ); ?></option>
							<option value="tabs"><?php _e( 'Tab Group' ); ?></option>
							<option value="accordion"><?php _e( 'Accordion Group' ); ?></option>
							<option value="slides"><?php _e( 'Slideshow Group' ); ?></option>
						</select>
				</label>
			</div>
		</fieldset><?php

	}

	if ( in_array( $post_type, arch_post_types() ) && $column_name == 'arch_title' ) {

		?><fieldset class="inline-edit-col-center">
			<div class="inline-edit-col">
				<label class="inline-edit-title alignleft">
					<span class="title"><svg class="arch-quick-icon" viewBox="0 0 24 24" width="18" height="18" fill="currentcolor"><path d="M3 19h18v3H3v-3zm12.82-2h3.424L14 3h-4L4.756 17H8.18l1.067-3.5h5.506L15.82 17zm-1.952-6h-3.73l1.868-5.725L13.868 11z"/></svg> Title </span>
	                    <select name="arch_title" class="arch_title">
							<option value=""><?php _e( ' ' ); ?></option>
	                    	<option value="link-title"><?php _e( 'Linked Title' ); ?></option>
	                    	<option value="no-link-title"><?php _e( 'Title (no link)' ); ?></option>
	                    	<option value="no-title"><?php _e( 'Hide Title' ); ?></option>
	                    </select>
				</label>
			</div>
		</fieldset><?php

	}

	if ( in_array( $post_type, arch_post_types() ) && $column_name == 'arch_excerpt' ) {

		?><fieldset class="inline-edit-col-center">
			<div class="inline-edit-col">
				<label class="inline-edit-excerpt alignleft">
					<span class="title"><svg class="arch-quick-icon" viewBox="0 0 24 24" width="18" height="18" fill="currentcolor"><path d="M16 19H3v-2h13v2zm5-10H3v2h18V9zM3 5v2h11V5H3zm14 0v2h4V5h-4zm-6 8v2h10v-2H11zm-8 0v2h5v-2H3z"/></svg> Excerpt </span>
	                    <select name="arch_excerpt" class="arch_excerpt">
							<option value=""><?php _e( ' ' ); ?></option>
	                    	<option value="excerpt"><?php _e( 'Excerpt' ); ?></option>
	                    	<option value="content"><?php _e( 'Content' ); ?></option>
	                    	<option value="none"><?php _e( 'None' ); ?></option>
	                    </select>
				</label>
			</div>
		</fieldset><?php

	}

	if ( in_array( $post_type, arch_post_types() ) && $column_name == 'arch_width' ) {

		?><fieldset class="inline-edit-col-center">
			<div class="inline-edit-col">
				<label class="inline-edit-width alignleft">
					<span class="title"><svg class="arch-quick-icon" viewBox="0 0 24 24" width="18" height="18" fill="currentcolor"><path d="M16 13H5.828l2.086 2.086L6.5 16.5 2 12l4.5-4.5 1.414 1.414L5.828 11H16zm-8-2h10.172l-2.086-2.086L17.5 7.5 22 12l-4.5 4.5-1.414-1.414L18.172 13H8z"/></svg> Width </span>
						<select name="arch_width" class="arch_width">
							<option value=""><?php _e( ' ' ); ?></option>
							<option value="u-1of1-md"><?php _e( '100%' ); ?></option>
							<option value="u-1of4-md"><?php _e( '25%' ); ?></option>
							<option value="u-1of3-md"><?php _e( '33.33%' ); ?></option>
							<option value="u-1of2-md"><?php _e( '50%' ); ?></option>
							<option value="u-2of3-md"><?php _e( '66.66%' ); ?></option>
							<option value="u-3of4-md"><?php _e( '75%' ); ?></option>
						</select>
				</label>
			</div>
		</fieldset><?php

	}

	if ( in_array( $post_type, arch_post_types() ) && $column_name == 'arch_height' ) {
		// $equal = ( 'false' == get_post_meta( $post->ID, '_featured', true ) ) ? 'false' : 'true';
		?><fieldset class="inline-edit-col-left inline-edit-categories">
			<div class="inline-edit-col">

				<div id="arch-height">
					<span class="alignleft inline-edit-icon">
						<svg class="arch-quick-icon" viewBox="0 0 24 24" width="18" height="18" fill="currentcolor"><path d="M8.25 2.468v19.066c0 .806.66 1.465 1.47 1.465h4.397c.806 0 1.468-.66 1.467-1.47V2.47c0-.807-.66-1.467-1.467-1.467h-4.4c-.81 0-1.466.666-1.467 1.47zm3.143 17.39v1.047H8.775v-1.05l2.618.002zm2.096-2.097v1.05H8.77v-1.05h4.714zm-2.1-2.09v1.05H8.772v-1.05h2.618zm0-2.093v1.048H8.773v-1.05h2.617zm2.092-2.094v1.047h-4.71v-1.05h4.712zm-2.093-2.1v1.05H8.776V9.38h2.617zm0-2.093v1.047H8.776v-1.05h2.62zm2.1-2.098v1.05H8.773V5.19h4.714zM11.393 3.1v1.047l-2.62-.002.002-1.047h2.618z"/></svg>
					</span>
					<label class="alignleft inline-edit-height">
						<span class="checkbox-title"> <?php _e( 'True Height' ); ?> </span>
						<input type="checkbox" class="arch_height" name="arch_height" value="false" />
					</label>

					<br>
				</div>

			</div>
		</fieldset>
		<?php

	}

}

/**
 * The 'save_post' action passes 2 arguments: the $post_id (an integer)
 * and the $post information (an object).
 */
add_action( 'save_post', 'arch_be_qe_save_post', 10, 2 );
function arch_be_qe_save_post( $post_id, $post ) {

	// pointless if $_POST is empty (this happens on bulk edit)
	if ( empty( $_POST ) ) {
		return $post_id; }

	// verify quick edit nonce
	if ( isset( $_POST['_inline_edit'] ) && ! wp_verify_nonce( $_POST['_inline_edit'], 'inlineeditnonce' ) ) {
		return $post_id; }

	// don't save for autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id; }

	// dont save for revisions
	if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
		return $post_id; }

	if ( in_array( $post->post_type, arch_post_types() ) ) {
			/**
			 * Because this action is run in several places, checking for the array key
			 * keeps WordPress from editing data that wasn't in the form, i.e. if you had
			 * this post meta on your "Quick Edit" but didn't have it on the "Edit Post" screen.
			 */
			 // Sanitize user input.
	 		$height = isset( $_POST['arch_height'] ) ? 'false' : '';

	 		// Update the meta field in the database.
	 		update_post_meta( $post_id, 'arch_height', $height );

			$custom_fields = array( 'arch_component','arch_title','arch_excerpt','arch_width' );

		foreach ( $custom_fields as $field ) {

			if ( array_key_exists( $field, $_POST ) ) {
				update_post_meta( $post_id, $field, $_POST[ $field ] ); }
		}
	}

}

/**
 * Your javascript will run an AJAX function to save your data.
 * This is the WordPress AJAX function that will handle and save your data.
 */
add_action( 'wp_ajax_arch_save_bulk_edit', 'arch_save_bulk_edit' );
function arch_save_bulk_edit() {

	// we need the post IDs
	$post_ids = ( isset( $_POST['post_ids'] ) && ! empty( $_POST['post_ids'] ) ) ? $_POST['post_ids'] : null;

	// if we have post IDs
	if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {

		// get the custom fields
		$custom_fields = array( 'arch_component','arch_title','arch_excerpt','arch_width','arch_height' );

		foreach ( $custom_fields as $field ) {

			// if it has a value, doesn't update if empty on bulk
			if ( isset( $_POST[ $field ] ) && ! empty( $_POST[ $field ] ) ) {

				// update for each post ID
				foreach ( $post_ids as $post_id ) {
					update_post_meta( $post_id, $field, $_POST[ $field ] );
				}
			}
		}
	}
}


function arch_post_types() {
	$cpts = array( 'arch' );

	if ( has_filter( 'arch_add_post_types' ) ) {
		$cpts = apply_filters( 'arch_add_post_types', $cpts );
	}

	return $cpts;
}



function arch_cpt_args( $args, $post_type ) {

	if ( in_array( $post_type, arch_post_types() ) ) {
		$args['hierarchical'] = true;
	}

	return $args;
}


function arch_add_cpt_columns( $columns ) {
	if ( ! in_array( get_post_type(), arch_post_types() ) ) {
		return $columns; }
	return array_merge($columns,
		array(
			'arch_component'      => __( 'Type' ),
		    'arch_title'       => __( 'Title Display' ),
		    'arch_excerpt'     => __( 'Content' ),
			'arch_width'          => __( 'Width' ),
			'arch_height'         => __( 'Equal height' ),
		)
	);
}


function arch_manage_cpt_columns( $column, $post_id ) {
	if ( ! in_array( get_post_type(), arch_post_types() ) ) {
		return; }
	global $post;

	switch ( $column ) {

		case 'arch_component' :

			$arch_component = get_post_meta( $post_id, 'arch_component', true );

			if ( empty( $arch_component ) ) {
				echo __( '_' );
			} else { 				echo esc_html( $arch_component ); }

			break;

		case 'arch_title' :

			$arch_title = get_post_meta( $post_id, 'arch_title', true );

			if ( empty( $arch_title ) ) {
				echo __( '_' );
			} else { 				echo esc_html( $arch_title ); }
			break;

		case 'arch_excerpt' :

			$arch_excerpt = get_post_meta( $post_id, 'arch_excerpt', true );

			if ( empty( $arch_excerpt ) ) {
				echo __( '_' );
			} else { 				echo esc_html( $arch_excerpt ); }
			break;

		case 'arch_width' :

			$arch_width = get_post_meta( $post_id, 'arch_width', true );

			if ( empty( $arch_width ) ) {
				echo __( '_' );
			} else { 				echo esc_html( $arch_width ); }

			break;

		case 'arch_height' :

			$arch_height = get_post_meta( $post_id, 'arch_height', true );

			if ( empty( $arch_height ) ) {
				echo __( '_' );
			} else { 				echo esc_html( $arch_height ); }
			break;

		default :
			break;
	}
}

function arch_is_home() {
	return apply_filters( 'arch_is_home', in_array( 'post', arch_post_types() ) && is_home() );
}

/**
 * Add templates to hybrid_get_content_template()
 */
	add_filter( 'hybrid_content_template', 'arch_templates' );

function arch_templates( $template ) {

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() || is_singular( arch_post_types() ) ) {

		$arch_component = get_post_meta( get_the_ID(), 'arch_component', true );

		if ( $arch_component && ! is_single( get_the_ID() ) ) {

		 	$template = trailingslashit( arch_builder_plugin()->dir_path ) . "templates/{$arch_component}.php";
			$has_template    = locate_template( array( "templates/{$arch_component}.php" ) );

			if ( $has_template ) {
				$template = $has_template; }
		}
	}

	return $template;
}


function arch_title() {
	$arch_title = get_post_meta( get_the_ID(), 'arch_title', true );
	if ( 'no-title' == $arch_title ) {
		return; }

	if ( $arch_title == 'no-link-title' ) {
		the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' );
	} else {
		the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' );
	}
}

function arch_excerpt() {
	$arch_excerpt = get_post_meta( get_the_ID(), 'arch_excerpt', true );
	if ( 'none' == $arch_excerpt ) {
		return; }

	return $arch_excerpt == 'content' ? the_content() : the_excerpt();
}



	// Set default widths
if ( ! function_exists( 'arch_width_options' ) ) {

	function arch_width_options() {
		return array(
		'u-1of1-md'      => '1/1',
		'u-1of4-md'      => '1/4',
			'u-1of3-md'      => '1/3',
			'u-1of2-md'      => '1/2',
			'u-2of3-md'      => '2/3',
			'u-3of4-md'      => '3/4',
			);
	}
}

	add_action( 'pre_get_posts', 'arch_post_order', 1 );
function arch_post_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return; }
	if ( is_post_type_archive( arch_post_types() ) ) {
			$query->set( 'order', 'ASC' );
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'post_parent', 0 );
	}
}

	add_filter( 'hybrid_get_theme_layout', 'arch_landing_layout' );

function arch_landing_layout( $layout ) {

	$archive_layout = '';
	if ( is_post_type_archive() ) {
		global $cptarchives;

		$archive_layout = hybrid_get_post_layout( $cptarchives->get_archive_id() );
	}
	return $archive_layout && 'default' !== $archive_layout ? $archive_layout : $layout;
}

	add_action( 'init', 'arch_image_sizes', 5 );
function arch_image_sizes() {
	add_image_size( 'arch-hd', 1200, 675, true );
}
