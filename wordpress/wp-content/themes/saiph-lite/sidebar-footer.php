<?php
/**
 * The footer widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saiph
 */

$mysidebars = array(
	'footer-a',
	'footer-b',
	'footer-c',
	'footer-d'
);

$sidebars = array();
foreach ( $mysidebars as $column ) {
	if ( is_active_sidebar( $column ) ) {
		$sidebars[] = $column;
	}
};

if ( empty( $sidebars ) ) {
	return;
}

$size = 12 / count( $sidebars );

?>
<!-- Footer Widgets -->
<div class="row tpl-footer-columns tpl-spacing-top-x2 tpl-spacing-bottom">
	<?php foreach ( $mysidebars as $column ):
		if ( is_active_sidebar( $column ) ) :

			?>
			<div id="<?php echo $column ?>" class="col-md-<?php echo $size ?> col-sm-6 col-xs-12 footer-sidebar widget-area"
				role="complementary">
				<?php dynamic_sidebar( $column ); ?>
			</div>
			<?php
		endif;
	endforeach; ?>
</div>
<!-- End Footer Widgets -->