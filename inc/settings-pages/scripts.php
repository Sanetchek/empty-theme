<?php

// Migrate scripts data from general options to scripts options
add_action('admin_init', 'emptytheme_migrate_scripts_data');
function emptytheme_migrate_scripts_data() {
    // Check if migration is needed
    $scripts_options = get_option('emptytheme_scripts_options');
    $general_options = get_option('emptytheme_general_options');

    // If scripts options don't exist but general options have scripts data, migrate it
    if (empty($scripts_options) && !empty($general_options)) {
        $new_scripts_options = array();

        if (isset($general_options['head_scripts'])) {
            $new_scripts_options['head_scripts'] = $general_options['head_scripts'];
        }

        if (isset($general_options['footer_scripts'])) {
            $new_scripts_options['footer_scripts'] = $general_options['footer_scripts'];
        }

        // Save migrated data
        if (!empty($new_scripts_options)) {
            update_option('emptytheme_scripts_options', $new_scripts_options);

            // Remove scripts data from general options
            unset($general_options['head_scripts']);
            unset($general_options['footer_scripts']);
            update_option('emptytheme_general_options', $general_options);
        }
    }
}

// Register Scripts Settings
add_action('admin_init', 'emptytheme_scripts_settings_init');
function emptytheme_scripts_settings_init() {
    // Scripts Settings
    register_setting('emptytheme_scripts_settings_group', 'emptytheme_scripts_options');

    add_settings_section(
        'emptytheme_scripts_section',
        __('Scripts & Snippets', 'emptytheme'),
        'emptytheme_scripts_section_callback',
        'emptytheme-scripts-settings'
    );

    // Head scripts field
    add_settings_field(
        'head_scripts',
        __('Head Scripts', 'emptytheme'),
        'emptytheme_head_scripts_field_callback',
        'emptytheme-scripts-settings',
        'emptytheme_scripts_section'
    );

    // Body scripts field
    add_settings_field(
        'body_scripts',
        __('Body Scripts', 'emptytheme'),
        'emptytheme_body_scripts_field_callback',
        'emptytheme-scripts-settings',
        'emptytheme_scripts_section'
    );

    // Footer scripts field
    add_settings_field(
        'footer_scripts',
        __('Footer Scripts', 'emptytheme'),
        'emptytheme_footer_scripts_field_callback',
        'emptytheme-scripts-settings',
        'emptytheme_scripts_section'
    );
}

// Section callback
function emptytheme_scripts_section_callback() {
    echo '<p>' . __('Add custom scripts and code snippets to different parts of your website.', 'emptytheme') . '</p>';
}

// Field callbacks
function emptytheme_head_scripts_field_callback() {
    $options = get_option('emptytheme_scripts_options');
    $head_scripts = isset($options['head_scripts']) ? $options['head_scripts'] : '';
    ?>
    <textarea id="head_scripts"
              name="emptytheme_scripts_options[head_scripts]"
              rows="6"
              class="large-text code"
              placeholder="<?php esc_attr_e('<!-- Google Analytics, Meta tags, etc. -->', 'emptytheme'); ?>"><?php echo esc_textarea($head_scripts); ?></textarea>
    <p class="description">
        <?php _e('Scripts added here will be included in the &lt;head&gt; section of your site. Useful for Google Analytics, meta tags, etc.', 'emptytheme'); ?><br>
        <strong><?php _e('Examples:', 'emptytheme'); ?></strong><br>
        • Google Analytics tracking code<br>
        • Meta tags and Open Graph data<br>
        • Custom CSS styles<br>
        • Font loading scripts
    </p>
    <?php
}

function emptytheme_body_scripts_field_callback() {
    $options = get_option('emptytheme_scripts_options');
    $body_scripts = isset($options['body_scripts']) ? $options['body_scripts'] : '';
    ?>
    <textarea id="body_scripts"
              name="emptytheme_scripts_options[body_scripts]"
              rows="6"
              class="large-text code"
              placeholder="<?php esc_attr_e('<!-- Custom body scripts, chat widgets, etc. -->', 'emptytheme'); ?>"><?php echo esc_textarea($body_scripts); ?></textarea>
    <p class="description">
        <?php _e('Scripts added here will be included right after the opening &lt;body&gt; tag. Useful for chat widgets, custom body scripts, etc.', 'emptytheme'); ?><br>
        <strong><?php _e('Examples:', 'emptytheme'); ?></strong><br>
        • Live chat widgets<br>
        • Custom body initialization scripts<br>
        • Third-party tracking scripts<br>
        • Custom JavaScript libraries
    </p>
    <?php
}

function emptytheme_footer_scripts_field_callback() {
    $options = get_option('emptytheme_scripts_options');
    $footer_scripts = isset($options['footer_scripts']) ? $options['footer_scripts'] : '';
    ?>
    <textarea id="footer_scripts"
              name="emptytheme_scripts_options[footer_scripts]"
              rows="6"
              class="large-text code"
              placeholder="<?php esc_attr_e('<!-- Facebook Pixel, Chat widgets, etc. -->', 'emptytheme'); ?>"><?php echo esc_textarea($footer_scripts); ?></textarea>
    <p class="description">
        <?php _e('Scripts added here will be included before the closing &lt;/body&gt; tag. Useful for Facebook Pixel, chat widgets, etc.', 'emptytheme'); ?><br>
        <strong><?php _e('Examples:', 'emptytheme'); ?></strong><br>
        • Facebook Pixel<br>
        • Google Tag Manager<br>
        • Chat widgets<br>
        • Performance monitoring scripts
    </p>
    <?php
}

// Scripts Settings page callback
function emptytheme_scripts_settings_page() {
    ?>
    <div class="wrap theme-settings">
        <h1><?php _e('Scripts & Snippets', 'emptytheme'); ?></h1>
        <p><?php _e('Add custom scripts and code snippets to different parts of your website. Be careful when adding scripts - incorrect code can break your site.', 'emptytheme'); ?></p>

        <form method="post" action="options.php">
            <?php
            settings_fields('emptytheme_scripts_settings_group');
            do_settings_sections('emptytheme-scripts-settings');
            submit_button(__('Save Scripts', 'emptytheme'));
            ?>
        </form>
    </div>
    <?php
}

// Helper function to easily fetch scripts options
function emptytheme_get_scripts_option($key, $default = '') {
    $options = get_option('emptytheme_scripts_options', array());
    return isset($options[$key]) ? $options[$key] : $default;
}
