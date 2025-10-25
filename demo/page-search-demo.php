<?php
/**
 * Template Name: Search Form Demo
 *
 * This template demonstrates different search form variants
 */

get_header();
?>

<div class="search-demo-page">
	<div class="container">
		<section class="search-demo">
			<header class="search-demo__header">
				<h1><?php esc_html_e('Search Form Variants Demo', 'emptytheme'); ?></h1>
				<p><?php esc_html_e('Different styles of search forms for various use cases', 'emptytheme'); ?></p>
			</header>

			<div class="search-demo__variants">

				<!-- Default Search Form -->
				<div class="search-demo__variant">
					<h3><?php esc_html_e('Default Search Form', 'emptytheme'); ?></h3>
					<p><?php esc_html_e('Standard search form for general use', 'emptytheme'); ?></p>
					<?php get_search_form(); ?>
				</div>

				<!-- Compact Search Form -->
				<div class="search-demo__variant">
					<h3><?php esc_html_e('Compact Search Form', 'emptytheme'); ?></h3>
					<p><?php esc_html_e('Smaller version for headers and sidebars', 'emptytheme'); ?></p>
					<?php show_search_form_variant('compact', __('Quick search...', 'emptytheme')); ?>
				</div>

				<!-- Large Search Form -->
				<div class="search-demo__variant">
					<h3><?php esc_html_e('Large Search Form', 'emptytheme'); ?></h3>
					<p><?php esc_html_e('Bigger version for hero sections', 'emptytheme'); ?></p>
					<?php show_search_form_variant('large', __('Search our entire website...', 'emptytheme')); ?>
				</div>

				<!-- Dark Search Form -->
				<div class="search-demo__variant search-demo__variant--dark">
					<h3><?php esc_html_e('Dark Search Form', 'emptytheme'); ?></h3>
					<p><?php esc_html_e('Dark theme version for dark backgrounds', 'emptytheme'); ?></p>
					<?php show_search_form_variant('dark', __('Search in dark mode...', 'emptytheme')); ?>
				</div>

			</div>

			<div class="search-demo__usage">
				<h3><?php esc_html_e('Usage Examples', 'emptytheme'); ?></h3>
				<div class="search-demo__code">
					<h4><?php esc_html_e('PHP Code:', 'emptytheme'); ?></h4>
					<pre><code><?php esc_html_e('// Default form
get_search_form();

// Compact form
show_search_form_variant("compact", "Quick search...");

// Large form
show_search_form_variant("large", "Search our website...");

// Dark form
show_search_form_variant("dark", "Search in dark mode...");', 'emptytheme'); ?></code></pre>
				</div>
			</div>

		</section>
	</div>
</div>

<style>
.search-demo-page {
	padding: 4rem 0;
	background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
	min-height: 100vh;
}

.search-demo {
	max-width: 1000px;
	margin: 0 auto;
}

.search-demo__header {
	text-align: center;
	margin-bottom: 4rem;
}

.search-demo__header h1 {
	font-size: 2.5rem;
	color: var(--color-dark);
	margin-bottom: 1rem;
}

.search-demo__header p {
	font-size: 1.25rem;
	color: var(--color-text);
}

.search-demo__variants {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 3rem;
	margin-bottom: 4rem;
}

.search-demo__variant {
	background: var(--color-white);
	padding: 2rem;
	border-radius: 15px;
	text-align: center;
}

.search-demo__variant--dark {
	background: var(--color-dark);
	color: var(--color-white);
}

.search-demo__variant--dark h3,
.search-demo__variant--dark p {
	color: var(--color-white);
}

.search-demo__variant h3 {
	font-size: 1.5rem;
	margin-bottom: 1rem;
	color: var(--color-dark);
}

.search-demo__variant p {
	font-size: 1rem;
	color: var(--color-text);
	margin-bottom: 2rem;
}

.search-demo__usage {
	background: var(--color-white);
	padding: 2rem;
	border-radius: 15px;
}

.search-demo__usage h3 {
	font-size: 1.5rem;
	margin-bottom: 1.5rem;
	color: var(--color-dark);
}

.search-demo__code {
	background: #f8f9fa;
	padding: 1.5rem;
	border-radius: 8px;
	border-left: 4px solid var(--color-yellow);
}

.search-demo__code h4 {
	font-size: 1.125rem;
	margin-bottom: 1rem;
	color: var(--color-dark);
}

.search-demo__code pre {
	margin: 0;
	overflow-x: auto;
}

.search-demo__code code {
	font-family: 'Courier New', monospace;
	font-size: 0.9rem;
	line-height: 1.5;
	color: #333;
}
</style>

<?php
get_footer();
