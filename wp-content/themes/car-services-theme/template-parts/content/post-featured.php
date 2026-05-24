<?php
/**
 * Featured Image Template Part
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<div class="entry-thumbnail">
	<?php
	the_post_thumbnail( 'car-services-large', array(
		'class' => 'featured-image',
		'alt'   => the_title_attribute( array( 'echo' => false ) ),
	) );
	?>
</div>
