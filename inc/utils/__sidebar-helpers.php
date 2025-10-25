<?php
/**
 * Sidebar Content Helpers
 *
 * This file contains helper functions for checking sidebar content availability
 * and managing sidebar display logic.
 *
 * @package emptytheme
 */

/**
 * Check if sidebar has any visible content
 *
 * This function checks if the sidebar has widgets that would produce visible output.
 * It goes beyond just checking if widgets are active by also checking if they
 * have actual content to display.
 *
 * @param string $sidebar_id The sidebar ID to check (default: 'sidebar-1')
 * @return bool True if sidebar has visible content
 */
function emptytheme_sidebar_has_content($sidebar_id = 'sidebar-1') {
    // First check if sidebar is active
    if (!is_active_sidebar($sidebar_id)) {
        return false;
    }

    // Get sidebar widgets
    $sidebars_widgets = wp_get_sidebars_widgets();

    if (empty($sidebars_widgets) || empty($sidebars_widgets[$sidebar_id])) {
        return false;
    }

    $widgets = $sidebars_widgets[$sidebar_id];

    if (empty($widgets) || !is_array($widgets)) {
        return false;
    }

    // Check each widget for content
    foreach ($widgets as $widget_id) {
        if (!empty($widget_id) && emptytheme_widget_has_content($widget_id)) {
            return true;
        }
    }

    return false;
}

/**
 * Check if a specific widget has visible content
 *
 * @param string $widget_id The widget ID to check
 * @return bool True if widget has visible content
 */
function emptytheme_widget_has_content($widget_id) {
    global $wp_registered_widgets;

    if (!isset($wp_registered_widgets[$widget_id])) {
        return false;
    }

    $widget = $wp_registered_widgets[$widget_id];

    // Check if required keys exist
    if (!isset($widget['id_base']) || !isset($widget['params'][0]['number'])) {
        return false;
    }

    $widget_class = isset($widget['classname']) ? $widget['classname'] : '';
    $widget_type = $widget['id_base'];
    $widget_number = $widget['params'][0]['number'];

    // Get widget instance settings
    $widget_settings = get_option('widget_' . $widget_type);

    if (empty($widget_settings) || !isset($widget_settings[$widget_number])) {
        return false;
    }

    $instance = $widget_settings[$widget_number];

    // Check if instance is valid
    if (empty($instance)) {
        return false;
    }

    // Check specific widget types for content
    switch ($widget_type) {
        case 'search':
            return true; // Search widget always has content

        case 'recent-posts':
            $number = isset($instance['number']) ? (int) $instance['number'] : 5;
            $posts = wp_get_recent_posts(array(
                'numberposts' => $number,
                'post_status' => 'publish'
            ));
            return !empty($posts);

        case 'recent-comments':
            $number = isset($instance['number']) ? (int) $instance['number'] : 5;
            $comments = get_comments(array(
                'number' => $number,
                'status' => 'approve'
            ));
            return !empty($comments);

        case 'categories':
            $categories = get_categories(array('hide_empty' => true));
            return !empty($categories);

        case 'tag_cloud':
            $tags = get_tags(array('hide_empty' => true));
            return !empty($tags);

        case 'archives':
            $archives = wp_get_archives(array('echo' => false));
            return !empty($archives);

        case 'calendar':
            return true; // Calendar widget always has content

        case 'text':
            $text = isset($instance['text']) ? $instance['text'] : '';
            return !empty(trim(strip_tags($text)));

        case 'rss':
            $rss_url = isset($instance['url']) ? $instance['url'] : '';
            if (empty($rss_url)) {
                return false;
            }
            // Check if RSS feed has items
            $rss = fetch_feed($rss_url);
            if (is_wp_error($rss)) {
                return false;
            }
            $maxitems = $rss->get_item_quantity(isset($instance['items']) ? (int) $instance['items'] : 10);
            return $maxitems > 0;

        case 'meta':
            return true; // Meta widget always has content

        case 'pages':
            $pages = get_pages(array('post_status' => 'publish'));
            return !empty($pages);

        case 'nav_menu':
            $menu_id = isset($instance['nav_menu']) ? $instance['nav_menu'] : 0;
            if (empty($menu_id)) {
                return false;
            }
            $menu_items = wp_get_nav_menu_items($menu_id);
            return !empty($menu_items);

        default:
            // For custom widgets, assume they have content if they're active
            return true;
    }
}

/**
 * Get sidebar content preview for debugging
 *
 * @param string $sidebar_id The sidebar ID to check
 * @return array Array of widget information
 */
function emptytheme_get_sidebar_content_preview($sidebar_id = 'sidebar-1') {
    global $wp_registered_widgets;
    $preview = array();

    if (!is_active_sidebar($sidebar_id)) {
        return $preview;
    }

    $sidebars_widgets = wp_get_sidebars_widgets();

    if (empty($sidebars_widgets[$sidebar_id])) {
        return $preview;
    }

    $widgets = $sidebars_widgets[$sidebar_id];

    foreach ($widgets as $widget_id) {
        $has_content = emptytheme_widget_has_content($widget_id);
        $preview[] = array(
            'widget_id' => $widget_id,
            'has_content' => $has_content,
            'widget_type' => isset($wp_registered_widgets[$widget_id]['id_base']) ? $wp_registered_widgets[$widget_id]['id_base'] : 'unknown'
        );
    }

    return $preview;
}

/**
 * Check if sidebar should be displayed on current page
 *
 * @param string $sidebar_id The sidebar ID to check
 * @return bool True if sidebar should be displayed
 */
function emptytheme_should_display_sidebar($sidebar_id = 'sidebar-1') {
    // Check if sidebar has content
    if (!emptytheme_sidebar_has_content($sidebar_id)) {
        return false;
    }

    // Additional checks can be added here for specific page types
    // For example, hide sidebar on certain pages

    return true;
}
