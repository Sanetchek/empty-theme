<?php

/**
 * Shows the header logo
 *
 */
function show_logo()
{ ?>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" aria-label="<?php esc_attr_e('Go to homepage', 'emptytheme'); ?>">
		<?php
		// Get the logo from theme options
		$custom_logo_id = emptytheme_get_logo_id();
		if ($custom_logo_id) {
			echo function_exists('liteimage') ? liteimage($custom_logo_id, [
				'thumb' => [0, 29],
				'args' => ['alt' => get_bloginfo('name'), 'fetchpriority' => 'high', 'loading' => 'eager', 'class' => 'header-logo-image']
			]) : get_image($custom_logo_id, [0, 29], ['alt' => get_bloginfo('name'), 'fetchpriority' => 'high', 'loading' => 'eager', 'class' => 'header-logo-image']);
		} else {
			$logo = assets('images/logo.svg');
			echo '<img rel="preload" width="122" height="29" loading="eager" fetchpriority="high" as="image" src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '" class="header-logo-image">';
		}
		?>
	</a>
	<?php
}