<?php
/**
 * Template Tags and Helper Functions
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme option
 *
 * @since 1.0.0
 * @param string $option Option name.
 * @param string $default Default value.
 * @return mixed
 */
function car_services_get_option( $option, $default = '' ) {
	return get_theme_mod( $option, $default );
}

/**
 * Get business phone number
 *
 * @since 1.0.0
 * @return string
 */
function car_services_get_phone() {
	return car_services_get_option( 'car_services_phone' );
}

/**
 * Get business email
 *
 * @since 1.0.0
 * @return string
 */
function car_services_get_email() {
	return car_services_get_option( 'car_services_email' );
}

/**
 * Get business address
 *
 * @since 1.0.0
 * @return string
 */
function car_services_get_address() {
	return car_services_get_option( 'car_services_address' );
}

/**
 * Get business hours
 *
 * @since 1.0.0
 * @return string
 */
function car_services_get_hours() {
	return car_services_get_option( 'car_services_hours' );
}

/**
 * Get social media link
 *
 * @since 1.0.0
 * @param string $platform Social platform.
 * @return string
 */
function car_services_get_social_link( $platform ) {
	return car_services_get_option( 'car_services_' . $platform );
}

/**
 * Display social media links
 *
 * @since 1.0.0
 * @return void
 */
function car_services_display_social_links() {
	$platforms = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
	$has_links = false;

	foreach ( $platforms as $platform ) {
		if ( car_services_get_social_link( $platform ) ) {
			$has_links = true;
			break;
		}
	}

	if ( ! $has_links ) {
		return;
	}

	echo '<ul class="social-links">';
	foreach ( $platforms as $platform ) {
		$link = car_services_get_social_link( $platform );
		if ( $link ) {
			echo '<li><a href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer"><span class="sr-only">' . esc_html( ucfirst( $platform ) ) . '</span></a></li>';
		}
	}
	echo '</ul>';
}

/**
 * Display post meta
 *
 * @since 1.0.0
 * @return void
 */
function car_services_post_meta() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	echo '<div class="post-meta">';
	echo '<span class="meta-author">' . esc_html__( 'By ', 'car-services-theme' ) . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	echo '<span class="meta-date">' . esc_html( get_the_date() ) . '</span>';
	echo '<span class="meta-category">' . esc_html__( 'In ', 'car-services-theme' ) . wp_kses_post( get_the_category_list( ', ' ) ) . '</span>';
	echo '</div>';
}

/**
 * Display post navigation
 *
 * @since 1.0.0
 * @return void
 */
function car_services_post_navigation() {
	the_posts_pagination( array(
		'mid_size'           => 2,
		'prev_text'          => esc_html__( '← Previous', 'car-services-theme' ),
		'next_text'          => esc_html__( 'Next →', 'car-services-theme' ),
		'before_page_number' => '<span class="page-number">',
		'after_page_number'  => '</span>',
	) );
}

/**
 * Get custom logo
 *
 * @since 1.0.0
 * @return string
 */
function car_services_get_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html            = '';

	if ( $custom_logo_id ) {
		$html = wp_get_attachment_image( $custom_logo_id, 'full' );
	} else {
		$html = esc_html( get_bloginfo( 'name' ) );
	}

	return $html;
}

/**
 * Display logo
 *
 * @since 1.0.0
 * @return void
 */
function car_services_logo() {
	echo '<div class="site-logo">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . car_services_get_logo() . '</a>';
	echo '</div>';
}

/**
 * Sanitize and output featured image
 *
 * @since 1.0.0
 * @param string $size Image size.
 * @return void
 */
function car_services_featured_image( $size = 'car-services-large' ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size, array(
			'class' => 'featured-image',
			'alt'   => the_title_attribute( array( 'echo' => false ) ),
		) );
	}
}

/**
 * Escape and output text
 *
 * @since 1.0.0
 * @param string $text Text to escape.
 * @return void
 */
function car_services_the_text( $text ) {
	echo wp_kses_post( $text );
}

/**
 * Override default search form with icon button
 *
 * @since 1.0.0
 * @return string
 */
function car_services_search_form() {
	return '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<label>
			<span class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'car-services-theme' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search…', 'placeholder', 'car-services-theme' ) . '" value="' . esc_attr( get_search_query() ) . '" name="s" />
		</label>
		<button type="submit" class="search-submit" aria-label="' . esc_attr__( 'Search', 'car-services-theme' ) . '">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" aria-hidden="true">
				<circle cx="11" cy="11" r="7"/>
				<line x1="21" y1="21" x2="16.65" y2="16.65"/>
			</svg>
		</button>
	</form>';
}
add_filter( 'get_search_form', 'car_services_search_form' );
