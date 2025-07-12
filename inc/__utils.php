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
 * Returns the URL to a specific icon within the social sprite sheet.
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

// Include the header logo utility file
require_once get_template_directory() . '/inc/utils/__show-header-logo.php';
// Include the burger menu utility file
require_once get_template_directory() . '/inc/utils/__show-burger-menu.php';
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