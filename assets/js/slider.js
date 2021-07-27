/**
 * Flexslider Setup
 *
 * Adds the Flexslider Plugin for the Featured Post Slideshow
 *
 * @package Kathenas
 */

jQuery( document ).ready(function($) {

	/* Add flexslider to #post-slider div */
	$( "#post-slider" ).flexslider({
		animation: kathenas_slider_params.animation,
		slideshowSpeed: kathenas_slider_params.speed,
		namespace: "zeeflex-",
		selector: ".zeeslides > li",
		smoothHeight: false,
		pauseOnHover: true,
		controlsContainer: ".post-slider-controls"
	});

});
