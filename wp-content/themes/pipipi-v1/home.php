<?php
/**
 * Home
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pipipi-v1
 */

get_header();
?>

	<main id="primary" class="site-main">

    <div class="horizontal-scroll-wrapper">

		  <?php
		  while ( have_posts() ) :
		  	the_post();
  
		  	get_template_part( 'template-parts/content', 'mix-cover' );
  
		  endwhile; // End of the loop.
		  ?>

    </div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
