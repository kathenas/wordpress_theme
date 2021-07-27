<?php
/**
 * The template for displaying single posts
 *
 * @package Kathenas
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php kathenas_post_image_single(); ?>

	<header class="entry-header">

		<?php kathenas_entry_meta(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php kathenas_posted_by(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">

		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kathenas' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php kathenas_entry_tags(); ?>
		<?php do_action( 'kathenas_author_bio' ); ?>
		<?php kathenas_post_navigation(); ?>

	</footer><!-- .entry-footer -->

</article>
