<?php
/**
 * The template for displaying all single attachments.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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
	<div <?php echo saiph_attr_to_html( $header ); ?>>
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
<!-- #main -->
<main id="main" class="site-main container">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'single-attachment' ); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; // End of the loop. ?>

</main>
<!-- #main -->

<?php get_footer(); ?>
