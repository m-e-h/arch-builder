<?php

if ( ! class_exists( 'ButterBean_Arch' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	final class ButterBean_Arch {

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {

			// Call the register function.
			add_action( 'butterbean_register', array( $this, 'register' ), 10, 2 );
		}

		/**
		 * Registers managers, sections, controls, and settings.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  object  $butterbean  Instance of the `ButterBean` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register( $butterbean, $post_type ) {

			if ( ! in_array( $post_type, arch_post_types(), true ) ) {
				return; }

			/* === Register Managers === */

			$butterbean->register_manager(
				'bbe_arch',
				array(
					'label'     => 'Archive Layout:',
					'post_type' => arch_post_types(),
					'context'   => 'normal',
					'priority'  => 'high',
				)
			);

			$manager = $butterbean->get_manager( 'bbe_arch' );

			/* === Register Sections === */

			$manager->register_section(
				'arch_block_feilds',
				array(
					'label' => 'Block',
					'icon'  => 'dashicons-align-center',
				)
			);

			$manager->register_section(
				'arch_element_feilds',
				array(
					'label' => 'Elements',
					'icon'  => 'dashicons-image-filter',
				)
			);

			$manager->register_section(
				'arch_modifier_feilds',
				array(
					'label' => 'Modifiers',
					'icon'  => 'dashicons-admin-settings',
				)
			);

			/* === Register Controls === */

			$manager->register_control(
				'arch_component',
					array(
						'type'        => 'select',
						'section'     => 'arch_block_feilds',
						'label'       => 'Component Type',
						'description' => 'Arch description.',
						'choices'     => arch_block_choices(),
					)
			);

			$manager->register_control(
				'arch_title',
					array(
						'type'        => 'select',
						'section'     => 'arch_element_feilds',
						'label'       => 'Title Display',
						'description' => 'Arch description.',
						'choices'     => arch_title_choices(),
					)
			);

			$manager->register_control(
				'arch_excerpt',
					array(
						'type'        => 'select',
						'section'     => 'arch_element_feilds',
						'label'       => 'Excerpt Type',
						'description' => 'Arch description.',
						'choices'     => arch_excerpt_choices(),
					)
			);

			$manager->register_control(
				'arch_width',
					array(
						'type'        => 'select',
						'section'     => 'arch_modifier_feilds',
						'label'       => 'Block Width',
						'description' => 'Arch description.',
						'choices'     => arch_width_options(),
					)
			);

			$manager->register_control(
				'arch_color',
				array(
					'type'        => 'color',
					'section'     => 'arch_modifier_feilds',
					'label'       => 'Pick an accent color',
					'description' => 'THIS DOESNT WORK YET.',
				)
			);

			$manager->register_control(
				'arch_height',
					array(
						'type'        => 'checkbox',
						'section'     => 'arch_modifier_feilds',
						'label'       => 'Independent Height',
						'description' => 'By default blocks stretch to the size of adjacent blocks.',
					)
			);

			/* === Register Settings === */

			$manager->register_setting(
				'arch_component',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_title',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_excerpt',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_width',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_height',
				array( 'sanitize_callback' => 'butterbean_validate_boolean' )
			);

			$manager->register_setting(
				'arch_color',
				array( 'sanitize_callback' => '' )
			);
		}


		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __construct() {}
	}

	ButterBean_Arch::get_instance();
}
