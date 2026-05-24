<?php
/**
 * Brand Logos Carousel Section
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading = car_services_field( 'brands_heading', __( 'Luxury Brands', 'car-services-theme' ) );

// Collect all brands that have at least a logo or a name
$brands = array();
for ( $i = 1; $i <= 10; $i++ ) {
	$logo = car_services_field( 'brand_' . $i . '_logo', '' );
	$name = car_services_field( 'brand_' . $i . '_name', '' );
	if ( $logo || $name ) {
		$brands[] = array( 'logo' => $logo, 'name' => $name );
	}
}

// Default fallback brand names (no logos) so the section is visible without ACF data
if ( empty( $brands ) ) {
	$brands = array(
		array( 'logo' => '', 'name' => 'Toyota' ),
		array( 'logo' => '', 'name' => 'Ford' ),
		array( 'logo' => '', 'name' => 'BMW' ),
		array( 'logo' => '', 'name' => 'Mercedes' ),
		array( 'logo' => '', 'name' => 'Honda' ),
		array( 'logo' => '', 'name' => 'Audi' ),
		array( 'logo' => '', 'name' => 'Tesla' ),
		array( 'logo' => '', 'name' => 'Volkswagen' ),
	);
}

// Need at least one brand to render
if ( empty( $brands ) ) {
	return;
}
?>

<section class="brands-section">
	<div class="container">
		<?php if ( $heading ) : ?>
		<h2 class="brands-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
	</div>

	<div class="brands-carousel-wrapper" aria-label="<?php esc_attr_e( 'Car brands carousel', 'car-services-theme' ); ?>">
		<div class="brands-track">
			<?php
			// Render the list twice for seamless infinite loop
			for ( $pass = 0; $pass < 2; $pass++ ) :
				foreach ( $brands as $brand ) :
					$logo = $brand['logo'];
					$name = $brand['name'];
			?>
			<div class="brand-item" aria-hidden="<?php echo $pass === 1 ? 'true' : 'false'; ?>">
				<?php if ( $logo ) : ?>
				<div class="brand-logo">
					<img src="<?php echo esc_url( $logo ); ?>"
					     alt="<?php echo $name ? esc_attr( $name ) . ' logo' : esc_attr__( 'Car brand logo', 'car-services-theme' ); ?>"
					     loading="lazy">
				</div>
				<?php else : ?>
				<div class="brand-logo brand-logo--text-only">
					<span class="brand-logo-placeholder" aria-hidden="true">&#9671;</span>
				</div>
				<?php endif; ?>
				<?php if ( $name ) : ?>
				<span class="brand-name"><?php echo esc_html( $name ); ?></span>
				<?php endif; ?>
			</div>
			<?php
				endforeach;
			endfor;
			?>
		</div>
	</div>
</section>
