<?php
/**
 * TGM Plugin Activation — Required & Recommended Plugins
 *
 * Registers plugins that the theme depends on. After theme activation
 * WordPress shows an admin notice with one-click install / activate links.
 *
 * Library : /lib/tgmpa/class-tgm-plugin-activation.php  (v2.6.1)
 * Docs    : http://tgmpluginactivation.com/
 *
 * To add or remove a plugin edit the $plugins array below.
 * Each entry supports the following keys:
 *   name     — Plugin display name (required)
 *   slug     — WordPress.org plugin slug  (required for repo plugins)
 *   required — true = required | false = recommended
 *   source   — Omit for WordPress.org; set to an absolute path or URL
 *              for bundled / external plugins.
 *
 * @package Car_Services_Theme
 * @since   1.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load the TGMPA library (guarded so it is never included twice).
require_once get_template_directory() . '/lib/tgmpa/class-tgm-plugin-activation.php';

/**
 * Register required and recommended plugins via TGMPA.
 *
 * Hooked to `tgmpa_register` which TGMPA fires on `after_setup_theme`.
 */
add_action( 'tgmpa_register', 'car_services_register_required_plugins' );

function car_services_register_required_plugins() {

	/*
	 * ----------------------------------------------------------------
	 * Plugin definitions
	 * ----------------------------------------------------------------
	 * All three plugins live on WordPress.org, so no `source` key is
	 * needed — TGMPA will install them directly from the repository.
	 * ----------------------------------------------------------------
	 */
	$plugins = array(

		// Advanced Custom Fields — powers all backend content fields.
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),

		// Classic Editor — ensures the standard post editor is available.
		array(
			'name'     => 'Classic Editor',
			'slug'     => 'classic-editor',
			'required' => true,
		),

		// Contact Form 7 — used for the Book Now modal form shortcode.
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true,
		),

		// One Click Demo Import — enables Appearance → Import Demo screen.
		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => false, // recommended, not required
		),

	);

	/*
	 * ----------------------------------------------------------------
	 * TGMPA configuration
	 * ----------------------------------------------------------------
	 * Adjust `menu` and `parent_slug` only if you add a custom admin
	 * menu. All other defaults are fine for a standard theme.
	 * ----------------------------------------------------------------
	 */
	$config = array(
		// Unique ID for this TGMPA instance — prevents conflicts if
		// another theme/plugin also uses TGMPA on the same install.
		'id'           => 'car-services-theme',

		// Where the bundled plugin ZIPs live (not used here — all
		// plugins are pulled from WordPress.org).
		'default_path' => '',

		// Admin menu label for the "Install plugins" page.
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',

		// Show a dashboard notice until all required plugins are active.
		'has_notices'  => true,

		// Let the notice be dismissed only temporarily; it reappears
		// after the next page load so the user can not forget it.
		'dismissable'  => true,
		'dismiss_msg'  => '',

		// Automatically activate plugins after installation (skips the
		// extra "activate" step in the plugins list).
		'is_automatic' => true,

		// Shown at the top of the required-plugins admin screen.
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
