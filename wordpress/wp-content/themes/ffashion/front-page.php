<?php
/**
 * Site Front Page
 *
 * This is a traditional static HTML site model with a fixed front page and
 * content placed in Pages, rarely if ever using posts, categories, or tags. 
 *
 * @subpackage fFashion
 * @author tishonator
 * @since fFashion 1.0.3
 * @link https://codex.wordpress.org/Creating_a_Static_Front_Page
 *
 */

/**
 * If front page is set to display the blog posts index, include home.php;
 * otherwise, display static front page content
 */
if ( 'posts' == get_option( 'show_on_front' ) ) :

    get_template_part( 'home' );

else :

	get_header();

	ffashion_display_slider();
?>
	<div class="clear">
	</div><!-- .clear -->

	<div id="main-content-wrapper">
		<div id="main-content-home">
			<?php get_sidebar( 'home' ); ?>

			<?php if ( have_posts() ) : 
					// starts the loop
					while ( have_posts() ) :

						the_post();

						/*
						 * Include the post format-specific template for the content.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
			?>
						<div class="navigation">
							<?php echo paginate_links( array( 'prev_next' => '', ) ); ?>
						</div><!-- .navigation -->
			<?php else :

						// if no content is loaded, show the 'no found' template
						get_template_part( 'content', 'none' );
					
				  endif; ?>

		</div><!-- #main-content -->
	</div><!-- #main-content-wrapper -->

<?php

	get_footer();

endif; ?>
