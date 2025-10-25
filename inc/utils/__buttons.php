<?php

/**
 * Shows a button
 */
function show_button($text, $href = '', $color = 'yellow', $class = '') {
    if (empty($href)) {
        $href = '#';
    }

    ?>
    <a href="<?php echo esc_url($href); ?>" class="button button-<?php echo esc_attr($color); ?> <?php echo esc_attr($class); ?>"><span class="button-text"><?php echo esc_html($text); ?></span></a>
    <?php
}