<?php

// Register settings
add_action('admin_init', 'emptytheme_general_settings_init');
function emptytheme_general_settings_init() {
    // General Settings
    register_setting('emptytheme_general_settings_group', 'emptytheme_general_options');

    add_settings_section(
        'emptytheme_general_section',
        'General Settings',
        null,
        'emptytheme-general-settings'
    );
}

// General Settings page callback
function emptytheme_general_settings_page() {
    ?>
    <div class="wrap theme-settings">
        <form method="post" action="options.php">
            <?php
            settings_fields('emptytheme_general_settings_group');
            do_settings_sections('emptytheme-general-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}