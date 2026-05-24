<?php
/**
 * Testimonials Section Template Part - Masonry Grid
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tag        = car_services_field( 'testimonials_tag', __( 'Testimonials', 'car-services-theme' ) );
$heading    = car_services_field( 'testimonials_heading', __( 'What Our Customers Say', 'car-services-theme' ) );
$subheading = car_services_field( 'testimonials_subheading', __( 'Real experiences from real customers who trust us with their vehicles.', 'car-services-theme' ) );

$default_testimonials = array(
	array( 'name' => 'James Whitfield', 'role' => 'Regular Customer', 'rating' => 5, 'text' => 'Absolutely brilliant service from start to finish. Brought my BMW in for a full service and the team were incredibly professional. Transparent pricing and they even gave me a call mid-way to explain what they found. Will never go anywhere else.' ),
	array( 'name' => 'Sarah Mitchell', 'role' => 'New Customer', 'rating' => 5, 'text' => 'Fixed my brakes same day! I was really stressed about the noise my car was making, but the team put me at ease straight away. Fair price too.' ),
	array( 'name' => 'Derek Thompson', 'role' => 'Fleet Manager', 'rating' => 5, 'text' => 'We use Dark Skull Autocare for our entire company fleet of 12 vehicles. The turnaround times are excellent and the quality of work is consistently outstanding. Highly recommend for business fleet management.' ),
	array( 'name' => 'Priya Sharma', 'role' => 'Loyal Customer', 'rating' => 4, 'text' => 'Great experience overall. The technician explained everything clearly and the car feels like new after the service. Booking was easy and they were ready for me on arrival.' ),
	array( 'name' => 'Marcus Brown', 'role' => 'First-Time Visitor', 'rating' => 5, 'text' => 'Took my Audi in after another garage quoted me an extortionate amount. Dark Skull fixed the issue for half the price and in half the time. Honest, skilled, and friendly — what more do you want?' ),
	array( 'name' => 'Claire Johnson', 'role' => 'Regular Customer', 'rating' => 5, 'text' => 'I have been coming here for three years and the quality never drops. They remembered details about my car from previous visits. The 12-month guarantee gives me total peace of mind.' ),
);

// Build testimonials array from individual ACF fields.
$testimonials = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$name   = car_services_field( 'testimonial_' . $i . '_name', $default_testimonials[ $i - 1 ]['name'] );
	$role   = car_services_field( 'testimonial_' . $i . '_role', $default_testimonials[ $i - 1 ]['role'] );
	$rating = car_services_field( 'testimonial_' . $i . '_rating', $default_testimonials[ $i - 1 ]['rating'] );
	$text   = car_services_field( 'testimonial_' . $i . '_text', $default_testimonials[ $i - 1 ]['text'] );

	if ( $name || $text ) {
		$testimonials[] = array(
			'name'   => $name,
			'role'   => $role,
			'rating' => $rating,
			'text'   => $text,
		);
	}
}
?>

<section class="testimonials-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $tag ); ?></span>
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $subheading ); ?></p>
		</div>

		<div class="testimonials-masonry">
			<?php
			foreach ( $testimonials as $testimonial ) :
				$rating   = max( 1, min( 5, (int) ( $testimonial['rating'] ?? 5 ) ) );
				$stars    = str_repeat( '★', $rating ) . str_repeat( '☆', 5 - $rating );
				$name     = $testimonial['name'] ?? '';
				$role     = $testimonial['role'] ?? '';
				$text     = $testimonial['text'] ?? '';
				$words    = preg_split( '/\s+/', trim( $name ) );
				$initials = '';
				foreach ( $words as $w ) {
					if ( $w !== '' ) {
						$initials .= strtoupper( mb_substr( $w, 0, 1 ) );
					}
				}
				?>
				<div class="testimonial-card">
					<div class="testimonial-rating"><?php echo esc_html( $stars ); ?></div>
					<p class="testimonial-text">&ldquo;<?php echo esc_html( $text ); ?>&rdquo;</p>
					<div class="testimonial-author">
						<div class="testimonial-avatar"><?php echo esc_html( $initials ); ?></div>
						<div class="testimonial-info">
							<strong><?php echo esc_html( $name ); ?></strong>
							<span><?php echo esc_html( $role ); ?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
