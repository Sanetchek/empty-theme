<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package emptytheme
 */

?>
	</main>

	<?php
	// Show mobile menu (only on mobile devices)
	show_mobile_menu();
	?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__inner container">

			<div class="site-footer__inner_top">
				<div class="site-footer__logo">
					<?php show_logo(); ?>
				</div>

				<nav class="site-footer__menu" aria-label="<?php esc_attr_e('Footer Navigation', 'emptytheme'); ?>">
					<?php wp_nav_menu([
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'container'      => false,
						'menu_class'     => 'site-footer__menu_list',
						'fallback_cb'    => false,
					]); ?>
				</nav>
			</div>

			<div class="site-footer__inner_middle">
				<?php echo do_shortcode('[theme_footer_text]'); ?>
			</div>

			<div class="site-footer__inner_privacy">
				<nav class="site-footer__privacy_menu" aria-label="<?php esc_attr_e('Privacy Navigation', 'emptytheme'); ?>">
					<?php wp_nav_menu([
						'theme_location' => 'privacy-menu',
						'menu_id'        => 'privacy-menu',
						'container'      => false,
						'menu_class'     => 'site-footer__privacy_menu_list',
						'fallback_cb'    => false,
					]); ?>
				</nav>
			</div>

			<div class="site-footer__inner_bottom">
				<div class="site-footer__company"><?php _e('Company name', 'emptytheme'); ?></div>

				<div class="site-footer__copyright"><?php echo do_shortcode('[theme_copyright]'); ?></div>
			</div>

		</div><!-- .site-footer__inner -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
