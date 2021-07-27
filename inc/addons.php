<?php
/**
 * Add Support for Theme Addons
 *
 * @package Kathenas
 */

/**
 * Register support for Jetpack and theme addons
 */
function kathenas_theme_addons_setup() {

	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'post-wrapper',
		'footer_widgets' => 'footer',
		'wrapper'        => false,
		'render'         => 'kathenas_infinite_scroll_render',
		'posts_per_page' => 6,
	) );

	// Add theme support for AMP.
	add_theme_support( 'amp' );

}
add_action( 'after_setup_theme', 'kathenas_theme_addons_setup' );


/**
 * Custom render function for Infinite Scroll.
 */
function kathenas_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
}


/**
 * Checks if AMP page is rendered.
 */
function kathenas_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}


/**
 * Adds amp support for menu toggle.
 */
function kathenas_amp_menu_toggle() {
	if ( kathenas_is_amp() ) {
		echo "[aria-expanded]=\"primaryMenuExpanded? 'true' : 'false'\" ";
		echo 'on="tap:AMP.setState({primaryMenuExpanded: !primaryMenuExpanded})"';
	}
}


/**
 * Adds amp support for mobile dropdown navigation menu.
 */
function kathenas_amp_menu_is_toggled() {
	if ( kathenas_is_amp() ) {
		echo "[class]=\"'main-navigation' + ( primaryMenuExpanded ? ' toggled-on' : '' )\"";
	}
}


/**
 * Filter the HTML output of a nav menu item to add the AMP dropdown button to reveal the sub-menu.
 * This is only used for AMP since in JS it is added via initNavigation() in navigation.js.
 * Source: https://amp-wp.org/documentation/playbooks/navigation-sub-menu-buttons/
 *
 * @param string $item_output   Nav menu item HTML.
 * @param object $item          Nav menu item.
 * @return string Modified nav menu item HTML.
 */
function kathenas_amp_menu_dropdown_toggles( $item_output, $item, $depth, $args ) {

	// Return early if AMP is not used.
	if ( ! kathenas_is_amp() ) {
		return $item_output;
	}

	// Check if primary or secondary navigation is filtered.
	if ( 'primary' !== $args->theme_location && 'secondary' !== $args->theme_location ) {
		return $item_output;
	}

	// Skip when the item has no sub-menu.
	if ( ! in_array( 'menu-item-has-children', $item->classes, true ) ) {
		return $item_output;
	}

	// Obtain the initial expanded state.
	$expanded = in_array( 'current-menu-ancestor', $item->classes, true );

	// Generate a unique state ID.
	static $nav_menu_item_number = 0;
	$nav_menu_item_number++;
	$expanded_state_id = 'navMenuItemExpanded' . $nav_menu_item_number;

	// Create new state for managing storing the whether the sub-menu is expanded.
	$item_output .= sprintf(
		'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
		esc_attr( $expanded_state_id ),
		wp_json_encode( $expanded )
	);

	/*
	* Create the toggle button which mutates the state and which has class and
	* aria-expanded attributes which react to the state changes.
	*/
	$dropdown_button  = '<button';
	$dropdown_class   = 'dropdown-toggle';
	$toggled_class    = 'toggled-on';
	$dropdown_button .= sprintf(
		' class="%s" [class]="%s"',
		esc_attr( $dropdown_class . ( $expanded ? " $toggled_class" : '' ) ),
		esc_attr( sprintf( "%s + ( $expanded_state_id ? %s : '' )", wp_json_encode( $dropdown_class ), wp_json_encode( " $toggled_class" ) ) )
	);
	$dropdown_button .= sprintf(
		' aria-expanded="%s" [aria-expanded]="%s"',
		esc_attr( wp_json_encode( $expanded ) ),
		esc_attr( "$expanded_state_id ? 'true' : 'false'" )
	);
	$dropdown_button .= sprintf(
		' on="%s"',
		esc_attr( "tap:AMP.setState( { $expanded_state_id: ! $expanded_state_id } )" )
	);
	$dropdown_button .= '>';

	// Add SVG icon.
	$dropdown_button .= $expanded ? kathenas_get_svg( 'collapse' ) : kathenas_get_svg( 'expand' );

	// Let the screen reader text in the button also update based on the expanded state.
	$dropdown_button .= sprintf(
		'<span class="screen-reader-text" [text]="%s">%s</span>',
		esc_attr( sprintf( "$expanded_state_id ? %s : %s", wp_json_encode( esc_html__( 'Collapse child menu', 'kathenas' ) ), wp_json_encode( esc_html__( 'Expand child menu', 'kathenas' ) ) ) ),
		esc_html( $expanded ? esc_html__( 'Collapse child menu', 'kathenas' ) : esc_html__( 'Expand child menu', 'kathenas' ) )
	);

	$dropdown_button .= '</button>';

	$item_output .= $dropdown_button;
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'kathenas_amp_menu_dropdown_toggles', 10, 4 );
