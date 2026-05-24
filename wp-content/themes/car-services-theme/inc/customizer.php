<?php
/**
 * Theme Customizer Configuration
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add customizer sections
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function car_services_customize_register( $wp_customize ) {
	// Branding Section
	$wp_customize->add_section( 'car_services_branding', array(
		'title'       => esc_html__( 'Car Services Branding', 'car-services-theme' ),
		'priority'    => 30,
		'description' => esc_html__( 'Configure branding elements', 'car-services-theme' ),
	) );

	// Business Phone
	$wp_customize->add_setting( 'car_services_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'car_services_phone', array(
		'label'       => esc_html__( 'Business Phone Number', 'car-services-theme' ),
		'section'     => 'car_services_branding',
		'type'        => 'text',
	) );

	// Business Email
	$wp_customize->add_setting( 'car_services_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'car_services_email', array(
		'label'       => esc_html__( 'Business Email', 'car-services-theme' ),
		'section'     => 'car_services_branding',
		'type'        => 'text',
	) );

	// Business Address
	$wp_customize->add_setting( 'car_services_address', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'car_services_address', array(
		'label'       => esc_html__( 'Business Address', 'car-services-theme' ),
		'section'     => 'car_services_branding',
		'type'        => 'textarea',
	) );

	// Business Hours
	$wp_customize->add_setting( 'car_services_hours', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'car_services_hours', array(
		'label'       => esc_html__( 'Business Hours', 'car-services-theme' ),
		'section'     => 'car_services_branding',
		'type'        => 'textarea',
	) );

	// Social Links Section
	$wp_customize->add_section( 'car_services_social', array(
		'title'    => esc_html__( 'Social Media Links', 'car-services-theme' ),
		'priority' => 40,
	) );

	// Social media links
	$social_links = array(
		'facebook'  => esc_html__( 'Facebook URL', 'car-services-theme' ),
		'twitter'   => esc_html__( 'Twitter URL', 'car-services-theme' ),
		'instagram' => esc_html__( 'Instagram URL', 'car-services-theme' ),
		'linkedin'  => esc_html__( 'LinkedIn URL', 'car-services-theme' ),
		'youtube'   => esc_html__( 'YouTube URL', 'car-services-theme' ),
	);

	foreach ( $social_links as $platform => $label ) {
		$wp_customize->add_setting( 'car_services_' . $platform, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'car_services_' . $platform, array(
			'label'   => $label,
			'section' => 'car_services_social',
			'type'    => 'url',
		) );
	}

	// Footer Section
	$wp_customize->add_section( 'car_services_footer', array(
		'title'    => esc_html__( 'Footer Settings', 'car-services-theme' ),
		'priority' => 50,
	) );

	// Footer Copyright Text
	$wp_customize->add_setting( 'car_services_copyright', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'car_services_copyright', array(
		'label'       => esc_html__( 'Copyright Text', 'car-services-theme' ),
		'section'     => 'car_services_footer',
		'type'        => 'textarea',
	) );

	// Blog / Archive Banner Section
	$wp_customize->add_section( 'car_services_blog', array(
		'title'    => esc_html__( 'Blog Banner', 'car-services-theme' ),
		'priority' => 45,
	) );

	$wp_customize->add_setting( 'blog_banner_title', array(
		'default'           => __( 'Our Blog', 'car-services-theme' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'blog_banner_title', array(
		'label'   => esc_html__( 'Blog Banner Title', 'car-services-theme' ),
		'section' => 'car_services_blog',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'blog_banner_subtitle', array(
		'default'           => __( 'News, tips and advice from the Dark Skull Autocare team', 'car-services-theme' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'blog_banner_subtitle', array(
		'label'   => esc_html__( 'Blog Banner Subtitle', 'car-services-theme' ),
		'section' => 'car_services_blog',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'blog_banner_bg', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'blog_banner_bg', array(
		'label'   => esc_html__( 'Blog Banner Background Image', 'car-services-theme' ),
		'section' => 'car_services_blog',
	) ) );
}
add_action( 'customize_register', 'car_services_customize_register' );
