<?php

// Register settings
add_action('admin_init', 'emptytheme_general_settings_init');
function emptytheme_general_settings_init() {
    // General Settings
    register_setting('emptytheme_general_settings_group', 'emptytheme_general_options');

    add_settings_section(
        'emptytheme_general_section',
        __('General Settings', 'emptytheme'),
        null,
        'emptytheme-general-settings'
    );

    // Logo field
    add_settings_field(
        'logo_id',
        __('Logo', 'emptytheme'),
        'emptytheme_logo_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Header button field
    add_settings_field(
        'header_button',
        __('Header Button', 'emptytheme'),
        'emptytheme_header_button_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Phone field
    add_settings_field(
        'phone',
        __('Phone Number', 'emptytheme'),
        'emptytheme_phone_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Email field
    add_settings_field(
        'email',
        __('Email Address', 'emptytheme'),
        'emptytheme_email_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Address field
    add_settings_field(
        'address',
        __('Address', 'emptytheme'),
        'emptytheme_address_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Footer text field
    add_settings_field(
        'footer_text',
        __('Footer Text', 'emptytheme'),
        'emptytheme_footer_text_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Copyright field
    add_settings_field(
        'copyright',
        __('Copyright', 'emptytheme'),
        'emptytheme_copyright_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Maintenance mode field
    add_settings_field(
        'maintenance_mode',
        __('Maintenance Mode', 'emptytheme'),
        'emptytheme_maintenance_mode_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Preloader toggle field
    add_settings_field(
        'preloader_enabled',
        __('Custom Preloader', 'emptytheme'),
        'emptytheme_preloader_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );
}

// Field callbacks
function emptytheme_logo_field_callback() {
    $options = get_option('emptytheme_general_options');
    $logo_id = isset($options['logo_id']) ? $options['logo_id'] : '';
    if (function_exists('emptytheme_get_attachment_id_translated')) {
        $logo_id = emptytheme_get_attachment_id_translated($logo_id);
    }
    ?>
    <div class="logo-upload-field">
        <input type="hidden" id="logo_id" name="emptytheme_general_options[logo_id]" value="<?php echo esc_attr($logo_id); ?>" />
        <div id="logo_preview" class="logo-preview">
            <?php if ($logo_id) : ?>
                <?php echo function_exists('liteimage') ? liteimage($logo_id, [
                    'thumb' => [0, 60],
                    'args' => ['alt' => get_bloginfo('name')]
                ]) : get_image($logo_id, [0, 60], ['alt' => get_bloginfo('name')]); ?>
            <?php else : ?>
                <img height="60" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php _e('Default Logo', 'emptytheme'); ?>" />
            <?php endif; ?>
        </div>
        <div class="logo-upload-buttons">
            <button type="button" class="button button-secondary" id="upload_logo_button">
                <?php echo $logo_id ? __('Change Logo', 'emptytheme') : __('Upload Logo', 'emptytheme'); ?>
            </button>
            <?php if ($logo_id) : ?>
                <button type="button" class="button button-link-delete" id="remove_logo_button">
                    <?php _e('Remove Logo', 'emptytheme'); ?>
                </button>
            <?php endif; ?>
        </div>
    <p class="description">
        <?php _e('Upload your site logo. Recommended size: 200x60px.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_logo]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_logo size="thumbnail" class="custom-class"]</code>
    </p>
    </div>
    <?php
}

function emptytheme_header_button_field_callback() {
    $button_title = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('header_button_title', __('Connect', 'emptytheme')) : __('Connect', 'emptytheme');
    $button_url = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('header_button_url', '#') : '#';
    ?>
    <div class="header-button-fields">
        <div style="margin-bottom: 15px;">
            <label for="header_button_title" style="display: block; margin-bottom: 5px; font-weight: 600;">
                <?php _e('Button Text', 'emptytheme'); ?>
            </label>
            <input type="text"
                   id="header_button_title"
                   name="emptytheme_general_options[header_button_title]"
                   value="<?php echo esc_attr($button_title); ?>"
                   class="regular-text"
                   placeholder="<?php esc_attr_e('Connect', 'emptytheme'); ?>" />
        </div>
        <div>
            <label for="header_button_url" style="display: block; margin-bottom: 5px; font-weight: 600;">
                <?php _e('Button URL', 'emptytheme'); ?>
            </label>
            <input type="url"
                   id="header_button_url"
                   name="emptytheme_general_options[header_button_url]"
                   value="<?php echo esc_url($button_url); ?>"
                   class="regular-text"
                   placeholder="<?php esc_attr_e('https://example.com', 'emptytheme'); ?>" />
        </div>
    </div>
    <p class="description">
        <?php _e('Configure the header button that appears in the main navigation.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_phone_field_callback() {
    $phone = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('phone', '') : '';
    ?>
    <input type="tel"
           id="phone"
           name="emptytheme_general_options[phone]"
           value="<?php echo esc_attr($phone); ?>"
           class="regular-text"
           placeholder="<?php esc_attr_e('+1 (555) 123-4567', 'emptytheme'); ?>" />
    <p class="description">
        <?php _e('Enter your phone number. It will be displayed as a clickable link.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_phone]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_phone class="custom-class" text="Custom Text"]</code>
    </p>
    <?php
}

function emptytheme_email_field_callback() {
    $email = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('email', '') : '';
    ?>
    <input type="email"
           id="email"
           name="emptytheme_general_options[email]"
           value="<?php echo esc_attr($email); ?>"
           class="regular-text"
           placeholder="<?php esc_attr_e('info@example.com', 'emptytheme'); ?>" />
    <p class="description">
        <?php _e('Enter your email address. It will be displayed as a clickable mailto link.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_email]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_email class="custom-class" text="Custom Text"]</code>
    </p>
    <?php
}

function emptytheme_address_field_callback() {
    $address = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('address', '') : '';
    ?>
    <textarea id="address"
              name="emptytheme_general_options[address]"
              rows="3"
              class="large-text"
              placeholder="<?php esc_attr_e('Enter your business address', 'emptytheme'); ?>"><?php echo esc_textarea($address); ?></textarea>
    <p class="description">
        <?php _e('Enter your business address. Basic HTML is allowed.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_address]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_address class="custom-class"]</code>
    </p>
    <?php
}

function emptytheme_footer_text_field_callback() {
    $footer_text = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('footer_text', '') : '';
    ?>
    <textarea id="footer_text"
              name="emptytheme_general_options[footer_text]"
              rows="4"
              class="large-text"
              placeholder="<?php esc_attr_e('Enter your footer text content here...', 'emptytheme'); ?>"><?php echo esc_textarea($footer_text); ?></textarea>
    <p class="description">
        <?php _e('Enter your footer text content. Basic HTML is allowed.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_footer_text]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_footer_text class="custom-class"]</code>
    </p>
    <?php
}

function emptytheme_copyright_field_callback() {
    $copyright = function_exists('emptytheme_get_option_translated') ? emptytheme_get_option_translated('copyright', '') : '';
    ?>
    <input type="text"
           id="copyright"
           name="emptytheme_general_options[copyright]"
           value="<?php echo esc_attr($copyright); ?>"
           class="regular-text"
           placeholder="<?php esc_attr_e('© 2024 Your Company Name. All rights reserved.', 'emptytheme'); ?>" />
    <p class="description">
        <?php _e('Enter your copyright notice.', 'emptytheme'); ?><br>
        <strong><?php _e('Shortcode:', 'emptytheme'); ?></strong> <code>[theme_copyright]</code> <?php _e('or', 'emptytheme'); ?> <code>[theme_copyright class="custom-class"]</code>
    </p>
    <?php
}

function emptytheme_maintenance_mode_field_callback() {
    $options = get_option('emptytheme_general_options');
    $maintenance_mode = isset($options['maintenance_mode']) ? $options['maintenance_mode'] : false;
    ?>
    <label class="toggle-switch">
        <input type="checkbox"
               id="maintenance_mode"
               name="emptytheme_general_options[maintenance_mode]"
               value="1"
               <?php checked($maintenance_mode, 1); ?> />
        <span class="toggle-slider"></span>
    </label>
    <span class="toggle-label">
        <?php _e('Enable maintenance mode (Site under construction)', 'emptytheme'); ?>
    </span>
    <p class="description">
        <?php _e('When enabled, visitors will see a "Site under construction" page. Logged-in users and administrators can still access the site normally.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_preloader_field_callback() {
    $options = get_option('emptytheme_general_options');
    $preloader_enabled = isset($options['preloader_enabled']) ? $options['preloader_enabled'] : false;
    ?>
    <label class="toggle-switch">
        <input type="checkbox"
               id="preloader_enabled"
               name="emptytheme_general_options[preloader_enabled]"
               value="1"
               <?php checked($preloader_enabled, 1); ?> />
        <span class="toggle-slider"></span>
    </label>
    <span class="toggle-label">
        <?php _e('Enable custom preloader', 'emptytheme'); ?>
    </span>
    <p class="description">
        <?php _e('When enabled, a loading animation will be displayed while the page loads. You can also use the [theme_preloader] shortcode to display it manually.', 'emptytheme'); ?>
    </p>
    <?php
}

// General Settings page callback
function emptytheme_general_settings_page() {
    ?>
    <div class="wrap theme-settings">
        <h1><?php _e('Theme General Settings', 'emptytheme'); ?></h1>
        <p><?php _e('Configure your theme\'s general settings, logo, contact information, and more.', 'emptytheme'); ?></p>

        <?php
        $current_lang = apply_filters('wpml_current_language', null);
        $default_lang = apply_filters('wpml_default_language', null);
        $is_non_default_lang = ($current_lang && $default_lang && $current_lang !== $default_lang);
        if ($is_non_default_lang) {
            echo '<div class="notice notice-info"><p>' . esc_html__('You are editing translations for this language. Saving will update WPML String Translation entries for this language only.', 'emptytheme') . '</p></div>';
        }
        ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('emptytheme_general_settings_group');
            // Preserve current language on POST so WPML can pick it up during options.php
            if (!empty($current_lang)) {
                echo '<input type="hidden" name="lang" value="' . esc_attr($current_lang) . '" />';
            }
            do_settings_sections('emptytheme-general-settings');
            submit_button(__('Save Settings', 'emptytheme'));
            ?>
        </form>
    </div>
    <?php
}

// Helper function to easily fetch options
function emptytheme_get_option($key, $default = '') {
    // Use WPML-aware function if available
    if (function_exists('emptytheme_get_option_translated')) {
        return emptytheme_get_option_translated($key, $default);
    }

    // Fallback to original function
    $options = get_option('emptytheme_general_options', array());
    return isset($options[$key]) ? $options[$key] : $default;
}