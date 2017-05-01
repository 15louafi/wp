<?php
/**
 * The template for displaying the footer.
 *
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saiph
 */

$footerClass = array(
	'footerlight',
	'tpl-footer'
);

$attr = array(
	'class' => trim( saiph_create_prop_array( $footerClass ) ),
);

$saiph_menu_footer = array(
	'theme_location' => 'footer-menu',
	'container'      => false,
	'menu_class'     => 'tpl-footer-menu nav navbar-nav navbar-center',
	'echo'           => true,
	'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'          => 1,
	'fallback_cb'    => false,
);
?>
<!-- Clearing Floats / Cross Browser Solution -->
<div class="clearfix"></div>
<footer <?php echo saiph_attr_to_html( $attr ) ?>>
	<?php
	if ( has_nav_menu( 'footer-menu' ) ) {
		wp_nav_menu( $saiph_menu_footer );
	};
	?>
	<div class="container">
		<?php get_sidebar( 'footer' ) ?>
		<div class="tpl-copyright">
			<hr class="spacer" />
			<p class="text-center tpl-copyright tpl-spacing-bottom">
				<?php printf(esc_html__( 'Copyright  &copy; %s %s. All rights Reserved.', 'saiph-lite' ), date_i18n('Y'), get_option( 'blogname' )); ?>
			</p>
		</div>
	</div>
</footer>

</div>

<!-- Go Top Button -->
<a href="#0" class="tpl-go-top">
	<span class="fa fa-angle-up"></span>
</a>
<!-- / Go Top Button -->

<?php wp_footer() ?>
</body>
