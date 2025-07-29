<?php
// Enqueue styles for admin
add_action('admin_enqueue_scripts', 'emptytheme_admin_styles');
function emptytheme_admin_styles($hook) {
    if (strpos($hook, 'emptytheme-') !== false) {
        wp_enqueue_style('emptytheme-admin', get_template_directory_uri() . '/css/emptytheme-admin.css', array(), '1.0');
    }
}

// Register top-level menu
add_action('admin_menu', 'emptytheme_settings_menu');
function emptytheme_settings_menu() {
    // Top-level menu
    add_menu_page(
        'Theme Settings',           // page_title
        'Theme Settings',           // menu_title
        'edit_posts',                    // capability
        'emptytheme-general-settings',   // menu_slug
        null,                            // callback
        'dashicons-admin-generic',       // icon_url
        2                                // position
    );

    // General Settings subpage (default)
    add_submenu_page(
        'emptytheme-general-settings',
        'General Settings',
        'General',
        'edit_posts',
        'emptytheme-general-settings',
        'emptytheme_general_settings_page',
        1
    );

    // Social Share subpage
    add_submenu_page(
        'emptytheme-general-settings',
        'Social Share Settings',
        'Social Share',
        'edit_posts',
        'emptytheme-social-share',
        'emptytheme_social_share_settings_page',
        10
    );
}

// Register settings for General Settings
require_once get_template_directory() . '/inc/settings-pages/general.php';

// Social Share Settings page
require_once get_template_directory() . '/inc/settings-pages/social-share.php';