<?php
/**
 * Theme Customizer.
 *
 * @package arch-builder
 */

add_action( 'customize_register', 'arch_customize_register', 11 );

/**
 * Customizer Settings
 *
 * @param  array $wp_customize Add controls and settings.
 */
function arch_customize_register( $wp_customize ) {

	// Setting: Checkbox.
	$wp_customize->add_setting( 'arch_front_page', array(
		'type'                 => 'theme_mod',
		'default'              => 'enable',
		'transport'            => 'refresh',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'arch_validate_boolean' // Custom function in customizer-sanitization.php file.
	) );
	// Control: Checkbox.
	$wp_customize->add_control( 'arch_front_page', array(
		'label'       => __( 'Arch Front Page', 'arch' ),
		'description' => __( 'Populate front-page with Arch Posts', 'arch' ),
		'section'     => 'static_front_page',
		'type'        => 'checkbox'
	) );

}


/**
 * Function for validating booleans before saving them as metadata. If the value is
 * `true`, we'll return a `1` to be stored as the meta value.  Else, we return `false`.
 *
 * @since  1.0.0
 * @access public
 * @param  mixed
 * @return bool|int
 */
function arch_validate_boolean( $value ) {
	return wp_validate_boolean( $value ) ? 1 : false;
}
