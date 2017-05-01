<?php
/**
 * Template part for displaying posts.
 *
 *
 * @package Saiph
 */

// Enqueue needed scripts
wp_enqueue_script( 'magnificpopup-js' );
wp_enqueue_style( 'magnificpopup-css' );
wp_enqueue_script( 'justifiedgallery-js' );
wp_enqueue_style( 'justifiedgallery-css' );

// Format the date
$saiph_date = get_the_date( 'j/M' );
list( $day, $month ) = explode( '/', $saiph_date );

// Grab the gallery images
$gallery = get_post_gallery_images( $post );
$gallery_options = array(
	'data-saiph'          => 'justifiedGallery',
	'data-row-height'     => '200',
	'data-image-margins'  => '1',
	'data-image-captions' => false,
	'data-nojustify'      => 'justify',
);
?>
<!-- Article Content -->
<article <?php post_class( 'tpl-blog-box-gallery' ); ?> id="post-<?php the_ID(); ?>">
	<span class="tpl-blog-date" itemprop="datePublished"><?php echo $day ?>
		<small><?php echo $month ?></small></span>
	<?php if ( is_sticky() && ! is_single() ) { ?>
		<div class="tpl-sticky-post">
			<div class="sticky-wrapper"><span class="fa icon-target"></span></div>
		</div>
	<?php } ?>
	<!-- Gallery Container -->
	<div class="tpl-blog-box-images">
		<div <?php echo saiph_attr_to_html( $gallery_options ) ?>>
			<?php foreach ( $gallery as $image ) { ?>
				<a class="magnific-popup" href="<?php echo $image ?>">
					<img src="<?php echo $image ?>" alt="<?php echo __( 'Gallery Image', 'saiph-lite' ) ?>"/>
				</a>
			<?php } ?>
		</div>
	</div>
	<!-- .Gallery Container -->
	<!-- Header -->
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h2 itemprop="headline">', '</h2>' );
		} else {
			the_title( '<h4 itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		}
		?>
	</header>
	<!-- .Header -->
	<!-- Blog Post Body -->
	<div class="tpl-blog-post-body" itemprop="articleBody">
		<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="tpl-permalink">' . __('Permalink', 'saiph-lite') . '</a>'?>
		<?php add_filter( 'the_content', 'saiph_remove_first_gallery' ); ?>
		<?php the_content( __( 'Read article', 'saiph-lite' ) ); ?>
	</div>
	<!-- .Blog Post Body -->
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
</article>
<!-- .Article Content -->
