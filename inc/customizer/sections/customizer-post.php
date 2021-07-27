<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Kathenas
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function kathenas_customize_register_post_settings( $wp_customize ) {

	// Add Section for Post Settings.
	$wp_customize->add_section( 'kathenas_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'kathenas' ),
		'priority' => 30,
		'panel'    => 'kathenas_options_panel',
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new Kathenas_Customize_Header_Control(
		$wp_customize, 'kathenas_theme_options[postmeta_headline]', array(
			'label'    => esc_html__( 'Post Details', 'kathenas' ),
			'section'  => 'kathenas_section_post',
			'settings' => array(),
			'priority' => 20,
		)
	) );

	// Add Meta Date setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[meta_date]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display date', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 30,
	) );

	// Add Meta Category setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[meta_category]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display categories', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );

	// Add Single Posts Headline.
	$wp_customize->add_control( new Kathenas_Customize_Header_Control(
		$wp_customize, 'kathenas_theme_options[single_post_headline]', array(
			'label'    => esc_html__( 'Single Posts', 'kathenas' ),
			'section'  => 'kathenas_section_post',
			'settings' => array(),
			'priority' => 50,
		)
	) );

	// Add Meta Author setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[meta_author]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display author', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 60,
	) );

	// Add Meta Tags setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[meta_tags]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display tags', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );

	// Add Post Navigation setting and control.
	$wp_customize->add_setting( 'kathenas_theme_options[post_navigation]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 80,
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Kathenas_Customize_Header_Control(
		$wp_customize, 'kathenas_theme_options[featured_images]', array(
			'label'    => esc_html__( 'Featured Images', 'kathenas' ),
			'section'  => 'kathenas_section_post',
			'settings' => array(),
			'priority' => 90,
		)
	) );

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting( 'kathenas_theme_options[post_image_archives]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[post_image_archives]', array(
		'label'    => esc_html__( 'Display images on blog and archives', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 100,
	) );

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting( 'kathenas_theme_options[post_image_single]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'kathenas_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'kathenas_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display image on single posts', 'kathenas' ),
		'section'  => 'kathenas_section_post',
		'settings' => 'kathenas_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 110,
	) );

	// Add Partial for Excerpt Length and Post Images on blog and archives.
	$wp_customize->selective_refresh->add_partial( 'kathenas_blog_layout_partial', array(
		'selector'         => '.site-main .post-wrapper',
		'settings'         => array(
			'kathenas_theme_options[excerpt_length]',
			'kathenas_theme_options[post_image_archives]',
		),
		'render_callback'  => 'kathenas_customize_partial_blog_layout',
		'fallback_refresh' => false,
	) );
}
add_action( 'customize_register', 'kathenas_customize_register_post_settings' );

/**
 * Render the blog layout for the selective refresh partial.
 */
function kathenas_customize_partial_blog_layout() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
}
