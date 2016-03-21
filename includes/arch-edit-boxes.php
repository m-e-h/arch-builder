<?php
/**
 * Quick Edit and Bulk edit taken from http://wpdreamer.com/2012/03/manage-wordpress-posts-using-bulk-edit-and-quick-edit
 */
add_action( 'bulk_edit_custom_box', 'arch_bulk_quick_edit_custom_box', 10, 2 );
add_action( 'quick_edit_custom_box', 'arch_bulk_quick_edit_custom_box', 10, 2 );
function arch_bulk_quick_edit_custom_box($column_name, $post_type) {

	if (in_array($post_type, arch_post_types()) && $column_name == 'arch_component') {

		?><fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">
				<label class="inline-edit-status alignleft">
					<span class="title">Component Type </span>
                        <select name="arch_component">
                        	<option value="card"><?php _e( 'Card' ); ?></option>
                        	<option value="tabs"><?php _e( 'Tab Group' ); ?></option>
                        	<option value="accordion"><?php _e( 'Accordion Group' ); ?></option>
                        </select>
				</label>
			</div>
		</fieldset><?php

	}

	if (in_array($post_type, arch_post_types()) && $column_name == 'arch_excerpt') {

		?><fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">
				<label class="inline-edit-status alignleft">
					<span class="title">Show content </span>
	                    <select name="arch_excerpt">
	                    	<option value="excerpt"><?php _e( 'Excerpt' ); ?></option>
	                    	<option value="content"><?php _e( 'Content' ); ?></option>
	                    	<option value="title-only"><?php _e( 'Title Only' ); ?></option>
	                    </select>
				</label>
			</div>
		</fieldset><?php

	}

	if (in_array($post_type, arch_post_types()) && $column_name == 'arch_width') {

		?><fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">
				<label class="inline-edit-status alignleft">
					<span class="title">Width </span>
                        <select name="arch_width">
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

}

/**
 * The 'save_post' action passes 2 arguments: the $post_id (an integer)
 * and the $post information (an object).
 */
add_action( 'save_post', 'arch_be_qe_save_post', 10, 2 );
function arch_be_qe_save_post($post_id, $post) {

	// pointless if $_POST is empty (this happens on bulk edit)
	if ( empty( $_POST ) )
		return $post_id;

	// verify quick edit nonce
	if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
		return $post_id;

	// don't save for autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	// dont save for revisions
	if ( isset( $post->post_type ) && $post->post_type == 'revision' )
		return $post_id;

	if (in_array($post->post_type, arch_post_types())) {
			/**
			 * Because this action is run in several places, checking for the array key
			 * keeps WordPress from editing data that wasn't in the form, i.e. if you had
			 * this post meta on your "Quick Edit" but didn't have it on the "Edit Post" screen.
			 */
			$custom_fields = array( 'arch_component','arch_excerpt','arch_width' );

			foreach( $custom_fields as $field ) {

				if ( array_key_exists( $field, $_POST ) )
					update_post_meta( $post_id, $field, $_POST[ $field ] );

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
	$post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : null;

	// if we have post IDs
	if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {

		// get the custom fields
		$custom_fields = array( 'arch_component','arch_excerpt','arch_width' );

		foreach( $custom_fields as $field ) {

			// if it has a value, doesn't update if empty on bulk
			if ( isset( $_POST[ $field ] ) && !empty( $_POST[ $field ] ) ) {

				// update for each post ID
				foreach( $post_ids as $post_id ) {
					update_post_meta( $post_id, $field, $_POST[ $field ] );
				}

			}

		}

	}

}


function arch_is_home() {
	return apply_filters( 'arch_is_home', in_array('post', arch_post_types()) && is_home() );
}

/**
 * Add templates to hybrid_get_content_template()
 */
 add_filter( 'hybrid_content_template', 'arch_templates' );

 function arch_templates( $template ) {

	if ( is_post_type_archive( arch_post_types() ) || arch_is_home() ) {

 	$arch_component = get_post_meta( get_the_ID(), 'arch_component', true );

         if ( $arch_component ) {

         	$template = trailingslashit( arch_builder_plugin()->dir_path ) . "templates/{$arch_component}.php";
			$has_template = locate_template( array( "templates/{$arch_component}.php" ) );

             if ( $has_template )
                 $template = $has_template;
         }
     }

     return $template;
 }


function arch_excerpt() {
	$arch_excerpt = get_post_meta( get_the_ID(), 'arch_excerpt', true );
	if ($arch_excerpt == 'title-only')
		return;

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


function arch_post_types($cpts = array()) {
	$cpts = array( 'post' );

	if (has_filter('arch_add_post_types')) {
		$cpts = apply_filters('arch_add_post_types', $cpts);
	}

	return $cpts;
}




?>
