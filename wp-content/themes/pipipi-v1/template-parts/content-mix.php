<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pipipi-v1
 */

$release_date = pipipi_get_release_date();
$artist_link = pipipi_get_artist_link();
$sc_player = pipipi_get_sc_player();
$artist_name = pipipi_get_artist_name();
$artist_location = pipipi_get_artist_location();
$artist_info = pipipi_get_artist_info();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( is_singular() ) : ?>

			<h1><?php echo $artist_name; ?></h1>
			<h2><?php echo get_the_title(); ?></h2>

		<?php else : ?>

			<h2><?php echo $artist_name; ?></h2>
			<h3><?php echo get_the_title(); ?></h3>

		<?php endif;

		// pipipi_v1_post_thumbnail();
		//echo $release_date;
		//echo $sc_player;

		?>
	</header><!-- .entry-header -->

	<?php // pipipi_v1_post_thumbnail(); ?>

	<div class="entry-content">

		<div class="columns">

			<div class="column-left">

				<?php pipipi_v1_post_thumbnail('full'); ?>

				<div class="mix-meta">

					<?php echo $sc_player; ?>
		
					<p><strong>Released:</strong> <?php echo $release_date; ?></p>
		
					<p>@<?php echo $artist_link; ?></p>
		
					<p><?php echo $artist_location; ?></p>
	
					<?php if ($artist_info) : ?>
	
						<p><?php echo $artist_info; ?></p>
	
					<?php endif; ?>

				</div>
	
			</div>
	
			<div class="column-right">

		<?php

		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pipipi-v1' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		$next_post_id = get_next_post()->ID;
		$previous_post_id = get_previous_post()->ID;

		the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'pipipi-v1' ) . '</span> <span class="nav-title">' . pipipi_get_artist_name($previous_post_id) . ' — %title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'pipipi-v1' ) . '</span> <span class="nav-title">' . pipipi_get_artist_name($next_post_id) . ' — %title</span>',
				)
			);
		?>

			</div>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
