<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pipipi-v1
 */

get_header();
?>

	<nav id="archive-navigation" class="archive-navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'archive-menu',
				'menu_id'        => 'archive-menu',
			)
		);
		?>
	</nav><!-- #site-navigation -->

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<span class="screen-reader-text"><h1>Mixes</h1></span>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'mix-index' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
