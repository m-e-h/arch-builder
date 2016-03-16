<?php
/**
 * Plugin Name: Arch Builder
 * Plugin URI: https://github.com/m-e-h/arch-builder
 * Description: Flexible WP archive pages.
 * Version: 0.1.0
 * Author: Marty Helmick
 * License:     GPLv2
 * Text Domain: arch-builder
 * Domain Path: /languages
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
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );

		// Plugin directory URIs.
		$this->css_uri = trailingslashit( $this->dir_uri . 'assets/css' );
		$this->js_uri  = trailingslashit( $this->dir_uri . 'assets/js'  );
	}

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		if ( file_exists( $this->dir_path . 'vendor/CMB2/init.php' ) )
			require_once( $this->dir_path . 'vendor/CMB2/init.php' );

		require_once( $this->dir_path . 'includes/post-types.php' );
		require_once( $this->dir_path . 'includes/taxonomies.php' );
		//require_once( $this->dir_path . 'includes/options.php' );
		require_once( $this->dir_path . 'includes/metaboxes.php' );
		require_once( $this->dir_path . 'includes/arch-width.php' );
		require_once( $this->dir_path . 'includes/arch-edit-boxes.php' );
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
		//register_activation_hook( __FILE__, array( $this, 'activation' ) );

		// Internationalize the text strings used.
		//add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
	}

	/**
	 * Register scripts and styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_register_scripts() {

		//wp_register_style( 'arch-builder-style', $this->dir_uri . 'css/arch-style.css' );
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

	// public function activation() {
	// 	// Make sure any rewrite functionality has been loaded.
	// 	flush_rewrite_rules();
	// }

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
