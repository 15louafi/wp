<?php
/**
 *
 * The Menu
 *
 * @package saiph
 */

$saiph_menu_defaults = array(
	'theme_location' => 'primary',
	'container'      => false,
	'menu_class'     => 'nav navbar-nav navbar-right',
	'echo'           => true,
	'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'          => 2,
	'fallback_cb'    => false,
);

$menu_class = array(
	'class' => 'navbar tpl-menu tpl-menu-sticky ',
);

$brand_class = array(
	'class' => 'navbar-brand',
	'href'  => esc_url( home_url( '/' ) )
);

wp_enqueue_script( 'stickykit' );

?>

<!-- Start Menu -->
<header>
	<nav <?php echo saiph_attr_to_html( $menu_class ) ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<a <?php echo saiph_attr_to_html( $brand_class ) ?>>
						<?php echo get_option( 'blogname' ) ?>
					</a>

					<div class="navbar-header">
						<button type="button" class="tpl-menu-toggle collapsed tcon tcon-menu--xcross"
							data-toggle="collapse" data-target="#navbar-collapse-1" aria-label="toggle menu">
							<span class="tcon-menu__lines" aria-hidden="true"></span>
							<span class="tcon-visuallyhidden">toggle menu</span>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="navbar-collapse-1">
						<?php wp_nav_menu( $saiph_menu_defaults ); ?>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- End Menu -->

