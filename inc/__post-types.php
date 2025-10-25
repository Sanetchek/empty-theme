<?php
/**
 * Register custom post types
 */

// Register How It Works post type
function emptytheme_register_how_it_works_post_type() {
    $labels = array(
        'name'                  => _x('How It Works', 'Post type general name', 'emptytheme'),
        'singular_name'         => _x('How It Works', 'Post type singular name', 'emptytheme'),
        'menu_name'             => _x('How It Works', 'Admin Menu text', 'emptytheme'),
        'name_admin_bar'        => _x('How It Works', 'Add New on Toolbar', 'emptytheme'),
        'add_new'               => __('Add New', 'emptytheme'),
        'add_new_item'          => __('Add New How It Works', 'emptytheme'),
        'new_item'              => __('New How It Works', 'emptytheme'),
        'edit_item'             => __('Edit How It Works', 'emptytheme'),
        'view_item'             => __('View How It Works', 'emptytheme'),
        'all_items'             => __('How It Works', 'emptytheme'),
        'search_items'          => __('Search How It Works', 'emptytheme'),
        'parent_item_colon'     => __('Parent How It Works:', 'emptytheme'),
        'not_found'             => __('No How It Works found.', 'emptytheme'),
        'not_found_in_trash'    => __('No How It Works found in Trash.', 'emptytheme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'emptytheme-general-settings',
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => array('title', 'thumbnail', 'editor'),
        'show_in_rest'       => false,
    );

    register_post_type('how_it_works', $args);
}
add_action('init', 'emptytheme_register_how_it_works_post_type');

// Register Testimonials post type
function emptytheme_register_testimonials_post_type() {
    $labels = array(
        'name'                  => _x('Testimonials', 'Post type general name', 'emptytheme'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'emptytheme'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'emptytheme'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'emptytheme'),
        'add_new'               => __('Add New', 'emptytheme'),
        'add_new_item'          => __('Add New Testimonial', 'emptytheme'),
        'new_item'              => __('New Testimonial', 'emptytheme'),
        'edit_item'             => __('Edit Testimonial', 'emptytheme'),
        'view_item'             => __('View Testimonial', 'emptytheme'),
        'all_items'             => __('Testimonials', 'emptytheme'),
        'search_items'          => __('Search Testimonials', 'emptytheme'),
        'parent_item_colon'     => __('Parent Testimonials:', 'emptytheme'),
        'not_found'             => __('No Testimonials found.', 'emptytheme'),
        'not_found_in_trash'    => __('No Testimonials found in Trash.', 'emptytheme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'emptytheme-general-settings',
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'thumbnail', 'editor'),
        'show_in_rest'       => false,
    );

    register_post_type('testimonials', $args);
}
add_action('init', 'emptytheme_register_testimonials_post_type');

// Register FAQ post type
function emptytheme_register_faq_post_type() {
    $labels = array(
        'name'                  => _x('FAQ', 'Post type general name', 'emptytheme'),
        'singular_name'         => _x('FAQ', 'Post type singular name', 'emptytheme'),
        'menu_name'             => _x('FAQ', 'Admin Menu text', 'emptytheme'),
        'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'emptytheme'),
        'add_new'               => __('Add New', 'emptytheme'),
        'add_new_item'          => __('Add New FAQ', 'emptytheme'),
        'new_item'              => __('New FAQ', 'emptytheme'),
        'edit_item'             => __('Edit FAQ', 'emptytheme'),
        'view_item'             => __('View FAQ', 'emptytheme'),
        'all_items'             => __('FAQ', 'emptytheme'),
        'search_items'          => __('Search FAQ', 'emptytheme'),
        'parent_item_colon'     => __('Parent FAQ:', 'emptytheme'),
        'not_found'             => __('No FAQ found.', 'emptytheme'),
        'not_found_in_trash'    => __('No FAQ found in Trash.', 'emptytheme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'emptytheme-general-settings',
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'editor'),
        'show_in_rest'       => false,
    );

    register_post_type('faq', $args);
}
add_action('init', 'emptytheme_register_faq_post_type');

// Add separator and reorder menu items
add_action('admin_menu', 'emptytheme_reorder_theme_settings_menu', 999);
function emptytheme_reorder_theme_settings_menu() {
    global $submenu;

    if (!isset($submenu['emptytheme-general-settings'])) {
        return;
    }

    // Store original submenu
    $original_submenu = $submenu['emptytheme-general-settings'];

    // Clear the submenu
    $submenu['emptytheme-general-settings'] = array();

    // Add items in correct order
    $new_order = array();

    // Add existing items first (General, Scripts, Social Share)
    foreach ($original_submenu as $item) {
        if (strpos($item[2], 'emptytheme-general-settings') !== false ||
            strpos($item[2], 'emptytheme-scripts-settings') !== false ||
            strpos($item[2], 'emptytheme-social-share') !== false) {
            $new_order[] = $item;
        }
    }

    // Add separator
    $new_order[] = array('POST TYPES', 'read', 'separator-emptytheme-post-types', '', 'wp-menu-separator');

    // Add post types
    foreach ($original_submenu as $item) {
        if (strpos($item[2], 'edit.php?post_type=how_it_works') !== false ||
            strpos($item[2], 'edit.php?post_type=testimonials') !== false ||
            strpos($item[2], 'edit.php?post_type=faq') !== false) {
            $new_order[] = $item;
        }
    }

    // Update submenu
    $submenu['emptytheme-general-settings'] = $new_order;
}

// Customize admin menu to add separator text
add_action('admin_head', 'emptytheme_customize_admin_menu');
function emptytheme_customize_admin_menu() {
    ?>
    <style>
        #adminmenu #toplevel_page_emptytheme-general-settings li.wp-menu-separator {
            height: auto;
        }

        #toplevel_page_emptytheme-general-settings .wp-menu-separator[href="separator-emptytheme-post-types"] {
            pointer-events: none;
            cursor: default;
            padding: 0;
            color: #646970;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            opacity: 0.95;
            margin-top: 8px;
            font-size: 11px;
            text-align: center;
            display: grid;
            align-items: center;
            justify-content: center;
            grid-template-columns: 1fr max-content 1fr;
        }
        #toplevel_page_emptytheme-general-settings .wp-menu-separator[href="separator-emptytheme-post-types"]:before,
        #toplevel_page_emptytheme-general-settings .wp-menu-separator[href="separator-emptytheme-post-types"]:after {
            content: "";
            display: block;
            color: #c3c4c7;
            height: 1px;
            background-color: #c3c4c7;
            font-weight: 400;
            margin: 0 6px;
        }
        /* Ensure separator doesn't interfere with other menu items */
        #toplevel_page_emptytheme-general-settings .wp-menu-separator[href="separator-emptytheme-post-types"] + li {
            margin-top: 0;
        }
    </style>
    <?php
}
