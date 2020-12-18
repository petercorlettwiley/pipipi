<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pipipi-v1
 */

if ( ! function_exists( 'pipipi_v1_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function pipipi_v1_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'pipipi-v1' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'pipipi_v1_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function pipipi_v1_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'pipipi-v1' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'pipipi_v1_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function pipipi_v1_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'pipipi-v1' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'pipipi-v1' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'pipipi-v1' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'pipipi-v1' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pipipi-v1' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'pipipi-v1' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'pipipi_v1_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function pipipi_v1_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'pipipi_get_artist_name' ) ) :
	/**
	 * Get mix's artist name
	 */
	function pipipi_get_artist_name() {
		if( has_term('', 'artist') ){
		    // do something
			return get_the_terms( get_the_ID(), 'artist' )[0]->name;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_mix_series' ) ) :
	/**
	 * Get mix's series
	 */
	function pipipi_get_mix_series() {
		if( has_term('', 'series') ){
		    // do something
			$term_id = get_the_terms( get_the_ID(), 'series' )[0]->term_id;
			return get_field('series_display_name', 'term_'.$term_id);
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_sc_key' ) ) :
	/**
	 * Get SC link
	 */
	function pipipi_get_sc_key() {

		if( get_field('soundcloud_mix_key') ){
			return get_field('soundcloud_mix_key');
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_artist_link' ) ) :
	/**
	 * Get artist link
	 */
	function pipipi_get_artist_link() {

		if( get_field('artist_link') && get_field('artist_sc_account') ){
			return '<a href="' . get_field('artist_link') . '" target="_blank">' . get_field('artist_sc_account') . '</a>';
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_artist_location' ) ) :
	/**
	 * Get artist location
	 */
	function pipipi_get_artist_location() {

		if( get_field('artist_location') ){
			return get_field('artist_location');
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_artist_info' ) ) :
	/**
	 * Get artist location
	 */
	function pipipi_get_artist_info() {

		if( get_field('artist_info') ){
			return get_field('artist_info');
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_release_date' ) ) :
	/**
	 * Get mix's release date
	 */
	function pipipi_get_release_date() {

		if( get_field('release_date') ){
			return get_field('release_date');
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_floating_logo' ) ) :
	/**
	 * Get the floating logo from customizer options
	 */
	function pipipi_get_floating_logo() {

		//wp_get_attachment_image_src( $attachment_id, $size

		$floating_logo_url = wp_get_attachment_image_src(get_theme_mod('floating_logo'), 'full')[0];
		//print_r($floating_logo_url);

		if( $floating_logo_url ){
			return '<a href="/" class="floating-logo"><img src="' . $floating_logo_url . '" alt="' . 'name' . '"></a>';
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'pipipi_get_sc_player' ) ) :
	/**
	 * Get the sc player for a given mix
	 */
	function pipipi_get_sc_player() {

		$sc_key = pipipi_get_sc_key();

		if( $sc_key ){
			return '<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $sc_key . '&color=%000000&auto_play=false&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>';
		} else {
			return false;
		}
	}
endif;

