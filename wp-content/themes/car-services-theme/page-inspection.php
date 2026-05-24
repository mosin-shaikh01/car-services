<?php
/**
 * Template Name: Vehicle Inspection
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

get_header();

// ── Banner ──────────────────────────────────────────────────────────────────
$banner_title    = car_services_field( 'insp_banner_title', __( 'Vehicle Inspections', 'car-services-theme' ) );
$banner_subtitle = car_services_field( 'insp_banner_subtitle', __( 'Comprehensive checks to keep you safe and roadworthy', 'car-services-theme' ) );
$banner_bg       = car_services_field( 'insp_banner_bg', CAR_SERVICES_URI . '/assets/images/hero-bg.svg' );

// ── Intro ────────────────────────────────────────────────────────────────────
$intro_tag     = car_services_field( 'insp_intro_tag', __( 'About Our Inspections', 'car-services-theme' ) );
$intro_heading = car_services_field( 'insp_intro_heading', __( 'Why a Vehicle Inspection Matters', 'car-services-theme' ) );
$intro_text    = car_services_field( 'insp_intro_text', __( 'Whether you are buying a used car, preparing for an MOT, or simply want peace of mind, our inspection service gives you the full picture. Our certified technicians carry out a thorough multi-point check and provide a clear, jargon-free report.', 'car-services-theme' ) );
$intro_image   = car_services_field( 'insp_intro_image', '' );

// ── Checklist ────────────────────────────────────────────────────────────────
$checklist_tag     = car_services_field( 'insp_checklist_tag', __( 'What We Cover', 'car-services-theme' ) );
$checklist_heading = car_services_field( 'insp_checklist_heading', __( 'Our Multi-Point Inspection', 'car-services-theme' ) );
$checklist_sub     = car_services_field( 'insp_checklist_sub', __( 'Every inspection covers all major vehicle systems — nothing is overlooked.', 'car-services-theme' ) );

$check_defaults = array(
	1  => 'Engine condition &amp; oil levels',
	2  => 'Brake pads, discs &amp; fluid',
	3  => 'Tyre tread depth &amp; pressure',
	4  => 'Steering &amp; suspension',
	5  => 'Battery condition &amp; charging',
	6  => 'Lights, indicators &amp; horn',
	7  => 'Exhaust system &amp; emissions',
	8  => 'Coolant &amp; fluid levels',
	9  => 'Windscreen &amp; wipers',
	10 => 'Seatbelts &amp; airbag warning lights',
	11 => 'Drive shafts &amp; CV joints',
	12 => 'Full OBD diagnostic scan',
);

$checklist = array();
for ( $i = 1; $i <= 12; $i++ ) {
	$checklist[] = car_services_field( 'insp_check_' . $i, $check_defaults[ $i ] );
}

// ── Packages ─────────────────────────────────────────────────────────────────
$packages_tag     = car_services_field( 'insp_packages_tag', __( 'Inspection Packages', 'car-services-theme' ) );
$packages_heading = car_services_field( 'insp_packages_heading', __( 'Choose Your Inspection', 'car-services-theme' ) );
$packages_sub     = car_services_field( 'insp_packages_sub', __( 'All packages include a written report. No hidden charges.', 'car-services-theme' ) );

$package_defaults = array(
	1 => array(
		'name'     => 'Basic Check',
		'price'    => '£39',
		'duration' => '45 mins',
		'features' => "Visual exterior inspection\nTyre check\nLights & signals\nFluid levels\nBasic OBD scan",
		'featured' => false,
		'btn_text' => 'Book Basic',
	),
	2 => array(
		'name'     => 'Full Inspection',
		'price'    => '£79',
		'duration' => '90 mins',
		'features' => "Everything in Basic\nBrakes & suspension\nEngine & transmission\nExhaust & emissions\nDetailed written report\nPhotographed findings",
		'featured' => true,
		'btn_text' => 'Book Full',
	),
	3 => array(
		'name'     => 'Pre-Purchase Check',
		'price'    => '£99',
		'duration' => '2 hours',
		'features' => "Everything in Full\nVehicle history check\nFrame & chassis inspection\nEstimated repair costs\nVerbal walkthrough\nPriority booking",
		'featured' => false,
		'btn_text' => 'Book Pre-Purchase',
	),
);

$packages = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$raw_features   = car_services_field( 'insp_pkg_' . $i . '_features', $package_defaults[ $i ]['features'] );
	$btn_url        = car_services_field( 'insp_pkg_' . $i . '_btn_url', home_url( '/contact' ) );
	$btn_shortcode  = car_services_field( 'insp_pkg_' . $i . '_btn_shortcode', '' );
	// If shortcode is set, use href="#" to trigger modal; otherwise use URL
	$btn_href       = ! empty( $btn_shortcode ) ? '#' : esc_url( $btn_url );

	$packages[]   = array(
		'name'     => car_services_field( 'insp_pkg_' . $i . '_name', $package_defaults[ $i ]['name'] ),
		'price'    => car_services_field( 'insp_pkg_' . $i . '_price', $package_defaults[ $i ]['price'] ),
		'duration' => car_services_field( 'insp_pkg_' . $i . '_duration', $package_defaults[ $i ]['duration'] ),
		'features' => array_filter( array_map( 'trim', explode( "\n", $raw_features ) ) ),
		'featured' => (bool) car_services_field( 'insp_pkg_' . $i . '_featured', $package_defaults[ $i ]['featured'] ),
		'btn_text' => car_services_field( 'insp_pkg_' . $i . '_btn_text', $package_defaults[ $i ]['btn_text'] ),
		'btn_href' => $btn_href,
	);
}

// ── Steps ────────────────────────────────────────────────────────────────────
$steps_tag     = car_services_field( 'insp_steps_tag', __( 'The Process', 'car-services-theme' ) );
$steps_heading = car_services_field( 'insp_steps_heading', __( 'What Happens on the Day', 'car-services-theme' ) );

$step_defaults = array(
	1 => array( 'Book Your Slot',       'Choose a package and book online or by phone. We offer flexible weekday and Saturday slots.' ),
	2 => array( 'Drop Off Your Car',    'Arrive at your booked time. Our team will note your concerns and confirm the package details.' ),
	3 => array( 'Thorough Inspection',  'Our technician carries out the full check with no rush. Photographs are taken of any findings.' ),
	4 => array( 'Receive Your Report',  'We walk you through the results clearly. You receive a written report before you leave.' ),
);
$steps = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$steps[] = array(
		'title'       => car_services_field( 'insp_step_' . $i . '_title', $step_defaults[ $i ][0] ),
		'description' => car_services_field( 'insp_step_' . $i . '_description', $step_defaults[ $i ][1] ),
	);
}

// ── CTA ───────────────────────────────────────────────────────────────────────
$cta_heading       = car_services_field( 'insp_cta_heading', __( 'Book Your Inspection Today', 'car-services-theme' ) );
$cta_text          = car_services_field( 'insp_cta_text', __( 'Drive away with full confidence. Our team is ready to give your vehicle the thorough check it deserves.', 'car-services-theme' ) );
$cta_btn_text      = car_services_field( 'insp_cta_btn_text', __( 'Book Now', 'car-services-theme' ) );
$cta_btn_url       = car_services_field( 'insp_cta_btn_url', home_url( '/contact' ) );
$cta_btn_shortcode = car_services_field( 'insp_cta_btn_shortcode', '' );
// If shortcode is set, use href="#" to trigger modal; otherwise use URL
$cta_btn_href      = ! empty( $cta_btn_shortcode ) ? '#' : esc_url( $cta_btn_url );
$cta_bg    = car_services_field( 'insp_cta_bg_image', '' );
$cta_class = 'cta-section' . ( $cta_bg ? ' cta-has-bg' : '' );
?>

<!-- ── Page Banner ─────────────────────────────────────────────────────── -->
<section class="page-banner" style="background-image: url('<?php echo esc_url( $banner_bg ); ?>');">
	<div class="page-banner-overlay"></div>
	<div class="container">
		<div class="page-banner-content">
			<h1><?php echo esc_html( $banner_title ); ?></h1>
			<p><?php echo esc_html( $banner_subtitle ); ?></p>
		</div>
	</div>
</section>

<!-- ── Intro ───────────────────────────────────────────────────────────── -->
<section class="inspection-intro">
	<div class="container">
		<div class="inspection-intro-grid">
			<div class="inspection-intro-content">
				<span class="section-tag"><?php echo esc_html( $intro_tag ); ?></span>
				<h2><?php echo esc_html( $intro_heading ); ?></h2>
				<p><?php echo esc_html( $intro_text ); ?></p>
			</div>
			<div class="inspection-intro-image">
				<?php if ( $intro_image ) : ?>
					<img src="<?php echo esc_url( $intro_image ); ?>" alt="<?php echo esc_attr( $intro_heading ); ?>">
				<?php else : ?>
					<div class="insp-img-placeholder">
						<span>🔍</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- ── What We Check ───────────────────────────────────────────────────── -->
<section class="inspection-checklist-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $checklist_tag ); ?></span>
			<h2><?php echo esc_html( $checklist_heading ); ?></h2>
			<p><?php echo esc_html( $checklist_sub ); ?></p>
		</div>
		<div class="checklist-grid">
			<?php foreach ( $checklist as $item ) : ?>
				<div class="checklist-item">
					<span class="checklist-icon">✓</span>
					<span><?php echo wp_kses_post( $item ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── Packages ────────────────────────────────────────────────────────── -->
<section class="inspection-packages-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $packages_tag ); ?></span>
			<h2><?php echo esc_html( $packages_heading ); ?></h2>
			<p><?php echo esc_html( $packages_sub ); ?></p>
		</div>
		<div class="packages-grid">
			<?php foreach ( $packages as $pkg ) : ?>
				<div class="package-card<?php echo $pkg['featured'] ? ' package-card--featured' : ''; ?>">
					<?php if ( $pkg['featured'] ) : ?>
						<div class="package-badge"><?php esc_html_e( 'Most Popular', 'car-services-theme' ); ?></div>
					<?php endif; ?>
					<div class="package-header">
						<h3><?php echo esc_html( $pkg['name'] ); ?></h3>
						<div class="package-price"><?php echo esc_html( $pkg['price'] ); ?></div>
						<div class="package-duration">⏱ <?php echo esc_html( $pkg['duration'] ); ?></div>
					</div>
					<ul class="package-features">
						<?php foreach ( $pkg['features'] as $feature ) : ?>
							<li><span>✓</span> <?php echo wp_kses_post( $feature ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo $pkg['btn_href']; ?>" class="btn <?php echo $pkg['featured'] ? 'btn-primary' : 'btn-outline'; ?> btn-block">
						<?php echo esc_html( $pkg['btn_text'] ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── How It Works ────────────────────────────────────────────────────── -->
<section class="how-it-works-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $steps_tag ); ?></span>
			<h2><?php echo esc_html( $steps_heading ); ?></h2>
		</div>
		<div class="steps-grid">
			<?php foreach ( $steps as $index => $step ) : ?>
				<div class="step-item">
					<div class="step-number"><?php echo esc_html( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── CTA ─────────────────────────────────────────────────────────────── -->
<section class="<?php echo esc_attr( $cta_class ); ?>"<?php if ( $cta_bg ) : ?> style="background-image: url(<?php echo esc_url( $cta_bg ); ?>);"<?php endif; ?>>
	<?php if ( $cta_bg ) : ?><div class="cta-overlay"></div><?php endif; ?>
	<div class="container">
		<div class="cta-content">
			<h2><?php echo esc_html( $cta_heading ); ?></h2>
			<p><?php echo esc_html( $cta_text ); ?></p>
			<a href="<?php echo $cta_btn_href; ?>" class="btn btn-primary btn-lg">
				<?php echo esc_html( $cta_btn_text ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
