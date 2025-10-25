<?php
/**
 * Test file for sidebar content checking
 * This file can be used to test the sidebar content functions
 *
 * Usage: Add this to your theme's functions.php temporarily for testing:
 * include_once get_template_directory() . '/inc/utils/__sidebar-test.php';
 */

// Only run if we're in WordPress admin or if user is logged in
if (!is_admin() && !is_user_logged_in()) {
    return;
}

// Add admin notice to show sidebar content status
add_action('admin_notices', 'emptytheme_sidebar_content_test_notice');

function emptytheme_sidebar_content_test_notice() {
    if (!function_exists('emptytheme_sidebar_has_content')) {
        return;
    }

    $has_content = emptytheme_sidebar_has_content('sidebar-1');
    $preview = emptytheme_get_sidebar_content_preview('sidebar-1');

    echo '<div class="notice notice-info is-dismissible">';
    echo '<h3>Sidebar Content Test</h3>';
    echo '<p><strong>Sidebar has content:</strong> ' . ($has_content ? 'Yes' : 'No') . '</p>';

    if (!empty($preview)) {
        echo '<p><strong>Widgets in sidebar:</strong></p>';
        echo '<ul>';
        foreach ($preview as $widget) {
            echo '<li>' . esc_html($widget['widget_id']) . ' (' . esc_html($widget['widget_type']) . ') - ' . ($widget['has_content'] ? 'Has content' : 'No content') . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No widgets found in sidebar.</p>';
    }

    echo '</div>';
}
