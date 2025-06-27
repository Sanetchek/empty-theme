<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package emptytheme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip Link -->
<a class="skip-link screen-reader-text" href="#main_content"><?php esc_html_e('Skip to main content', 'emptytheme'); ?></a>

<?php $masterhead_class = wp_is_mobile() ? 'header-inner-mobile' : 'header-inner-desktop'; ?>
<header id="masthead" class="site-header <?php echo esc_attr($masterhead_class); ?>" role="banner">
	<div class="container header__wrap">
		<?php if (wp_is_mobile()) : ?>
			<?php
			show_burger_menu();
			show_header_logo();
			?>
		<?php else : ?>
			<nav class="header-menu-wrapper" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'emptytheme'); ?>">
				<?php
				wp_nav_menu([
					'theme_location' => 'header-menu',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'header-menu',
					'fallback_cb'    => false,
				]);
				?>
			</nav>
			<?php show_header_logo(); ?>
		<?php endif; ?>

		<div class="header-actions">
			<?php show_header_links(false); ?>
		</div>
	</div>
</header>

<main id="main_content" class="main-content">