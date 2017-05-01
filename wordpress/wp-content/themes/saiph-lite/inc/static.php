<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Include static files: javascript and css
 */

if ( is_admin() ) {
	return;
}

/**
 * Register and Enqueue scripts and styles for the front end.
 */

$saiph_protocol = is_ssl() ? 'https' : 'http';

// Load the fonts
$googleFonts = array(
	'contentFont'  => $saiph_protocol . '://fonts.googleapis.com/css?family=Mallanna:regular',
	'titleFont'    => $saiph_protocol . '://fonts.googleapis.com/css?family=Raleway:100,200,300,regular,500,600,700,800,900',
	'subtitleFont' => $saiph_protocol . '://fonts.googleapis.com/css?family=Vollkorn:regular,italic,700,700italic'
);

wp_register_script( 'stickykit', get_stylesheet_directory_uri() . '/assets/vendors/stickykit/jquery.sticky-kit.min.js', array(), '1.0.0', true );
wp_enqueue_script( 'scrollreveal', get_stylesheet_directory_uri() . '/assets/vendors/scrollreveal/scrollReveal.min.js', array(), '1.0.0', true );
wp_register_script( 'tabcollapse', get_stylesheet_directory_uri() . '/assets/vendors/bootstrap-tabcollapse/bootstrap-tabcollapse.js', array( 'jquery' ), '1.0.0', true );
wp_register_script( 'velocity', get_stylesheet_directory_uri() . '/assets/vendors/velocity/velocity.min.js', array( 'jquery' ), '1.0.0', true );
// Load Bootstrap
wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.css', array() );
// Enqueue the theme
wp_enqueue_style( 'saiph-lite' . '-style', get_stylesheet_directory_uri() . '/assets/css/style.css' );
// Enqueue icons
wp_enqueue_style( 'saiph-lite' . '-icons', get_stylesheet_directory_uri() . '/assets/css/icons.css' );
wp_enqueue_script( 'transformicon', get_stylesheet_directory_uri() . '/assets/vendors/transformicons/transformicons.min.js', array(), '1.0.0', true );
wp_register_style( 'magnificpopup', get_stylesheet_directory_uri() . '/assets/vendors/magnificPopup/magnific-popup.css', array() );
wp_register_script( 'magnificpopup', get_stylesheet_directory_uri() . '/assets/vendors/magnificPopup/jquery.magnific-popup.js', array(), '1.0.0', true );
wp_register_style( 'justifiedgallery', get_stylesheet_directory_uri() . '/assets/vendors/justifiedGallery/justifiedGallery.min.css', array() );
wp_register_script( 'justifiedgallery', get_stylesheet_directory_uri() . '/assets/vendors/justifiedGallery/jquery.justifiedGallery.min.js', array(), '1.0.0', true );
// Enqueue Bootstrap script and template scripts
wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.js', array( 'jquery' ) );
wp_enqueue_script( 'saiph-lite' . '-object', get_stylesheet_directory_uri() . '/assets/js/saiph.js', array(), '1.0.0', true );
wp_enqueue_script( 'saiph-lite' . '-initiator', get_stylesheet_directory_uri() . '/assets/js/template.js', array(), '1.0.0', true );

wp_enqueue_style( 'saiph-lite' . '-google-font-content', $googleFonts['contentFont'], false, NULL, 'all' );
wp_enqueue_style( 'saiph-lite' . '-google-font-titles', $googleFonts['titleFont'], false, NULL, 'all' );
wp_enqueue_style( 'saiph-lite' . '-google-font-subtitles', $googleFonts['subtitleFont'], false, NULL, 'all' );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

// Selectize
{
	wp_enqueue_style(
		'selectize',
		get_template_directory_uri() . '/assets/css/selectize.css',
		array(),
		'1.0'
	);
	wp_enqueue_script(
		'selectize',
		get_template_directory_uri() . '/assets/js/selectize.min.js',
		array( 'jquery' ),
		'1.0',
		true
	);
}
