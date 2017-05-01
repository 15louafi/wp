<?php
/**
 * The sidebar containing the main home columns widget areas
 *
 * @subpackage fFashion
 * @author tishonator
 * @since fFashion 1.0.3
 *
 */
?>

<?php 
	/**
	 * Display widgets dragged in 'Homepage Widget Area'
	 */
?>

<?php if ( !dynamic_sidebar( 'homepage-widget-area' ) ) : ?>

			<h2 class="sidebar-title">
				<?php _e('Home Widget Area', 'ffashion'); ?>
			</h2><!-- .sidebar-title -->
			
			<div class="sidebar-after-title">
			</div><!-- .sidebar-after-title -->
			
			<div class="textwidget">
				<?php _e('This is homepage widget area. To customize it, please navigate to Admin Panel -> Appearance -> Widgets and add widgets to Homepage Widget Area.', 'ffashion'); ?>
			</div><!-- .textwidget -->

<?php endif; // end of ! dynamic_sidebar( 'homepage-widget-area' )
?>