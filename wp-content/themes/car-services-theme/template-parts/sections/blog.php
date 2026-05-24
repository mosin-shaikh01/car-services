<?php
/**
 * Blog Section Template Part
 *
 * @package Car_Services_Theme
 * @since 1.2.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tag        = car_services_field( 'blog_section_tag', __( 'Latest News', 'car-services-theme' ) );
$heading    = car_services_field( 'blog_section_heading', __( 'Tips & Insights', 'car-services-theme' ) );
$subheading = car_services_field( 'blog_section_subheading', __( 'Expert advice and updates from our team.', 'car-services-theme' ) );
$btn_text   = car_services_field( 'blog_section_button_text', __( 'Read All Articles', 'car-services-theme' ) );

// Query recent posts
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$posts = new WP_Query( $args );
?>

<section class="blog-section">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $tag ); ?></span>
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $subheading ); ?></p>
		</div>

		<?php if ( $posts->have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( $posts->have_posts() ) :
					$posts->the_post();
					$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
					?>
					<article class="blog-card">
						<?php if ( $featured_image ) : ?>
							<div class="blog-image">
								<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php the_title_attribute(); ?>">
							</div>
						<?php endif; ?>

						<div class="blog-content">
							<div class="blog-meta">
								<span class="blog-date"><?php echo esc_html( get_the_date( 'M d, Y' ) ); ?></span>
								<span class="blog-author">by <?php echo esc_html( get_the_author() ); ?></span>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="blog-link">
								<?php esc_html_e( 'Read More', 'car-services-theme' ); ?> →
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="blog-footer">
				<a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn-primary">
					<?php echo esc_html( $btn_text ); ?>
				</a>
			</div>
		<?php else : ?>
			<div class="no-posts-message">
				<p><?php esc_html_e( 'No blog posts yet. Check back soon!', 'car-services-theme' ); ?></p>
			</div>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>
