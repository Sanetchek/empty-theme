<?php

/**
 * Shows the mobile menu
 * Only displays on mobile devices using wp_is_mobile()
 *
 * @since 1.0.0
 * @return void
 */
function show_mobile_menu() {
	// Only show on mobile devices
	if ( ! wp_is_mobile() ) {
		return;
	}
	?>
	<!-- Mobile Menu Overlay -->
	<div id="mobile-menu-overlay"></div>

	<!-- Mobile Menu -->
	<aside id="mobile-menu" class="mobile-menu">
		<div class="mobile-menu__header">
			<button type="button" class="mobile-menu__close" aria-label="<?php esc_attr_e('Close menu', 'emptytheme'); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
				</svg>
			</button>
		</div>

		<nav class="mobile-menu__nav" aria-label="<?php esc_attr_e('Mobile Navigation', 'emptytheme'); ?>">
			<?php
			wp_nav_menu([
				'theme_location' => 'mobile-menu',
				'menu_id'        => 'mobile-menu-list',
				'container'      => false,
				'menu_class'     => 'mobile-menu__list',
				'fallback_cb'    => function() {
					// Fallback to header menu if mobile menu doesn't exist
					wp_nav_menu([
						'theme_location' => 'header-menu',
						'menu_id'        => 'mobile-menu-list-fallback',
						'container'      => false,
						'menu_class'     => 'mobile-menu__list',
						'fallback_cb'    => false,
					]);
				},
			]);
			?>
		</nav>

		<div class="mobile-menu__footer">
			<?php
			// Show connect button
			if ( function_exists( 'show_button' ) ) {
				$button_title = function_exists('emptytheme_get_option') ? emptytheme_get_option('header_button_title', 'Connect') : 'Connect';
				$button_url = function_exists('emptytheme_get_option') ? emptytheme_get_option('header_button_url', '#') : '#';
				show_button($button_title, $button_url, 'black', 'mobile-menu__button');
			}
			?>
		</div>
	</aside>
	<?php
}
