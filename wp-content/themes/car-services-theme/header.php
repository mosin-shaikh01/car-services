<?php
/**
 * The header for the theme
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'car-services-theme' ); ?></a>

	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div class="header-container">
				<div class="header-top">
					<div class="site-branding">
						<?php car_services_logo(); ?>
						<?php if ( ! has_custom_logo() ) : ?>
							<div class="site-title-tagline">
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</h1>
								<?php
								$site_description = get_bloginfo( 'description', 'display' );
								if ( $site_description ) {
									echo '<p class="site-description">' . esc_html( $site_description ) . '</p>';
								}
								?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( car_services_get_phone() || car_services_get_email() ) : ?>
						<div class="header-contact">
							<?php if ( car_services_get_phone() ) : ?>
								<div class="contact-phone">
									<a href="tel:<?php echo esc_attr( car_services_get_phone() ); ?>">
										<?php echo esc_html( car_services_get_phone() ); ?>
									</a>
								</div>
							<?php endif; ?>

							<?php if ( car_services_get_email() ) : ?>
								<div class="contact-email">
									<a href="mailto:<?php echo esc_attr( car_services_get_email() ); ?>">
										<?php echo esc_html( car_services_get_email() ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="hamburger"></span>
						<span class="hamburger"></span>
						<span class="hamburger"></span>
					</button>

					<div class="nav-wrapper">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'fallback_cb'    => 'wp_page_menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						) );
						?>

						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline btn-contact-mobile">
							<?php esc_html_e( 'Contact', 'car-services-theme' ); ?>
						</a>
					</div>

					<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline btn-contact-desktop">
						<?php esc_html_e( 'Contact', 'car-services-theme' ); ?>
					</a>
				</nav>
			</div>
		</header><!-- #masthead -->

		<main id="main" class="site-main">
