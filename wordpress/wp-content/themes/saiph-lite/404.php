<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Saiph
 */

get_header();
?>

<div id="content" class="site-content container tpl-spacing-tb-x3 tpl-padding-bottom-x2" role="main">
	<div class="col-md-8 col-md-offset-2 text-center">
		<span class="saiph_error">
			404
		</span>
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Panic! The requested page was not found.', 'saiph-lite' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'saiph-lite' ); ?></p>

			<?php get_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
