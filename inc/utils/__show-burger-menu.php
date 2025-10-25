<?php

/**
 * Shows the hamburger menu button
 *
 * @since 1.0.0
 * @return void
 */
function show_burger_menu() {
	?>
	<button type="button" class="header-burger" aria-label="<?php esc_attr_e('Toggle navigation menu', 'emptytheme'); ?>" aria-expanded="false" aria-controls="mobile-menu">
		<span class="header-burger-icon" aria-hidden="true">
			<i></i><i></i><i></i>
		</span>
	</button>
	<?php
}
