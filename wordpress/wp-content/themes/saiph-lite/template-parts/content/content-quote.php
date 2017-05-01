<?php
/**
 * Template part for displaying posts.
 *
 *
 * @package Saiph
 */
?>
<!-- Article Quote Container -->
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div class="tpl-blog-box-quote" itemscope="" itemtype="http://schema.org/BlogPosting">
		<?php the_content( __( 'Read article', 'saiph-lite' ) ); ?>
		<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="tpl-permalink">' . __('Permalink', 'saiph-lite') . '</a>'?>
	</div>
	<?php if ( is_single() ) { ?>
		<footer class="tpl-article-footer">
			<?php
			// If the page is single, we include the row with category, tags
			get_template_part( 'template-parts/post-footer' );
			// Include author information
			get_template_part( 'template-parts/author-info' );
			// Include the related posts
			get_template_part( 'template-parts/related-posts' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</footer>
	<?php } ?>
</div>
<!-- .Article Quote Container -->
