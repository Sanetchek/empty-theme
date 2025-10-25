<?php
/**
 * Page Views Management
 *
 * Adds views column to admin posts/pages list and automatically tracks views
 */

// Add views column to all post types
add_filter('manage_posts_columns', 'emptytheme_add_views_column');
add_filter('manage_pages_columns', 'emptytheme_add_views_column');

// Add views column to custom post types
add_action('admin_init', 'emptytheme_add_views_column_to_custom_post_types');

function emptytheme_add_views_column_to_custom_post_types() {
    // Get all registered post types
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        // Skip built-in post types (already handled above)
        if (in_array($post_type, array('post', 'page'))) {
            continue;
        }

        // Add column filter for each custom post type
        add_filter("manage_{$post_type}_posts_columns", 'emptytheme_add_views_column');
    }
}

function emptytheme_add_views_column($columns) {
    // Skip testimonials - views will be added in __custom-columns.php
    if (isset($columns['star_rating'])) {
        return $columns;
    }

    // Check if current user can read posts of this type
    global $current_screen;
    if (!$current_screen || !current_user_can('edit_posts')) {
        return $columns;
    }

    // Default behavior for other post types - insert views column after title
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        // Insert views column after title
        if ($key === 'title') {
            $new_columns['views'] = __('Views', 'emptytheme');
        }
    }

    return $new_columns;
}

// Display views count in the column
add_action('manage_posts_custom_column', 'emptytheme_display_views_column', 10, 2);
add_action('manage_pages_custom_column', 'emptytheme_display_views_column', 10, 2);

// Display views for custom post types
add_action('admin_init', 'emptytheme_add_views_display_to_custom_post_types');

function emptytheme_add_views_display_to_custom_post_types() {
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        if (in_array($post_type, array('post', 'page'))) {
            continue;
        }

        add_action("manage_{$post_type}_posts_custom_column", 'emptytheme_display_views_column', 10, 2);
    }
}

function emptytheme_display_views_column($column, $post_id) {
    if ($column === 'views') {
        // Check if current user can read this post
        $post = get_post($post_id);
        if (!$post || !current_user_can('read_post', $post_id)) {
            echo '—';
            return;
        }

        $views = get_post_meta($post_id, 'views', true);
        echo $views ? $views : '0';
    }
}

// Make views column sortable
add_filter('manage_edit-post_sortable_columns', 'emptytheme_make_views_column_sortable');
add_filter('manage_edit-page_sortable_columns', 'emptytheme_make_views_column_sortable');

// Make views column sortable for custom post types
add_action('admin_init', 'emptytheme_add_sortable_views_to_custom_post_types');

function emptytheme_add_sortable_views_to_custom_post_types() {
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        if (in_array($post_type, array('post', 'page'))) {
            continue;
        }

        add_filter("manage_edit-{$post_type}_sortable_columns", 'emptytheme_make_views_column_sortable');
    }
}

function emptytheme_make_views_column_sortable($columns) {
    $columns['views'] = 'views';
    return $columns;
}

// Handle sorting by views
add_action('pre_get_posts', 'emptytheme_handle_views_sorting');

function emptytheme_handle_views_sorting($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ($orderby === 'views') {
        $query->set('meta_key', 'views');
        $query->set('orderby', 'meta_value_num');
    }
}

// Automatically track page views
add_action('wp_head', 'emptytheme_track_page_view');

function emptytheme_track_page_view() {
    // Only track on single posts/pages, not on admin or other pages
    if (!is_singular() || is_admin()) {
        return;
    }

    global $post;

    if (!$post) {
        return;
    }

    // Get current views count
    $views = get_post_meta($post->ID, 'views', true);

    // Increment views count
    $views = $views ? $views + 1 : 1;

    // Update views count
    update_post_meta($post->ID, 'views', $views);
}

// Add views column CSS styling
add_action('admin_head', 'emptytheme_views_column_css');

function emptytheme_views_column_css() {
    echo '<style>
        .column-views {
            width: 80px;
            text-align: center;
        }
        .column-views .dashicons {
            color: #666;
        }
    </style>';
}

// Add bulk actions for views (optional)
add_filter('bulk_actions-edit-post', 'emptytheme_add_views_bulk_actions');
add_filter('bulk_actions-edit-page', 'emptytheme_add_views_bulk_actions');

// Add bulk actions for custom post types
add_action('admin_init', 'emptytheme_add_views_bulk_actions_to_custom_post_types');

function emptytheme_add_views_bulk_actions_to_custom_post_types() {
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        if (in_array($post_type, array('post', 'page'))) {
            continue;
        }

        add_filter("bulk_actions-edit-{$post_type}", 'emptytheme_add_views_bulk_actions');
    }
}

function emptytheme_add_views_bulk_actions($actions) {
    $actions['reset_views'] = __('Reset Views', 'emptytheme');
    return $actions;
}

// Handle bulk actions
add_filter('handle_bulk_actions-edit-post', 'emptytheme_handle_views_bulk_actions', 10, 3);
add_filter('handle_bulk_actions-edit-page', 'emptytheme_handle_views_bulk_actions', 10, 3);

// Handle bulk actions for custom post types
add_action('admin_init', 'emptytheme_add_views_bulk_handler_to_custom_post_types');

function emptytheme_add_views_bulk_handler_to_custom_post_types() {
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        if (in_array($post_type, array('post', 'page'))) {
            continue;
        }

        add_filter("handle_bulk_actions-edit-{$post_type}", 'emptytheme_handle_views_bulk_actions', 10, 3);
    }
}

function emptytheme_handle_views_bulk_actions($redirect_to, $doaction, $post_ids) {
    if ($doaction !== 'reset_views') {
        return $redirect_to;
    }

    foreach ($post_ids as $post_id) {
        delete_post_meta($post_id, 'views');
    }

    $redirect_to = add_query_arg('bulk_reset_views', count($post_ids), $redirect_to);
    return $redirect_to;
}

// Show bulk action notice
add_action('admin_notices', 'emptytheme_views_bulk_action_notice');

function emptytheme_views_bulk_action_notice() {
    if (!empty($_REQUEST['bulk_reset_views'])) {
        $count = intval($_REQUEST['bulk_reset_views']);
        printf(
            '<div id="message" class="updated notice is-dismissible"><p>' .
            /* translators: %s: Number of posts */
            _n('Views reset for %s post.', 'Views reset for %s posts.', $count, 'emptytheme') .
            '</p></div>',
            $count
        );
    }
}
