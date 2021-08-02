<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package Kathenas
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function kathenas_customize_register_blog_settings( $wp_customize ) {

	// Add Section for Blog Settings.
	$wp_customize->add_section( 'kathenas_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'kathenas' ),
		'priority' => 25,
		'panel'    => 'kathenas_options_panel',
	) );

	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[blog_title]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[blog_title]', array(
		'label'    => esc_html__( 'Blog Title', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[blog_title]',
		'type'     => 'text',
		'priority' => 10,
	) );

	$wp_customize->selective_refresh->add_partial( 'kathenas_theme_options[blog_title]', array(
		'selector'         => '.blog-header .blog-title',
		'render_callback'  => 'kathenas_customize_partial_blog_title',
		'fallback_refresh' => false,
	) );

	// Add Blog Description setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[blog_description]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[blog_description]', array(
		'label'    => esc_html__( 'Blog Description', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[blog_description]',
		'type'     => 'textarea',
		'priority' => 20,
	) );

	$wp_customize->selective_refresh->add_partial( 'kathenas_theme_options[blog_description]', array(
		'selector'         => '.blog-header .blog-description',
		'render_callback'  => 'kathenas_customize_partial_blog_description',
		'fallback_refresh' => false,
	) );

	// Add Blog Layout setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[post_layout]', array(
		'default'           => 'one-column',
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'kathenas_sanitize_select',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Blog Layout', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[post_layout]',
		'type'     => 'select',
		'priority' => 30,
		'choices'  => array(
			'one-column'    => esc_html__( 'One Column', 'kathenas' ),
			'two-columns'   => esc_html__( 'Two Columns', 'kathenas' ),
			'three-columns' => esc_html__( 'Three Columns without Sidebar', 'kathenas' ),
		),
	) );

	// Add Excerpt Length setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[excerpt_length]', array(
		'default'           => 20,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[excerpt_length]', array(
		'label'    => esc_html__( 'Excerpt Length', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[excerpt_length]',
		'type'     => 'text',
		'priority' => 40,
	) );

	// Add Setting and Control for Read More Text.
	$wp_customize->add_setting( 'kathenas_theme_options[read_more_text]', array(
		'default'           => esc_html__( 'Continue reading', 'kathenas' ),
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[read_more_text]', array(
		'label'    => esc_html__( 'Read More Text', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[read_more_text]',
		'type'     => 'text',
		'priority' => 50,
	) );

	// Add Magazine Widgets Headline.
	$wp_customize->add_control( new Kathenas_Customize_Header_Control(
		$wp_customize, 'kathenas_theme_options[blog_magazine_widgets_title]', array(
			'label'    => esc_html__( 'Magazine Widgets', 'kathenas' ),
			'section'  => 'kathenas_section_blog',
			'settings' => array(),
			'priority' => 60,
		)
	) );

	// Add Setting and Control for Magazine widgets.
	$wp_customize->add_setting( 'kathenas_theme_options[blog_magazine_widgets]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[blog_magazine_widgets]', array(
		'label'    => esc_html__( 'Display Magazine widgets on blog index', 'kathenas' ),
		'section'  => 'kathenas_section_blog',
		'settings' => 'kathenas_theme_options[blog_magazine_widgets]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );
}
add_action( 'customize_register', 'kathenas_customize_register_blog_settings' );

/**
 * Render the blog title for the selective refresh partial.
 */
function kathenas_customize_partial_blog_title() {
	$theme_options = kathenas_theme_options();
	echo wp_kses_post( $theme_options['blog_title'] );
}

/**
 * Render the blog description for the selective refresh partial.
 */
function kathenas_customize_partial_blog_description() {
	$theme_options = kathenas_theme_options();
	echo wp_kses_post( $theme_options['blog_description'] );
}
