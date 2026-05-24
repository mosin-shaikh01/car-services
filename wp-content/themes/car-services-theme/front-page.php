<?php
/**
 * Template for displaying the front page
 * template name: Front Page
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="homepage">
	<?php
	// Hero Section with logo and background
	get_template_part( 'template-parts/sections/hero' );

	// Brand Logos Carousel
	get_template_part( 'template-parts/sections/brands' );

	// Services Section with 4 cards
	get_template_part( 'template-parts/sections/services' );

	// Why Choose Us Section
	get_template_part( 'template-parts/sections/why-choose-us' );

	// CTA Section
	get_template_part( 'template-parts/sections/cta' );

	// Testimonials Masonry Grid Section
	get_template_part( 'template-parts/sections/testimonials' );
	?>
</div><!-- .homepage -->

<?php
get_footer();
