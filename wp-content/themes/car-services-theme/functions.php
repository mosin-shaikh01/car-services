<?php
/**
 * Car Services Theme Functions and Definitions
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define theme constants
define( 'CAR_SERVICES_DIR', get_template_directory() );
define( 'CAR_SERVICES_URI', get_template_directory_uri() );
define( 'CAR_SERVICES_VERSION', '1.2.4' );

// Include theme setup files
require_once CAR_SERVICES_DIR . '/inc/theme-setup.php';
require_once CAR_SERVICES_DIR . '/inc/enqueue.php';
require_once CAR_SERVICES_DIR . '/inc/customizer.php';
require_once CAR_SERVICES_DIR . '/inc/template-tags.php';
require_once CAR_SERVICES_DIR . '/inc/woocommerce.php';
require_once CAR_SERVICES_DIR . '/inc/acf-fields.php';
require_once CAR_SERVICES_DIR . '/inc/acf.php';
require_once CAR_SERVICES_DIR . '/inc/forms.php';

// Required & recommended plugins — must load before after_setup_theme fires.
require_once CAR_SERVICES_DIR . '/inc/tgm-plugins.php';

// One Click Demo Import integration (conditional on plugin being active).
require_once CAR_SERVICES_DIR . '/inc/demo-import.php';

// Load text domain for translations
add_action( 'after_setup_theme', function() {
	load_theme_textdomain( 'car-services-theme', CAR_SERVICES_DIR . '/languages' );
} );
