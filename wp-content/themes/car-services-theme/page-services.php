<?php
/**
 * Template Name: Services
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

get_header();

// ── Banner ──────────────────────────────────────────────────────────────────
$banner_title    = car_services_field( 'srv_banner_title', __( 'Our Services', 'car-services-theme' ) );
$banner_subtitle = car_services_field( 'srv_banner_subtitle', __( 'Everything your vehicle needs — under one roof', 'car-services-theme' ) );
$banner_bg       = car_services_field( 'srv_banner_bg', CAR_SERVICES_URI . '/assets/images/hero-bg.svg' );

// ── Intro ────────────────────────────────────────────────────────────────────
$intro_tag     = car_services_field( 'srv_intro_tag', __( 'What We Do', 'car-services-theme' ) );
$intro_heading = car_services_field( 'srv_intro_heading', __( 'Full-Range Automotive Care', 'car-services-theme' ) );
$intro_text    = car_services_field( 'srv_intro_text', __( 'From routine servicing to complex repairs, our fully certified team handles it all. Every job is carried out with precision, quality parts, and a 12-month workmanship guarantee.', 'car-services-theme' ) );

// ── Service Cards ─────────────────────────────────────────────────────────────
$card_defaults = array(
	1 => array( '🔧', 'Car Repairs',          'From minor fixes to major mechanical work, our technicians diagnose and repair all vehicle types quickly and correctly the first time.' ),
	2 => array( '🛠️', 'Maintenance Services',  'Regular servicing keeps your vehicle running at its best. We follow manufacturer schedules and use only approved parts and fluids.' ),
	3 => array( '🔍', 'Vehicle Inspections',   'Pre-purchase, pre-MOT, or peace-of-mind checks — our thorough inspections give you the full picture on any vehicle.' ),
	4 => array( '💻', 'Diagnostic Checks',     'Our state-of-the-art diagnostic equipment reads fault codes across all systems so we pinpoint problems fast and accurately.' ),
	5 => array( '📋', 'MOT Testing',           'Fully authorised MOT testing station. We test, advise, and can carry out any required remedial work on the same day.' ),
	6 => array( '🚗', 'Tyre Services',         'Supply and fitting of all major tyre brands, including puncture repairs, wheel balancing, and TPMS sensor replacement.' ),
);

$service_cards = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$service_cards[] = array(
		'icon'        => car_services_field( 'srv_card_' . $i . '_icon', $card_defaults[ $i ][0] ),
		'title'       => car_services_field( 'srv_card_' . $i . '_title', $card_defaults[ $i ][1] ),
		'description' => car_services_field( 'srv_card_' . $i . '_description', $card_defaults[ $i ][2] ),
		'link_text'   => car_services_field( 'srv_card_' . $i . '_link_text', __( 'Book Now', 'car-services-theme' ) ),
		'link_url'    => car_services_field( 'srv_card_' . $i . '_link_url', home_url( '/contact' ) ),
	);
}

// ── How It Works ─────────────────────────────────────────────────────────────
$steps_tag     = car_services_field( 'srv_steps_tag', __( 'The Process', 'car-services-theme' ) );
$steps_heading = car_services_field( 'srv_steps_heading', __( 'How It Works', 'car-services-theme' ) );

$step_defaults = array(
	1 => array( 'Book Online or Call',    'Choose a service and book at a time that suits you — online, by phone, or just drop in.' ),
	2 => array( 'Drop Off Your Vehicle',  'Bring your car in at the agreed time. Our team will greet you and confirm the work needed.' ),
	3 => array( 'We Get to Work',         'Our technicians carry out the job using quality parts, keeping you updated throughout.' ),
	4 => array( 'Collect &amp; Drive Away', 'Pick up your vehicle knowing the work is done right — backed by our 12-month guarantee.' ),
);
$steps = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$steps[] = array(
		'title'       => car_services_field( 'srv_step_' . $i . '_title', $step_defaults[ $i ][0] ),
		'description' => car_services_field( 'srv_step_' . $i . '_description', $step_defaults[ $i ][1] ),
	);
}

// ── FAQ ───────────────────────────────────────────────────────────────────────
$faq_tag     = car_services_field( 'srv_faq_tag', __( 'FAQ', 'car-services-theme' ) );
$faq_heading = car_services_field( 'srv_faq_heading', __( 'Frequently Asked Questions', 'car-services-theme' ) );

$faq_defaults = array(
	1 => array( 'How do I book a service?',                'You can book online using our contact form, call us directly, or simply drop in during business hours and our team will get you sorted.' ),
	2 => array( 'How long does a standard service take?',  'A standard service typically takes 1.5–2 hours. More complex work may take longer — we will always give you an honest time estimate upfront.' ),
	3 => array( 'Do you offer a guarantee on work done?',  'Yes. All workmanship is covered by a 12-month guarantee. If an issue arises with work we have completed, bring it back and we will fix it at no extra charge.' ),
	4 => array( 'Will you use genuine manufacturer parts?','We use quality OEM-equivalent or genuine parts depending on your preference and vehicle requirements. We will always discuss options with you before proceeding.' ),
	5 => array( 'Can I wait while my car is serviced?',    'Yes, we have a comfortable waiting area with Wi-Fi and refreshments. For longer jobs we can arrange a courtesy vehicle — just let us know when booking.' ),
	6 => array( 'Do you work on all makes and models?',    'Yes. Our technicians are trained across all major makes and models, from small city cars to large SUVs and commercial vehicles.' ),
);

$faqs = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$q = car_services_field( 'srv_faq_' . $i . '_question', isset( $faq_defaults[ $i ] ) ? $faq_defaults[ $i ][0] : '' );
	$a = car_services_field( 'srv_faq_' . $i . '_answer',   isset( $faq_defaults[ $i ] ) ? $faq_defaults[ $i ][1] : '' );
	if ( $q && $a ) {
		$faqs[] = array( 'q' => $q, 'a' => $a );
	}
}

// ── CTA ───────────────────────────────────────────────────────────────────────
$cta_heading  = car_services_field( 'srv_cta_heading', __( 'Ready to Book Your Service?', 'car-services-theme' ) );
$cta_text     = car_services_field( 'srv_cta_text', __( 'Contact us today and our team will get you booked in as soon as possible.', 'car-services-theme' ) );
$cta_btn_text = car_services_field( 'srv_cta_btn_text', __( 'Contact Us', 'car-services-theme' ) );
$cta_btn_url  = car_services_field( 'srv_cta_btn_url', home_url( '/contact' ) );
$cta_bg    = car_services_field( 'srv_cta_bg_image', '' );
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
<section class="services-page-intro">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $intro_tag ); ?></span>
			<h2><?php echo esc_html( $intro_heading ); ?></h2>
			<p><?php echo esc_html( $intro_text ); ?></p>
		</div>
	</div>
</section>

<!-- ── Services Grid ───────────────────────────────────────────────────── -->
<section class="services-page-grid-section">
	<div class="container">
		<div class="services-page-grid">
			<?php foreach ( $service_cards as $card ) : ?>
				<div class="service-page-card">
					<div class="service-page-card-icon"><?php echo esc_html( $card['icon'] ); ?></div>
					<h3><?php echo esc_html( $card['title'] ); ?></h3>
					<p><?php echo esc_html( $card['description'] ); ?></p>
					<a href="<?php echo esc_url( $card['link_url'] ); ?>" class="service-page-card-link">
						<?php echo esc_html( $card['link_text'] ); ?> →
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
					<h3><?php echo wp_kses_post( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── FAQ ─────────────────────────────────────────────────────────────── -->
<?php if ( ! empty( $faqs ) ) : ?>
<section class="srv-faq-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $faq_tag ); ?></span>
			<h2><?php echo esc_html( $faq_heading ); ?></h2>
		</div>
		<div class="faq-list">
			<?php foreach ( $faqs as $index => $faq ) : ?>
			<details class="faq-item" <?php echo $index === 0 ? 'open' : ''; ?>>
				<summary class="faq-question">
					<span><?php echo esc_html( $faq['q'] ); ?></span>
					<span class="faq-icon" aria-hidden="true"></span>
				</summary>
				<div class="faq-answer">
					<p><?php echo esc_html( $faq['a'] ); ?></p>
				</div>
			</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ── CTA ─────────────────────────────────────────────────────────────── -->
<section class="<?php echo esc_attr( $cta_class ); ?>"<?php if ( $cta_bg ) : ?> style="background-image: url(<?php echo esc_url( $cta_bg ); ?>);"<?php endif; ?>>
	<?php if ( $cta_bg ) : ?><div class="cta-overlay"></div><?php endif; ?>
	<div class="container">
		<div class="cta-content">
			<h2><?php echo esc_html( $cta_heading ); ?></h2>
			<p><?php echo esc_html( $cta_text ); ?></p>
			<a href="<?php echo esc_url( $cta_btn_url ); ?>" class="btn btn-primary btn-lg">
				<?php echo esc_html( $cta_btn_text ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
