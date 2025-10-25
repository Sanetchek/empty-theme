<?php
/**
 * Custom Meta Boxes for Post Types
 */

// Automatic ACF installation on theme activation
add_action('after_switch_theme', 'emptytheme_install_acf_plugin');

function emptytheme_install_acf_plugin() {
    // Check if ACF is installed
    if (!function_exists('acf_add_local_field_group')) {
        // Show installation notification
        add_action('admin_notices', function() {
            echo '<div class="notice notice-info"><p><strong>emptytheme Theme:</strong> Installing Advanced Custom Fields plugin...</p></div>';
        });

        // Install ACF via WordPress API
        $result = emptytheme_install_plugin_from_repo('advanced-custom-fields', 'acf');

        if ($result) {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success"><p><strong>emptytheme Theme:</strong> Advanced Custom Fields plugin successfully installed and activated!</p></div>';
            });
        } else {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-error"><p><strong>emptytheme Theme:</strong> Error installing Advanced Custom Fields plugin. Please install it manually.</p></div>';
            });
        }
    }
}

function emptytheme_install_plugin_from_repo($slug, $file) {
    // Check administrator permissions
    if (!current_user_can('install_plugins')) {
        return false;
    }

    // Check if plugin is already installed
    if (is_plugin_active($file . '/' . $file . '.php')) {
        return true;
    }

    // Include necessary files
    if (!function_exists('download_url')) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }
    if (!function_exists('wp_install_plugin')) {
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    }

    // Get plugin information
    $api = plugins_api('plugin_information', array(
        'slug' => $slug,
        'fields' => array(
            'short_description' => false,
            'sections' => false,
            'requires' => false,
            'rating' => false,
            'ratings' => false,
            'downloaded' => false,
            'last_updated' => false,
            'added' => false,
            'tags' => false,
            'compatibility' => false,
            'homepage' => false,
            'donate_link' => false,
        ),
    ));

    if (is_wp_error($api)) {
        return false;
    }

    // Install plugin
    $upgrader = new Plugin_Upgrader();
    $installed = $upgrader->install($api->download_link);

    if (is_wp_error($installed)) {
        return false;
    }

    // Activate plugin
    $activate = activate_plugin($file . '/' . $file . '.php');

    if (is_wp_error($activate)) {
        return false;
    }

    return true;
}

// Setting up the path to JSON ACF files
add_filter('acf/settings/save_json', function($path) {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});
