<?php
/**
 * Block Template: Breadcrumbs
 *
 * @package tmlnews
 */

// Ensure breadcrumbs class is loaded
if (!class_exists('Theme_Breadcrumbs')) {
    if ($is_preview) {
        echo '<div class="breadcrumbs-block-container _container">';
        echo '<div class="breadcrumbs-block">';
        echo '<p>' . esc_html__('Breadcrumbs class (Theme_Breadcrumbs) is not available.', 'tmlnews') . '</p>';
        echo '</div>';
        echo '</div>';
    }
    return;
}

// Render breadcrumbs
?>
<div class="breadcrumbs-block-container _container">
    <div class="breadcrumbs-block">
        <?php echo Theme_Breadcrumbs::render(); ?>
    </div>
</div>