<?php

/**
 * Renders an accordion element.
 *
 * The function takes an array of items as its argument and returns an HTML string
 * containing an accordion element with a title and content for each item in the
 * array. The first item in the array is expanded by default.
 *
 * @param array $list An array of items to render in the accordion.
 * @return string The HTML string containing the accordion element.
 */
function show_accordion($list, $first = true) {
	ob_start(); // Start output buffering

	if ($list) :
	?>
		<div class="accordion">
			<?php foreach ($list as $key => $item) :
				$first_active = $key == 0 && $first ? 'active' : '';
				$unique_id = 'accordion-' . sanitize_title($item['title']) . '-' . $key;
				$button_id = 'accordion-button-' . $key;
			?>
			<div class="accordion-item <?php echo $first_active; ?>">
				<button type="button" id="<?php echo esc_attr($button_id); ?>" class="accordion-question"
					aria-expanded="<?php echo $first_active ? 'true' : 'false'; ?>"
					aria-controls="<?php echo esc_attr($unique_id); ?>">
					<?= esc_html($item['title']) ?>
				</button>
				<div class="accordion-answer" id="<?php echo esc_attr($unique_id); ?>"
					role="region"
					aria-labelledby="<?php echo esc_attr($button_id); ?>"
					aria-hidden="<?php echo $first_active ? 'false' : 'true'; ?>">
					<div class="accordion-text"><?= wp_kses_post($item['content']) ?></div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	<?php
	endif;

	return ob_get_clean(); // Return the buffered output
}

function create_accordion_items($list)
{
	$items = [];
	foreach ($list as $item_id) {
		if ($item_id) {
			$raw_content = get_post_field('post_content', $item_id);
			$content = apply_filters('the_content', $raw_content);
			$items[] = [
				'title' => get_the_title($item_id),
				'content' => $content,
			];
		}
	}
	return $items;
}
