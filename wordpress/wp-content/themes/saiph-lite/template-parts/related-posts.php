<?php

/**
 *  These functions shows a number of posts related to the currently displayed post.
 *  Relations are defined by tags: if post tags match, the post will be displayed as related
 */

$tags = wp_get_post_tags( $post->ID );


if ( ! empty( $tags ) && is_array( $tags ) ) {
	$tag_ids = array();
	foreach ( $tags as $tag ) {
		$tag_ids[] = (int) $tag->term_id;
	}
	if ( ! empty( $tag_ids ) ) {
		$posts_array = array(
			'tag__in'             => $tag_ids,
			'post_type'           => get_post_type( $post->ID ),
			'showposts'           => 4,
			'ignore_sticky_posts' => 1,
			'orderby'             => 'rand',
			'post__not_in'        => array( $post->ID )
		);
		$my_query    = get_posts( $posts_array );

		if ( ! empty( $my_query ) ) {
			$count         = 1;
			$output        = '';
			$related_posts = true;
			$output .= '<div class="row related-posts tpl-spacing-tb">';
			$output .= '<h3 class="related-title">' . __( 'You might also like', 'saiph-lite' ) . '</h3>';

			foreach ( $my_query as $related_post ) {
				$related_post->post_title   = wp_trim_words( $related_post->post_title, 6 );
				$related_post->post_content = wp_trim_words( $related_post->post_content, 20 );
				$post_thumbnail_id          = get_post_thumbnail_id( $related_post->ID );
				$post_thumb                 = get_the_post_thumbnail( $related_post->ID, 'post-thumbnail', array( 'title' => esc_attr( get_the_title( $post_thumbnail_id ) ) ) );
				if ( $post_thumb == '' ) {
					$post_thumb = '<img width="85" height="85" src="' . get_stylesheet_directory_uri() . '/images/no-thumb.png" />';
				}
				$link = get_permalink( $related_post->ID );
				$output .= '<div class="col-md-6 col-xs12">';
				$output .= '<div class="related-post">';
				$output .= '<div class="related-thumb"><a href="' . $link . '">' . $post_thumb . '</a></div>';
				$output .= '<div class="related-content"><h4><a href="' . $link . '">' . $related_post->post_title . '</h4></a><p>' . $related_post->post_content . '</p></div>';
				$output .= '</div>';
				$output .= '</div>';
			}

			$output .= '</div>';
			if ( $related_posts ) {
				echo $output;
			}
		}

		wp_reset_query();
	}
}
