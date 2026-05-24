<?php
/**
 * Call-to-Action Section Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading  = car_services_field( 'cta_heading', __( 'Ready to Service Your Vehicle?', 'car-services-theme' ) );
$text     = car_services_field( 'cta_text', __( 'Contact us today for professional car maintenance and repair services.', 'car-services-theme' ) );
$btn_text = car_services_field( 'cta_button_text', __( 'Contact Us', 'car-services-theme' ) );
$btn_url  = car_services_field( 'cta_button_url', home_url( '/contact' ) );
$bg_image = car_services_field( 'cta_bg_image', '' );

$section_class  = 'cta-section';
$has_bg         = ! empty( $bg_image );

if ( $has_bg ) {
	$section_class .= ' cta-has-bg';
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php if ( $has_bg ) : ?> style="background-image: url(<?php echo esc_url( $bg_image ); ?>);"<?php endif; ?>>
	<?php if ( $bg_image ) : ?>
	<div class="cta-overlay"></div>
	<?php endif; ?>
	<div class="container">
		<div class="cta-content">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $text ); ?></p>
			<a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary btn-lg">
				<?php echo esc_html( $btn_text ); ?>
			</a>
		</div>
	</div>
</section>
