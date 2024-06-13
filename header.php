<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package emptytheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header id="masthead">
			<div class="site-header">
				<div class="container header__wrap">
					<?php if (theme_logo()) : ?>
						<?= theme_logo(); // Appearance -> Customize -> Site Identity -> Logo field ?>
					<?php else : ?>
						<a href="/" class="site-branding" rel="home" aria-current="page" tabindex="0">
							<?php bloginfo('name'); ?>
						</a><!-- .site-branding -->
					<?php endif; ?>

					<nav class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->

					<div id="burger-menu" class="burger-menu">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div>
				</div>

			</div>
		</header><!-- #masthead -->
