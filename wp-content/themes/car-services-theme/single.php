<?php
/**
 * The template for displaying single posts
 *
 * @package Car_Services_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="page-banner" style="<?php echo has_post_thumbnail() ? 'background-image: url(\'' . esc_url( get_the_post_thumbnail_url( null, 'full' ) ) . '\');' : 'background-image: url(\'' . esc_url( CAR_SERVICES_URI . '/assets/images/hero-bg.svg' ) . '\');'; ?>">
	<div class="page-banner-overlay"></div>
	<div class="container">
		<div class="page-banner-content">
			<h1><?php the_title(); ?></h1>
			<p class="page-banner-meta">
				<?php
				echo esc_html( get_the_date() );
				$cats = get_the_category();
				if ( $cats ) {
					echo ' &nbsp;·&nbsp; ' . esc_html( $cats[0]->name );
				}
				?>
			</p>
		</div>
	</div>
</section>

<div class="container">
	<div class="content-area <?php echo is_active_sidebar( 'primary-sidebar' ) ? 'with-sidebar' : ''; ?>">
		<div class="main-content">
			<?php
			while ( have_posts() ) {
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item single-post' ); ?>>
					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before'    => '<div class="page-links">' . esc_html__( 'Pages:', 'car-services-theme' ),
							'after'     => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
						?>
					</div>

					<footer class="entry-footer">
						<?php
						$tags = get_the_tags();
						if ( $tags ) {
							echo '<div class="post-tags">';
							echo '<span class="tags-label">' . esc_html__( 'Tags: ', 'car-services-theme' ) . '</span>';
							foreach ( $tags as $tag ) {
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-link">' . esc_html( $tag->name ) . '</a> ';
							}
							echo '</div>';
						}
						?>
					</footer>

					<nav class="post-navigation single-post-nav">
						<?php
						$prev = get_previous_post();
						$next = get_next_post();
						if ( $prev || $next ) {
							echo '<div class="post-nav-links">';
							if ( $prev ) {
								echo '<a href="' . esc_url( get_permalink( $prev ) ) . '" class="nav-prev">← ' . esc_html( get_the_title( $prev ) ) . '</a>';
							}
							if ( $next ) {
								echo '<a href="' . esc_url( get_permalink( $next ) ) . '" class="nav-next">' . esc_html( get_the_title( $next ) ) . ' →</a>';
							}
							echo '</div>';
						}
						?>
					</nav>
				</article>

				<?php comments_template(); ?>
				<?php
			}
			?>
		</div><!-- .main-content -->

		<?php
		if ( is_active_sidebar( 'primary-sidebar' ) ) {
			get_sidebar();
		}
		?>
	</div><!-- .content-area -->
</div><!-- .container -->

<?php
get_footer();
