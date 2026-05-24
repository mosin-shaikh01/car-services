<?php
/**
 * WooCommerce Compatibility
 *
 * All hooks and filters here are guarded behind class_exists('WooCommerce')
 * so the theme works correctly on sites where WooCommerce is not installed.
 *
 * WooCommerce theme support is declared once in inc/theme-setup.php inside
 * car_services_setup() — not duplicated here.
 *
 * @package Car_Services_Theme
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Nothing below should load if WooCommerce is not active.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Set the number of product thumbnails per row.
 *
 * @return int
 */
function car_services_woo_product_thumbnails() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'car_services_woo_product_thumbnails' );

/**
 * Set the number of products shown per page on shop/archive.
 *
 * @return int
 */
function car_services_loop_shop_per_page() {
	return apply_filters( 'woocommerce_products_per_page', 12 );
}
add_filter( 'loop_shop_per_page', 'car_services_loop_shop_per_page' );

/**
 * Set the number of columns in the product loop.
 *
 * @return int
 */
function car_services_loop_shop_columns() {
	return apply_filters( 'woocommerce_products_columns', 3 );
}
add_filter( 'loop_shop_columns', 'car_services_loop_shop_columns' );

/**
 * Customise WooCommerce breadcrumb markup.
 *
 * @param  array $args Default breadcrumb arguments.
 * @return array
 */
function car_services_breadcrumb_args( $args ) {
	$args['delimiter']   = ' / ';
	$args['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
	$args['wrap_after']  = '</nav>';
	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'car_services_breadcrumb_args' );

/**
 * Enqueue the theme WooCommerce stylesheet.
 * Runs after WooCommerce's own styles are registered so dequeuing
 * the defaults on line below actually works.
 *
 * @return void
 */
function car_services_enqueue_woocommerce_styles() {
	wp_enqueue_style(
		'car-services-woocommerce',
		CAR_SERVICES_URI . '/assets/css/woocommerce.css',
		array(),
		CAR_SERVICES_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'car_services_enqueue_woocommerce_styles' );

/**
 * Remove the default WooCommerce stylesheets so only the theme's
 * woocommerce.css is loaded (avoids style conflicts).
 *
 * @return void
 */
function car_services_dequeue_woocommerce_styles() {
	wp_dequeue_style( 'woocommerce-layout' );
	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_dequeue_style( 'woocommerce-general' );
}
add_action( 'wp_enqueue_scripts', 'car_services_dequeue_woocommerce_styles', 99 );
