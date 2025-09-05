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
        __('Footer Text / Copyright', 'emptytheme'),
        'emptytheme_footer_text_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Header scripts field
    add_settings_field(
        'header_scripts',
        __('Header Scripts', 'emptytheme'),
        'emptytheme_header_scripts_field_callback',
        'emptytheme-general-settings',
        'emptytheme_general_section'
    );

    // Footer scripts field
    add_settings_field(
        'footer_scripts',
        __('Footer Scripts', 'emptytheme'),
        'emptytheme_footer_scripts_field_callback',
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
    ?>
    <div class="logo-upload-field">
        <input type="hidden" id="logo_id" name="emptytheme_general_options[logo_id]" value="<?php echo esc_attr($logo_id); ?>" />
        <div id="logo_preview" class="logo-preview">
            <?php if ($logo_id) : ?>
                <?php echo wp_get_attachment_image($logo_id, 'medium', false, array('style' => 'max-width: 200px; height: auto;')); ?>
            <?php endif; ?>
        </div>
        <button type="button" class="button button-secondary" id="upload_logo_button">
            <?php echo $logo_id ? __('Change Logo', 'emptytheme') : __('Upload Logo', 'emptytheme'); ?>
        </button>
        <?php if ($logo_id) : ?>
            <button type="button" class="button button-link-delete" id="remove_logo_button">
                <?php _e('Remove Logo', 'emptytheme'); ?>
            </button>
        <?php endif; ?>
        <p class="description">
            <?php _e('Upload your site logo. Recommended size: 200x60px.', 'emptytheme'); ?>
        </p>
    </div>
    <?php
}

function emptytheme_phone_field_callback() {
    $options = get_option('emptytheme_general_options');
    $phone = isset($options['phone']) ? $options['phone'] : '';
    ?>
    <input type="tel"
           id="phone"
           name="emptytheme_general_options[phone]"
           value="<?php echo esc_attr($phone); ?>"
           class="regular-text"
           placeholder="<?php esc_attr_e('+1 (555) 123-4567', 'emptytheme'); ?>" />
    <p class="description">
        <?php _e('Enter your phone number. It will be displayed as a clickable link.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_email_field_callback() {
    $options = get_option('emptytheme_general_options');
    $email = isset($options['email']) ? $options['email'] : '';
    ?>
    <input type="email"
           id="email"
           name="emptytheme_general_options[email]"
           value="<?php echo esc_attr($email); ?>"
           class="regular-text"
           placeholder="<?php esc_attr_e('info@example.com', 'emptytheme'); ?>" />
    <p class="description">
        <?php _e('Enter your email address. It will be displayed as a clickable mailto link.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_address_field_callback() {
    $options = get_option('emptytheme_general_options');
    $address = isset($options['address']) ? $options['address'] : '';
    ?>
    <textarea id="address"
              name="emptytheme_general_options[address]"
              rows="3"
              class="large-text"
              placeholder="<?php esc_attr_e('Enter your business address', 'emptytheme'); ?>"><?php echo esc_textarea($address); ?></textarea>
    <p class="description">
        <?php _e('Enter your business address. Basic HTML is allowed.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_footer_text_field_callback() {
    $options = get_option('emptytheme_general_options');
    $footer_text = isset($options['footer_text']) ? $options['footer_text'] : '';
    ?>
    <textarea id="footer_text"
              name="emptytheme_general_options[footer_text]"
              rows="4"
              class="large-text"
              placeholder="<?php esc_attr_e('© 2024 Your Company Name. All rights reserved.', 'emptytheme'); ?>"><?php echo esc_textarea($footer_text); ?></textarea>
    <p class="description">
        <?php _e('Enter your footer text or copyright notice. Basic HTML is allowed.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_header_scripts_field_callback() {
    $options = get_option('emptytheme_general_options');
    $header_scripts = isset($options['header_scripts']) ? $options['header_scripts'] : '';
    ?>
    <textarea id="header_scripts"
              name="emptytheme_general_options[header_scripts]"
              rows="6"
              class="large-text code"
              placeholder="<?php esc_attr_e('<!-- Google Analytics, Meta tags, etc. -->', 'emptytheme'); ?>"><?php echo esc_textarea($header_scripts); ?></textarea>
    <p class="description">
        <?php _e('Scripts added here will be included in the &lt;head&gt; section of your site. Useful for Google Analytics, meta tags, etc.', 'emptytheme'); ?>
    </p>
    <?php
}

function emptytheme_footer_scripts_field_callback() {
    $options = get_option('emptytheme_general_options');
    $footer_scripts = isset($options['footer_scripts']) ? $options['footer_scripts'] : '';
    ?>
    <textarea id="footer_scripts"
              name="emptytheme_general_options[footer_scripts]"
              rows="6"
              class="large-text code"
              placeholder="<?php esc_attr_e('<!-- Facebook Pixel, Chat widgets, etc. -->', 'emptytheme'); ?>"><?php echo esc_textarea($footer_scripts); ?></textarea>
    <p class="description">
        <?php _e('Scripts added here will be included before the closing &lt;/body&gt; tag. Useful for Facebook Pixel, chat widgets, etc.', 'emptytheme'); ?>
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

        <form method="post" action="options.php">
            <?php
            settings_fields('emptytheme_general_settings_group');
            do_settings_sections('emptytheme-general-settings');
            submit_button(__('Save Settings', 'emptytheme'));
            ?>
        </form>
    </div>
    <?php
}

// Helper function to easily fetch options
function emptytheme_get_option($key, $default = '') {
    $options = get_option('emptytheme_general_options', array());
    return isset($options[$key]) ? $options[$key] : $default;
}