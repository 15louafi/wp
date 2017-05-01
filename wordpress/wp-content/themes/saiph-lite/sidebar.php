<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saiph
 */

if ( ! is_active_sidebar( 'standard' ) ) {
	return;
}
?>
<!-- Main Siderbar -->
<div id="aside-sidebar" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'standard' ); ?>
</div>
<!-- End Main Sidebar -->
