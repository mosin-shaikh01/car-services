<?php
/**
 * Template Name: Contact Us
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

get_header();

// ── Banner ──────────────────────────────────────────────────────────────────
$banner_title    = car_services_field( 'contact_banner_title', __( 'Contact Us', 'car-services-theme' ) );
$banner_subtitle = car_services_field( 'contact_banner_subtitle', __( 'We are here to help — get in touch with our team today', 'car-services-theme' ) );
$banner_bg       = car_services_field( 'contact_banner_bg', CAR_SERVICES_URI . '/assets/images/hero-bg.svg' );

// ── Contact Info ─────────────────────────────────────────────────────────────
$address = car_services_field( 'contact_address', '14 Skull Lane, Birmingham, B1 2XY' );
$phone   = car_services_field( 'contact_phone', '0121 456 7890' );
$email   = car_services_field( 'contact_email', 'hello@darkskullautocare.co.uk' );
$hours   = car_services_field( 'contact_hours', "Monday – Friday: 8:00am – 6:00pm\nSaturday: 9:00am – 4:00pm\nSunday: Closed" );

// ── Form ─────────────────────────────────────────────────────────────────────
$form_heading    = car_services_field( 'contact_form_heading', __( 'Send Us a Message', 'car-services-theme' ) );
$form_subheading = car_services_field( 'contact_form_subheading', __( 'Fill in the form below and we will get back to you within 24 hours.', 'car-services-theme' ) );
$form_shortcode  = car_services_field( 'contact_form_shortcode', '' );

// ── Map ───────────────────────────────────────────────────────────────────────
$map_embed = car_services_field( 'contact_map_embed', '' );
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

<!-- ── Contact Content ─────────────────────────────────────────────────── -->
<section class="contact-section">
	<div class="container">
		<div class="contact-grid">

			<!-- Info column -->
			<div class="contact-info">
				<span class="section-tag"><?php esc_html_e( 'Find Us', 'car-services-theme' ); ?></span>
				<h2><?php esc_html_e( 'Get In Touch', 'car-services-theme' ); ?></h2>

				<div class="contact-info-items">
					<div class="contact-info-item">
						<div class="contact-icon">📍</div>
						<div class="contact-detail">
							<strong><?php esc_html_e( 'Address', 'car-services-theme' ); ?></strong>
							<p><?php echo nl2br( esc_html( $address ) ); ?></p>
						</div>
					</div>

					<div class="contact-info-item">
						<div class="contact-icon">📞</div>
						<div class="contact-detail">
							<strong><?php esc_html_e( 'Phone', 'car-services-theme' ); ?></strong>
							<p><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
						</div>
					</div>

					<div class="contact-info-item">
						<div class="contact-icon">✉️</div>
						<div class="contact-detail">
							<strong><?php esc_html_e( 'Email', 'car-services-theme' ); ?></strong>
							<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
						</div>
					</div>

					<div class="contact-info-item">
						<div class="contact-icon">🕐</div>
						<div class="contact-detail">
							<strong><?php esc_html_e( 'Opening Hours', 'car-services-theme' ); ?></strong>
							<p><?php echo nl2br( esc_html( $hours ) ); ?></p>
						</div>
					</div>
				</div>

				<!-- Map under Get In Touch -->
				<?php if ( $map_embed ) : ?>
					<div class="contact-map">
						<?php echo wp_kses( $map_embed, array(
							'iframe' => array(
								'src'             => true,
								'width'           => true,
								'height'          => true,
								'style'           => true,
								'allowfullscreen' => true,
								'loading'         => true,
								'referrerpolicy'  => true,
								'frameborder'     => true,
							),
						) ); ?>
					</div>
				<?php else : ?>
					<div class="contact-map contact-map-placeholder">
						<div class="map-placeholder-inner">
							<span>🗺️</span>
							<p><?php esc_html_e( 'Paste your Google Maps embed code in the admin panel to show a map here.', 'car-services-theme' ); ?></p>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Form column -->
			<div class="contact-form-wrap">
				<h2><?php echo esc_html( $form_heading ); ?></h2>
				<p class="contact-form-sub"><?php echo esc_html( $form_subheading ); ?></p>

				<?php if ( $form_shortcode ) : ?>
					<?php echo do_shortcode( $form_shortcode ); ?>
				<?php else : ?>
					<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<?php wp_nonce_field( 'cs_contact_form', 'cs_contact_nonce' ); ?>
						<input type="hidden" name="action" value="cs_contact_form">

						<div class="form-row form-row-2">
							<div class="form-group">
								<label for="cs_name"><?php esc_html_e( 'Full Name', 'car-services-theme' ); ?> <span>*</span></label>
								<input type="text" id="cs_name" name="cs_name" placeholder="<?php esc_attr_e( 'John Smith', 'car-services-theme' ); ?>" required>
							</div>
							<div class="form-group">
								<label for="cs_phone"><?php esc_html_e( 'Phone Number', 'car-services-theme' ); ?></label>
								<input type="tel" id="cs_phone" name="cs_phone" placeholder="<?php esc_attr_e( '07700 000000', 'car-services-theme' ); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="cs_email"><?php esc_html_e( 'Email Address', 'car-services-theme' ); ?> <span>*</span></label>
							<input type="email" id="cs_email" name="cs_email" placeholder="<?php esc_attr_e( 'you@example.com', 'car-services-theme' ); ?>" required>
						</div>

						<div class="form-group">
							<label for="cs_vehicle"><?php esc_html_e( 'Vehicle (Make &amp; Model)', 'car-services-theme' ); ?></label>
							<input type="text" id="cs_vehicle" name="cs_vehicle" placeholder="<?php esc_attr_e( 'e.g. Ford Focus 2019', 'car-services-theme' ); ?>">
						</div>

						<div class="form-group">
							<label for="cs_service"><?php esc_html_e( 'Service Required', 'car-services-theme' ); ?></label>
							<select id="cs_service" name="cs_service">
								<option value=""><?php esc_html_e( 'Select a service…', 'car-services-theme' ); ?></option>
								<option value="car-repair"><?php esc_html_e( 'Car Repair', 'car-services-theme' ); ?></option>
								<option value="maintenance"><?php esc_html_e( 'Maintenance Service', 'car-services-theme' ); ?></option>
								<option value="inspection"><?php esc_html_e( 'Vehicle Inspection', 'car-services-theme' ); ?></option>
								<option value="diagnostic"><?php esc_html_e( 'Diagnostic Check', 'car-services-theme' ); ?></option>
								<option value="mot"><?php esc_html_e( 'MOT Test', 'car-services-theme' ); ?></option>
								<option value="other"><?php esc_html_e( 'Other', 'car-services-theme' ); ?></option>
							</select>
						</div>

						<div class="form-group">
							<label for="cs_message"><?php esc_html_e( 'Message', 'car-services-theme' ); ?> <span>*</span></label>
							<textarea id="cs_message" name="cs_message" rows="3" placeholder="<?php esc_attr_e( 'Tell us about your vehicle and what you need…', 'car-services-theme' ); ?>" required></textarea>
						</div>

						<button type="submit" class="btn btn-primary btn-lg btn-block">
							<?php esc_html_e( 'Send Message', 'car-services-theme' ); ?>
						</button>
					</form>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
