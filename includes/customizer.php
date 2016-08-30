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
		'default'              => false,
		'transport'            => 'refresh',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_validate_boolean'
	) );
	// Control: Checkbox.
	$wp_customize->add_control( 'arch_front_page', array(
		'label'       => __( 'Arch Front Page', 'arch' ),
		'description' => __( 'Populate front-page with Arch Posts', 'arch' ),
		'section'     => 'static_front_page',
		'type'        => 'checkbox',
	) );

}
