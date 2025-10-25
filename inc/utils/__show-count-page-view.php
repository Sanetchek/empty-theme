<?php

/**
 * Count Page View
 *
 * @param string $count_id Post ID
 * @param boolean $user Whether to get user views instead of post views
 * @return string Formatted view count
 */
function view($count_id = '', $user = false)
{
	global $post;

	if (!$count_id) {
		$count_id = $post->ID;
	}

	$view = get_post_meta($count_id, 'views', true);

	if ($user) {
		$view = get_user_meta($count_id, 'views', true);
	}

	if ($view) {
		if ($view > 999999) {
			$view /= 1000000;
			$view = round($view, 1);
			return $view . 'M';
		} elseif ($view > 999) {
			$view /= 1000;
			$view = round($view, 1);
			return $view . 'K';
		} else {
			return $view;
		}
	} else {
		return '0';
	}
}

/**
 * Get raw view count without formatting
 *
 * @param string $count_id Post ID
 * @param boolean $user Whether to get user views instead of post views
 * @return int Raw view count
 */
function get_raw_views($count_id = '', $user = false)
{
	global $post;

	if (!$count_id) {
		$count_id = $post->ID;
	}

	$view = get_post_meta($count_id, 'views', true);

	if ($user) {
		$view = get_user_meta($count_id, 'views', true);
	}

	return $view ? (int)$view : 0;
}
