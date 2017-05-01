<?php
/**
 *
 * @package Saiph
 */
if ( ! function_exists( 'saiph_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function saiph_setup() {

		load_theme_textdomain( 'saiph-lite', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'assets/css/editor-style.css' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 85, 85, true );
		add_image_size( 'saiph-theme-full-width', 1170, 450, array( 'center', 'center' ) );
		add_image_size( 'saiph-theme-project', 850, 720, array( 'center', 'center' ) );
		add_image_size( 'saiph-blog-thumb', 370, 310, array( 'center', 'center' ) );
		add_image_size( 'saiph-testimonial-thumb', 128, 128, false );
		add_image_size( 'saiph-vertical-thumb', 435, 720, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		 $available_formats = array(
			'aside',
			'image',
			'quote',
			'link',
			'gallery',
			'video'
		);
		add_theme_support( 'post-formats', $available_formats);

		add_filter( 'use_default_gallery_style', '__return_false' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'saiph_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Change tags class:
		function saiph_add_class_the_tags( $html ) {
			$postid = get_the_ID();
			$html   = str_replace( '<a', '<a class="tpl-tag"', $html );

			return $html;
		}

		add_filter( 'the_tags', 'saiph_add_class_the_tags' );


		function modify_read_more_link() {
			return '<a class="read-more-button" href="' . get_permalink() . '">Read article</a>';
		}

		add_filter( 'the_content_more_link', 'modify_read_more_link' );

		function saiph_add_image_schema( $attr ) {
			$attr['itemprop'] = 'image';

			return $attr;
		}

		add_filter( 'wp_get_attachment_image_attributes', 'saiph_add_image_schema', 10, 2 );

	}
endif; // saiph_setup
add_action( 'after_setup_theme', 'saiph_setup' );


/**
 * Flush out the transients used in fw_theme_categorized_blog.
 *
 * @internal
 */
function saiph_action_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'saiph_categories' );
}

add_action( 'edit_category', 'saiph_action_theme_category_transient_flusher' );
add_action( 'save_post', 'saiph_action_theme_category_transient_flusher' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function saiph_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'saiph_content_width', 1400 );
}

add_action( 'after_setup_theme', 'saiph_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function saiph_action_theme_widgets_init() {

	register_sidebar(
			array(
					'name'          => __( 'Standard Widget Area', 'saiph-lite' ),
					'id'            => 'standard',
					'description'   => __( 'Appears in a column of the site.', 'saiph-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
			)
	);
	register_sidebar(
			array(
					'name'          => __( 'Footer Area A', 'saiph-lite' ),
					'id'            => 'footer-a',
					'description'   => __( 'Footer Column A.', 'saiph-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
			)
	);
	register_sidebar(
			array(
					'name'          => __( 'Footer Area B', 'saiph-lite' ),
					'id'            => 'footer-b',
					'description'   => __( 'Footer Column B.', 'saiph-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
			)
	);
	register_sidebar(
			array(
					'name'          => __( 'Footer Area C', 'saiph-lite' ),
					'id'            => 'footer-c',
					'description'   => __( 'Footer Column C.', 'saiph-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
			)
	);
	register_sidebar(
			array(
					'name'          => __( 'Footer Area D', 'saiph-lite' ),
					'id'            => 'footer-d',
					'description'   => __( 'Footer Column D.', 'saiph-lite' ),
					'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
			)
	);
}

add_action( 'widgets_init', 'saiph_action_theme_widgets_init' );

function saiph_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'saiph_body_classes' );

/** @internal
 *
 * Disable shortcodes
 *
 */
function saiph_filter_theme_disable_default_shortcodes( $to_disable ) {

	$to_disable = array(
		'accordion',
		'button',
		'calendar',
		'call_to_action',
		'icon',
		'icon_box',
		'notification',
		'special_heading',
		'tabs',
		'team_member',
		'testimonials',
		'video',
	);

	return $to_disable;
}

add_filter( 'fw_ext_shortcodes_disable_shortcodes', 'saiph_filter_theme_disable_default_shortcodes' );

/** @internal */
function saiph_action_include_link_option_type() {
	require_once dirname( __FILE__ ) . '/includes/option-types/url-picker/class-fw-option-type-url-picker.php';
}
add_action( 'fw_init', 'saiph_action_include_link_option_type' );
