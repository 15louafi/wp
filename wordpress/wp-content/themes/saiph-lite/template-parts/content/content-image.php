<?php
/**
 * Template part for displaying image posts.
 *
 *
 * @package Saiph
 */
$args = array(
	'split_media' => true,
	'scan' => true,
	'scan_raw' => true,
	'echo' => false,
	'featured' => false,
	'attachment' => false,
	'captions' => false,
);

if ( is_single() ) {
	$args['link'] = 'file';
}
$image = get_the_image( $args );
// Remove nasty styles :)
$image = str_replace('thumbnail post-thumbnail', get_the_ID(), $image);

?>
<!-- Article Content -->
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<!-- Main Container -->
	<div class="tpl-blog-box-image" itemscope="" itemtype="http://schema.org/BlogPosting">
		<?php if ( is_single() ) {
			the_content();
		} else { ?>
			<!-- Post Content -->
			<div class="tpl-blog-image">
				<?php echo $image ?>
				<!-- Post Meta , visible on hover -->
				<div class="post-meta">
					<div class="author"><i class="fa fa-user"></i><span> <?php echo the_author_link() ?></span></div>
					<div class="comments"><i class="fa fa-comments"></i><a href="<?php echo esc_url( get_permalink() ) ?>"><span> <?php echo get_comments_number() ?> </span></a></div>
				</div>
				<!-- .Post Meta -->
			</div>
			<!-- .Post Content-->
		<?php } ?>
	</div>
	<!-- .Main Container -->
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
</article>
<!-- .Article Content -->
