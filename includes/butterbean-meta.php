<?php

use Mexitek\PHPColors\Color;

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
				'arch_block_fields',
				array(
					'label' => 'Block',
					'icon'  => 'dashicons-align-center',
				)
			);

			$manager->register_section(
				'arch_element_fields',
				array(
					'label' => 'Elements',
					'icon'  => 'dashicons-image-filter',
				)
			);

			$manager->register_section(
				'arch_modifier_fields',
				array(
					'label' => 'Modifiers',
					'icon'  => 'dashicons-admin-settings',
				)
			);

			/* === Register Controls === */
$uri = arch_builder_plugin()->img_uri;

			$manager->register_control(
				'arch_component',
				array(
					'type'        => 'radio-image',
					'section'     => 'arch_block_fields',
					'label'       => 'Component Type',
					'choices' => array(
						'card' => array(
							'url'   => $uri . 'card.svg',
							'label' => __( 'Card', 'hcct' )
						),
						'flag' => array(
							'url'   => $uri . 'flag.svg',
							'label' => __( 'Flag', 'hcct' )
						),
						'tabs' => array(
							'url'   => $uri . 'tabs.svg',
							'label' => __( 'Tabs', 'hcct' )
						),
						'accordion' => array(
							'url'   => $uri . 'accordion.svg',
							'label' => __( 'Accordion', 'hcct' )
						),
						'slides' => array(
							'url'   => $uri . 'slide.svg',
							'label' => __( 'Slides', 'hcct' )
						),
					)
				)
			);

			$manager->register_control(
				'arch_width',
					array(
						'type'        => 'select',
						'section'     => 'arch_block_fields',
						'label'       => 'Component Width',
						'choices'     => arch_width_options(),
					)
			);

			$manager->register_control(
				'arch_height',
					array(
						'type'        => 'checkbox',
						'section'     => 'arch_block_fields',
						'label'       => 'Independent Height',
						'description' => 'By default blocks stretch to the size of adjacent blocks.',
					)
			);

			$manager->register_control(
				'arch_title',
					array(
						'type'        => 'select',
						'section'     => 'arch_element_fields',
						'label'       => 'Title Display',
						'choices'     => arch_title_choices(),
					)
			);

			$manager->register_control(
				'arch_excerpt',
					array(
						'type'        => 'select',
						'section'     => 'arch_element_fields',
						'label'       => 'Excerpt Type',
						'description' => 'Show the whole page(content), a teaser without formatting(excerpt) or show only the title (and image).',
						'choices'     => arch_excerpt_choices(),
					)
			);

			$arch_primary_c = new Color( Abraham_Custom_Styles::primary_color_default( $hex ) );
			$arch_secondary_c = new Color( Abraham_Custom_Styles::secondary_color_default( $hex ) );

			$manager->register_control(
				'arch_bg_color',
				array(
					'type'        => 'palette',
					'section'     => 'arch_modifier_fields',
					'label'       => 'Background Color',
					'description' => 'Colors below are the site defaults. Your actual palette will reflect the defaults chosen for your Landing Page.',
					'choices'     => array(
						'u-bg-white' => array(
							'label' => __( 'White (default)', 'hcct' ),
							'colors' => array( '#ffffff' )
						),
						'u-bg-1-light' => array(
							'label' => __( 'Primary Light', 'hcct' ),
							'colors' => array( $arch_primary_c->lighten( 10 ) )
						),
						'u-bg-1' => array(
							'label' => __( 'Primary', 'hcct' ),
							'colors' => array( $arch_primary_c->getHex() )
						),
						'u-bg-1-dark' => array(
							'label' => __( 'Primary Dark', 'hcct' ),
							'colors' => array( $arch_primary_c->darken( 10 ) )
						),
						'u-bg-2-light' => array(
							'label' => __( 'Secondary Light', 'hcct' ),
							'colors' => array( $arch_secondary_c->lighten( 10 ) )
						),
						'u-bg-2' => array(
							'label' => __( 'Secondary', 'hcct' ),
							'colors' => array( $arch_secondary_c->getHex() )
						),
						'u-bg-2-dark' => array(
							'label' => __( 'Secondary Dark', 'hcct' ),
							'colors' => array( $arch_secondary_c->darken( 10 ) )
						),
						'u-bg-transparent' => array(
							'label' => __( 'Transparent', 'hcct' ),
							'colors' => array( '#dddddd' )
						),
					)
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
				'arch_bg_color',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_height',
				array( 'sanitize_callback' => 'butterbean_validate_boolean' )
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
