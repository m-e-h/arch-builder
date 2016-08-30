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
							'label' => __( 'Card', 'arch' ),
						),
						'flag' => array(
							'url'   => $uri . 'flag.svg',
							'label' => __( 'Flag', 'arch' ),
						),
						'tile' => array(
							'url'   => $uri . 'tile.svg',
							'label' => __( 'Tile(NOT READY)', 'arch' ),
						),
						'row' => array(
							'url'   => $uri . 'row.svg',
							'label' => __( 'Row(NOT READY)', 'arch' ),
						),
						'tabs' => array(
							'url'   => $uri . 'tabs.svg',
							'label' => __( 'Tabs', 'arch' ),
						),
						'accordion' => array(
							'url'   => $uri . 'accordion.svg',
							'label' => __( 'Accordion', 'arch' ),
						),
						'slides' => array(
							'url'   => $uri . 'slide.svg',
							'label' => __( 'Slides', 'arch' ),
						),
					),
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

			// require_once arch_builder_plugin()->dir_path . 'includes/bb-controls/class-control-oembed.php';
			//
			// $manager->register_control(
			// new ButterBean_Control_Oembed(
			// 	$manager,
			// 	'arch_oembed',
			// 	array(
			// 		'type'        => 'oembed',
			// 		'section'     => 'arch_element_fields',
			// 		'label'       => 'Embed',
			// 	)
			// 	)
			// );

			$arch_primary_default = apply_filters( 'theme_mod_primary_color', '' );
			$arch_primary_archive = $arch_primary_default;
			$arch_secondary_default = apply_filters( 'theme_mod_secondary_color', '' );
			$arch_secondary_archive = $arch_secondary_default;
			global $cptarchives;
			if ( $GLOBALS['cptarchives'] ) {
				$arch_primary_archive = $cptarchives->get_archive_meta( 'doc_page_primary_color', true, $arch_primary_default, $post_type );
				$arch_secondary_archive = $cptarchives->get_archive_meta( 'doc_page_secondary_color', true, $arch_secondary_default, $post_type );
			}
			$arch_primary_c = new Color( $arch_primary_archive );
			$arch_secondary_c = new Color( $arch_secondary_archive );

			$manager->register_control(
				'arch_bg_color',
				array(
					'type'        => 'palette',
					'section'     => 'arch_modifier_fields',
					'label'       => 'Background Color',
					'description' => 'The default colors can be designated from your Landing Page.',
					'choices'     => array(
						'u-bg-white' => array(
							'label' => __( 'White (default)', 'arch' ),
							'colors' => array( '#ffffff' ),
						),
						'u-bg-1-light' => array(
							'label' => __( 'Primary Light', 'arch' ),
							'colors' => array( $arch_primary_c->lighten( 10 ) ),
						),
						'u-bg-1' => array(
							'label' => __( 'Primary', 'arch' ),
							'colors' => array( $arch_primary_c->getHex() ),
						),
						'u-bg-1-dark' => array(
							'label' => __( 'Primary Dark', 'arch' ),
							'colors' => array( $arch_primary_c->darken( 10 ) ),
						),
						'u-bg-transparent' => array(
							'label' => __( 'Transparent', 'arch' ),
							'colors' => array( '#dddddd' ),
						),
						'u-bg-2-light' => array(
							'label' => __( 'Secondary Light', 'arch' ),
							'colors' => array( $arch_secondary_c->lighten( 10 ) ),
						),
						'u-bg-2' => array(
							'label' => __( 'Secondary', 'arch' ),
							'colors' => array( $arch_secondary_c->getHex() ),
						),
						'u-bg-2-dark' => array(
							'label' => __( 'Secondary Dark', 'arch' ),
							'colors' => array( $arch_secondary_c->darken( 10 ) ),
						),
					),
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

			// $manager->register_setting(
			// 	'arch_oembed',
			// 	array( 'sanitize_callback' => 'esc_url' )
			// );

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
