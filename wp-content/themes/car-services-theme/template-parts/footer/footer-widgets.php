<?php
/**
 * Footer Widgets Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) && ! is_active_sidebar( 'footer-4' ) ) {
	return;
}
?>

<div class="footer-widgets">
	<?php
	for ( $i = 1; $i <= 4; $i++ ) {
		if ( is_active_sidebar( 'footer-' . $i ) ) {
			echo '<div class="footer-widget-area">';
			dynamic_sidebar( 'footer-' . $i );
			echo '</div>';
		}
	}
	?>
</div>
