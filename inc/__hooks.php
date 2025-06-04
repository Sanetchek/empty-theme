<?php
/**
 * Login redirect if not administrator, editor, Yoast SEO manager/editor, or shop manager
 */
add_action('admin_init', function () {
	if (!current_user_can('administrator') &&
		!current_user_can('editor') &&
		!current_user_can('wpseo_manager') &&
		!current_user_can('wpseo_editor') &&
		!current_user_can('shop_manager') &&
		(!defined('DOING_AJAX') || !DOING_AJAX)) {

		wp_safe_redirect(home_url('/')); // Redirect to homepage instead of 404
		exit;
	}
});

/**
 * Counting the number of page visits
 */
add_action('wp_head', function ($args = []) {
	global $wpdb, $post, $user_ID;
	$rg = (object) wp_parse_args($args, [
		'meta_key' => 'views',
		'who_count' => 0,
		'exclude_bots' => true,
	]);

	$do_count = $rg->who_count === 0 ? true : ($rg->who_count === 1 ? !$user_ID : (bool) $user_ID);

	if ($do_count && $rg->exclude_bots) {
		$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
		if ($user_agent && !preg_match('/Mozilla|Opera/i', $user_agent) || preg_match('/Bot\/|robot|Slurp\/|yahoo/i', $user_agent)) {
			$do_count = false;
		}
	}

	if (!$do_count) return;

	if (is_singular()) {
		$updated = $wpdb->query($wpdb->prepare(
			"UPDATE $wpdb->postmeta SET meta_value = (meta_value+1) WHERE post_id = %d AND meta_key = %s",
			$post->ID, $rg->meta_key
		));

		if (!$updated) {
			add_post_meta($post->ID, $rg->meta_key, 1, true);
		}
		wp_cache_delete($post->ID, 'post_meta');
	} elseif (is_author()) {
		$user = get_user_by('slug', get_query_var('author_name'));
		$updated = $wpdb->query($wpdb->prepare(
			"UPDATE $wpdb->usermeta SET meta_value = (meta_value+1) WHERE user_id = %d AND meta_key = %s",
			$user->ID, $rg->meta_key
		));

		if (!$updated) {
			add_user_meta($user->ID, $rg->meta_key, 1, true);
		}
		wp_cache_delete($user->ID, 'user_meta');
	}
});

/**
 * Contact form 7 remove span
 */
add_filter('wpcf7_form_elements', function ($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

	$content = str_replace('<br />', '', $content);

	return $content;
});

/**
 * Allow SVG
 */
add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}, 10, 1);

/**
 * Check file type and extension for SVG
 */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
	if (!empty($data['ext']) && !empty($data['type'])) {
		return $data;
	}

	$wp_filetype = wp_check_filetype($filename, $mimes);
	if ('svg' === $wp_filetype['ext'] || 'svgz' === $wp_filetype['ext']) {
		$data['ext'] = $wp_filetype['ext'];
		$data['type'] = 'image/svg+xml';
	}

	return $data;
}, 10, 4);