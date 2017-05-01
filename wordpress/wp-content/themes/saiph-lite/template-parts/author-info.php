<?php
/**
 * Template part for displaying author info.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saiph
 */
// Grab the current author
$curauth = get_userdata( $post->post_author );

if ( is_single() && ! empty( $curauth->description ) ) { ?>
	<!-- Author description -->
	<div class="row author-description tpl-spacing-tb tpl-vcenter">
		<!-- Avatar -->
		<div class="col-md-2 tpl-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
		</div>
		<!-- .Avatar -->
		<!-- Short Description -->
		<div class="col-md-10" itemscope="" itemtype="http://schema.org/Person">
			<h5>
       <span itemprop="author">
         <span itemprop="name"><?php echo the_author_posts_link(); ?></span>
       </span>
			</h5>

			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
		<!-- .Short Description -->
	</div>
	<!-- .Author description -->
<?php } ?>
