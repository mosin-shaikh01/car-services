<?php
/**
 * The main template file
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$blog_bg       = get_theme_mod( 'blog_banner_bg' ) ?: CAR_SERVICES_URI . '/assets/images/hero-bg.svg';
$blog_title    = get_theme_mod( 'blog_banner_title', __( 'Our Blog', 'car-services-theme' ) );
$blog_subtitle = get_theme_mod( 'blog_banner_subtitle', __( 'News, tips and advice from the Dark Skull Autocare team', 'car-services-theme' ) );
?>

<section class="page-banner" style="background-image: url('<?php echo esc_url( $blog_bg ); ?>');">
	<div class="page-banner-overlay"></div>
	<div class="container">
		<div class="page-banner-content">
			<h1><?php echo esc_html( $blog_title ); ?></h1>
			<p><?php echo esc_html( $blog_subtitle ); ?></p>
		</div>
	</div>
</section>

<div class="container">
	<div class="content-area <?php echo ( is_active_sidebar( 'primary-sidebar' ) && ! is_archive() ) ? 'with-sidebar' : ''; ?>">
		<div class="main-content">
			<?php
			if ( have_posts() ) {
				?>
				<div class="posts-list">
					<?php
					while ( have_posts() ) {
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
							<header class="entry-header">
								<?php
								if ( is_singular() ) {
									the_title( '<h1 class="entry-title">', '</h1>' );
								} else {
									the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								}
								?>
								<?php car_services_post_meta(); ?>
							</header><!-- .entry-header -->

							<?php car_services_featured_image( 'car-services-large' ); ?>

							<div class="entry-content">
								<?php
								the_excerpt();

								wp_link_pages( array(
									'before'         => '<div class="page-links">' . esc_html__( 'Pages:', 'car-services-theme' ),
									'after'          => '</div>',
									'link_before'    => '<span>',
									'link_after'     => '</span>',
									'pagelink'       => '<span aria-current="page">%</span>',
									'separator'      => ' ',
								) );
								?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<a href="<?php the_permalink(); ?>" class="read-more">
									<?php esc_html_e( 'Read More →', 'car-services-theme' ); ?>
								</a>
							</footer><!-- .entry-footer -->
						</article><!-- #post-<?php the_ID(); ?> -->
						<?php
					}
					?>
				</div><!-- .posts-list -->

				<?php
				car_services_post_navigation();
			} else {
				?>
				<div class="no-posts">
					<h2><?php esc_html_e( 'Nothing Found', 'car-services-theme' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'car-services-theme' ); ?></p>
					<?php get_search_form(); ?>
				</div>
				<?php
			}
			?>
		</div><!-- .main-content -->

		<?php
		if ( is_active_sidebar( 'primary-sidebar' ) && ! is_archive() ) {
			get_sidebar();
		}
		?>
	</div><!-- .content-area -->
</div><!-- .container -->

<?php
get_footer();
