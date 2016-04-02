<?php

class Arch_Builder {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'arch_block_metabox',
			__( 'Archive Display', 'arch_builder' ),
			array( $this, 'render_metabox' ),
			arch_post_types(),
			'normal',
			'default'
		);

	}

	public function render_metabox($post) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'nonce_action', 'nonce' );

		// Retrieve an existing value from the database.
		$arch_component = get_post_meta( $post->ID, 'arch_component', true );
		$arch_width     = get_post_meta( $post->ID, 'arch_width', true );
		$arch_excerpt   = get_post_meta( $post->ID, 'arch_excerpt', true );

		// Set default values.
		if( empty( $arch_component ) ) $arch_component = '';
		if( empty( $arch_width ) ) $arch_width         = '';
		if( empty( $arch_excerpt ) ) $arch_excerpt     = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="arch_component" class="arch_component_label">' . __( 'Component Type', 'arch_builder' ) . '</label></th>';
		echo '		<td>';
		echo '			<select id="arch_component" name="arch_component" class="arch_component_field">';
		echo '			<option value="card" ' . selected( $arch_component, 'card', false ) . '> ' . __( 'Card', 'arch_builder' ) . '</option>';
		echo '			<option value="tabs" ' . selected( $arch_component, 'tabs', false ) . '> ' . __( 'Tab Group', 'arch_builder' ) . '</option>';
		echo '			<option value="accordion" ' . selected( $arch_component, 'accordion', false ) . '> ' . __( 'Accordion Group', 'arch_builder' ) . '</option>';
		echo '			<option value="slides" ' . selected( $arch_component, 'accordion', false ) . '> ' . __( 'Slideshow Group', 'arch_builder' ) . '</option>';
		echo '			</select>';
		echo '		</td>';
		echo '	</tr>';
		echo '	<tr>';

		echo '	<tr>';
		echo '		<th><label for="arch_width" class="arch_width_label">' . __( 'Width', 'arch_builder' ) . '</label></th>';
		echo '		<td>';
		echo '			<select id="arch_width" name="arch_width" class="arch_width_field">';
		echo '			<option value="u-1of1-md" ' . selected( $arch_width, 'u-1of1-md', false ) . '> ' . __( '100%', 'arch_builder' ) . '</option>';
		echo '			<option value="u-1of4-md" ' . selected( $arch_width, 'u-1of4-md', false ) . '> ' . __( '25%', 'arch_builder' ) . '</option>';
		echo '			<option value="u-1of3-md" ' . selected( $arch_width, 'u-1of3-md', false ) . '> ' . __( '33.33%', 'arch_builder' ) . '</option>';
		echo '			<option value="u-1of2-md" ' . selected( $arch_width, 'u-1of2-md', false ) . '> ' . __( '50%', 'arch_builder' ) . '</option>';
		echo '			<option value="u-2of3-md" ' . selected( $arch_width, 'u-2of3-md', false ) . '> ' . __( '66.66%', 'arch_builder' ) . '</option>';
		echo '			<option value="u-3of4-md" ' . selected( $arch_width, 'u-3of4-md', false ) . '> ' . __( '75%', 'arch_builder' ) . '</option>';
		echo '			</select>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="arch_excerpt" class="arch_excerpt_label">' . __( 'Content', 'arch_builder' ) . '</label></th>';
		echo '		<td>';
		echo '			<select id="arch_excerpt" name="arch_excerpt" class="arch_excerpt_field">';
		echo '			<option value="excerpt" ' . selected( $arch_excerpt, 'excerpt', false ) . '> ' . __( 'Excerpt', 'arch_builder' ) . '</option>';
		echo '			<option value="content" ' . selected( $arch_excerpt, 'content', false ) . '> ' . __( 'Content', 'arch_builder' ) . '</option>';
		echo '			<option value="none" ' . selected( $arch_excerpt, 'none', false ) . '> ' . __( 'None', 'arch_builder' ) . '</option>';
		echo '			</select>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox($post_id, $post) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
		$nonce_action = 'nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Sanitize user input.
		$new_arch_component = isset( $_POST[ 'arch_component' ] ) ? $_POST[ 'arch_component' ] : '';
		$new_arch_width     = isset( $_POST[ 'arch_width' ] ) ? $_POST[ 'arch_width' ] : '';
		$new_arch_excerpt   = isset( $_POST[ 'arch_excerpt' ] ) ? $_POST[ 'arch_excerpt' ] : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'arch_component', $new_arch_component );
		update_post_meta( $post_id, 'arch_width', $new_arch_width );
		update_post_meta( $post_id, 'arch_excerpt', $new_arch_excerpt );

	}

}

new Arch_Builder;
