<?php
/**
 * Hero Section Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg         = car_services_field( 'hero_background', get_theme_mod( 'hero_background_image', CAR_SERVICES_URI . '/assets/images/hero-bg.svg' ) );
$hero_video      = car_services_field( 'hero_video', '' );
$hero_logo       = car_services_field( 'hero_logo', CAR_SERVICES_URI . '/assets/images/logo.svg' );
$hero_title      = car_services_field( 'hero_title', get_bloginfo( 'name' ) );
$hero_subtitle   = car_services_field( 'hero_subtitle', get_bloginfo( 'description' ) );
$btn_text        = car_services_field( 'hero_button_text', __( 'Book Now', 'car-services-theme' ) );
$btn_url         = car_services_field( 'hero_button_url', home_url( '/contact' ) );
$btn_shortcode   = car_services_field( 'hero_button_shortcode', '' );
// If shortcode is set, use href="#" to trigger modal (via text matching in JS); otherwise use URL
$btn_href        = ! empty( $btn_shortcode ) ? '#' : esc_url( $btn_url );

// Use image as CSS background only when there is no video.
$bg_style = $hero_video ? '' : ( $hero_bg ? ' style="background-image: url(\'' . esc_url( $hero_bg ) . '\');"' : '' );
?>

<section class="hero-section<?php echo $hero_video ? ' hero-has-video' : ''; ?>"<?php echo $bg_style; ?>>

	<?php if ( $hero_video ) : ?>
		<video
			class="hero-video-bg"
			autoplay
			loop
			muted
			playsinline
			<?php if ( $hero_bg ) : ?>poster="<?php echo esc_url( $hero_bg ); ?>"<?php endif; ?>
		>
			<source src="<?php echo esc_url( $hero_video ); ?>" type="video/<?php echo esc_attr( pathinfo( $hero_video, PATHINFO_EXTENSION ) ); ?>">
		</video>
	<?php endif; ?>

	<div class="hero-overlay"></div>
	<div class="hero-container">
		<?php if ( $hero_logo ) : ?>
			<div class="hero-logo">
				<img src="<?php echo esc_url( $hero_logo ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" loading="lazy">
			</div>
		<?php endif; ?>

		<div class="hero-content">
			<h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>

			<a href="<?php echo $btn_href; ?>" class="btn btn-primary btn-lg">
				<span class="btn-icon">☎️</span>
				<?php echo esc_html( $btn_text ); ?>
			</a>
		</div>
	</div>
</section>
