<?php
/**
 * ACF JSON Sync
 *
 * Tells ACF to save and load field group JSON files from the theme's
 * /acf-json/ directory. This keeps field definitions version-controlled
 * alongside theme code and eliminates manual DB → DB migrations.
 *
 * How it works:
 *  - Save point : whenever a field group is saved in wp-admin, ACF writes
 *                 a matching .json file into /acf-json/.
 *  - Load point : on every page request ACF reads those .json files so the
 *                 field groups are registered from the file, not the DB.
 *
 * @package Car_Services_Theme
 * @since   1.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the theme's acf-json directory as the ACF save point.
 *
 * ACF calls this filter when it needs to know where to write .json files.
 * Returning the theme directory path keeps everything self-contained.
 *
 * @param  string $path  Default save path (usually inside the ACF plugin).
 * @return string        Absolute path to /acf-json/ inside the theme.
 */
add_filter( 'acf/settings/save_json', function( $path ) {
	return get_template_directory() . '/acf-json';
} );

/**
 * Add the theme's acf-json directory to ACF's list of load points.
 *
 * ACF merges field groups from every path in this array, giving local
 * JSON files precedence over the database when both exist.
 *
 * @param  array $paths  Existing load paths (ACF default + any already registered).
 * @return array         Paths with the theme's acf-json directory appended.
 */
add_filter( 'acf/settings/load_json', function( $paths ) {
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
} );
