<?php
/**
 * The template used for displaying page content
 *
 * @subpackage fFashion
 * @author tishonator
 * @since fFashion 1.0.3
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="page-content">
		<?php echo '<h1 class="entry-title">'.get_the_title().'</h1>'; ?>

		<?php ffashion_the_content_single(); ?>
	</div><!-- .page-content -->

	<div class="page-after-content">
		
		<?php if ( ! post_password_required() ) : ?>

			<?php if ('open' == $post->comment_status) : ?>

				<span class="comments-icon">
					<?php comments_popup_link(__( 'No Comments', 'ffashion' ), __( '1 Comment', 'ffashion' ), __( '% Comments', 'ffashion' ), '', __( 'Comments are closed.', 'ffashion' )); ?>
				</span>

			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'ffashion' ), '<span class="edit-icon">', '</span>' ); ?>
		<?php endif; ?>

	</div><!-- .page-after-content -->
</article><!-- #post-## -->

