<?php
/**
 * Template Name: About Us
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

get_header();

// ── Banner ──────────────────────────────────────────────────────────────────
$banner_title    = car_services_field( 'about_banner_title', __( 'About Us', 'car-services-theme' ) );
$banner_subtitle = car_services_field( 'about_banner_subtitle', __( 'The team behind Dark Skull Autocare', 'car-services-theme' ) );
$banner_bg       = car_services_field( 'about_banner_bg', CAR_SERVICES_URI . '/assets/images/hero-bg.svg' );

// ── Story ────────────────────────────────────────────────────────────────────
$story_tag     = car_services_field( 'about_story_tag', __( 'Our Story', 'car-services-theme' ) );
$story_heading = car_services_field( 'about_story_heading', __( 'Built on Passion, Driven by Trust', 'car-services-theme' ) );
$story_content = car_services_field( 'about_story_content', __( 'Dark Skull Autocare was founded with one simple mission: to give every driver the kind of honest, expert care that is hard to find. We started as a small family-run garage and have grown into one of the most trusted names in the area — but our values have never changed.

Every vehicle that comes through our doors is treated with respect. Every customer receives a straight answer, a fair price, and a job done right. We do not cut corners, we do not upsell unnecessarily, and we do not let a car leave until we are proud of the work.', 'car-services-theme' ) );
$story_image   = car_services_field( 'about_story_image', '' );

// ── Stats ────────────────────────────────────────────────────────────────────
$stats_defaults = array(
	1 => array( '15+', 'Years Experience' ),
	2 => array( '8,500+', 'Cars Serviced' ),
	3 => array( '12', 'Certified Technicians' ),
	4 => array( '99%', 'Customer Satisfaction' ),
);
$stats = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$stats[] = array(
		'number' => car_services_field( 'about_stat_' . $i . '_number', $stats_defaults[ $i ][0] ),
		'label'  => car_services_field( 'about_stat_' . $i . '_label', $stats_defaults[ $i ][1] ),
	);
}

// ── Values ───────────────────────────────────────────────────────────────────
$values_tag     = car_services_field( 'about_values_tag', __( 'What We Stand For', 'car-services-theme' ) );
$values_heading = car_services_field( 'about_values_heading', __( 'Our Core Values', 'car-services-theme' ) );

$values_defaults = array(
	1 => array( '🎯', 'Integrity First', 'We give you the truth about your vehicle — always. No made-up faults, no inflated estimates.' ),
	2 => array( '🔩', 'Expert Craftsmanship', 'Every technician is fully trained and takes pride in every single job, big or small.' ),
	3 => array( '❤️', 'Customer First', 'Your experience matters. From your first call to collecting your keys, we make it simple.' ),
);
$values = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$values[] = array(
		'icon'        => car_services_field( 'about_value_' . $i . '_icon', $values_defaults[ $i ][0] ),
		'title'       => car_services_field( 'about_value_' . $i . '_title', $values_defaults[ $i ][1] ),
		'description' => car_services_field( 'about_value_' . $i . '_description', $values_defaults[ $i ][2] ),
	);
}

// ── Team ─────────────────────────────────────────────────────────────────────
$team_tag     = car_services_field( 'about_team_tag', __( 'Meet the Team', 'car-services-theme' ) );
$team_heading = car_services_field( 'about_team_heading', __( 'The People Behind the Wrenches', 'car-services-theme' ) );

$team_defaults = array(
	1 => array( 'Marcus Reid', 'Lead Technician & Founder', '', 'Over 20 years of hands-on experience across all vehicle makes. Marcus built this garage from the ground up.' ),
	2 => array( 'Jordan Blake', 'Senior Mechanic', '', 'Specialises in diagnostics and electrical systems. Jordan has a reputation for fixing what others cannot.' ),
	3 => array( 'Priya Nair', 'Service Advisor', '', 'Priya is your first point of contact — keeping communication clear, bookings smooth, and customers happy.' ),
	4 => array( 'Danny Walsh', 'MOT Tester & Technician', '', 'Our certified MOT tester with an eye for detail and a passion for keeping cars roadworthy.' ),
);
$team = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$team[] = array(
		'name'  => car_services_field( 'about_team_' . $i . '_name', $team_defaults[ $i ][0] ),
		'role'  => car_services_field( 'about_team_' . $i . '_role', $team_defaults[ $i ][1] ),
		'image' => car_services_field( 'about_team_' . $i . '_image', '' ),
		'bio'   => car_services_field( 'about_team_' . $i . '_bio', $team_defaults[ $i ][3] ),
	);
}

// ── CTA ───────────────────────────────────────────────────────────────────────
$cta_heading  = car_services_field( 'about_cta_heading', __( 'Ready to Book Your Service?', 'car-services-theme' ) );
$cta_text     = car_services_field( 'about_cta_text', __( 'Get in touch with our team today — we are always happy to help.', 'car-services-theme' ) );
$cta_btn_text = car_services_field( 'about_cta_btn_text', __( 'Contact Us', 'car-services-theme' ) );
$cta_btn_url  = car_services_field( 'about_cta_btn_url', home_url( '/contact' ) );
$cta_bg    = car_services_field( 'about_cta_bg_image', '' );
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

<!-- ── Our Story ───────────────────────────────────────────────────────── -->
<section class="about-story">
	<div class="container">
		<div class="about-story-grid">
			<div class="about-story-content">
				<span class="section-tag"><?php echo esc_html( $story_tag ); ?></span>
				<h2><?php echo esc_html( $story_heading ); ?></h2>
				<div class="about-story-text">
					<?php
					$paragraphs = array_filter( array_map( 'trim', explode( "\n\n", $story_content ) ) );
					foreach ( $paragraphs as $p ) {
						echo '<p>' . esc_html( $p ) . '</p>';
					}
					?>
				</div>
			</div>
			<div class="about-story-image">
				<?php if ( $story_image ) : ?>
					<img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( $story_heading ); ?>">
				<?php else : ?>
					<div class="about-story-placeholder">
						<span>🔧</span>
						<p><?php esc_html_e( 'Upload a story image from the admin panel', 'car-services-theme' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- ── Stats Bar ───────────────────────────────────────────────────────── -->
<section class="about-stats">
	<div class="container">
		<div class="stats-grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat-item">
					<span class="stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
					<span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── Core Values ─────────────────────────────────────────────────────── -->
<section class="about-values">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $values_tag ); ?></span>
			<h2><?php echo esc_html( $values_heading ); ?></h2>
		</div>
		<div class="values-grid">
			<?php foreach ( $values as $value ) : ?>
				<div class="value-card">
					<div class="value-card-icon"><?php echo esc_html( $value['icon'] ); ?></div>
					<h3><?php echo esc_html( $value['title'] ); ?></h3>
					<p><?php echo esc_html( $value['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ── Team ────────────────────────────────────────────────────────────── -->
<section class="about-team">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $team_tag ); ?></span>
			<h2><?php echo esc_html( $team_heading ); ?></h2>
		</div>
		<div class="team-grid">
			<?php foreach ( $team as $member ) :
				$words    = preg_split( '/\s+/', trim( $member['name'] ) );
				$initials = '';
				foreach ( $words as $w ) {
					if ( $w !== '' ) $initials .= strtoupper( mb_substr( $w, 0, 1 ) );
				}
			?>
				<div class="team-card">
					<div class="team-card-photo">
						<?php if ( $member['image'] ) : ?>
							<img src="<?php echo esc_url( $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
						<?php else : ?>
							<div class="team-card-avatar"><?php echo esc_html( $initials ); ?></div>
						<?php endif; ?>
					</div>
					<div class="team-card-info">
						<h3><?php echo esc_html( $member['name'] ); ?></h3>
						<span class="team-card-role"><?php echo esc_html( $member['role'] ); ?></span>
						<?php if ( $member['bio'] ) : ?>
							<p><?php echo esc_html( $member['bio'] ); ?></p>
						<?php endif; ?>
					</div>
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
			<a href="<?php echo esc_url( $cta_btn_url ); ?>" class="btn btn-primary btn-lg">
				<?php echo esc_html( $cta_btn_text ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
