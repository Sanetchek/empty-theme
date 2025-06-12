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
 * Shows the header logo
 *
 * @param string $acf_logo_field The field name of the logo in ACF
 */
function show_header_logo($acf_logo_field = '') {
	$logo = get_field($acf_logo_field, 'option') ?? assets('images/logo.svg');
	?>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" aria-label="<?php esc_attr_e('Go to homepage', 'noakirel'); ?>">
		<img src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr_e('Site logo', 'noakirel'); ?>">
	</a>
	<?php
}

/**
 * Shows the hamburger menu button
 *
 * @since 1.0.0
 * @return void
 */
function show_burger_menu() {
	?>
	<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'emptytheme'); ?>">
		<span class="screen-reader-text"><?php esc_html_e('Menu', 'emptytheme'); ?></span>
		<span class="hamburger-bar" aria-hidden="true"></span>
		<span class="hamburger-bar" aria-hidden="true"></span>
		<span class="hamburger-bar" aria-hidden="true"></span>
	</button>
	<?php
}

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
	return get_template_directory_uri() . '/assets/img/sprite.svg#' . $icon_id;
}

/**
 * Retrieve the HTML for an image, given its attachment ID.
 *
 * @param int    $img     The attachment ID of the image.
 * @param string $thumb   The size of the image to retrieve. Default 'large'.
 * @param array  $attr    The attributes to add to the <img> element. Default empty array.
 * @return string The HTML for the image.
 */
function get_image($img = '', $thumb = 'large', $attr = []) {
	return wp_get_attachment_image($img, $thumb, '', $attr);
}

/**
 * Displays an image on the page if the attachment ID is provided.
 *
 * @param int    $img   The attachment ID of the image.
 * @param string $thumb The size of the image to display. Default is 'large'.
 * @param array  $attr  Additional attributes for the <img> element. Default is an empty array.
 */

function show_image($img = '', $thumb = 'large', $attr = []) {
	if ($img) {
		echo wp_get_attachment_image($img, $thumb, '', $attr);
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
					class="social_share_svg"><img src="' . sprite('s-whatsapp')	. '" /></span>
			</a>
			<a class="social_share_link social_share_facebook"
				href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '"
				title="Facebook" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' . sprite('s-facebook')	. '" /></span>
			</a>
			<a class="social_share_link social_share_gmail"
				href="mailto:' .
		$url . '?subject=' . $title . '"
				title="Mail" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' . sprite('s-mail')	. '" /></span>
			</a>
			<a class="social_share_link social_share_twitter"
				href="http://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $url . '"
				title="Twitter" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg"><img src="' . sprite('s-twitter') . '" /></span>
			</a>
		</div>
	</div>';
}

/**
 * Renders an accordion element for a product page.
 *
 * The function takes an array of items as its argument and returns an HTML string
 * containing an accordion element with a title and content for each item in the
 * array. The first item in the array is expanded by default.
 *
 * @param array $list An array of items to render in the accordion.
 * @return string The HTML string containing the accordion element.
 */
function display_product_accordion($list) {
	ob_start(); // Start output buffering

	if ($list) :
	?>
		<div class="accordion" role="presentation">
			<?php foreach ($list as $key => $item) : ?>
				<?php $first = ($key === 0); ?>
				<div class="accordion-item <?php echo $first ? 'active' : ''; ?>" role="region">
					<button class="accordion-title"
							aria-expanded="<?php echo $first ? 'true' : 'false'; ?>"
							aria-controls="accordion-content-<?php echo sanitize_title($item['title']); ?>">
						<span class="accordion-title-text"><?= esc_html($item['title']) ?></span>
						<span class="accordion-icon-plus">
							<svg class="accordion-icon" width="12" height="12" role="img" aria-label="<?php echo esc_attr__('Expansion Icon', 'noakirel'); ?>">
								<use href="<?php echo esc_url(sprite('plus')); ?>"></use>
							</svg>
						</span>
						<span class="accordion-icon-minus">
							<svg class="accordion-icon" width="12" height="12" role="img" aria-label="<?php echo esc_attr__('Close Icon', 'noakirel'); ?>">
								<use href="<?php echo esc_url(sprite('minus')); ?>"></use>
							</svg>
						</span>
					</button>
					<div class="accordion-content"
							id="accordion-content-<?php echo sanitize_title($item['title']); ?>"
							role="region"
							aria-hidden="<?php echo $first ? 'false' : 'true'; ?>">
						<p><?= esc_html($item['content']) ?></p>
					</div>
				</div>
				<?php
			endforeach; ?>
		</div>
	<?php
	endif;

	return ob_get_clean(); // Return the buffered output
}