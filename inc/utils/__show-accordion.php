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
		<div class="accordion" role="presentation">
			<?php foreach ($list as $key => $item) :
				$first_active = $key == 0 && $first ? 'active' : '';
			?>
			<div class="accordion-item <?php echo $first_active; ?>" role="region">
				<button role="button" class="accordion-question"
					aria-expanded="<?php echo $first_active ? 'true' : 'false'; ?>"
					aria-controls="accordion-content-<?php echo sanitize_title($item['title']); ?>">
					<?= esc_html($item['title']) ?>
				</button>
				<div class="accordion-answer"
					id="accordion-content-<?php echo sanitize_title($item['title']); ?>"
					role="region"
					aria-hidden="<?php echo $first_active ? 'false' : 'true'; ?>">
					<p class="accordion-text"><?= esc_html($item['content']) ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	<?php
	endif;

	return ob_get_clean(); // Return the buffered output
}
