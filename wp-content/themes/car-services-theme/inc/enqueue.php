<?php
/**
 * Enqueue scripts and styles
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue frontend styles and scripts
 *
 * @since 1.0.0
 * @return void
 */
function car_services_enqueue_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style(
		'car-services-main',
		CAR_SERVICES_URI . '/assets/css/style.css',
		array(),
		CAR_SERVICES_VERSION,
		'all'
	);

	// Enqueue responsive stylesheet
	wp_enqueue_style(
		'car-services-responsive',
		CAR_SERVICES_URI . '/assets/css/responsive.css',
		array( 'car-services-main' ),
		CAR_SERVICES_VERSION,
		'all'
	);

	// Enqueue scroll animation system (sitewide)
	wp_enqueue_style(
		'car-services-animations',
		CAR_SERVICES_URI . '/assets/css/animations.css',
		array( 'car-services-main' ),
		CAR_SERVICES_VERSION,
		'all'
	);

	// Enqueue homepage stylesheet only on the front page
	if ( is_front_page() ) {
		wp_enqueue_style(
			'car-services-homepage',
			CAR_SERVICES_URI . '/assets/css/homepage.css',
			array( 'car-services-main' ),
			CAR_SERVICES_VERSION,
			'all'
		);
	}

	// Enqueue page-specific stylesheet (About Us / Contact Us)
	if ( is_page_template( array( 'page-about.php', 'page-contact.php', 'page-services.php', 'page-inspection.php' ) ) || is_home() || is_archive() || is_single() ) {
		wp_enqueue_style(
			'car-services-pages',
			CAR_SERVICES_URI . '/assets/css/pages.css',
			array( 'car-services-main' ),
			CAR_SERVICES_VERSION,
			'all'
		);
	}

	// GSAP core (CDN, deferred until DOMContentLoaded via in_footer)
	wp_enqueue_script(
		'gsap',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	// ScrollTrigger plugin — depends on GSAP core
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	// Global animation config — must load before animations.js
	wp_enqueue_script(
		'car-services-gsap-init',
		CAR_SERVICES_URI . '/assets/js/gsap-init.js',
		array( 'gsap', 'gsap-scrolltrigger' ),
		CAR_SERVICES_VERSION,
		true
	);

	// GSAP animation module — depends on config above
	wp_enqueue_script(
		'car-services-gsap-animations',
		CAR_SERVICES_URI . '/assets/js/animations.js',
		array( 'car-services-gsap-init' ),
		CAR_SERVICES_VERSION,
		true
	);

	// Enqueue main JavaScript — depends on animations.js so window.csGSAPEnabled is set first
	wp_enqueue_script(
		'car-services-main',
		CAR_SERVICES_URI . '/assets/js/main.js',
		array( 'car-services-gsap-animations' ),
		CAR_SERVICES_VERSION,
		true
	);

	// Add inline script for theme config
	wp_add_inline_script(
		'car-services-main',
		'var carServicesTheme = ' . wp_json_encode( array(
			'siteUrl' => home_url(),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		) ) . ';',
		'before'
	);

	// Dequeue WP emoji scripts if not needed
	if ( apply_filters( 'car_services_remove_emoji', true ) ) {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'car_services_enqueue_scripts' );

/**
 * Enqueue block editor styles
 *
 * @since 1.0.0
 * @return void
 */
function car_services_enqueue_block_editor_assets() {
	wp_enqueue_style(
		'car-services-editor',
		CAR_SERVICES_URI . '/assets/css/editor.css',
		array(),
		CAR_SERVICES_VERSION,
		'all'
	);
}
add_action( 'enqueue_block_editor_assets', 'car_services_enqueue_block_editor_assets' );

/**
 * Enqueue Google Fonts in the block editor only.
 * Uses enqueue_block_editor_assets (admin-only) rather than
 * enqueue_block_assets (which fires on the frontend too).
 *
 * @since 1.0.0
 * @return void
 */
function car_services_block_editor_settings() {
	wp_enqueue_style(
		'car-services-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap',
		array(),
		null
	);
}
add_action( 'enqueue_block_editor_assets', 'car_services_block_editor_settings' );
