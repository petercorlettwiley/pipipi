<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pipipi-v1
 */

$release_date = get_field('release_date');
$artist_link = get_field('artist_link');

$artist_name = pipipi_get_artist_name();
$mix_series = pipipi_get_mix_series();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap">
		<a href="<?php the_permalink(); ?>">

			<div class="mix-art">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>

			<header class="mix-header">
				<?php the_title(); ?>
			</header><!-- .mix-header -->

			<div class="mix-artist">
				<?php echo $artist_name; ?>
			</div>

			<div class="mix-series">
				<?php echo $mix_series; ?>
			</div>

		</a>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
