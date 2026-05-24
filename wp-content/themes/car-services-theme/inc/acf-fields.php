<?php
/**
 * ACF Field Groups for Homepage
 *
 * Uses individual flat fields (compatible with free ACF plugin — no repeaters).
 * Fields are attached to the page set as the static Front Page in
 * Settings > Reading. If ACF is not active, templates fall back to
 * the default hardcoded values.
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper: get an ACF field with a fallback when ACF is missing or empty.
 */
function car_services_field( $key, $default = '', $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}
	$val = get_field( $key, $post_id );
	if ( $val === '' || $val === null || $val === false || ( is_array( $val ) && empty( $val ) ) ) {
		return $default;
	}
	return $val;
}

add_action( 'acf/init', 'car_services_register_homepage_fields' );
function car_services_register_homepage_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$location = array(
		array(
			array(
				'param'    => 'page_type',
				'operator' => '==',
				'value'    => 'front_page',
			),
		),
	);

	/* =========================
	 * BRANDS / LOGOS CAROUSEL
	 * ========================= */
	$brand_fields = array(
		array(
			'key'           => 'field_cs_brands_heading',
			'label'         => 'Section Heading',
			'name'          => 'brands_heading',
			'type'          => 'text',
			'default_value' => 'Luxury Brands',
		),
	);
	for ( $i = 1; $i <= 10; $i++ ) {
		$brand_fields[] = array(
			'key'           => 'field_cs_brand_' . $i . '_logo',
			'label'         => 'Brand ' . $i . ' Logo',
			'name'          => 'brand_' . $i . '_logo',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'thumbnail',
			'instructions'  => 'Upload brand/car manufacturer logo (transparent PNG recommended).',
		);
		$brand_fields[] = array(
			'key'           => 'field_cs_brand_' . $i . '_name',
			'label'         => 'Brand ' . $i . ' Name',
			'name'          => 'brand_' . $i . '_name',
			'type'          => 'text',
			'placeholder'   => 'e.g. Toyota',
		);
	}
	acf_add_local_field_group( array(
		'key'        => 'group_cs_brands',
		'title'      => '🚗 Homepage — Brand Logos Carousel',
		'location'   => $location,
		'menu_order' => 1,
		'fields'     => $brand_fields,
	) );

	/* =========================
	 * HERO SECTION
	 * ========================= */
	acf_add_local_field_group( array(
		'key'        => 'group_cs_hero',
		'title'      => '🏁 Homepage — Hero Section',
		'location'   => $location,
		'menu_order' => 0,
		'fields'     => array(
			array(
				'key'           => 'field_cs_hero_bg',
				'label'         => 'Background Image',
				'name'          => 'hero_background',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
				'instructions'  => 'Used as background when no video is set, or as a poster/fallback image for the video.',
			),
			array(
				'key'              => 'field_cs_hero_video',
				'label'            => 'Background Video (optional)',
				'name'             => 'hero_video',
				'type'             => 'file',
				'return_format'    => 'url',
				'mime_types'       => 'mp4,webm,ogg',
				'instructions'     => 'Upload an MP4 video to use as the hero background. The image above will be used as a poster/fallback. Leave empty to use the image only.',
			),
			array(
				'key'           => 'field_cs_hero_logo',
				'label'         => 'Hero Logo',
				'name'          => 'hero_logo',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'thumbnail',
			),
			array(
				'key'           => 'field_cs_hero_title',
				'label'         => 'Title',
				'name'          => 'hero_title',
				'type'          => 'text',
				'default_value' => 'Dark Skull Autocare',
			),
			array(
				'key'           => 'field_cs_hero_subtitle',
				'label'         => 'Subtitle',
				'name'          => 'hero_subtitle',
				'type'          => 'text',
				'default_value' => 'Professional auto care you can trust',
			),
			array(
				'key'           => 'field_cs_hero_btn_text',
				'label'         => 'Button Text',
				'name'          => 'hero_button_text',
				'type'          => 'text',
				'default_value' => 'Book Now',
			),
			array(
				'key'           => 'field_cs_hero_btn_url',
				'label'         => 'Button URL',
				'name'          => 'hero_button_url',
				'type'          => 'url',
				'default_value' => '/contact',
			),
		),
	) );

	/* =========================
	 * SERVICES SECTION
	 * ========================= */
	$service_fields = array(
		array(
			'key'           => 'field_cs_services_heading',
			'label'         => 'Section Heading',
			'name'          => 'services_heading',
			'type'          => 'text',
			'default_value' => 'Car Repairs',
		),
		array(
			'key'           => 'field_cs_services_btn_text',
			'label'         => 'Button Text',
			'name'          => 'services_button_text',
			'type'          => 'text',
			'default_value' => 'Book Now',
		),
		array(
			'key'           => 'field_cs_services_btn_url',
			'label'         => 'Button URL',
			'name'          => 'services_button_url',
			'type'          => 'url',
			'default_value' => '/contact',
		),
	);

	$service_defaults = array(
		1 => array( 'Car Repairs', '' ),
		2 => array( 'Maintenance Services', '' ),
		3 => array( 'Vehicle Inspections', '' ),
		4 => array( 'Diagnostic Checks', '' ),
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		$service_fields[] = array(
			'key'           => 'field_cs_service_' . $i . '_divider',
			'label'         => '— Service ' . $i,
			'name'          => '',
			'type'          => 'message',
			'message'       => '<strong>Service Card ' . $i . '</strong>',
		);
		$service_fields[] = array(
			'key'           => 'field_cs_service_' . $i . '_title',
			'label'         => 'Title',
			'name'          => 'service_' . $i . '_title',
			'type'          => 'text',
			'default_value' => $service_defaults[ $i ][0],
		);
		$service_fields[] = array(
			'key'           => 'field_cs_service_' . $i . '_desc',
			'label'         => 'Description',
			'name'          => 'service_' . $i . '_description',
			'type'          => 'textarea',
			'rows'          => 3,
		);
	}

	acf_add_local_field_group( array(
		'key'        => 'group_cs_services',
		'title'      => '🔧 Homepage — Services Section',
		'location'   => $location,
		'menu_order' => 2,
		'fields'     => $service_fields,
	) );

	/* =========================
	 * WHY CHOOSE US SECTION
	 * ========================= */
	$why_fields = array(
		array(
			'key'           => 'field_cs_why_tag',
			'label'         => 'Section Tag',
			'name'          => 'why_tag',
			'type'          => 'text',
			'default_value' => 'Why Us',
		),
		array(
			'key'           => 'field_cs_why_heading',
			'label'         => 'Heading',
			'name'          => 'why_heading',
			'type'          => 'text',
			'default_value' => 'Why Choose Dark Skull Autocare?',
		),
		array(
			'key'           => 'field_cs_why_subheading',
			'label'         => 'Subheading',
			'name'          => 'why_subheading',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => 'We go beyond just fixing cars — we build trust with every repair, every service, every time.',
		),
	);

	$why_defaults = array(
		1 => array( '🛡️', 'Certified Technicians', 'Our team of fully certified and experienced mechanics bring expertise to every job.' ),
		2 => array( '⚡', 'Fast Turnaround', 'We respect your time. Most services are completed same-day so you can get back on the road.' ),
		3 => array( '💰', 'Transparent Pricing', 'No hidden fees, no surprises. You get a full quote before any work begins.' ),
		4 => array( '🔧', 'Quality Parts Only', 'We use only OEM and top-grade aftermarket parts to ensure lasting repairs.' ),
		5 => array( '📋', 'Full Service History', 'We maintain a detailed service record for your vehicle with full visibility into what has been done.' ),
		6 => array( '🤝', '12-Month Guarantee', 'All our repairs and services come with a 12-month workmanship guarantee.' ),
	);

	for ( $i = 1; $i <= 6; $i++ ) {
		$why_fields[] = array(
			'key'     => 'field_cs_why_' . $i . '_divider',
			'label'   => '— Reason ' . $i,
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Reason Card ' . $i . '</strong>',
		);
		$why_fields[] = array(
			'key'           => 'field_cs_why_' . $i . '_icon',
			'label'         => 'Icon (emoji)',
			'name'          => 'why_' . $i . '_icon',
			'type'          => 'text',
			'default_value' => $why_defaults[ $i ][0],
		);
		$why_fields[] = array(
			'key'           => 'field_cs_why_' . $i . '_title',
			'label'         => 'Title',
			'name'          => 'why_' . $i . '_title',
			'type'          => 'text',
			'default_value' => $why_defaults[ $i ][1],
		);
		$why_fields[] = array(
			'key'           => 'field_cs_why_' . $i . '_desc',
			'label'         => 'Description',
			'name'          => 'why_' . $i . '_description',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => $why_defaults[ $i ][2],
		);
	}

	acf_add_local_field_group( array(
		'key'        => 'group_cs_why',
		'title'      => '⭐ Homepage — Why Choose Us',
		'location'   => $location,
		'menu_order' => 3,
		'fields'     => $why_fields,
	) );

	/* =========================
	 * CTA SECTION
	 * ========================= */
	acf_add_local_field_group( array(
		'key'        => 'group_cs_cta',
		'title'      => '📣 Homepage — Call To Action',
		'location'   => $location,
		'menu_order' => 4,
		'fields'     => array(
			array(
				'key'           => 'field_cs_cta_heading',
				'label'         => 'Heading',
				'name'          => 'cta_heading',
				'type'          => 'text',
				'default_value' => 'Ready to Service Your Vehicle?',
			),
			array(
				'key'           => 'field_cs_cta_text',
				'label'         => 'Description',
				'name'          => 'cta_text',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => 'Contact us today for professional car maintenance and repair services.',
			),
			array(
				'key'           => 'field_cs_cta_btn_text',
				'label'         => 'Button Text',
				'name'          => 'cta_button_text',
				'type'          => 'text',
				'default_value' => 'Contact Us',
			),
			array(
				'key'           => 'field_cs_cta_btn_url',
				'label'         => 'Button URL',
				'name'          => 'cta_button_url',
				'type'          => 'url',
				'default_value' => '/contact',
			),
			array(
				'key'           => 'field_cs_cta_bg',
				'label'         => 'Background Image (optional)',
				'name'          => 'cta_bg_image',
				'type'          => 'image',
				'return_format' => 'url',
				'instructions'  => 'Upload an image to use as the CTA section background. Leave empty to use the default gradient.',
			),
		),
	) );

	/* =========================
	 * TESTIMONIALS SECTION
	 * ========================= */
	$testimonial_fields = array(
		array(
			'key'           => 'field_cs_test_tag',
			'label'         => 'Section Tag',
			'name'          => 'testimonials_tag',
			'type'          => 'text',
			'default_value' => 'Testimonials',
		),
		array(
			'key'           => 'field_cs_test_heading',
			'label'         => 'Section Heading',
			'name'          => 'testimonials_heading',
			'type'          => 'text',
			'default_value' => 'What Our Customers Say',
		),
		array(
			'key'           => 'field_cs_test_subheading',
			'label'         => 'Subheading',
			'name'          => 'testimonials_subheading',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => 'Real experiences from real customers who trust us with their vehicles.',
		),
	);

	$testimonial_defaults = array(
		1 => array( 'James Whitfield', 'Regular Customer', 5, 'Absolutely brilliant service from start to finish. Brought my BMW in for a full service and the team were incredibly professional. Transparent pricing and they even gave me a call mid-way to explain what they found. Will never go anywhere else.' ),
		2 => array( 'Sarah Mitchell', 'New Customer', 5, 'Fixed my brakes same day! I was really stressed about the noise my car was making, but the team put me at ease straight away. Fair price too.' ),
		3 => array( 'Derek Thompson', 'Fleet Manager', 5, 'We use Dark Skull Autocare for our entire company fleet of 12 vehicles. The turnaround times are excellent and the quality of work is consistently outstanding. Highly recommend for business fleet management.' ),
		4 => array( 'Priya Sharma', 'Loyal Customer', 4, 'Great experience overall. The technician explained everything clearly and the car feels like new after the service. Booking was easy and they were ready for me on arrival.' ),
		5 => array( 'Marcus Brown', 'First-Time Visitor', 5, 'Took my Audi in after another garage quoted me an extortionate amount. Dark Skull fixed the issue for half the price and in half the time. Honest, skilled, and friendly — what more do you want?' ),
		6 => array( 'Claire Johnson', 'Regular Customer', 5, 'I have been coming here for three years and the quality never drops. They remembered details about my car from previous visits which really impressed me. The 12-month guarantee gives me total peace of mind.' ),
	);

	for ( $i = 1; $i <= 6; $i++ ) {
		$testimonial_fields[] = array(
			'key'     => 'field_cs_test_' . $i . '_divider',
			'label'   => '— Testimonial ' . $i,
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Testimonial ' . $i . '</strong>',
		);
		$testimonial_fields[] = array(
			'key'           => 'field_cs_test_' . $i . '_name',
			'label'         => 'Customer Name',
			'name'          => 'testimonial_' . $i . '_name',
			'type'          => 'text',
			'default_value' => $testimonial_defaults[ $i ][0],
		);
		$testimonial_fields[] = array(
			'key'           => 'field_cs_test_' . $i . '_role',
			'label'         => 'Role / Status',
			'name'          => 'testimonial_' . $i . '_role',
			'type'          => 'text',
			'default_value' => $testimonial_defaults[ $i ][1],
		);
		$testimonial_fields[] = array(
			'key'           => 'field_cs_test_' . $i . '_rating',
			'label'         => 'Rating (1–5)',
			'name'          => 'testimonial_' . $i . '_rating',
			'type'          => 'number',
			'min'           => 1,
			'max'           => 5,
			'default_value' => $testimonial_defaults[ $i ][2],
		);
		$testimonial_fields[] = array(
			'key'           => 'field_cs_test_' . $i . '_text',
			'label'         => 'Testimonial Text',
			'name'          => 'testimonial_' . $i . '_text',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => $testimonial_defaults[ $i ][3],
		);
	}

	/* =========================
	 * SOCIAL MEDIA LINKS
	 * (attached to front page so admin edits from one place)
	 * ========================= */
	acf_add_local_field_group( array(
		'key'        => 'group_cs_social',
		'title'      => '📱 Social Media Links',
		'location'   => $location,
		'menu_order' => 6,
		'fields'     => array(
			array(
				'key'          => 'field_social_note',
				'label'        => '',
				'name'         => '',
				'type'         => 'message',
				'message'      => 'These links appear as icons in the footer copyright bar. Leave blank to hide an icon.',
			),
			array( 'key' => 'field_social_facebook',  'label' => 'Facebook URL',  'name' => 'social_facebook',  'type' => 'url' ),
			array( 'key' => 'field_social_instagram', 'label' => 'Instagram URL', 'name' => 'social_instagram', 'type' => 'url' ),
			array( 'key' => 'field_social_twitter',   'label' => 'X / Twitter URL','name' => 'social_twitter',  'type' => 'url' ),
			array( 'key' => 'field_social_youtube',   'label' => 'YouTube URL',   'name' => 'social_youtube',   'type' => 'url' ),
			array( 'key' => 'field_social_tiktok',    'label' => 'TikTok URL',    'name' => 'social_tiktok',    'type' => 'url' ),
		),
	) );

	acf_add_local_field_group( array(
		'key'        => 'group_cs_testimonials',
		'title'      => '💬 Homepage — Testimonials',
		'location'   => $location,
		'menu_order' => 5,
		'fields'     => $testimonial_fields,
	) );

	/* =========================
	 * BOOK NOW MODAL (site-wide)
	 * ========================= */
	acf_add_local_field_group( array(
		'key'        => 'group_cs_book_now',
		'title'      => '📅 Book Now Modal (site-wide)',
		'location'   => $location,
		'menu_order' => 99,
		'fields'     => array(
			array(
				'key'           => 'field_cs_book_now_title',
				'label'         => 'Modal Heading',
				'name'          => 'book_now_title',
				'type'          => 'text',
				'default_value' => 'Book Your Appointment',
				'instructions'  => 'Heading displayed at the top of the Book Now popup.',
			),
			array(
				'key'           => 'field_cs_book_now_subtitle',
				'label'         => 'Modal Subheading',
				'name'          => 'book_now_subtitle',
				'type'          => 'text',
				'default_value' => 'Tell us what you need and our team will get back to you within 24 hours.',
			),
			array(
				'key'           => 'field_cs_book_now_shortcode',
				'label'         => 'Form Shortcode',
				'name'          => 'book_now_shortcode',
				'type'          => 'textarea',
				'rows'          => 2,
				'instructions'  => 'Paste any contact-form shortcode (Contact Form 7, WPForms, Gravity Forms, Fluent Forms, etc.) e.g. <code>[contact-form-7 id="123"]</code>. Leave blank to show the built-in fallback form.',
			),
		),
	) );

	/* =========================
	 * ABOUT US PAGE
	 * ========================= */
	$location_about = array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-about.php',
			),
		),
	);

	// Banner fields
	$about_fields = array(
		array(
			'key'           => 'field_about_banner_title',
			'label'         => 'Banner Title',
			'name'          => 'about_banner_title',
			'type'          => 'text',
			'default_value' => 'About Us',
		),
		array(
			'key'           => 'field_about_banner_subtitle',
			'label'         => 'Banner Subtitle',
			'name'          => 'about_banner_subtitle',
			'type'          => 'text',
			'default_value' => 'The team behind Dark Skull Autocare',
		),
		array(
			'key'           => 'field_about_banner_bg',
			'label'         => 'Banner Background Image',
			'name'          => 'about_banner_bg',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'medium',
		),

		// Story section
		array(
			'key'     => 'field_about_story_divider',
			'label'   => '— Our Story Section',
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Our Story</strong>',
		),
		array(
			'key'           => 'field_about_story_tag',
			'label'         => 'Section Tag',
			'name'          => 'about_story_tag',
			'type'          => 'text',
			'default_value' => 'Our Story',
		),
		array(
			'key'           => 'field_about_story_heading',
			'label'         => 'Heading',
			'name'          => 'about_story_heading',
			'type'          => 'text',
			'default_value' => 'Built on Passion, Driven by Trust',
		),
		array(
			'key'           => 'field_about_story_content',
			'label'         => 'Story Text (separate paragraphs with a blank line)',
			'name'          => 'about_story_content',
			'type'          => 'textarea',
			'rows'          => 8,
		),
		array(
			'key'           => 'field_about_story_image',
			'label'         => 'Story Image',
			'name'          => 'about_story_image',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'medium',
		),

		// Stats section
		array(
			'key'     => 'field_about_stats_divider',
			'label'   => '— Stats Bar',
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Stats Bar (4 figures)</strong>',
		),
	);

	$stat_defaults = array(
		1 => array( '15+', 'Years Experience' ),
		2 => array( '8,500+', 'Cars Serviced' ),
		3 => array( '12', 'Certified Technicians' ),
		4 => array( '99%', 'Customer Satisfaction' ),
	);
	for ( $i = 1; $i <= 4; $i++ ) {
		$about_fields[] = array(
			'key'           => 'field_about_stat_' . $i . '_number',
			'label'         => 'Stat ' . $i . ' — Number',
			'name'          => 'about_stat_' . $i . '_number',
			'type'          => 'text',
			'default_value' => $stat_defaults[ $i ][0],
		);
		$about_fields[] = array(
			'key'           => 'field_about_stat_' . $i . '_label',
			'label'         => 'Stat ' . $i . ' — Label',
			'name'          => 'about_stat_' . $i . '_label',
			'type'          => 'text',
			'default_value' => $stat_defaults[ $i ][1],
		);
	}

	// Values section
	$about_fields[] = array(
		'key'     => 'field_about_values_divider',
		'label'   => '— Core Values',
		'name'    => '',
		'type'    => 'message',
		'message' => '<strong>Core Values (3 cards)</strong>',
	);
	$about_fields[] = array(
		'key'           => 'field_about_values_tag',
		'label'         => 'Section Tag',
		'name'          => 'about_values_tag',
		'type'          => 'text',
		'default_value' => 'What We Stand For',
	);
	$about_fields[] = array(
		'key'           => 'field_about_values_heading',
		'label'         => 'Section Heading',
		'name'          => 'about_values_heading',
		'type'          => 'text',
		'default_value' => 'Our Core Values',
	);

	$value_defaults = array(
		1 => array( '🎯', 'Integrity First', 'We give you the truth about your vehicle — always. No made-up faults, no inflated estimates.' ),
		2 => array( '🔩', 'Expert Craftsmanship', 'Every technician is fully trained and takes pride in every single job, big or small.' ),
		3 => array( '❤️', 'Customer First', 'Your experience matters. From your first call to collecting your keys, we make it simple.' ),
	);
	for ( $i = 1; $i <= 3; $i++ ) {
		$about_fields[] = array(
			'key'     => 'field_about_value_' . $i . '_divider',
			'label'   => 'Value ' . $i,
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Value Card ' . $i . '</strong>',
		);
		$about_fields[] = array(
			'key'           => 'field_about_value_' . $i . '_icon',
			'label'         => 'Icon (emoji)',
			'name'          => 'about_value_' . $i . '_icon',
			'type'          => 'text',
			'default_value' => $value_defaults[ $i ][0],
		);
		$about_fields[] = array(
			'key'           => 'field_about_value_' . $i . '_title',
			'label'         => 'Title',
			'name'          => 'about_value_' . $i . '_title',
			'type'          => 'text',
			'default_value' => $value_defaults[ $i ][1],
		);
		$about_fields[] = array(
			'key'           => 'field_about_value_' . $i . '_description',
			'label'         => 'Description',
			'name'          => 'about_value_' . $i . '_description',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => $value_defaults[ $i ][2],
		);
	}

	// Team section
	$about_fields[] = array(
		'key'     => 'field_about_team_divider',
		'label'   => '— Team',
		'name'    => '',
		'type'    => 'message',
		'message' => '<strong>Team Members (4 cards)</strong>',
	);
	$about_fields[] = array(
		'key'           => 'field_about_team_tag',
		'label'         => 'Section Tag',
		'name'          => 'about_team_tag',
		'type'          => 'text',
		'default_value' => 'Meet the Team',
	);
	$about_fields[] = array(
		'key'           => 'field_about_team_heading',
		'label'         => 'Section Heading',
		'name'          => 'about_team_heading',
		'type'          => 'text',
		'default_value' => 'The People Behind the Wrenches',
	);

	$team_defaults = array(
		1 => array( 'Marcus Reid', 'Lead Technician & Founder', 'Over 20 years of hands-on experience. Marcus built this garage from the ground up.' ),
		2 => array( 'Jordan Blake', 'Senior Mechanic', 'Specialises in diagnostics and electrical systems.' ),
		3 => array( 'Priya Nair', 'Service Advisor', 'Keeping communication clear, bookings smooth, and customers happy.' ),
		4 => array( 'Danny Walsh', 'MOT Tester & Technician', 'Certified MOT tester with an eye for detail.' ),
	);
	for ( $i = 1; $i <= 4; $i++ ) {
		$about_fields[] = array(
			'key'     => 'field_about_team_' . $i . '_divider',
			'label'   => 'Team Member ' . $i,
			'name'    => '',
			'type'    => 'message',
			'message' => '<strong>Team Member ' . $i . '</strong>',
		);
		$about_fields[] = array(
			'key'           => 'field_about_team_' . $i . '_name',
			'label'         => 'Name',
			'name'          => 'about_team_' . $i . '_name',
			'type'          => 'text',
			'default_value' => $team_defaults[ $i ][0],
		);
		$about_fields[] = array(
			'key'           => 'field_about_team_' . $i . '_role',
			'label'         => 'Role / Position',
			'name'          => 'about_team_' . $i . '_role',
			'type'          => 'text',
			'default_value' => $team_defaults[ $i ][1],
		);
		$about_fields[] = array(
			'key'           => 'field_about_team_' . $i . '_image',
			'label'         => 'Photo',
			'name'          => 'about_team_' . $i . '_image',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'thumbnail',
		);
		$about_fields[] = array(
			'key'           => 'field_about_team_' . $i . '_bio',
			'label'         => 'Short Bio',
			'name'          => 'about_team_' . $i . '_bio',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => $team_defaults[ $i ][2],
		);
	}

	// CTA
	$about_fields[] = array(
		'key'     => 'field_about_cta_divider',
		'label'   => '— Bottom CTA',
		'name'    => '',
		'type'    => 'message',
		'message' => '<strong>Call to Action</strong>',
	);
	$about_fields[] = array(
		'key'           => 'field_about_cta_heading',
		'label'         => 'CTA Heading',
		'name'          => 'about_cta_heading',
		'type'          => 'text',
		'default_value' => 'Ready to Book Your Service?',
	);
	$about_fields[] = array(
		'key'           => 'field_about_cta_text',
		'label'         => 'CTA Text',
		'name'          => 'about_cta_text',
		'type'          => 'text',
		'default_value' => 'Get in touch with our team today — we are always happy to help.',
	);
	$about_fields[] = array(
		'key'           => 'field_about_cta_btn_text',
		'label'         => 'Button Text',
		'name'          => 'about_cta_btn_text',
		'type'          => 'text',
		'default_value' => 'Contact Us',
	);
	$about_fields[] = array(
		'key'           => 'field_about_cta_btn_url',
		'label'         => 'Button URL',
		'name'          => 'about_cta_btn_url',
		'type'          => 'url',
		'default_value' => '/contact',
	);
	$about_fields[] = array(
		'key'           => 'field_about_cta_bg',
		'label'         => 'CTA Background Image (optional)',
		'name'          => 'about_cta_bg_image',
		'type'          => 'image',
		'return_format' => 'url',
		'instructions'  => 'Upload an image for the CTA background. Leave empty to use the default gradient.',
	);

	acf_add_local_field_group( array(
		'key'        => 'group_cs_about',
		'title'      => '🏢 About Us Page',
		'location'   => $location_about,
		'menu_order' => 0,
		'fields'     => $about_fields,
	) );

	/* =========================
	 * CONTACT US PAGE
	 * ========================= */
	$location_contact = array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-contact.php',
			),
		),
	);

	acf_add_local_field_group( array(
		'key'        => 'group_cs_contact',
		'title'      => '📞 Contact Us Page',
		'location'   => $location_contact,
		'menu_order' => 0,
		'fields'     => array(

			// Banner
			array(
				'key'           => 'field_contact_banner_title',
				'label'         => 'Banner Title',
				'name'          => 'contact_banner_title',
				'type'          => 'text',
				'default_value' => 'Contact Us',
			),
			array(
				'key'           => 'field_contact_banner_subtitle',
				'label'         => 'Banner Subtitle',
				'name'          => 'contact_banner_subtitle',
				'type'          => 'text',
				'default_value' => 'We are here to help — get in touch with our team today',
			),
			array(
				'key'           => 'field_contact_banner_bg',
				'label'         => 'Banner Background Image',
				'name'          => 'contact_banner_bg',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
			),

			// Contact Info
			array(
				'key'     => 'field_contact_info_divider',
				'label'   => '— Contact Information',
				'name'    => '',
				'type'    => 'message',
				'message' => '<strong>Contact Details</strong>',
			),
			array(
				'key'           => 'field_contact_address',
				'label'         => 'Address',
				'name'          => 'contact_address',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => '14 Skull Lane, Birmingham, B1 2XY',
			),
			array(
				'key'           => 'field_contact_phone',
				'label'         => 'Phone Number',
				'name'          => 'contact_phone',
				'type'          => 'text',
				'default_value' => '0121 456 7890',
			),
			array(
				'key'           => 'field_contact_email',
				'label'         => 'Email Address',
				'name'          => 'contact_email',
				'type'          => 'email',
				'default_value' => 'hello@darkskullautocare.co.uk',
			),
			array(
				'key'           => 'field_contact_hours',
				'label'         => 'Opening Hours (one line per day)',
				'name'          => 'contact_hours',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => "Monday – Friday: 8:00am – 6:00pm\nSaturday: 9:00am – 4:00pm\nSunday: Closed",
			),

			// Form
			array(
				'key'     => 'field_contact_form_divider',
				'label'   => '— Contact Form',
				'name'    => '',
				'type'    => 'message',
				'message' => '<strong>Contact Form</strong><br>Paste a Contact Form 7 or WPForms shortcode below to replace the built-in form. Leave blank to use the default form.',
			),
			array(
				'key'           => 'field_contact_form_heading',
				'label'         => 'Form Heading',
				'name'          => 'contact_form_heading',
				'type'          => 'text',
				'default_value' => 'Send Us a Message',
			),
			array(
				'key'           => 'field_contact_form_subheading',
				'label'         => 'Form Subheading',
				'name'          => 'contact_form_subheading',
				'type'          => 'text',
				'default_value' => 'Fill in the form below and we will get back to you within 24 hours.',
			),
			array(
				'key'          => 'field_contact_form_shortcode',
				'label'        => 'Form Plugin Shortcode (optional)',
				'name'         => 'contact_form_shortcode',
				'type'         => 'text',
				'instructions' => 'e.g. [contact-form-7 id="123"] or [wpforms id="456"]',
			),

			// Map
			array(
				'key'     => 'field_contact_map_divider',
				'label'   => '— Map',
				'name'    => '',
				'type'    => 'message',
				'message' => '<strong>Google Maps Embed</strong><br>Paste the full &lt;iframe&gt; embed code from Google Maps.',
			),
			array(
				'key'          => 'field_contact_map_embed',
				'label'        => 'Map Embed Code',
				'name'         => 'contact_map_embed',
				'type'         => 'textarea',
				'rows'         => 5,
				'instructions' => 'Go to Google Maps → Share → Embed a map → copy the iframe code.',
			),
		),
	) );

	/* =========================
	 * SERVICES PAGE
	 * ========================= */
	$location_services = array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ) );

	$srv_fields = array(
		array( 'key' => 'field_srv_banner_title',    'label' => 'Banner Title',            'name' => 'srv_banner_title',    'type' => 'text',  'default_value' => 'Our Services' ),
		array( 'key' => 'field_srv_banner_subtitle', 'label' => 'Banner Subtitle',         'name' => 'srv_banner_subtitle', 'type' => 'text',  'default_value' => 'Everything your vehicle needs — under one roof' ),
		array( 'key' => 'field_srv_banner_bg',       'label' => 'Banner Background Image', 'name' => 'srv_banner_bg',       'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ),
		array( 'key' => 'field_srv_intro_div',       'label' => '— Intro',                 'name' => '',                    'type' => 'message', 'message' => '<strong>Intro Section</strong>' ),
		array( 'key' => 'field_srv_intro_tag',       'label' => 'Section Tag',             'name' => 'srv_intro_tag',       'type' => 'text',  'default_value' => 'What We Do' ),
		array( 'key' => 'field_srv_intro_heading',   'label' => 'Heading',                 'name' => 'srv_intro_heading',   'type' => 'text',  'default_value' => 'Full-Range Automotive Care' ),
		array( 'key' => 'field_srv_intro_text',      'label' => 'Intro Text',              'name' => 'srv_intro_text',      'type' => 'textarea', 'rows' => 3 ),
	);

	$srv_card_defaults = array(
		1 => array( '🔧', 'Car Repairs',          'From minor fixes to major mechanical work, our technicians diagnose and repair all vehicle types.' ),
		2 => array( '🛠️', 'Maintenance Services',  'Regular servicing keeps your vehicle running at its best. We follow manufacturer schedules.' ),
		3 => array( '🔍', 'Vehicle Inspections',   'Pre-purchase, pre-MOT, or peace-of-mind checks — our thorough inspections give you the full picture.' ),
		4 => array( '💻', 'Diagnostic Checks',     'State-of-the-art diagnostic equipment reads fault codes across all systems quickly and accurately.' ),
		5 => array( '📋', 'MOT Testing',           'Fully authorised MOT testing station. Test, advice, and same-day remedial work available.' ),
		6 => array( '🚗', 'Tyre Services',         'Supply and fitting of all major tyre brands, puncture repairs, wheel balancing, and TPMS.' ),
	);
	$srv_fields[] = array( 'key' => 'field_srv_cards_div', 'label' => '— Service Cards', 'name' => '', 'type' => 'message', 'message' => '<strong>Service Cards (6)</strong>' );
	for ( $i = 1; $i <= 6; $i++ ) {
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_div',  'label' => 'Card ' . $i,       'name' => '',                                'type' => 'message',  'message' => '<strong>Service Card ' . $i . '</strong>' );
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_icon', 'label' => 'Icon (emoji)',      'name' => 'srv_card_' . $i . '_icon',        'type' => 'text',     'default_value' => $srv_card_defaults[ $i ][0] );
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_ttl',  'label' => 'Title',             'name' => 'srv_card_' . $i . '_title',       'type' => 'text',     'default_value' => $srv_card_defaults[ $i ][1] );
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_dsc',  'label' => 'Description',       'name' => 'srv_card_' . $i . '_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => $srv_card_defaults[ $i ][2] );
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_lbt',  'label' => 'Button Text',       'name' => 'srv_card_' . $i . '_link_text',   'type' => 'text',     'default_value' => 'Book Now' );
		$srv_fields[] = array( 'key' => 'field_srv_card_' . $i . '_lbu',  'label' => 'Button URL',        'name' => 'srv_card_' . $i . '_link_url',    'type' => 'url',      'default_value' => '/contact' );
	}

	$srv_step_defaults = array(
		1 => array( 'Book Online or Call',   'Choose a service and book at a time that suits you.' ),
		2 => array( 'Drop Off Your Vehicle', 'Bring your car in. Our team will confirm the work needed.' ),
		3 => array( 'We Get to Work',        'Our technicians carry out the job using quality parts.' ),
		4 => array( 'Collect & Drive Away',  'Pick up your vehicle — backed by our 12-month guarantee.' ),
	);
	$srv_fields[] = array( 'key' => 'field_srv_steps_div',     'label' => '— How It Works', 'name' => '', 'type' => 'message', 'message' => '<strong>How It Works (4 steps)</strong>' );
	$srv_fields[] = array( 'key' => 'field_srv_steps_tag',     'label' => 'Section Tag',    'name' => 'srv_steps_tag',     'type' => 'text', 'default_value' => 'The Process' );
	$srv_fields[] = array( 'key' => 'field_srv_steps_heading', 'label' => 'Heading',        'name' => 'srv_steps_heading', 'type' => 'text', 'default_value' => 'How It Works' );
	for ( $i = 1; $i <= 4; $i++ ) {
		$srv_fields[] = array( 'key' => 'field_srv_step_' . $i . '_div', 'label' => 'Step ' . $i,    'name' => '',                                'type' => 'message',  'message' => '<strong>Step ' . $i . '</strong>' );
		$srv_fields[] = array( 'key' => 'field_srv_step_' . $i . '_ttl', 'label' => 'Title',         'name' => 'srv_step_' . $i . '_title',       'type' => 'text',     'default_value' => $srv_step_defaults[ $i ][0] );
		$srv_fields[] = array( 'key' => 'field_srv_step_' . $i . '_dsc', 'label' => 'Description',   'name' => 'srv_step_' . $i . '_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => $srv_step_defaults[ $i ][1] );
	}
	// FAQ Section
	$srv_faq_defaults = array(
		1 => array( 'How do I book a service?',               'You can book online using our contact form, call us directly, or simply drop in during business hours and our team will get you sorted.' ),
		2 => array( 'How long does a standard service take?', 'A standard service typically takes 1.5–2 hours. More complex work such as diagnostics or major repairs may take longer — we will always give you an honest time estimate upfront.' ),
		3 => array( 'Do you offer a guarantee on work done?', 'Yes. All workmanship carried out by our team is covered by a 12-month guarantee. If an issue arises with work we have completed, bring it back and we will fix it at no extra charge.' ),
		4 => array( 'Will you use genuine manufacturer parts?', 'We use quality OEM-equivalent or genuine parts depending on your preference and vehicle requirements. We will always discuss part options with you before proceeding.' ),
		5 => array( 'Can I wait while my car is being serviced?', 'Yes, we have a comfortable waiting area with Wi-Fi and refreshments. For longer jobs we can arrange a courtesy vehicle or local drop-off — just let us know when booking.' ),
		6 => array( 'Do you work on all makes and models?',   'Yes. Our technicians are trained across all major makes and models, from small city cars to large SUVs and commercial vehicles.' ),
	);
	$srv_fields[] = array( 'key' => 'field_srv_faq_div',     'label' => '— FAQ',          'name' => '',              'type' => 'message', 'message' => '<strong>FAQ Section</strong>' );
	$srv_fields[] = array( 'key' => 'field_srv_faq_tag',     'label' => 'Section Tag',    'name' => 'srv_faq_tag',     'type' => 'text', 'default_value' => 'FAQ' );
	$srv_fields[] = array( 'key' => 'field_srv_faq_heading', 'label' => 'Section Heading','name' => 'srv_faq_heading', 'type' => 'text', 'default_value' => 'Frequently Asked Questions' );
	for ( $i = 1; $i <= 8; $i++ ) {
		$q_default = isset( $srv_faq_defaults[ $i ] ) ? $srv_faq_defaults[ $i ][0] : '';
		$a_default = isset( $srv_faq_defaults[ $i ] ) ? $srv_faq_defaults[ $i ][1] : '';
		$srv_fields[] = array( 'key' => 'field_srv_faq_' . $i . '_div', 'label' => 'FAQ ' . $i,   'name' => '', 'type' => 'message', 'message' => '<strong>FAQ Item ' . $i . '</strong>' );
		$srv_fields[] = array( 'key' => 'field_srv_faq_' . $i . '_q',   'label' => 'Question',    'name' => 'srv_faq_' . $i . '_question', 'type' => 'text',     'default_value' => $q_default );
		$srv_fields[] = array( 'key' => 'field_srv_faq_' . $i . '_a',   'label' => 'Answer',      'name' => 'srv_faq_' . $i . '_answer',   'type' => 'textarea', 'rows' => 3, 'default_value' => $a_default );
	}

	$srv_fields[] = array( 'key' => 'field_srv_cta_div',      'label' => '— CTA',       'name' => '',                 'type' => 'message', 'message' => '<strong>Call to Action</strong>' );
	$srv_fields[] = array( 'key' => 'field_srv_cta_heading',  'label' => 'Heading',     'name' => 'srv_cta_heading',  'type' => 'text', 'default_value' => 'Ready to Book Your Service?' );
	$srv_fields[] = array( 'key' => 'field_srv_cta_text',     'label' => 'Text',        'name' => 'srv_cta_text',     'type' => 'text', 'default_value' => 'Contact us today and our team will get you booked in.' );
	$srv_fields[] = array( 'key' => 'field_srv_cta_btn_text', 'label' => 'Button Text', 'name' => 'srv_cta_btn_text', 'type' => 'text', 'default_value' => 'Contact Us' );
	$srv_fields[] = array( 'key' => 'field_srv_cta_btn_url',  'label' => 'Button URL',  'name' => 'srv_cta_btn_url',  'type' => 'url',  'default_value' => '/contact' );
	$srv_fields[] = array( 'key' => 'field_srv_cta_bg', 'label' => 'CTA Background Image (optional)', 'name' => 'srv_cta_bg_image', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Upload an image for the CTA background. Leave empty to use the default gradient.' );

	acf_add_local_field_group( array(
		'key'        => 'group_cs_services_page',
		'title'      => '🔧 Services Page',
		'location'   => $location_services,
		'menu_order' => 0,
		'fields'     => $srv_fields,
	) );

	/* =========================
	 * INSPECTION PAGE
	 * ========================= */
	$location_inspection = array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-inspection.php' ) ) );

	$insp_fields = array(
		array( 'key' => 'field_insp_banner_title',    'label' => 'Banner Title',            'name' => 'insp_banner_title',    'type' => 'text',  'default_value' => 'Vehicle Inspections' ),
		array( 'key' => 'field_insp_banner_subtitle', 'label' => 'Banner Subtitle',         'name' => 'insp_banner_subtitle', 'type' => 'text',  'default_value' => 'Comprehensive checks to keep you safe and roadworthy' ),
		array( 'key' => 'field_insp_banner_bg',       'label' => 'Banner Background Image', 'name' => 'insp_banner_bg',       'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ),
		array( 'key' => 'field_insp_intro_div',       'label' => '— Intro',                 'name' => '',                     'type' => 'message', 'message' => '<strong>Intro Section</strong>' ),
		array( 'key' => 'field_insp_intro_tag',       'label' => 'Section Tag',             'name' => 'insp_intro_tag',       'type' => 'text',     'default_value' => 'About Our Inspections' ),
		array( 'key' => 'field_insp_intro_heading',   'label' => 'Heading',                 'name' => 'insp_intro_heading',   'type' => 'text',     'default_value' => 'Why a Vehicle Inspection Matters' ),
		array( 'key' => 'field_insp_intro_text',      'label' => 'Text',                    'name' => 'insp_intro_text',      'type' => 'textarea', 'rows' => 4 ),
		array( 'key' => 'field_insp_intro_image',     'label' => 'Intro Image',             'name' => 'insp_intro_image',     'type' => 'image',    'return_format' => 'url', 'preview_size' => 'medium' ),
	);

	$check_defaults = array(
		1 => 'Engine condition & oil levels', 2 => 'Brake pads, discs & fluid',
		3 => 'Tyre tread depth & pressure',   4 => 'Steering & suspension',
		5 => 'Battery condition & charging',  6 => 'Lights, indicators & horn',
		7 => 'Exhaust system & emissions',    8 => 'Coolant & fluid levels',
		9 => 'Windscreen & wipers',           10 => 'Seatbelts & airbag warning lights',
		11 => 'Drive shafts & CV joints',     12 => 'Full OBD diagnostic scan',
	);
	$insp_fields[] = array( 'key' => 'field_insp_chk_div',     'label' => '— Checklist',     'name' => '', 'type' => 'message', 'message' => '<strong>What We Check (12 items)</strong>' );
	$insp_fields[] = array( 'key' => 'field_insp_chk_tag',     'label' => 'Section Tag',     'name' => 'insp_checklist_tag',     'type' => 'text', 'default_value' => 'What We Cover' );
	$insp_fields[] = array( 'key' => 'field_insp_chk_heading', 'label' => 'Section Heading', 'name' => 'insp_checklist_heading', 'type' => 'text', 'default_value' => 'Our Multi-Point Inspection' );
	$insp_fields[] = array( 'key' => 'field_insp_chk_sub',     'label' => 'Subheading',      'name' => 'insp_checklist_sub',     'type' => 'text', 'default_value' => 'Every inspection covers all major vehicle systems — nothing is overlooked.' );
	for ( $i = 1; $i <= 12; $i++ ) {
		$insp_fields[] = array( 'key' => 'field_insp_check_' . $i, 'label' => 'Check Item ' . $i, 'name' => 'insp_check_' . $i, 'type' => 'text', 'default_value' => $check_defaults[ $i ] );
	}

	$pkg_defaults = array(
		1 => array( 'Basic Check',        '£39', '45 mins', "Visual exterior inspection\nTyre check\nLights & signals\nFluid levels\nBasic OBD scan",                                                         false, 'Book Basic' ),
		2 => array( 'Full Inspection',    '£79', '90 mins', "Everything in Basic\nBrakes & suspension\nEngine & transmission\nExhaust & emissions\nDetailed written report\nPhotographed findings",            true,  'Book Full' ),
		3 => array( 'Pre-Purchase Check', '£99', '2 hours', "Everything in Full\nVehicle history check\nFrame & chassis inspection\nEstimated repair costs\nVerbal walkthrough\nPriority booking",             false, 'Book Pre-Purchase' ),
	);
	$insp_fields[] = array( 'key' => 'field_insp_pkg_div',     'label' => '— Packages',      'name' => '', 'type' => 'message', 'message' => '<strong>Inspection Packages (3)</strong>' );
	$insp_fields[] = array( 'key' => 'field_insp_pkg_tag',     'label' => 'Section Tag',     'name' => 'insp_packages_tag',     'type' => 'text', 'default_value' => 'Inspection Packages' );
	$insp_fields[] = array( 'key' => 'field_insp_pkg_heading', 'label' => 'Section Heading', 'name' => 'insp_packages_heading', 'type' => 'text', 'default_value' => 'Choose Your Inspection' );
	$insp_fields[] = array( 'key' => 'field_insp_pkg_sub',     'label' => 'Subheading',      'name' => 'insp_packages_sub',     'type' => 'text', 'default_value' => 'All packages include a written report. No hidden charges.' );
	for ( $i = 1; $i <= 3; $i++ ) {
		$d = $pkg_defaults[ $i ];
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_div',      'label' => 'Package ' . $i,          'name' => '',                               'type' => 'message',   'message' => '<strong>Package ' . $i . '</strong>' );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_name',     'label' => 'Package Name',           'name' => 'insp_pkg_' . $i . '_name',       'type' => 'text',      'default_value' => $d[0] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_price',    'label' => 'Price',                  'name' => 'insp_pkg_' . $i . '_price',      'type' => 'text',      'default_value' => $d[1] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_duration', 'label' => 'Duration',               'name' => 'insp_pkg_' . $i . '_duration',   'type' => 'text',      'default_value' => $d[2] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_features', 'label' => 'Features (one per line)','name' => 'insp_pkg_' . $i . '_features',   'type' => 'textarea',  'rows' => 6, 'default_value' => $d[3] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_featured', 'label' => 'Mark as Featured?',      'name' => 'insp_pkg_' . $i . '_featured',   'type' => 'true_false','default_value' => $d[4] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_btn_text', 'label' => 'Button Text',            'name' => 'insp_pkg_' . $i . '_btn_text',   'type' => 'text',      'default_value' => $d[5] );
		$insp_fields[] = array( 'key' => 'field_insp_pkg_' . $i . '_btn_url',  'label' => 'Button URL',             'name' => 'insp_pkg_' . $i . '_btn_url',    'type' => 'url',       'default_value' => '/contact' );
	}

	$insp_step_defaults = array(
		1 => array( 'Book Your Slot',      'Choose a package and book online or by phone.' ),
		2 => array( 'Drop Off Your Car',   'Arrive at your booked time. Our team notes your concerns.' ),
		3 => array( 'Thorough Inspection', 'Our technician carries out the full check with photographs.' ),
		4 => array( 'Receive Your Report', 'We walk you through results and provide a written report.' ),
	);
	$insp_fields[] = array( 'key' => 'field_insp_steps_div',     'label' => '— Process Steps', 'name' => '', 'type' => 'message', 'message' => '<strong>What Happens on the Day (4 steps)</strong>' );
	$insp_fields[] = array( 'key' => 'field_insp_steps_tag',     'label' => 'Section Tag',    'name' => 'insp_steps_tag',     'type' => 'text', 'default_value' => 'The Process' );
	$insp_fields[] = array( 'key' => 'field_insp_steps_heading', 'label' => 'Heading',        'name' => 'insp_steps_heading', 'type' => 'text', 'default_value' => 'What Happens on the Day' );
	for ( $i = 1; $i <= 4; $i++ ) {
		$insp_fields[] = array( 'key' => 'field_insp_step_' . $i . '_div', 'label' => 'Step ' . $i,    'name' => '',                                 'type' => 'message',  'message' => '<strong>Step ' . $i . '</strong>' );
		$insp_fields[] = array( 'key' => 'field_insp_step_' . $i . '_ttl', 'label' => 'Title',         'name' => 'insp_step_' . $i . '_title',       'type' => 'text',     'default_value' => $insp_step_defaults[ $i ][0] );
		$insp_fields[] = array( 'key' => 'field_insp_step_' . $i . '_dsc', 'label' => 'Description',   'name' => 'insp_step_' . $i . '_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => $insp_step_defaults[ $i ][1] );
	}
	$insp_fields[] = array( 'key' => 'field_insp_cta_div',      'label' => '— CTA',       'name' => '',                  'type' => 'message', 'message' => '<strong>Call to Action</strong>' );
	$insp_fields[] = array( 'key' => 'field_insp_cta_heading',  'label' => 'Heading',     'name' => 'insp_cta_heading',  'type' => 'text', 'default_value' => 'Book Your Inspection Today' );
	$insp_fields[] = array( 'key' => 'field_insp_cta_text',     'label' => 'Text',        'name' => 'insp_cta_text',     'type' => 'text', 'default_value' => 'Drive away with full confidence. Our team is ready to give your vehicle the thorough check it deserves.' );
	$insp_fields[] = array( 'key' => 'field_insp_cta_btn_text', 'label' => 'Button Text', 'name' => 'insp_cta_btn_text', 'type' => 'text', 'default_value' => 'Book Now' );
	$insp_fields[] = array( 'key' => 'field_insp_cta_btn_url',  'label' => 'Button URL',  'name' => 'insp_cta_btn_url',  'type' => 'url',  'default_value' => '/contact' );
	$insp_fields[] = array( 'key' => 'field_insp_cta_bg', 'label' => 'CTA Background Image (optional)', 'name' => 'insp_cta_bg_image', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Upload an image for the CTA background. Leave empty to use the default gradient.' );

	acf_add_local_field_group( array(
		'key'        => 'group_cs_inspection_page',
		'title'      => '🔍 Vehicle Inspection Page',
		'location'   => $location_inspection,
		'menu_order' => 0,
		'fields'     => $insp_fields,
	) );
}

/**
 * Admin notice if ACF is not active.
 */
add_action( 'admin_notices', 'car_services_acf_admin_notice' );
function car_services_acf_admin_notice() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}
	echo wp_kses(
		'<div class="notice notice-warning"><p>'
		. '<strong>' . esc_html__( 'Car Services Theme:', 'car-services-theme' ) . '</strong> '
		. esc_html__( 'Install and activate the ', 'car-services-theme' )
		. '<a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank" rel="noopener noreferrer">'
		. esc_html__( 'Advanced Custom Fields', 'car-services-theme' )
		. '</a>'
		. esc_html__( ' plugin to edit homepage content from the admin.', 'car-services-theme' )
		. '</p></div>',
		array(
			'div'    => array( 'class' => true ),
			'p'      => array(),
			'strong' => array(),
			'a'      => array( 'href' => true, 'target' => true, 'rel' => true ),
		)
	);
}
