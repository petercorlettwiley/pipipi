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
$soundcloud_link = get_field('soundcloud_mix_link');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php

		echo $artist_link;
		echo $release_date;
		echo $soundcloud_link;

		?>
	</header><!-- .entry-header -->

	<?php pipipi_v1_post_thumbnail(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
