<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Saiph
 */

get_header();
$header = saiph_create_header_gen();

?>

<header>
	<div <?php echo saiph_attr_to_html( $header ) ?>>
		<div class="container">
			<div class="row tpl-title tpl-white-title">
				<div class="col-md-6 col-xs-12">
					<h2>>
						<?php printf( esc_html__( 'Search Results for: %s', 'saiph-lite' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h2>
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
	<section>
		<div class="container tpl-padding-tb-x2">
			<div class="row">
				<?php echo is_active_sidebar( 'standard' ) ? '<div class="col-md-8">' : '<div class="col-md-12">';
				// Start the loop.
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content/content', 'search' );
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
