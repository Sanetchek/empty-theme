<?php

/**
 * Outputs links to the site search, favorites, and user profile pages.
 *
 * @param bool $is_show Whether to show the links. Defaults to false.
 */
function show_header_links($is_show = false) {
	if (!$is_show) return;
	?>
	<a href="#" class="header-search" aria-label="Search the site">
		<svg class="header-search-icon" width="22" height="22" role="img" aria-label="Search icon">
			<use href="<?php echo esc_url(sprite('search')); ?>"></use>
		</svg>
	</a>
	<a href="/favorites" class="header-favorites" aria-label="View favorites">
		<svg class="header-favorites-icon" width="24" height="20" role="img" aria-label="Favorites icon">
			<use href="<?php echo esc_url(sprite('heart')); ?>"></use>
		</svg>
	</a>
	<a href="/my-account" class="header-profile" aria-label="View user profile">
		<svg class="header-profile-icon" width="24" height="20" role="img" aria-label="Profile icon">
			<use href="<?php echo esc_url(sprite('user')); ?>"></use>
		</svg>
	</a>
	<?php
}