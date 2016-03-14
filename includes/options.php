<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */

 add_action( 'cmb2_render_multicheck_posttype', 'cmb_render_multicheck_posttype', 10, 5 );

 function cmb_render_multicheck_posttype($field, $escaped_value, $object_id, $object_type, $field_type_object) {
     $cpts = get_post_types();
     unset( $cpts[ 'nav_menu_item' ] );
     unset( $cpts[ 'revision' ] );
     $options = '';
     $i       = 1;
     $values  = (array) $escaped_value;

     if ( $cpts ) {
         foreach ( $cpts as $cpt ) {
             $args = array(
                 'value' => $cpt,
                 'label' => $cpt,
                 'type'  => 'checkbox',
                 'name'  => $field->args['_name'] . '[]',
             );

             if ( in_array( $cpt, $values ) ) {
                 $args[ 'checked' ] = 'checked';
             }
             $options .= $field_type_object->list_input( $args, $i );
             $i++;
         }
     }

     $classes = false === $field->args( 'select_all_button' ) ? 'cmb2-checkbox-list no-select-all cmb2-list' : 'cmb2-checkbox-list cmb2-list';
     echo $field_type_object->radio( array( 'class' => $classes, 'options' => $options ), 'multicheck_posttype' );
 }

class Arch_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'arch_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'arch_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var Arch_Admin
	 **/
	private static $instance = null;

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	private function __construct() {
		// Set our title
		$this->title = __( 'Site Options', 'arch' );
	}

	/**
	 * Returns the running object
	 *
	 * @return Arch_Admin
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new Arch_Admin();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key),
			),
		) );

		// Set our CMB2 fields

		$cmb->add_field( array(
			'name'    => __( 'Select Post Types', 'arch' ),
			'desc'    => __( 'field description (optional)', 'arch' ),
			'id'      => 'arch_cpt_selct',
			'type'    => 'multicheck_posttype',
		) );

	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices($object_id, $updated) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'arch' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get($field) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the Arch_Admin object
 * @since  0.1.0
 * @return Arch_Admin object
 */
function arch_admin() {
	return Arch_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function arch_get_option($key = '') {
	return cmb2_get_option( arch_admin()->key, $key );
}

// Get it started
arch_admin();
