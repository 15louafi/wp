<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Register menus
 */

register_nav_menus(
	array(
		'primary'     => __( 'Top primary menu', 'saiph-lite' ),
		'footer-menu' => __( 'Footer Menu', 'saiph-lite' ),
	)
);
