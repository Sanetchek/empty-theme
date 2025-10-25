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

<?php $masterhead_class = wp_is_mobile() ? 'mobile' : 'desktop'; ?>
<body <?php body_class( array('site_' . $masterhead_class) ); ?>>
	<?php wp_body_open(); ?>

	<a href="#main_content" class="skip-link screen-reader-text"><?php _e('Skip to main content', 'emptytheme'); ?></a>

	<header id="masthead" class="site-header">
		<div class="container site-header__inner">
			<?php if (wp_is_mobile()) : ?>
				<?php
				show_logo();
				show_burger_menu();
				?>
			<?php else : ?>
				<?php show_logo(); ?>
				<nav class="site-header__menu" aria-label="<?php esc_attr_e('Main Navigation', 'emptytheme'); ?>">
					<?php
					wp_nav_menu([
						'theme_location' => 'header-menu',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'site-header__menu_list',
						'fallback_cb'    => false,
					]);
					?>
				</nav>
				<?php
				$button_title = emptytheme_get_option('header_button_title', 'Connect');
				$button_url = emptytheme_get_option('header_button_url', '#');
				show_button($button_title, $button_url, 'black', 'site-header__button');
				?>
			<?php endif; ?>
		</div>
	</header>

	<main id="main_content" class="main-content">