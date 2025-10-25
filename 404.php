<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package emptytheme
 */

get_header();
?>

<div class="error-404-page">
	<div class="container">
		<section class="error-404 not-found">

			<!-- Animated 404 Number -->
			<div class="error-404__number" aria-hidden="true">
				<div class="error-404__digit error-404__digit--4">4</div>
				<div class="error-404__digit error-404__digit--0">0</div>
				<div class="error-404__digit error-404__digit--4-2">4</div>
			</div>

			<!-- Main Content -->
			<div class="error-404__content">
				<header class="error-404__header">
					<h1 class="error-404__title"><?php esc_html_e( 'Oops! Page Not Found', 'emptytheme' ); ?></h1>
					<p class="error-404__description"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'emptytheme' ); ?></p>
				</header>

				<!-- Search Form -->
				<section class="error-404__search">
					<h3><?php esc_html_e( 'Search for something else', 'emptytheme' ); ?></h3>
					<?php get_search_form(); ?>

				<!-- Search Suggestions -->
				<?php if (emptytheme_should_show_404_search_suggestions()) : ?>
				<div class="search-suggestions">
					<p><?php esc_html_e( 'Or try searching for:', 'emptytheme' ); ?></p>
					<?php emptytheme_show_404_popular_tags(6); ?>
				</div>
				<?php endif; ?>
				</section>

				<!-- Action Buttons -->
				<div class="error-404__actions">
					<?php show_button( __( 'Go Home', 'emptytheme' ), home_url(), 'yellow', 'error-404__button' ); ?>
				</div>

				<!-- Helpful Links -->
				<?php if (emptytheme_should_show_404_helpful_links()) : ?>
				<aside class="error-404__helpful-links" aria-label="<?php esc_attr_e('Helpful Links', 'emptytheme'); ?>">
					<h3><?php esc_html_e( 'Popular Pages', 'emptytheme' ); ?></h3>
					<div class="error-404__links-grid">

						<?php if (emptytheme_has_published_pages()) : ?>
						<div class="error-404__link-item">
							<h4><?php esc_html_e( 'Important Pages', 'emptytheme' ); ?></h4>
							<?php emptytheme_show_404_important_pages(5); ?>
						</div>
						<?php endif; ?>

						<?php if (emptytheme_has_published_posts()) : ?>
						<div class="error-404__link-item">
							<h4><?php esc_html_e( 'Recent Posts', 'emptytheme' ); ?></h4>
							<?php emptytheme_show_404_recent_posts(5); ?>
						</div>
						<?php endif; ?>

						<?php if (emptytheme_has_categories()) : ?>
						<div class="error-404__link-item">
							<h4><?php esc_html_e( 'Categories', 'emptytheme' ); ?></h4>
							<?php emptytheme_show_404_popular_categories(5); ?>
						</div>
						<?php endif; ?>

						<?php if (emptytheme_has_archives()) : ?>
						<div class="error-404__link-item">
							<h4><?php esc_html_e( 'Archives', 'emptytheme' ); ?></h4>
							<?php emptytheme_show_404_monthly_archives(5); ?>
						</div>
						<?php endif; ?>

					</div>
				</aside>
				<?php endif; ?>

			</div><!-- .error-404__content -->

		</section><!-- .error-404 -->
	</div><!-- .container -->
</div><!-- .error-404-page -->

<?php
get_footer();
