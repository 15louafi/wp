<?php
/**
 * Template part for displaying meta info from the post.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saiph
 */

if ( is_single() ) { ?>
	<!-- Post Information -->
	<ul class="blog-details">
		<?php if ( empty( $curauth->description ) ) { ?>
			<li><span class="fa fa-user"></span>
    <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
      <span itemprop="name"><?php echo the_author_posts_link(); ?></span>
    </span>
			</li>
		<?php } ?>

		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && saiph_categorized_blog() ) { ?>
			<li><span
					class="fa fa-folder-open-o"></span><?php echo get_the_category_list( _x( ' , ', 'Used between list items, there is a space after the comma.', 'saiph-lite' ) ); ?>
			</li>
		<?php }; ?>

		<?php if ( has_tag() ) { ?>
			<li><span class="fa fa-tags"></span> <?php the_tags( '<span class="tag-links">', ' , ', '</span>' ); ?></li>
		<?php } ?>

		<?php edit_post_link( __( 'Edit', 'saiph-lite' ), '<li><span class="fa fa-pencil"></span>', '</li>' ); ?>
	</ul>
	<!-- .Post Information -->
<?php } ?>
