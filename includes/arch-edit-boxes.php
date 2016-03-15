<?php
/**
 * Quick Edit and Bulk edit taken from http://wpdreamer.com/2012/03/manage-wordpress-posts-using-bulk-edit-and-quick-edit
 */
add_action( 'bulk_edit_custom_box', 'arch_be_qe_bulk_quick_edit_custom_box', 10, 2 );
add_action( 'quick_edit_custom_box', 'arch_be_qe_bulk_quick_edit_custom_box', 10, 2 );
function arch_be_qe_bulk_quick_edit_custom_box($column_name, $post_type) {

	if (in_array($post_type, abe_non_hierarchy_cpts()) && $column_name == 'arch_show_content') {

					?><fieldset class="inline-edit-col-right">
						<div class="inline-edit-col">
							<label class="inline-edit-status alignleft">
								<span class="title">Show content </span>
                                    <select name="arch_show_content">
                                    	<option value="excerpt"><?php _e( 'Excerpt' ); ?></option>
                                    	<option value="content"><?php _e( 'Content' ); ?></option>
                                    	<option value="none"><?php _e( 'Title Only' ); ?></option>
                                    </select>
							</label>
						</div>
					</fieldset><?php

	}

}

add_action( 'admin_enqueue_scripts', 'arch_be_qe_enqueue_admin_scripts' );
function arch_be_qe_enqueue_admin_scripts() {
	wp_enqueue_script( 'arch-bulk-quick-edit', arch_builder_plugin()->js_uri . "bulk_quick_edit.js", array( 'jquery', 'inline-edit-post' ), '', true );
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

	if (in_array($post->post_type, abe_non_hierarchy_cpts())) {
			/**
			 * Because this action is run in several places, checking for the array key
			 * keeps WordPress from editing data that wasn't in the form, i.e. if you had
			 * this post meta on your "Quick Edit" but didn't have it on the "Edit Post" screen.
			 */
			$custom_fields = array( 'arch_show_content' );

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
		$custom_fields = array( 'arch_show_content' );

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

?>
