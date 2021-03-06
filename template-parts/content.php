<?php
/**
 * The template for displaying articles in the loop with post excerpts
 *
 * @package Kathenas
 */

?>

<div class="post-column clearfix">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php kathenas_post_image_archives(); ?>

		<header class="entry-header">

			<?php kathenas_entry_meta(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content entry-excerpt clearfix">
			<?php the_excerpt(); ?>
			<?php kathenas_more_link(); ?>
		</div><!-- .entry-content -->

	</article>

</div>
