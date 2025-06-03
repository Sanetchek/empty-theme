<?php

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