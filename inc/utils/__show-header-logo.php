<?php

/**
 * Shows the header logo
 *
 * @param string $acf_logo_field The field name of the logo in ACF
 */
function show_header_logo($acf_logo_field = '') {
	$logo = get_field($acf_logo_field, 'option') ?? assets('images/logo.svg');
	?>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" aria-label="<?php esc_attr_e('Go to homepage', 'noakirel'); ?>">
		<img rel="preload" as="image" src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr_e('Site logo', 'noakirel'); ?>">
	</a>
	<?php
}
