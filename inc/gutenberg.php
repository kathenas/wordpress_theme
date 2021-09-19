<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Kathenas
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function kathenas_gutenberg_support() {

	// Define block color palette.
	$color_palette = apply_filters( 'kathenas_color_palette', array(
		'primary_color'    => '#996600',
		'secondary_color'  => '#008899',
		'tertiary_color'   => '#005566',
		'accent_color'     => '#cc3833',
		'highlight_color'  => '#009912',
		'light_gray_color' => '#f0f0f0',
		'gray_color'       => '#999999',
		'black_color'  => '#000000',
	) );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'kathenas_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'kathenas' ),
			'slug'  => 'primary',
			'color' => esc_html( $color_palette['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'kathenas' ),
			'slug'  => 'secondary',
			'color' => esc_html( $color_palette['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Tertiary', 'block color', 'kathenas' ),
			'slug'  => 'tertiary',
			'color' => esc_html( $color_palette['tertiary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'kathenas' ),
			'slug'  => 'accent',
			'color' => esc_html( $color_palette['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'kathenas' ),
			'slug'  => 'highlight',
			'color' => esc_html( $color_palette['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'kathenas' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'kathenas' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $color_palette['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'kathenas' ),
			'slug'  => 'gray',
			'color' => esc_html( $color_palette['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'kathenas' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $color_palette['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'kathenas' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Check if block style functions are available.
	if ( function_exists( 'register_block_style' ) ) {

		// Register Widget Title Block style.
		register_block_style( 'core/heading', array(
			'name'         => 'widget-title',
			'label'        => esc_html__( 'Widget Title', 'maxwell' ),
			'style_handle' => 'maxwell-stylesheet',
		) );
	}
}
add_action( 'after_setup_theme', 'kathenas_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function kathenas_block_editor_assets() {

	// Enqueue Editor Styling.
	wp_enqueue_style( 'kathenas-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), '20210306', 'all' );

	// Enqueue Page Template Switcher Editor plugin.
	#wp_enqueue_script( 'kathenas-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), '20210306' );
}
add_action( 'enqueue_block_editor_assets', 'kathenas_block_editor_assets' );


/**
 * Add body classes in Gutenberg Editor.
 */
function kathenas_block_editor_body_classes( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' kathenas-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' kathenas-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' kathenas-fullwidth-page-layout kathenas-page-title-hidden ';
	}

	return $classes;
}
#add_filter( 'admin_body_class', 'kathenas_block_editor_body_classes' );
