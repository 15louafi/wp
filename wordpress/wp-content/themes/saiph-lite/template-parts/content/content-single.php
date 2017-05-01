<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saiph
 */

// Format the date to create the ribbon
if ( 'post' == get_post_type() ) {
	$saiph_date = get_the_date( 'j/M' );
	list( $day, $month ) = explode( '/', $saiph_date );
}

?>
<!-- Article Content -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'tpl-blog-box' ); ?> itemscope=""
         itemtype="http://schema.org/BlogPosting">
 <span class="tpl-blog-date" itemprop="datePublished"><?php echo $day ?>
	 <small><?php echo $month ?></small></span>
	<?php if ( is_sticky() && ! is_single() ) { ?>
		<div class="tpl-sticky-post">
			<div class="sticky-wrapper"><span class="fa icon-target"></span></div>
		</div>
	<?php } ?>

	<?php if ( has_post_thumbnail() ) { ?>
		<!-- Blog Image -->
		<div class="tpl-blog-image">
			<?php echo ! is_single() ? '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' : '' ?>

			<?php the_post_thumbnail( 'saiph-theme-full-width' ) ?>

			<?php echo ! is_single() ? '</a>' : '' ?>
		</div>
		<!-- .Blog Image -->
	<?php } ?>
	<!-- Entry Header -->
	<header class="entry-header <?php echo ! has_post_thumbnail() ? 'tpl-padding-top-x2' : '' ?>">
		<?php
		if ( is_single() ) {
			the_title( '<h2 itemprop="headline">', '</h2>' );
		} else {
			the_title( '<h4 itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		}
		?>
	</header>
	<!-- .Entry Header -->
	<?php if ( is_search() ) { ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php } else { ?>
		<!-- Entry Content -->
		<div class="entry-content tpl-blog-post-body" itemprop="articleBody">
			<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="tpl-permalink">' . __('Permalink', 'saiph-lite') . '</a>'?>
			<?php
			// Add the content
			the_content( __( 'Read article', 'saiph-lite' ) );
			// Add pagination support only on single-pages
			if ( is_single() ) {
				wp_link_pages( array(
					               'before'      => '<ul class="tpl-pager">',
					               'after'       => '</ul>',
					               'link_before' => '<li>',
					               'link_after'  => '</li>',
				               ) );
			} ?>
		</div>
		<!-- .Entry Content -->
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
	<?php } ?>
</article>
<!-- .Article Content -->
