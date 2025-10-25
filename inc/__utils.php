<?php

/**
 * Returns the URL to a file within the `assets` folder.
 *
 * @param string $source The relative path to the file.
 * @return string The full URL to the file.
 */
function assets($source = '') {
	return get_template_directory_uri() . '/assets/' . $source;
}

/**
 * Returns the URL to a specific icon within the sprite sheet.
 *
 * @param string $icon_id The identifier of the icon within the sprite sheet.
 * @return string The full URL to the icon in the sprite sheet.
 */
function sprite($icon_id = '') {
	return get_template_directory_uri() . '/assets/images/sprite.svg#' . $icon_id;
}

/**
 * Returns the URL to a specific social media icon within the sprite sheet.
 *
 * @param string $icon_id The identifier of the icon within the sprite sheet.
 * @return string The full URL to the icon in the sprite sheet.
 */
function social_sprite($icon_id = '') {
	return get_template_directory_uri() . '/assets/images/social-sprite.svg#' . $icon_id;
}

/**
 * Retrieve the HTML for an image, given its attachment ID.
 *
 * @param int    $img_id  The attachment ID of the image.
 * @param string $thumb   The size of the image to retrieve. Default 'large'.
 * @param array  $attr    The attributes to add to the <img> element. Default empty array.
 * @return string The HTML for the image.
 */
function get_image($img_id = '', $thumb = 'large', $attr = []) {
	return wp_get_attachment_image($img_id, $thumb, '', $attr);
}

/**
 * Get logo ID from theme options
 *
 * @return int|false Logo attachment ID or false if not found
 */
function emptytheme_get_logo_id() {
	// Try theme options first
	if (function_exists('emptytheme_get_option')) {
		$logo_id = emptytheme_get_option('logo_id');
		if ($logo_id) {
			return $logo_id;
		}
	}

	return false;
}

/**
 * Displays an image on the page if the attachment ID is provided.
 *
 * @param int    $img_id The attachment ID of the image.
 * @param string $thumb  The size of the image to display. Default is 'large'.
 * @param array  $attr   Additional attributes for the <img> element. Default is an empty array.
 */

function show_image($img_id = '', $thumb = 'large', $attr = []) {
	if ($img_id) {
		echo wp_get_attachment_image($img_id, $thumb, '', $attr);
	}
}

/**
 * Includes a template part with the given name and arguments.
 *
 * @param string $file_name The name of the template part to include.
 * @param array $args An array of arguments to pass to the template part.
 */
function part($file_name = '', $args = []) {
	get_template_part( "template-parts/{$file_name}", '', $args );
}

// Include the buttons utility file
require_once get_template_directory() . '/inc/utils/__buttons.php';
// Include the logo utility file
require_once get_template_directory() . '/inc/utils/__show-logo.php';
// Include the burger menu utility file
require_once get_template_directory() . '/inc/utils/__show-burger-menu.php';
// Include the mobile menu utility file
require_once get_template_directory() . '/inc/utils/__show-mobile-menu.php';
// Include the truncate string utility file
require_once get_template_directory() . '/inc/utils/__truncate-string.php';
// Include the countries array utility file
require_once get_template_directory() . '/inc/utils/__countries.php';
// Include the show count page view utility file
require_once get_template_directory() . '/inc/utils/__show-count-page-view.php';
// Include the show accordion utility file
require_once get_template_directory() . '/inc/utils/__show-accordion.php';
// Include the generate example phone number utility file
require_once get_template_directory() . '/inc/utils/__generate-example-phone-number.php';
// Include the search form helpers utility file
require_once get_template_directory() . '/inc/utils/__search-form-helpers.php';
// Include the form helpers utility file
require_once get_template_directory() . '/inc/utils/__form-helpers.php';
// Include the 404 helpers utility file
require_once get_template_directory() . '/inc/utils/__404-helpers.php';

/**
 * Return translated value for a General option (WPML-aware).
 * Falls back to the original value when WPML is not active.
 *
 * @param string $key     Option key inside `emptytheme_general_options`.
 * @param mixed  $default Default value when option is not set.
 * @return mixed          Translated value if available.
 */
function emptytheme_get_option_translated($key, $default = '') {
    $base_options = get_option('emptytheme_general_options');
    $value = isset($base_options[$key]) ? $base_options[$key] : $default;

    $current_lang = apply_filters('wpml_current_language', null);
    $default_lang = apply_filters('wpml_default_language', null);

    // If we have a language-specific override option saved, prefer it
    if (!empty($current_lang) && !empty($default_lang) && $current_lang !== $default_lang) {
        $lang_option_key = 'emptytheme_general_options__' . $current_lang;
        $lang_options = get_option($lang_option_key);
        if (is_array($lang_options) && array_key_exists($key, $lang_options)) {
            $value = $lang_options[$key];
        }
    }

    // Let WPML String Translation provide translation if available
    $value = apply_filters('wpml_translate_single_string', $value, 'emptytheme_general_options', $key);
    return $value;
}

/**
 * Return translated attachment ID for current language (WPML Media-aware).
 *
 * @param int|string $attachment_id Original attachment ID.
 * @return int|string                Translated (or original) attachment ID.
 */
function emptytheme_get_attachment_id_translated($attachment_id) {
    if (empty($attachment_id)) {
        return $attachment_id;
    }

    $translated_id = apply_filters('wpml_object_id', (int) $attachment_id, 'attachment', true);
    if (!empty($translated_id)) {
        return $translated_id;
    }

    // Check language-specific override option
    $current_lang = apply_filters('wpml_current_language', null);
    $default_lang = apply_filters('wpml_default_language', null);
    if (!empty($current_lang) && !empty($default_lang) && $current_lang !== $default_lang) {
        $lang_option_key = 'emptytheme_general_options__' . $current_lang;
        $lang_options = get_option($lang_option_key);
        if (is_array($lang_options)) {
            // Try known media keys
            foreach (array('logo_id') as $media_key) {
                if (!empty($lang_options[$media_key])) {
                    return (int) $lang_options[$media_key];
                }
            }
        }
    }

    return $attachment_id;
}

// Register WPML integration for options updates
require_once get_template_directory() . '/inc/utils/__wpml-options.php';
