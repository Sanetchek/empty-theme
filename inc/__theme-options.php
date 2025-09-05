<?php
/**
 * Theme Options Functionality
 *
 * @package emptytheme
 */

// Output header scripts
add_action('wp_head', 'emptytheme_output_header_scripts');
function emptytheme_output_header_scripts() {
    $header_scripts = emptytheme_get_option('header_scripts');

    if (!empty($header_scripts)) {
        echo "\n<!-- Theme Header Scripts -->\n";
        echo $header_scripts . "\n";
        echo "<!-- End Theme Header Scripts -->\n";
    }
}

// Output footer scripts
add_action('wp_footer', 'emptytheme_output_footer_scripts');
function emptytheme_output_footer_scripts() {
    $footer_scripts = emptytheme_get_option('footer_scripts');

    if (!empty($footer_scripts)) {
        echo "\n<!-- Theme Footer Scripts -->\n";
        echo $footer_scripts . "\n";
        echo "<!-- End Theme Footer Scripts -->\n";
    }
}

// Output preloader
add_action('wp_footer', 'emptytheme_output_preloader');
function emptytheme_output_preloader() {
    $preloader_enabled = emptytheme_get_option('preloader_enabled');

    if ($preloader_enabled) {
        echo do_shortcode('[theme_preloader]');
    }
}

// Maintenance mode functionality
add_action('template_redirect', 'emptytheme_maintenance_mode_check');
function emptytheme_maintenance_mode_check() {
    $maintenance_mode = emptytheme_get_option('maintenance_mode');

    if ($maintenance_mode && !is_user_logged_in() && !current_user_can('administrator')) {
        // Set 503 status
        status_header(503);

        // Load maintenance template
        get_template_part('template-parts/maintenance');
        exit;
    }
}

// Add maintenance mode notice to admin bar
add_action('admin_bar_menu', 'emptytheme_maintenance_mode_admin_notice', 999);
function emptytheme_maintenance_mode_admin_notice($wp_admin_bar) {
    $maintenance_mode = emptytheme_get_option('maintenance_mode');

    if ($maintenance_mode && current_user_can('administrator')) {
        $wp_admin_bar->add_menu(array(
            'id' => 'maintenance-mode-notice',
            'title' => __('⚠️ Maintenance Mode Active', 'emptytheme'),
            'href' => admin_url('admin.php?page=emptytheme-general-settings'),
            'meta' => array(
                'class' => 'maintenance-mode-notice'
            )
        ));
    }
}

// Add maintenance mode notice to admin dashboard
add_action('admin_notices', 'emptytheme_maintenance_mode_admin_dashboard_notice');
function emptytheme_maintenance_mode_admin_dashboard_notice() {
    $maintenance_mode = emptytheme_get_option('maintenance_mode');

    if ($maintenance_mode && current_user_can('administrator')) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <strong><?php _e('Maintenance Mode Active', 'emptytheme'); ?></strong>
                <?php _e('Your site is currently in maintenance mode. Visitors will see a "Site under construction" page.', 'emptytheme'); ?>
                <a href="<?php echo admin_url('admin.php?page=emptytheme-general-settings'); ?>"><?php _e('Manage Settings', 'emptytheme'); ?></a>
            </p>
        </div>
        <?php
    }
}

// Enqueue admin scripts and styles for media uploader
add_action('admin_enqueue_scripts', 'emptytheme_admin_enqueue_scripts');
function emptytheme_admin_enqueue_scripts($hook) {
    // Only load on our settings page
    if ($hook !== 'toplevel_page_emptytheme-general-settings') {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'emptytheme-admin',
        get_template_directory_uri() . '/assets/js/admin.js',
        array('jquery', 'media-upload'),
        _S_VERSION,
        true
    );

    wp_enqueue_style(
        'emptytheme-admin',
        get_template_directory_uri() . '/assets/css/admin.css',
        array(),
        _S_VERSION
    );

    // Localize script for AJAX
    wp_localize_script('emptytheme-admin', 'emptytheme_admin', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('emptytheme_admin_nonce'),
        'strings' => array(
            'upload_title' => __('Choose or Upload Logo', 'emptytheme'),
            'upload_button' => __('Use this logo', 'emptytheme'),
            'remove_logo' => __('Remove Logo', 'emptytheme'),
            'change_logo' => __('Change Logo', 'emptytheme'),
            'upload_logo' => __('Upload Logo', 'emptytheme')
        )
    ));
}