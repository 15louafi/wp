<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saiph
 */

get_header();

$header_color = get_header_textcolor();
$header       = saiph_create_header_gen();
?>

<header>
	<div <?php echo saiph_attr_to_html( $header ) ?>>
		<div class="container">
			<div class="row tpl-title tpl-white-title">
				<div class="col-md-6 col-xs-12">
					<h2 <?php echo isset( $header_color ) ? 'style="color:#' . $header_color . '"' : '' ?>> <?php echo get_option( 'blogname' ) ?></h2>
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

<main id="main" class="site-main">
	<?php if ( have_posts() ) : ?>
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
	<?php endif; ?>
	<section>
		<div class="container tpl-padding-tb-x2">
			<div class="row">
				<?php echo is_active_sidebar( 'standard' ) ? '<div class="col-md-8">' : '<div class="col-md-12">';
				// Start the loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					$post_thumbnail_id = get_post_thumbnail_id();
					$verticalFormat    = saiph_vertical_image_check( $post_thumbnail_id );
					if ( $verticalFormat ) {
						get_template_part( 'template-parts/content/content-vertical' );
					} else {
						get_template_part( 'template-parts/content/content', get_post_format() );
					}
					// End the loop.
				endwhile;
				// Previous/next page navigation.
				saiph_numeric_posts_nav();
				// If no content, include the "No posts found" template.
				else:
					get_template_part( 'content-none', 'none' );
				endif;
				?>
			</div>
			<!--col-md-8/col-md-12-->
			<?php if ( is_active_sidebar( 'standard' ) ): ?>
				<div class="col-md-4">
					<?php get_sidebar( 'standard' ); ?>
				</div>
			<?php endif ?>
		</div>
	</section>
</main><!-- .site-main -->

<?php get_footer(); ?>
