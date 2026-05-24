<?php
/**
 * One Click Demo Import — Theme Integration
 *
 * Wires the theme's demo files to the One Click Demo Import plugin
 * (https://wordpress.org/plugins/one-click-demo-import/) so a fresh
 * install can be set up with a single click from Appearance → Import Demo.
 *
 * What happens on import:
 *  1. content.xml    — pages, posts, menus, and nav-menu items are created.
 *  2. widgets.wie    — widget areas are populated.
 *  3. customizer.dat — Customizer settings (logo, colours, etc.) are applied.
 *  4. ACF JSON       — any *.json files in /demo-import/ are copied to
 *                      /acf-json/ so ACF picks them up automatically.
 *  5. After-import   — menus are assigned to locations; front page is set.
 *
 * Demo files live in:  /demo-import/
 * ACF JSON target:     /acf-json/
 *
 * All logic is conditional on OCDI being active, so the theme boots
 * normally when the plugin is absent.
 *
 * @package Car_Services_Theme
 * @since   1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Guard: only register hooks when OCDI is present.
if ( ! class_exists( 'OCDI\OneClickDemoImport' ) ) {
	return;
}

/* -----------------------------------------------------------------------
 * 1. Import file definitions
 * -----------------------------------------------------------------------
 * `ocdi/import_files` tells OCDI where to find each demo asset.
 * Multiple demo variants can be listed as separate array entries.
 * ----------------------------------------------------------------------- */
add_filter( 'ocdi/import_files', 'car_services_ocdi_import_files' );

function car_services_ocdi_import_files() {
	$demo_dir = get_template_directory() . '/demo-import/';

	return array(
		array(
			// Label shown on the Appearance → Import Demo screen.
			'import_file_name' => 'Dark Skull Autocare — Full Demo',

			// WordPress content: pages, posts, nav menus, nav-menu items.
			'local_import_file' => $demo_dir . 'content.xml',

			// Widget settings exported with Widget Importer & Exporter.
			'local_import_widget_file' => $demo_dir . 'widgets.wie',

			// Customizer settings exported with Customizer Export/Import.
			'local_import_customizer_file' => $demo_dir . 'customizer.dat',

			// Optional: screenshot shown on the import selection screen.
			// 'import_preview_image_url' => get_template_directory_uri() . '/demo-import/preview.jpg',

			// Optional: live preview URL shown next to the import button.
			// 'preview_url' => 'https://your-demo-site.com/',

			// Notice displayed to the user before they click Import.
			'import_notice' => __(
				'Importing the demo takes about 1–2 minutes. Do not navigate away. '
				. 'Make sure Advanced Custom Fields and Contact Form 7 are active first.',
				'car-services-theme'
			),
		),
	);
}

/* -----------------------------------------------------------------------
 * 2. After-import actions
 * -----------------------------------------------------------------------
 * `ocdi/after_import` fires once OCDI has finished importing content,
 * widgets, and Customizer settings. We use it to:
 *   - Copy ACF JSON files from /demo-import/ → /acf-json/.
 *   - Assign nav menus to the three theme locations.
 *   - Set the static front page.
 * ----------------------------------------------------------------------- */
add_action( 'ocdi/after_import', 'car_services_ocdi_after_import' );

function car_services_ocdi_after_import( $selected_import ) {

	// 2a. ACF JSON sync ------------------------------------------------
	car_services_ocdi_import_acf_json();

	// 2b. Assign nav menus to theme locations --------------------------
	car_services_ocdi_assign_menus();

	// 2c. Set the static front page ------------------------------------
	car_services_ocdi_set_front_page();
}

/* -----------------------------------------------------------------------
 * 2a. ACF JSON — copy demo field-group definitions into /acf-json/
 * -----------------------------------------------------------------------
 * ACF auto-loads every *.json file it finds in the paths registered via
 * the `acf/settings/load_json` filter (see inc/acf.php). Copying files
 * here means field groups are immediately available after import without
 * any manual "Sync" step in the ACF admin.
 *
 * Skips files that are already identical (byte-for-byte) to avoid
 * unnecessary writes. Logs any copy failure to the PHP error log.
 * ----------------------------------------------------------------------- */
function car_services_ocdi_import_acf_json() {
	$source_dir = get_template_directory() . '/demo-import/';
	$target_dir = get_template_directory() . '/acf-json/';

	// Bail if the source or target directories are not readable/writable.
	if ( ! is_dir( $source_dir ) || ! is_dir( $target_dir ) ) {
		return;
	}

	if ( ! is_writable( $target_dir ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		error_log( 'Car Services Theme: /acf-json/ is not writable — ACF JSON demo import skipped.' );
		return;
	}

	$json_files = glob( $source_dir . '*.json' );

	if ( empty( $json_files ) ) {
		return; // No ACF JSON files in the demo package; nothing to do.
	}

	foreach ( $json_files as $source_file ) {
		$filename    = basename( $source_file );
		$target_file = $target_dir . $filename;

		// Skip if the target is already identical to the source.
		if ( file_exists( $target_file ) && md5_file( $source_file ) === md5_file( $target_file ) ) {
			continue;
		}

		$copied = copy( $source_file, $target_file );

		if ( ! $copied ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions
			error_log( "Car Services Theme: Could not copy ACF JSON file — {$filename}" );
		}
	}
}

/* -----------------------------------------------------------------------
 * 2b. Menu assignment
 * -----------------------------------------------------------------------
 * Maps imported nav menus (matched by name) to the three theme locations
 * registered in inc/theme-setup.php:
 *   primary  → 'Primary Menu'
 *   footer   → 'Footer Menu'
 *   mobile   → 'Mobile Menu'
 *
 * Uses get_term_by( 'name', … ) so it works regardless of term ID,
 * which varies between installations.
 * ----------------------------------------------------------------------- */
function car_services_ocdi_assign_menus() {
	/*
	 * Map: theme location slug => menu name as it appears in the WXR file.
	 * Adjust these names if your content.xml uses different menu titles.
	 */
	$location_map = array(
		'primary' => 'Primary Menu',
		'footer'  => 'Footer Menu',
		'mobile'  => 'Mobile Menu',
	);

	$assignments = array();

	foreach ( $location_map as $location => $menu_name ) {
		$menu = get_term_by( 'name', $menu_name, 'nav_menu' );

		if ( $menu && ! is_wp_error( $menu ) ) {
			$assignments[ $location ] = $menu->term_id;
		}
	}

	if ( ! empty( $assignments ) ) {
		set_theme_mod( 'nav_menu_locations', $assignments );
	}
}

/* -----------------------------------------------------------------------
 * 2c. Static front page
 * -----------------------------------------------------------------------
 * Finds the page titled 'Home' (imported from content.xml) and sets it
 * as the static front page. Also looks for a 'Blog' page and sets it as
 * the posts page if found.
 *
 * WordPress reading settings:
 *   show_on_front  'page'  → show a static page, not latest posts.
 *   page_on_front  <ID>    → which page to show as the homepage.
 *   page_for_posts <ID>    → which page lists blog posts (optional).
 * ----------------------------------------------------------------------- */
function car_services_ocdi_set_front_page() {

	// Try common homepage titles — first match wins.
	$home_titles = array( 'Home', 'Homepage', 'Front Page' );
	$front_page  = null;

	foreach ( $home_titles as $title ) {
		$front_page = car_services_ocdi_get_page( $title );
		if ( $front_page ) {
			break;
		}
	}

	if ( $front_page ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
	}

	// Optionally set a blog/posts page.
	$blog_titles = array( 'Blog', 'News', 'Articles' );

	foreach ( $blog_titles as $title ) {
		$blog_page = car_services_ocdi_get_page( $title );
		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
			break;
		}
	}
}

/* -----------------------------------------------------------------------
 * Helper: find a published page by exact title (case-insensitive).
 *
 * @param  string       $title  Page title to search for.
 * @return WP_Post|null         First matching published page, or null.
 * ----------------------------------------------------------------------- */
function car_services_ocdi_get_page( $title ) {
	$pages = get_posts( array(
		'post_type'              => 'page',
		'post_status'            => 'publish',
		'title'                  => $title,
		'posts_per_page'         => 1,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	) );

	return ! empty( $pages ) ? $pages[0] : null;
}

/* -----------------------------------------------------------------------
 * 3. Optional UX tweaks
 * ----------------------------------------------------------------------- */

/**
 * Replace the default OCDI intro text with a theme-specific message.
 *
 * @param  string $default_text  Default text from OCDI.
 * @return string
 */
add_filter( 'ocdi/plugin_intro_text', function( $default_text ) {
	return '<div class="ocdi__intro-text">'
		. '<p>'
		. esc_html__( 'Import the Dark Skull Autocare demo to get a head start. '
			. 'The process will import pages, menus, widgets, and Customizer settings. '
			. 'Existing content will not be deleted.', 'car-services-theme' )
		. '</p>'
		. '</div>';
} );

/**
 * Remove ProteusThemes branding from the import screen.
 */
add_filter( 'ocdi/disable_pt_branding', '__return_true' );
