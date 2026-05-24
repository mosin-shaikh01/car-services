<?php
/**
 * Why Choose Us Section Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tag        = car_services_field( 'why_tag', __( 'Why Us', 'car-services-theme' ) );
$heading    = car_services_field( 'why_heading', __( 'Why Choose Dark Skull Autocare?', 'car-services-theme' ) );
$subheading = car_services_field( 'why_subheading', __( 'We go beyond just fixing cars — we build trust with every repair, every service, every time.', 'car-services-theme' ) );

$default_reasons = array(
	array( 'icon' => '🛡️', 'title' => 'Certified Technicians', 'description' => 'Our team of fully certified and experienced mechanics bring expertise to every job, ensuring your vehicle is in safe hands.' ),
	array( 'icon' => '⚡', 'title' => 'Fast Turnaround', 'description' => 'We respect your time. Most services are completed same-day so you can get back on the road without unnecessary delays.' ),
	array( 'icon' => '💰', 'title' => 'Transparent Pricing', 'description' => 'No hidden fees, no surprises. You get a full quote before any work begins — honest pricing every single time.' ),
	array( 'icon' => '🔧', 'title' => 'Quality Parts Only', 'description' => 'We use only OEM and top-grade aftermarket parts to ensure lasting repairs and keep your warranty intact.' ),
	array( 'icon' => '📋', 'title' => 'Full Service History', 'description' => 'We maintain a detailed service record for your vehicle, so you always have full visibility into what has been done.' ),
	array( 'icon' => '🤝', 'title' => '12-Month Guarantee', 'description' => 'All our repairs and services come with a 12-month workmanship guarantee, giving you complete peace of mind.' ),
);

// Build reasons array from individual ACF fields.
$reasons = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$icon  = car_services_field( 'why_' . $i . '_icon', $default_reasons[ $i - 1 ]['icon'] );
	$title = car_services_field( 'why_' . $i . '_title', $default_reasons[ $i - 1 ]['title'] );
	$desc  = car_services_field( 'why_' . $i . '_description', $default_reasons[ $i - 1 ]['description'] );

	if ( $title ) {
		$reasons[] = array(
			'icon'        => $icon,
			'title'       => $title,
			'description' => $desc,
		);
	}
}
?>

<section class="why-choose-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $tag ); ?></span>
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $subheading ); ?></p>
		</div>

		<div class="why-choose-grid">
			<?php foreach ( $reasons as $reason ) : ?>
				<div class="why-card">
					<div class="why-card-icon"><?php echo esc_html( $reason['icon'] ); ?></div>
					<h3><?php echo esc_html( $reason['title'] ); ?></h3>
					<p><?php echo esc_html( $reason['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
