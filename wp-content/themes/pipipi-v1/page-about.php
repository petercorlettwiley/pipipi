<?php
/**
 * Template Name: About Page
 *
 * This is almost the same as page.php. Uses page classes to change page styles
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pipipi-v1
 */

get_header();
?>

  <div id="background"><?php echo pipipi_get_logo(); ?></div>

  <main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
      the_post();

      get_template_part( 'template-parts/content', 'page' );

    endwhile; // End of the loop.
    ?>

  </main><!-- #main -->

<?php
get_footer();
