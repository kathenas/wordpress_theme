<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package Kathenas
 */

/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function kathenas_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'kathenas_section_general', array(
		'title'    => esc_html__( 'General Settings', 'kathenas' ),
		'priority' => 10,
		'panel'    => 'kathenas_options_panel',
	) );

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'kathenas_theme_options[layout]', array(
		'default'           => 'right-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_select',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'kathenas' ),
		'section'  => 'kathenas_section_general',
		'settings' => 'kathenas_theme_options[layout]',
		'type'     => 'radio',
		'priority' => 10,
		'choices'  => array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'kathenas' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'kathenas' ),
		),
	) );
}
add_action( 'customize_register', 'kathenas_customize_register_general_settings' );
