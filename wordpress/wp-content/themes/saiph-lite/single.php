<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Saiph
 */

get_header();

$header_image = null;
if ( has_post_thumbnail() ){
	$header_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}
$header = saiph_create_header_gen($header_image);

?>

<header>
	<div <?php echo saiph_attr_to_html( $header ) ?>>
		<div class="container">
			<div class="row tpl-title tpl-white-title">
				<div class="col-md-6 col-xs-12">
					<?php echo the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>

<?php
if ( function_exists( 'fw_ext_get_breadcrumbs' ) ) {
	get_template_part( 'template-parts/breadcrumbs' );
}
?>
	<div class="container tpl-padding-tb-x2">
		<div class="row">

			<div id="content" class="site-content <?php echo is_active_sidebar( 'standard' ) ? 'col-md-8' : '' ?>"
				role="main">
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */

					get_template_part( 'template-parts/content/content', get_post_format() );

					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'saiph-lite' ),
						'next_text'          => __( 'Next page', 'saiph-lite' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'saiph-lite' ) . ' </span>',
					) );

				endwhile;
				?>
			</div>
			<!-- #content -->
			<?php if ( is_active_sidebar( 'standard' ) ): ?>
				<div class="col-md-4">
					<?php get_sidebar( 'standard' ); ?>
				</div>
			<?php endif ?>

		</div>
	</div>
<?php
get_footer();
