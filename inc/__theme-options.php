<?php
/**
 * Theme Options Functionality
 *
 * @package emptytheme
 */

// Output head scripts
add_action('wp_head', 'emptytheme_output_head_scripts');
function emptytheme_output_head_scripts() {
    $head_scripts = emptytheme_get_scripts_option('head_scripts');

    if (!empty($head_scripts)) {
        echo "\n<!-- Theme Head Scripts -->\n";
        echo $head_scripts . "\n";
        echo "<!-- End Theme Head Scripts -->\n";
    }
}

// Output body scripts
add_action('wp_body_open', 'emptytheme_output_body_scripts');
function emptytheme_output_body_scripts() {
    $body_scripts = emptytheme_get_scripts_option('body_scripts');

    if (!empty($body_scripts)) {
        echo "\n<!-- Theme Body Scripts -->\n";
        echo $body_scripts . "\n";
        echo "<!-- End Theme Body Scripts -->\n";
    }
}

// Output footer scripts
add_action('wp_footer', 'emptytheme_output_footer_scripts');
function emptytheme_output_footer_scripts() {
    $footer_scripts = emptytheme_get_scripts_option('footer_scripts');

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
        get_template_directory_uri() . '/assets/js/options-page.js',
        array('jquery', 'media-upload'),
        _S_VERSION,
        true
    );

    wp_enqueue_style(
        'emptytheme-admin',
        get_template_directory_uri() . '/assets/css/admin.min.css',
        array(),
        _S_VERSION
    );

    // Localize script for AJAX
    wp_localize_script('emptytheme-admin', 'emptytheme_admin', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('emptytheme_admin_nonce'),
        'template_url' => get_template_directory_uri(),
        'strings' => array(
            'upload_title' => __('Choose or Upload Logo', 'emptytheme'),
            'upload_button' => __('Use this logo', 'emptytheme'),
            'remove_logo' => __('Remove Logo', 'emptytheme'),
            'change_logo' => __('Change Logo', 'emptytheme'),
            'upload_logo' => __('Upload Logo', 'emptytheme')
        )
    ));
}

// Add meta description to head
add_action('wp_head', 'emptytheme_add_meta_description', 1);
function emptytheme_add_meta_description() {
    // Check if Yoast or Rank Math is handling meta descriptions
    // Priority: Yoast > Rank Math > Custom field > Auto-generated

    // Skip if Yoast SEO is active and has meta description
    if (defined('WPSEO_VERSION')) {
        return;
    }

    // Skip if Rank Math is active and has meta description
    if (defined('RANK_MATH_VERSION')) {
        return;
    }

    $description = '';

    // If single post or page
    if (is_singular()) {
        $post = get_queried_object();

        // Check for ACF custom meta description field
        if (function_exists('get_field')) {
            $custom_meta = get_field('meta_description', $post->ID);
            if (!empty($custom_meta)) {
                $description = $custom_meta;
            }
        }
        // If no custom field, try to get post excerpt
        if (empty($description) && !empty($post->post_excerpt)) {
            $description = $post->post_excerpt;
        }
        // If no excerpt, generate from content
        elseif (empty($description) && !empty($post->post_content)) {
            $content = wp_strip_all_tags($post->post_content);
            $description = wp_trim_words($content, 30);
        }
    }
    // For archive pages
    elseif (is_archive()) {
        $description = get_the_archive_description();
        if (empty($description)) {
            $title = get_the_archive_title();
            /* translators: %s: Archive title */
            $description = sprintf(__('Browse our collection of %s', 'emptytheme'), $title);
        }
    }
    // For blog index
    elseif (is_home() || is_front_page()) {
        $description = get_bloginfo('description');
    }

    // Fallback to site description
    if (empty($description)) {
        $description = get_bloginfo('description');
    }

    // Output meta description tag (keep between 120-160 characters for best SEO)
    if (!empty($description)) {
        $clean_description = esc_attr(wp_strip_all_tags($description));

        // Truncate if too long (for SEO best practices)
        if (mb_strlen($clean_description) > 160) {
            $clean_description = mb_substr($clean_description, 0, 157) . '...';
        }

        echo '<meta name="description" content="' . $clean_description . '" />' . "\n";
    }
}