<?php
/**
 * Theme Setup and Configuration
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * @since 1.0.0
 * @return void
 */
function car_services_setup() {
	// Add title tag support
	add_theme_support( 'title-tag' );

	// Auto-generate <link rel="alternate"> feed links in <head>
	add_theme_support( 'automatic-feed-links' );

	// Live-preview widget edits without a full page refresh in the Customizer
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Explicit editor styles support (the add_editor_style call is in editor_styles())
	add_theme_support( 'editor-styles' );

	// Add featured image support
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'car-services-large', 1200, 600, true );
	add_image_size( 'car-services-medium', 400, 300, true );
	add_image_size( 'car-services-small', 300, 200, true );

	// Add custom logo support — fully flexible so any image size uploads cleanly
	add_theme_support( 'custom-logo', array(
		'height'               => 60,
		'width'                => 200,
		'flex-height'          => true,
		'flex-width'           => true,
		'unlink-homepage-logo' => true,
	) );

	// Add HTML5 support
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Register navigation menus
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary Menu', 'car-services-theme' ),
		'footer'    => esc_html__( 'Footer Menu', 'car-services-theme' ),
		'mobile'    => esc_html__( 'Mobile Menu', 'car-services-theme' ),
	) );

	// Register editor stylesheet (relative path required by add_editor_style)
	add_editor_style( 'assets/css/editor.css' );

	// Add Gutenberg support
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// WooCommerce theme support (guarded — safe to declare even without WooCommerce active)
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Add custom header support
	add_theme_support( 'custom-header', array(
		'width'           => 1920,
		'height'          => 200,
		'flex-height'     => true,
		'flex-width'      => true,
	) );

	// Add custom background support
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );
}
add_action( 'after_setup_theme', 'car_services_setup' );

/**
 * Register widget areas (sidebars)
 *
 * @since 1.0.0
 * @return void
 */
function car_services_widgets_init() {
	// Primary sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'car-services-theme' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'Primary sidebar for blog posts', 'car-services-theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer widget areas
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Column %d', 'car-services-theme' ), $i ),
			'id'            => 'footer-' . $i,
			'description'   => sprintf( esc_html__( 'Footer widget area %d', 'car-services-theme' ), $i ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'car_services_widgets_init' );

/**
 * Add body classes
 *
 * @since 1.0.0
 * @param array $classes Array of body classes.
 * @return array
 */
function car_services_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'homepage';
	}

	if ( is_single() ) {
		$classes[] = 'single-post';
	}

	if ( is_page() ) {
		$classes[] = 'single-page';
	}

	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'has-navigation';
	}

	if ( has_custom_logo() ) {
		$classes[] = 'has-logo';
	}

	return $classes;
}
add_filter( 'body_class', 'car_services_body_classes' );

