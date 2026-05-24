<?php
/**
 * The footer for the theme
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		</main><!-- #main -->

		<footer id="colophon" class="site-footer">
			<div class="footer-main">
				<div class="footer-container">
					<div class="footer-grid">

						<!-- Col 1: Brand -->
						<div class="footer-brand">
							<div class="footer-logo">
								<?php
								if ( has_custom_logo() ) {
									the_custom_logo();
								} else {
									echo '<span class="footer-site-name">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
								}
								?>
							</div>
							<p class="footer-description">
								<?php
								$desc = get_bloginfo( 'description', 'display' );
								echo $desc ? esc_html( $desc ) : esc_html__( 'Professional auto care you can trust. Every service rigorously delivered to the highest standard.', 'car-services-theme' );
								?>
							</p>
							<?php if ( car_services_get_phone() ) : ?>
								<div class="footer-contact-block">
									<span class="footer-support-label"><?php esc_html_e( 'Support center 24/7', 'car-services-theme' ); ?></span>
									<a href="tel:<?php echo esc_attr( car_services_get_phone() ); ?>" class="footer-phone">
										<?php echo esc_html( car_services_get_phone() ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>

						<!-- Col 2: About Us -->
						<div class="footer-col">
							<h4 class="footer-col-title"><?php esc_html_e( 'About Us', 'car-services-theme' ); ?></h4>
							<ul class="footer-links">
								<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'car-services-theme' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/team' ) ); ?>"><?php esc_html_e( 'Our Team', 'car-services-theme' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/gallery' ) ); ?>"><?php esc_html_e( 'Our Works', 'car-services-theme' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'car-services-theme' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'car-services-theme' ); ?></a></li>
							</ul>
						</div>

						<!-- Col 3: Popular Services (2 sub-columns) -->
						<div class="footer-col footer-col-services">
							<h4 class="footer-col-title"><?php esc_html_e( 'Popular Services', 'car-services-theme' ); ?></h4>
							<div class="footer-services-grid">
								<ul class="footer-links">
									<li><a href="<?php echo esc_url( home_url( '/services/tire-repair' ) ); ?>"><?php esc_html_e( 'Tire Repair', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/brake-repair' ) ); ?>"><?php esc_html_e( 'Brake Repair', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/engine-repair' ) ); ?>"><?php esc_html_e( 'Engine Repair', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/steering-repair' ) ); ?>"><?php esc_html_e( 'Steering Repair', 'car-services-theme' ); ?></a></li>
								</ul>
								<ul class="footer-links">
									<li><a href="<?php echo esc_url( home_url( '/services/cooling-system' ) ); ?>"><?php esc_html_e( 'Cooling System', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/wheel-alignment' ) ); ?>"><?php esc_html_e( 'Wheel Alignment', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/battery' ) ); ?>"><?php esc_html_e( 'Battery & Starting', 'car-services-theme' ); ?></a></li>
									<li><a href="<?php echo esc_url( home_url( '/services/suspension' ) ); ?>"><?php esc_html_e( 'Suspension Repair', 'car-services-theme' ); ?></a></li>
								</ul>
							</div>
						</div>

						<!-- Col 4: Subscribe -->
						<div class="footer-col footer-col-subscribe">
							<h4 class="footer-col-title"><?php esc_html_e( 'Subscribe', 'car-services-theme' ); ?></h4>
							<form class="footer-subscribe-form" action="#" method="post">
								<label class="footer-input-label" for="footer-email"><?php esc_html_e( 'Your Email', 'car-services-theme' ); ?></label>
								<input
									type="email"
									id="footer-email"
									name="email"
									class="footer-email-input"
									placeholder="<?php esc_attr_e( 'Enter Your Email Address', 'car-services-theme' ); ?>"
									required
								/>
								<button type="submit" class="footer-subscribe-btn">
									<?php esc_html_e( 'Subscribe', 'car-services-theme' ); ?>
								</button>
							</form>
						</div>

					</div><!-- .footer-grid -->
				</div><!-- .footer-container -->
			</div><!-- .footer-main -->

			<!-- Footer Bottom Bar -->
			<div class="footer-bottom">
				<div class="footer-container">
					<div class="footer-bottom-inner">
						<p class="site-info">
							<?php
							if ( car_services_get_option( 'car_services_copyright' ) ) {
								car_services_the_text( car_services_get_option( 'car_services_copyright' ) );
							} else {
								printf(
									'&copy; %1$s %2$s. %3$s',
									esc_html( wp_date( 'Y' ) ),
									esc_html( get_bloginfo( 'name' ) ),
									esc_html__( 'All rights reserved.', 'car-services-theme' )
								);
							}
							?>
						</p>

						<?php
						// Social media icons
						$socials = array(
							'facebook'  => array(
								'url'   => car_services_field( 'social_facebook', '' ),
								'label' => 'Facebook',
								'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
							),
							'instagram' => array(
								'url'   => car_services_field( 'social_instagram', '' ),
								'label' => 'Instagram',
								'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
							),
							'twitter'   => array(
								'url'   => car_services_field( 'social_twitter', '' ),
								'label' => 'X / Twitter',
								'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.741l7.73-8.835L2.25 2.25h6.961l4.265 5.638 5.768-5.638Zm-1.161 17.52h1.833L7.084 4.126H5.117Z"/></svg>',
							),
							'youtube'   => array(
								'url'   => car_services_field( 'social_youtube', '' ),
								'label' => 'YouTube',
								'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon fill="#1a1a1a" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>',
							),
							'tiktok'    => array(
								'url'   => car_services_field( 'social_tiktok', '' ),
								'label' => 'TikTok',
								'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.75a8.16 8.16 0 0 0 4.78 1.53V6.82a4.85 4.85 0 0 1-1.01-.13z"/></svg>',
							),
						);

						$has_socials = false;
						foreach ( $socials as $s ) {
							if ( $s['url'] ) { $has_socials = true; break; }
						}

						if ( $has_socials ) :
						?>
							<div class="footer-social-icons">
								<?php foreach ( $socials as $network => $s ) : ?>
									<?php if ( $s['url'] ) : ?>
										<a href="<?php echo esc_url( $s['url'] ); ?>" class="footer-social-icon footer-social-<?php echo esc_attr( $network ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $s['label'] ); ?>">
											<?php echo $s['icon']; ?>
										</a>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div><!-- .footer-bottom -->

		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php
	/* ── Book Now Modal ──────────────────────────────────────────────────
	 * Triggered by any link/button on the site containing the text
	 * "Book Now" (case-insensitive). See initBookNowModal() in main.js.
	 * The form area accepts any third-party shortcode via the ACF field
	 * "Book Now Modal — Form Shortcode" on the homepage edit screen.
	 * ──────────────────────────────────────────────────────────────────── */
	$bn_title     = car_services_field( 'book_now_title', __( 'Book Your Appointment', 'car-services-theme' ) );
	$bn_subtitle  = car_services_field( 'book_now_subtitle', __( 'Tell us what you need and our team will get back to you within 24 hours.', 'car-services-theme' ) );
	$bn_shortcode = car_services_field( 'book_now_shortcode', '' );
	?>
	<div id="book-now-modal" class="cs-modal" role="dialog" aria-modal="true" aria-labelledby="book-now-modal-title" aria-hidden="true">
		<div class="cs-modal-backdrop" data-cs-modal-close></div>

		<div class="cs-modal-dialog" role="document">
			<button type="button" class="cs-modal-close" aria-label="<?php esc_attr_e( 'Close', 'car-services-theme' ); ?>" data-cs-modal-close></button>

			<div class="cs-modal-header">
				<h2 id="book-now-modal-title" class="cs-modal-title"><?php echo esc_html( $bn_title ); ?></h2>
				<?php if ( $bn_subtitle ) : ?>
					<p class="cs-modal-subtitle"><?php echo esc_html( $bn_subtitle ); ?></p>
				<?php endif; ?>
			</div>

			<div class="cs-modal-body">
				<?php if ( $bn_shortcode ) : ?>
					<?php echo do_shortcode( wp_kses_post( $bn_shortcode ) ); ?>
				<?php else : ?>
					<!-- Fallback form (used when no shortcode is configured) -->
					<form class="cs-modal-form contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<?php wp_nonce_field( 'cs_book_form', 'cs_book_nonce' ); ?>
						<input type="hidden" name="action" value="cs_book_form">

						<div class="form-group">
							<label for="cs_book_name"><?php esc_html_e( 'Full Name', 'car-services-theme' ); ?> <span>*</span></label>
							<input type="text" id="cs_book_name" name="cs_name" required>
						</div>

						<div class="form-row form-row-2">
							<div class="form-group">
								<label for="cs_book_phone"><?php esc_html_e( 'Phone', 'car-services-theme' ); ?> <span>*</span></label>
								<input type="tel" id="cs_book_phone" name="cs_phone" required>
							</div>
							<div class="form-group">
								<label for="cs_book_email"><?php esc_html_e( 'Email', 'car-services-theme' ); ?></label>
								<input type="email" id="cs_book_email" name="cs_email">
							</div>
						</div>

						<div class="form-group">
							<label for="cs_book_service"><?php esc_html_e( 'Service Required', 'car-services-theme' ); ?></label>
							<select id="cs_book_service" name="cs_service">
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
							<label for="cs_book_message"><?php esc_html_e( 'Message', 'car-services-theme' ); ?></label>
							<textarea id="cs_book_message" name="cs_message" rows="3" placeholder="<?php esc_attr_e( 'Preferred date, vehicle details, anything else we should know…', 'car-services-theme' ); ?>"></textarea>
						</div>

						<button type="submit" class="btn btn-primary btn-lg btn-block">
							<?php esc_html_e( 'Send Booking Request', 'car-services-theme' ); ?>
						</button>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
