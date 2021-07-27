<?php
/**
 * Template Name: Magazine Homepage
 *
 * Description: A custom page template for displaying the magazine homepage widgets.
 *
 * @package Kathenas
 */

get_header();

// Get Theme Options from Database.
$theme_options = kathenas_theme_options();

// Display Slider.
if ( true === $theme_options['slider_magazine'] && ! kathenas_is_amp() ) :

	get_template_part( 'template-parts/post-slider' );

endif;
?>

	<section id="primary" class="content-magazine content-single content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Display Magazine Homepage Widgets.
		kathenas_magazine_widgets();
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
