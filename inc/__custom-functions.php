<?php

/**
 * Break content on N words
 *
 * @param [type] $text
 * @param integer $counttext
 * @param string $sep
 * @return void
 */
function str_word($text, $counttext = 30, $sep = ' ')
{
	$text = wp_strip_all_tags($text);
	$words = explode($sep, $text);

	if (count($words) > $counttext)
		$text = join($sep, array_slice($words, 0, $counttext));

	return $text;
}

/**
 * Generates a responsive <picture> element with multiple <source> elements for different screen sizes.
 *
 * @param int    $image_id ID of the image attachment.
 * @param string $thumb    Size of the thumbnail to retrieve for the default image.
 * @param array  $args     An associative array of attributes to apply to the <img> element.
 * @param array  $min      An associative array of min-width media queries and corresponding image sizes.
 *                         Example: ['768' => 'medium', '1024' => 'large']
 * @param array  $max      An associative array of max-width media queries and corresponding image sizes.
 *                         Example: ['767' => 'thumbnail', '1023' => 'medium']
 *
 * @return string The generated HTML markup for the <picture> element or an empty string if the image is not found.
 */
function generate_picture_element($image_id, $thumb = 'full', $args = [], $min = [], $max = []) {
	$image = wp_get_attachment_image_src($image_id, $thumb);

	// Check if the image source is available
	if ($image) {
		$output = '<picture aria-hidden="true">';

		// Generate <source> elements for min-width queries
		if ($min) {
			foreach ($min as $width => $size) {
				$source_image = wp_get_attachment_image_src($image_id, $size);
				if ($source_image) {
					$output .= '<source media="(min-width:' . esc_attr($width) . 'px)" srcset="' . esc_url($source_image[0]) . '">';
				}
			}
		}

		// Generate <source> elements for max-width queries
		if ($max) {
			foreach ($max as $width => $size) {
				$source_image = wp_get_attachment_image_src($image_id, $size);
				if ($source_image) {
					$output .= '<source media="(max-width:' . esc_attr($width) . 'px)" srcset="' . esc_url($source_image[0]) . '">';
				}
			}
		}

		// Build attributes string for the <img> element
		$img_attributes = '';
		if (!empty($args) && is_array($args)) {
			foreach ($args as $key => $value) {
				$img_attributes .= esc_attr($key) . '="' . esc_attr($value) . '" ';
			}
		}

		// Add the <img> element
		$output .= '<img data-src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_the_title($image_id)) . '" src="' . esc_url($image[0]) . '" ' . trim($img_attributes) . '>';
		$output .= '</picture>';

		return $output;
	}

	return '';
}

/**
 * Count Page View
 *
 * @param string $cont_id
 * @param boolean $user
 * @return void
 */
function view($cont_id = '', $user = false)
{
	global $post;

	if (!$cont_id) {
		$cont_id = $post->ID;
	}

	$view = get_post_meta($cont_id, 'views', true);

	if ($user) {
		$view = get_user_meta($cont_id, 'views', true);
	}

	if ($view) {
		if ($view > 999999) {
			$view /= 1000000;
			$view = round($view, 1);
			return $view . 'KK';
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
 * Get Current Url
 */
function currUrl()
{
	global $wp;
	return home_url($wp->request);
}

/**
 * get assets
 */
function assets($source = '')
{
	return get_template_directory_uri() . '/assets/' . $source;
}

/**
 * get image
 */
function get_image($img = '', $thumb = 'large', $attr = [])
{
	return wp_get_attachment_image($img, $thumb, '', $attr);
}

/**
 * show image
 */
function show_image($img = '', $thumb = 'large', $attr = [])
{
	if ($img) {
		echo wp_get_attachment_image($img, $thumb, '', $attr);
	}
}

/**
 * Social Share
 *
 * @param [string] $url
 * @param [string] $title
 * @return string
 */
function socialShare($url, $title)
{
	return '<div class="social_share">
		<div class="article-social">
			<a class="social_share_link social_share_whatsapp"
				href="https://api.whatsapp.com/send?text=' . $title . '&url=' . $url . '"
				title="Whatsapp" rel="nofollow noopener" target="_blank">
				<span
					class="social_share_svg"><img src="' .
		get_template_directory_uri() . '/assets/img/icons/s-whatsapp.svg'
		. '" /></span>
			</a>
			<a class="social_share_link social_share_facebook"
				href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '"
				title="Facebook" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' .
		get_template_directory_uri() . '/assets/img/icons/s-facebook.svg'
		. '" /></span>
			</a>
			<a class="social_share_link social_share_gmail"
				href="mailto:' .
		$url . '?subject=' . $title . '"
				title="Mail" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' .
		get_template_directory_uri() . '/assets/img/icons/s-mail.svg'
		. '" /></span>
			</a>
			<a class="social_share_link social_share_twitter"
				href="http://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $url . '"
				title="Twitter" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' .
		get_template_directory_uri() . '/assets/img/icons/s-twitter.svg'
		. '" /></span>
			</a>
		</div>
	</div>';
}

/**
 * Show YouTube Video
 */
function showYoutubeVideo($link)
{
	$video = $link;
	$video = substr($video, strpos($video, "=") + 1);
	if ($link): ?>
<iframe width="635" height="405" src="https://www.youtube.com/embed/<?= $video ?>" title="YouTube video player"
  frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
  allowfullscreen></iframe>
<?php else: ?>
<img src="https://img.youtube.com/vi/<?php $video ?>/default.jpg" class="br-40" alt="youtube">
<?php endif;
}