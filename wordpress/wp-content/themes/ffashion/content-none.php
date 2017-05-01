<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @subpackage fFashion
 * @author tishonator
 * @since fFashion 1.0.3
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>

<article>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<h1><?php _e( 'Oh no! Article not found! 404 error!', 'ffashion' ); ?></h1>
	
	<?php elseif ( is_search() ) : ?>

			<h1><?php _e( 'No Results Found!', 'ffashion' ); ?></h1>
			<?php get_search_form(); ?>

	<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ffashion' ); ?></p>
			<?php get_search_form(); ?>

	<?php endif; ?>

</article>