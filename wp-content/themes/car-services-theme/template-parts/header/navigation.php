<?php
/**
 * Navigation Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<nav id="site-navigation" class="main-navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<span class="hamburger"></span>
		<span class="menu-label"><?php esc_html_e( 'Menu', 'car-services-theme' ); ?></span>
	</button>

	<?php
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
		'container'      => false,
		'fallback_cb'    => 'wp_page_menu',
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	) );
	?>
</nav><!-- #site-navigation -->
