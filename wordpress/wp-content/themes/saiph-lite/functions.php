<?php
/**
 * Saiph functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Saiph
 */

/**
 * We redeclare the unyson framework directory here
 */

function saiph_filter_theme_custom_framework_customizations_dir_rel_path( $rel_path ) {
	return '/framework';
}

add_filter(
	'fw_framework_customizations_dir_rel_path',
	'saiph_filter_theme_custom_framework_customizations_dir_rel_path'
);

require_once get_template_directory() . '/inc/init.php';

/**
 * Require the needed plugins
 */
require_once get_template_directory() . '/inc/includes/tgm-plugin-activation.php';

require_once get_template_directory() . '/inc/includes/class-media-grabber.php';

/** @internal */
function saiph_action_theme_register_required_plugins() {
	tgmpa( array(
		array(
			'name'     => 'Unyson',
			'slug'     => 'unyson',
			'required' => false,
		),
	) );

}

add_action( 'tgmpa_register', 'saiph_action_theme_register_required_plugins' );

/**
 * @param $content
 *
 * @return mixed
 */
function saiph_disable_container( $content ) {
	return str_replace( '<div class="container"', '<div class="project-container"', $content );
}

/**
 * @param $content
 *
 * @return mixed
 */
function saiph_remove_first_gallery( $content ) {
	$content = preg_replace( '/\[gallery.*?\]/', '', $content );

	return $content;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

