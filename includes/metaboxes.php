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
					'description' => '** Select on the parent post. Child posts will be used as the content.<br>*** In the above editor, add an image gallery from the media library',
					'choices' => array(
						'card' => array(
							'url'   => $uri . 'card.svg',
							'label' => __( 'Card (default)', 'arch' ),
						),
						'flag' => array(
							'url'   => $uri . 'flag.svg',
							'label' => __( 'Flag', 'arch' ),
						),
						'tabs' => array(
							'url'   => $uri . 'tabs.svg',
							'label' => __( 'Tabs**', 'arch' ),
						),
						'accordion' => array(
							'url'   => $uri . 'accordion.svg',
							'label' => __( 'Accordion**', 'arch' ),
						),
						'slides' => array(
							'url'   => $uri . 'slide.svg',
							'label' => __( 'Slides***', 'arch' ),
						),
						'tile' => array(
							'url'   => $uri . 'tile.svg',
							'label' => __( 'Tile(NOT READY)', 'arch' ),
						),
						'row' => array(
							'url'   => $uri . 'row.svg',
							'label' => __( 'Row**(NOT READY)', 'arch' ),
						),
					),
				)
			);

			// $manager->register_control(
			// 	'arch_width',
			// 	array(
			// 			'type'        => 'radio',
			// 			'section'     => 'arch_block_fields',
			// 			'label'       => 'Component Width',
			// 			'choices'     => arch_width_options(),
			// 		)
			// );

			$manager->register_control(
				'arch_width',
				array(
					'type'        => 'radio-image',
					'section'     => 'arch_block_fields',
					'label'       => 'Component Width',
					'choices' => array(
						'u-1of1-md' => array(
							'url'   => $uri . '1of1.svg',
							'label' => __( '100%', 'arch' ),
						),
						'u-1of2-md' => array(
							'url'   => $uri . '1of2.svg',
							'label' => __( '50%', 'arch' ),
						),
						'u-1of3-md' => array(
							'url'   => $uri . '1of3.svg',
							'label' => __( '33.33%', 'arch' ),
						),
						'u-2of3-md' => array(
							'url'   => $uri . '2of3.svg',
							'label' => __( '66.66%', 'arch' ),
						),
						'u-1of4-md' => array(
							'url'   => $uri . '1of4.svg',
							'label' => __( '25%', 'arch' ),
						),
						'u-3of4-md' => array(
							'url'   => $uri . '3of4.svg',
							'label' => __( '75%', 'arch' ),
						),
					),
				)
			);

			$manager->register_control(
				'arch_title',
				array(
					'type'        => 'radio-image',
					'section'     => 'arch_element_fields',
					'label'       => 'Title Display',
					'choices' => array(
						'link-title' => array(
							'url'   => $uri . 'link.svg',
							'label' => __( 'Linked Title', 'arch' ),
						),
						'no-link-title' => array(
							'url'   => $uri . 'no-link.svg',
							'label' => __( 'Title (no link)', 'arch' ),
						),
						'no-title' => array(
							'url'   => $uri . 'none.svg',
							'label' => __( 'Hide Title', 'arch' ),
						),
					),
				)
			);

			$manager->register_control(
				'arch_excerpt',
				array(
					'type'        => 'radio-image',
					'section'     => 'arch_element_fields',
					'label'       => 'Body Display',
					'description' => 'Show the whole page(content), a teaser without formatting(excerpt) or show only the title and(or) image.',
					'choices' => array(
						'excerpt' => array(
							'url'   => $uri . 'excerpt.svg',
							'label' => __( 'Excerpt', 'arch' ),
						),
						'content' => array(
							'url'   => $uri . 'content.svg',
							'label' => __( 'Content', 'arch' ),
						),
						'none' => array(
							'url'   => $uri . 'none.svg',
							'label' => __( 'None', 'arch' ),
						),
					),
				)
			);

			if ( current_user_can( 'manage_options' ) ) {
				$manager->register_control(
					'arch_svg',
					array(
						'type'        => 'textarea',
						'section'     => 'arch_element_fields',
						'attr'        => array( 'class' => 'bb-codeblock' ),
						'label'       => 'SVG Icon',
						'description' => 'Paste svg markup.'
					)
				);
				$manager->register_setting(
					'arch_svg',
					array( 'sanitize_callback' => 'esc_html' )
				);
			}

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


			if ( 'arch' === $post_type ) {

				$manager->register_control(
					'arch_primary_color',
					array(
					'type'        => 'color',
					'section'     => 'arch_modifier_fields',
					'label'       => 'Background Color',
					'options' => array( 'palettes' => array( "#{$arch_primary_c->lighten( 10 )}", "#{$arch_primary_c->getHex()}", "#{$arch_primary_c->darken( 10 )}", "#{$arch_secondary_c->lighten( 10 )}", "#{$arch_secondary_c->getHex()}", "#{$arch_secondary_c->darken( 10 )}" ) ),
					)
				);
				$manager->register_setting(
					'arch_primary_color',
					array( 'sanitize_callback' => 'sanitize_hex_color_no_hash', 'default' => $arch_primary_default )
				);

			} else {

				$manager->register_control(
					'arch_bg_color',
					array(
						'type'        => 'palette',
						'section'     => 'arch_modifier_fields',
						'label'       => 'Background Color',
						'description' => 'The default colors can be designated from your Landing Page.',
						'choices'     => array(
							'u-bg-1' => array(
								'label' => __( 'Primary', 'arch' ),
								'colors' => array( $arch_primary_c->getHex() ),
							),
							'u-bg-1-light' => array(
								'label' => __( 'Primary Light', 'arch' ),
								'colors' => array( $arch_primary_c->lighten( 10 ) ),
							),
							'u-bg-1-dark' => array(
								'label' => __( 'Primary Dark', 'arch' ),
								'colors' => array( $arch_primary_c->darken( 10 ) ),
							),
							'u-bg-white' => array(
								'label' => __( 'White (default)', 'arch' ),
								'colors' => array( '#ffffff' ),
							),
							'u-bg-2' => array(
								'label' => __( 'Secondary', 'arch' ),
								'colors' => array( $arch_secondary_c->getHex() ),
							),
							'u-bg-2-light' => array(
								'label' => __( 'Secondary Light', 'arch' ),
								'colors' => array( $arch_secondary_c->lighten( 10 ) ),
							),
							'u-bg-2-dark' => array(
								'label' => __( 'Secondary Dark', 'arch' ),
								'colors' => array( $arch_secondary_c->darken( 10 ) ),
							),
							'u-bg-transparent' => array(
								'label' => __( 'Transparent', 'arch' ),
								'colors' => array( '#ddd','#f5f5f5','#ddd','#f5f5f5','#ddd','#f5f5f5' ),
							),
						),
					)
				);

			} //endif

			$manager->register_control(
				'arch_height',
				array(
					'type'        => 'radio-image',
					'section'     => 'arch_modifier_fields',
					'label'       => 'Equal Height',
					'description' => 'Should this component stretch to the height of others in the row, regardless of content size?',
					'choices' => array(
						'stretch' => array(
							'url'   => $uri . 'equal-height.svg',
							'label' => __( 'Stretch (default)', 'arch' ),
						),
						'independent' => array(
							'url'   => $uri . 'not-equal.svg',
							'label' => __( 'Independent Height', 'arch' ),
						),
					),
				)
			);

			/* === Register Settings === */

			$manager->register_setting(
				'arch_component',
				array( 'sanitize_callback' => 'sanitize_key', 'default' => 'card' )
			);

			$manager->register_setting(
				'arch_title',
				array( 'sanitize_callback' => 'sanitize_key', 'default' => 'link-title' )
			);

			$manager->register_setting(
				'arch_excerpt',
				array( 'sanitize_callback' => 'sanitize_key', 'default' => 'excerpt' )
			);

			$manager->register_setting(
				'arch_width',
				array( 'sanitize_callback' => 'sanitize_key' )
			);

			$manager->register_setting(
				'arch_bg_color',
				array( 'sanitize_callback' => 'sanitize_key', 'default' => 'u-bg-white' )
			);

			$manager->register_setting(
				'arch_height',
				array( 'sanitize_callback' => 'sanitize_key', 'default' => 'stretch' )
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
