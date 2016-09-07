<?php
/*
Plugin Name: Arch Builder
Plugin URI: https://github.com/m-e-h/arch-builder
Description: Flexible WP archive pages.
Version: 0.7.0
Author: Marty Helmick
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: arch-builder
Domain Path: /languages
GitHub Plugin URI: https://github.com/m-e-h/arch-builder
*/

	/**
	 * Singleton class that sets up and initializes the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
final class Arch_Builder_Plugin {

	/**
	 * Directory path to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';

	/**
	 * Directory URI to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';


	/**
	 * Plugin CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';

	/**
	 * Plugin JS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';

	/**
	 * Plugin Image directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $img_uri = '';

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
			$instance->setup();
			$instance->includes();
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

	/**
	 * Initial plugin setup.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {

		// Main plugin directory path and URI.
		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url( __FILE__ ) );

		// Plugin assets URIs.
		$this->css_uri = trailingslashit( $this->dir_uri . 'assets/css' );
		$this->js_uri  = trailingslashit( $this->dir_uri . 'assets/js' );
		$this->img_uri  = trailingslashit( $this->dir_uri . 'assets/images' );
	}

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		require_once $this->dir_path . 'includes/post-types.php';
		require_once $this->dir_path . 'includes/template-tags.php';
		require_once $this->dir_path . 'lib/butterbean/butterbean.php';
		require_once $this->dir_path . 'includes/arch-edit-boxes.php';
		require_once $this->dir_path . 'includes/customizer.php';
		require_once $this->dir_path . 'includes/arch-injections.php';
		require_once $this->dir_path . 'includes/metaboxes.php';
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );

		/* Add front end styles. */
		add_action( 'wp_enqueue_scripts', array( $this, 'arch_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		// Internationalize the text strings used.
		// add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
	}

	/**
	 * Loads the front end scripts and styles.  No styles are loaded if the theme supports the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function arch_scripts() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$arch_component = get_post_meta( get_the_ID(), 'arch_component', true );

		/* Register the plugin script. */
		wp_register_script( 'arch-tabs', trailingslashit( $this->js_uri ) . 'arch-tabs.js', false, false, true );
		wp_register_script( 'arch-toggle', trailingslashit( $this->js_uri ) . 'houdini.js', false, false, true );
		wp_register_script( 'lory', trailingslashit( $this->js_uri ) . 'lory.js', false, false, true );
		wp_add_inline_script( 'lory', $this->get_lory_script() );

		/* Load the plugin stylesheet if no theme support. */
		if ( ! current_theme_supports( 'arch-builder' ) ) {
			wp_enqueue_style( 'arch', trailingslashit( $this->css_uri ) . "arch{$suffix}.css" ); }
	}

	public function get_lory_script() {

	return "
	var domReady = function(callback) {
		document.readyState === 'interactive' ||
		document.readyState === 'complete' ? callback() : document.addEventListener('DOMContentLoaded', callback);
	};


	domReady(function () {
		var slides = document.querySelector('.arch-slides');

		lory(slides, {
			infinite: 1,
			enableMouseEvents: true
		});
	});";
	}

	/**
	 * Register scripts and styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {
		$screen = get_current_screen();
		if ( ! in_array( $screen->post_type, arch_post_types(), true ) ) {
			return;
		}
		wp_enqueue_style( 'arch-admin-styles', trailingslashit( $this->css_uri ) . 'admin.css' );
		wp_enqueue_script( 'arch-bulk-quick-edit', trailingslashit( $this->js_uri ) . 'admin.js', array( 'jquery', 'inline-edit-post' ), false, true );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		load_plugin_textdomain( 'arch-builder', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'languages' );
	}

	public function activation() {

		arch_posts_register_post_types();
		
		/* Get the administrator role. */
		$role = get_role( 'administrator' );

		/* If the administrator role exists, add required capabilities for the plugin. */
		if ( !empty( $role ) ) {
			$role->add_cap( 'manage_arch_posts' );
			$role->add_cap( 'create_arch_posts' );
			$role->add_cap( 'edit_arch_posts'   );
		}

		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}
}

/**
 * Gets the instance of the main plugin class.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function arch_builder_plugin() {
	return Arch_Builder_Plugin::get_instance();
}

// Let's do this thang!
arch_builder_plugin();
