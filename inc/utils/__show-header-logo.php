<?php

/**
 * Shows the header logo
 *
 * @param string $acf_logo_field The field name of the logo in ACF
 */
function show_header_logo($acf_logo_field = '') {
	// Get the logo from the customizer (Site Identity > Logo)
	$custom_logo_id = get_theme_mod('custom_logo');
	if ($custom_logo_id) {
		$logo = wp_get_attachment_image_url($custom_logo_id, 'full');
	} else {
		$logo = assets('images/logo.svg');
	}
	?>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" aria-label="<?php esc_attr_e('Go to homepage', 'emptytheme'); ?>">
		<img rel="preload" as="image" src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr_e('Site logo', 'emptytheme'); ?>">
	</a>
	<?php
}
