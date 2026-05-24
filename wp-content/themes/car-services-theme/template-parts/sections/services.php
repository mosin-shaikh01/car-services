<?php
/**
 * Services Section Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading  = car_services_field( 'services_heading', __( 'Car Repairs', 'car-services-theme' ) );
$btn_text = car_services_field( 'services_button_text', __( 'Book Now', 'car-services-theme' ) );
$btn_url  = car_services_field( 'services_button_url', home_url( '/contact' ) );

$default_services = array(
	array( 'title' => 'Car Repairs', 'description' => 'Diam rhoncus feugiat habitasse felis. Sistem non sed lacus integer sem tortor consequat pellentesque eget luctus in fermentum nec ornare mollis at Morbi pellentesque etiam sem.' ),
	array( 'title' => 'Maintenance Services', 'description' => 'Maecenas orci odio mauris vestibulum elementum scelerisque ultrices sit amet ante vitae sodales lorem fermentum porta et sollicitudin nibh in nisi tincidunt ipsum.' ),
	array( 'title' => 'Vehicle Inspections', 'description' => 'Posuere vac vehicula eros felis vestibulum erat nunc vulputate nec fringilla venenatis ipsum nec sollicitudin integer laoreet tempor sle lorem elementum magna.' ),
	array( 'title' => 'Diagnostic Checks', 'description' => 'Quisque fermentum lorem mauris non vehicula mauris convallis blandit fringilla bibendum elementum temporibus scelerisque.' ),
);

// Build services array from individual ACF fields.
$services = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$title = car_services_field( 'service_' . $i . '_title', $default_services[ $i - 1 ]['title'] );
	$desc  = car_services_field( 'service_' . $i . '_description', $default_services[ $i - 1 ]['description'] );

	if ( $title ) {
		$services[] = array(
			'title'       => $title,
			'description' => $desc,
		);
	}
}
?>

<section class="services-section">
	<div class="container">
		<div class="services-header">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary">
				<span class="btn-icon">☎️</span>
				<?php echo esc_html( $btn_text ); ?>
			</a>
		</div>

		<div class="services-grid">
			<?php foreach ( $services as $service ) : ?>
				<div class="service-card">
					<h3><?php echo esc_html( $service['title'] ); ?></h3>
					<p><?php echo esc_html( $service['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="services-footer">
			<a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary">
				<?php echo esc_html( $btn_text ); ?>
			</a>
		</div>
	</div>
</section>
