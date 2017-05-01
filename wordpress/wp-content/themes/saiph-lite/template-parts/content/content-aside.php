<?php
/**
 * Template part for displaying posts.
 *
 *
 * @package Saiph
 */

?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div class="tpl-blog-box-aside" itemscope="" itemtype="http://schema.org/BlogPosting">
		<?php if ( is_single() ) { ?>
			<header class="entry-header <?php echo ! has_post_thumbnail() ? 'tpl-padding-top-x2' : '' ?>">
				<?php the_title( '<h2 itemprop="name headline">', '</h2>' ); ?>
			</header><!-- .entry-header -->
		<?php } ?>
		<small class="aside-date"><?php echo get_the_date( 'l jS Y' ) ?></small>
		<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="tpl-permalink">' . __('Permalink', 'saiph-lite') . '</a>'?>
		<?php
		the_content( __( 'Read article', 'saiph-lite' ) );
		// If the page is single, we include the row with category, tags
		if ( is_single() ) {
			get_template_part( 'template-parts/post-footer' );
			// Include author information
			get_template_part( 'template-parts/author-info' );
			// Include the related posts
			get_template_part( 'template-parts/related-posts' );
		} ?>
	</div>
	<?php if ( is_single() ) { ?>
		<footer class="tpl-article-footer">
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</footer>
	<?php } ?>
</article>