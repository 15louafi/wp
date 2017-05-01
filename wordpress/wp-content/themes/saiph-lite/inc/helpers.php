<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Helper functions and classes with static methods for usage in theme
 */


/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function fw_theme_get_featured_posts() {
	/**
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'fw_theme_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function fw_theme_has_featured_posts() {
	return ! is_paged() && (bool) fw_theme_get_featured_posts();
}

if ( ! function_exists( 'fw_theme_the_attached_image' ) ) : /**
 * Print the attached image with a link to the next attached image.
 */ {
	function fw_theme_the_attached_image() {
		$post = get_post();
		/**
		 * Filter the default attachment size.
		 *
		 * @param array $dimensions {
		 *                          An array of height and width dimensions.
		 *
		 * @type int    $height     Height of the image in pixels. Default 810.
		 * @type int    $width      Width of the image in pixels. Default 810.
		 * }
		 */
		$attachment_size     = apply_filters( 'fw_theme_attachment_size', array( 810, 810 ) );
		$next_attachment_url = wp_get_attachment_url();

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			                             'post_parent'    => $post->post_parent,
			                             'fields'         => 'ids',
			                             'numberposts'    => - 1,
			                             'post_status'    => 'inherit',
			                             'post_type'      => 'attachment',
			                             'post_mime_type' => 'image',
			                             'order'          => 'ASC',
			                             'orderby'        => 'menu_order ID',
		                             ) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id ) {
				$next_attachment_url = get_attachment_link( $next_id );
			} // or get the URL of the first image attachment.
			else {
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
		}

		printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		        esc_url( $next_attachment_url ),
		        wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
}
endif;

if ( ! function_exists( 'fw_theme_list_authors' ) ) : /**
 * Print a list of all site contributors who published at least one post.
 */ {
	function fw_theme_list_authors() {
		$contributor_ids = get_users( array(
			                              'fields'  => 'ID',
			                              'orderby' => 'post_count',
			                              'order'   => 'DESC',
			                              'who'     => 'authors',
		                              ) );

		foreach ( $contributor_ids as $contributor_id ) :
			$post_count = count_user_posts( $contributor_id );

			// Move on if user has not published a post (yet).
			if ( ! $post_count ) {
				continue;
			}
			?>

			<div class="contributor">
				<div class="contributor-info">
					<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
					<div class="contributor-summary">
						<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>

						<p class="contributor-bio">
							<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
						</p>
						<a class="button contributor-posts-link"
						   href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
							<?php printf( _n( '%d Article', '%d Articles', $post_count, 'saiph-lite' ), $post_count ); ?>
						</a>
					</div>
					<!-- .contributor-summary -->
				</div>
				<!-- .contributor-info -->
			</div><!-- .contributor -->

			<?php
		endforeach;
	}
}
endif;

/**
 * Custom template tags
 */
{
	if ( ! function_exists( 'fw_theme_paging_nav' ) ) : /**
	 * Display navigation to next/previous set of posts when applicable.
	 */ {
		function fw_theme_paging_nav( $wp_query = NULL ) {

			if ( ! $wp_query ) {
				$wp_query = $GLOBALS['wp_query'];
			}

			// Don't print empty markup if there's only one page.

			if ( $wp_query->max_num_pages < 2 ) {
				return;
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
			                                                                        'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
			                                                                              'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
				                         'base'      => $pagenum_link,
				                         'format'    => $format,
				                         'total'     => $wp_query->max_num_pages,
				                         'current'   => $paged,
				                         'mid_size'  => 1,
				                         'add_args'  => array_map( 'urlencode', $query_args ),
				                         'prev_text' => __( '&larr; Previous', 'saiph-lite' ),
				                         'next_text' => __( 'Next &rarr;', 'saiph-lite' ),
			                         ) );

			if ( $links ) :

				?>
				<nav class="navigation paging-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'saiph-lite' ); ?></h1>

					<div class="pagination loop-pagination">
						<?php echo $links; ?>
					</div>
					<!-- .pagination -->
				</nav><!-- .navigation -->
				<?php
			endif;
		}
	}
	endif;

	if ( ! function_exists( 'fw_theme_post_nav' ) ) : /**
	 * Display navigation to next/previous post when applicable.
	 */ {
		function fw_theme_post_nav() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}

			?>
			<div class="container">
				<nav class="navigation post-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'saiph-lite' ); ?></h1>

					<div class="nav-links">
						<?php
						if ( is_attachment() ) :
							previous_post_link( '%link',
							                    __( '<span class="meta-nav">Published In</span>%title', 'saiph-lite' ) );
						else :
							previous_post_link( '%link',
							                    __( '<span class="meta-nav">Previous Post</span>%title', 'saiph-lite' ) );
							next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'saiph-lite' ) );
						endif;
						?>
					</div>
					<!-- .nav-links -->
				</nav>
				<!-- .navigation -->
			</div>
			<?php
		}
	}
	endif;

	if ( ! function_exists( 'fw_theme_posted_on' ) ) : /**
	 * Print HTML with meta information for the current post-date/time and author.
	 */ {
		function fw_theme_posted_on() {
			if ( is_sticky() && is_home() && ! is_paged() ) {
				echo '<span class="featured-post">' . __( 'Sticky', 'saiph-lite' ) . '</span>';
			}

			// Set up and print post meta information.
			printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
			        esc_url( get_permalink() ),
			        esc_attr( get_the_date( 'c' ) ),
			        esc_html( get_the_date() ),
			        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			        get_the_author()
			);
		}
	}
	endif;

	/**
	 * Find out if blog has more than one category.
	 *
	 * @return boolean true if blog has more than 1 category
	 */
	function saiph_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'saiph_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				                                     'hide_empty' => 1,
			                                     ) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'saiph_categories', $all_the_cool_cats );
		}

		if ( 1 !== (int) $all_the_cool_cats ) {
			// This blog has more than 1 category so fw_theme_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so fw_theme_categorized_blog should return false
			return false;
		}
	}

	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index
	 * views, or a div element when on single views.
	 */
	function fw_theme_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$current_position = false;
		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {
			$current_position = fw_ext_sidebars_get_current_position();
		}


		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php
				if ( ( in_array( $current_position,
				                 array( 'full', 'left' ) ) || is_page_template( 'page-templates/full-width.php' )
				       || empty( $current_position )
				)
				) {
					the_post_thumbnail( 'fw-theme-full-width' );
				} else {
					the_post_thumbnail();
				}
				?>
			</div>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				if ( ( in_array( $current_position,
				                 array( 'full', 'left' ) ) || is_page_template( 'page-templates/full-width.php' ) )
				     || empty( $current_position )
				) {
					the_post_thumbnail( 'fw-theme-full-width' );
				} else {
					the_post_thumbnail();
				}
				?>
			</a>

		<?php endif; // End is_singular()
	}
}
/**
 * Custom functions to retrieve data
 */
function saiph_numeric_posts_nav( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<ul class="tpl-pager">';
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( 1 ) .
			     "'><i class='fa fa-angle-double-left'></i></a></li>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $paged - 1 ) .
			     "'><i class='fa fa-long-arrow-left'></i></a></li>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<li class=\"active\">" . $i .
				                        "</li>" : "<li><a href='" . get_pagenum_link( $i ) .
				                                  "' class=\"inactive\">" . $i .
				                                  "</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<li><a href=\"" . get_pagenum_link( $paged + 1 ) .
			     "\"><i class='fa fa-long-arrow-right'></i></a></li>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $pages ) .
			     "'><i class='fa fa-angle-double-right'></i></a></li>";
		}
		echo "</ul>\n";

	}
}

/**
 * Recurrsive in array function (for multi-dimensional arrays)
 *
 * @param            $needle
 * @param            $haystack
 * @param bool|false $strict
 *
 * @return bool
 */
function saiph_in_array_r( $needle, $haystack, $strict = false ) {
	foreach ( $haystack as $item ) {
		if ( ( $strict ? $item === $needle : $item == $needle ) || ( is_array( $item ) && saiph_in_array_r( $needle, $item, $strict ) ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Returns the SRC of a post image
 *
 * @param $post_id
 * @param $image_size
 *
 * @return SimpleXMLElement[]
 */
function saiph_get_image_src( $post_id, $image_size ) {
	$the_image = simplexml_load_string( get_the_post_thumbnail( $post_id, $image_size ) );

	return $the_image->attributes()->src;
}

/**
 * Returns a string with escaped HTML attributes
 *
 * @param $obj
 *
 * @return bool|string
 */
function saiph_create_prop_array( $obj ) {

	foreach ( $obj as $property => $value ) {
		if ( strlen( $value ) ) {
			$style[] = $property . ':' . esc_attr( $value ) . ';';
		}
	}

	if ( $obj ) {
		return implode( ' ', $obj );
	}

	return false;
}

/**
 * Prints the custom head content (custom CSS or Javascript)
 *
 * @param $data
 */
function saiph_add_custom_head( $data ) {
	$data  = array_filter( $data );
	$types = array(
		'CSS' => 'style',
		'JS'  => 'script'
	);
	if ( (bool) $data ) {
		foreach ( $data as $type => $script ) {
			echo '<' . $types[ $type ] . '>' . "\n" .
			     $script . "\n" .
			     '</' . $types[ $type ] . '>' . "\n";
		}
	}

	return;
}

/**
 * Function to return time passed in the Twitter Carousel
 *
 * @param $time
 *
 * @return string
 */
function saiph_human_timing( $time ) {
	static $translations = NULL;
	if ( $translations === NULL ) {
		$translations = array(
			'year'    => __( 'year', 'saiph-lite' ),
			'years'   => __( 'years', 'saiph-lite' ),
			'month'   => __( 'month', 'saiph-lite' ),
			'months'  => __( 'months', 'saiph-lite' ),
			'week'    => __( 'week', 'saiph-lite' ),
			'weeks'   => __( 'weeks', 'saiph-lite' ),
			'day'     => __( 'day', 'saiph-lite' ),
			'days'    => __( 'days', 'saiph-lite' ),
			'hour'    => __( 'hour', 'saiph-lite' ),
			'hours'   => __( 'hours', 'saiph-lite' ),
			'minute'  => __( 'minute', 'saiph-lite' ),
			'minutes' => __( 'minutes', 'saiph-lite' ),
			'second'  => __( 'second', 'saiph-lite' ),
			'seconds' => __( 'seconds', 'saiph-lite' ),
		);
	}
	$time = time() - $time; // to get the time since that moment

	$tokens = array(
		31536000 => 'year',
		2592000  => 'month',
		604800   => 'week',
		86400    => 'day',
		3600     => 'hour',
		60       => 'minute',
		1        => 'second'
	);
	foreach ( $tokens as $unit => $translation_key ) {
		if ( $time < $unit ) {
			continue;
		}
		$number_of_units = floor( $time / $unit );

		return $number_of_units . ' ' . $translations[ $translation_key . ( ( $number_of_units > 1 ) ? 's' : '' ) ];
	}
}

function saiph_sanitize_multi( $obj ) {
	$obj = explode( ',', $obj );
	foreach ( $obj as $obj_in => $id ) {
		$obj[ $obj_in ] = (int) filter_var( $id, FILTER_SANITIZE_NUMBER_INT );
	}

	return $obj;
}


/**
 * This will generate the header for default pages such as
 * index.php, archive.php, tags.php etc
 *
 * @return array
 */
function saiph_create_header_gen($img = null) {
	
	$headerObject = array(
		'class' => 'tpl-header-wrapper primary'
	);
	
	$header_image = get_header_image();
	if ( $img !== null ) {
		$header_image = $img;
	}

	if ( ! empty ( $header_image ) ) {
		$headerObject['style'] = 'background-image:url("' . esc_url( $header_image ) . '")';
	}

	return $headerObject;

}

/**
 * Function to check if the height of the image is bigger than the width so
 * we can include a different kind of post format
 *
 * @param $post_thumbnail_id
 *
 * @return bool
 */
function saiph_vertical_image_check( $post_thumbnail_id ) {
	$image_data = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
	//Get the image width and height from the data provided by wp_get_attachment_image_src()
	$width  = $image_data[1];
	$height = $image_data[2];

	if ( $height > $width ) {
		return true;
	}

	return false;
}

/**
 * Generate html tag
 *
 * @param string $tag Tag name
 * @param array $attr Tag attributes
 * @param bool|string $end Append closing tag. Also accepts body content
 * @return string The tag's html
 */
function saiph_html_tag($tag, $attr = array(), $end = false) {
	$html = '<'. $tag .' ' . saiph_attr_to_html($attr);
	if ($end === true) {
		# <script></script>
		$html .= '></'. $tag .'>';
	} else if ($end === false) {
		# <br/>
		$html .= '/>';
	} else {
		# <div>content</div>
		$html .= '>'. $end .'</'. $tag .'>';
	}
	return $html;
}

/**
 * Generate attributes string for html tag
 * @param array $attr_array array('href' => '/', 'title' => 'Test')
 * @return string 'href="/" title="Test"'
 */
function saiph_attr_to_html(array $attr_array) {
	$html_attr = '';
	foreach ($attr_array as $attr_name => $attr_val) {
		if ($attr_val === false) {
			continue;
		}
		$html_attr .= $attr_name .'="'. saiph_htmlspecialchars($attr_val) .'" ';
	}
	return $html_attr;
}

/**
 * Use this id do not want to enter every time same last two parameters
 * Info: Cannot use default parameters because in php 5.2 encoding is not UTF-8 by default
 *
 * @param string $string
 * @return string
 */
function saiph_htmlspecialchars($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}