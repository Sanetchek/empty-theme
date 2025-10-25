<?php

// Register WPML strings for General options on update to sync with String Translation
add_action('update_option_emptytheme_general_options', 'emptytheme_wpml_register_general_options_strings', 10, 3);
function emptytheme_wpml_register_general_options_strings($old_value, $new_value, $option_name) {
    if (!is_array($new_value)) {
        return;
    }

    // If WPML not active, skip
    if (!has_action('wpml_register_single_string')) {
        return;
    }

    $keys_to_register = array(
        // Header
        'header_button_title', 'header_button_url',
        // Contact
        'phone', 'email', 'address',
        // Footer
        'footer_text', 'copyright',
    );

    foreach ($keys_to_register as $key) {
        if (isset($new_value[$key])) {
            // Ensure scalar string for registration
            $string_value = is_scalar($new_value[$key]) ? (string) $new_value[$key] : '';
            do_action('wpml_register_single_string', 'emptytheme_general_options', $key, $string_value);
        }
    }
}

// Intercept saving General options on non-default languages and write translations instead
add_filter('pre_update_option_emptytheme_general_options', 'emptytheme_wpml_intercept_general_options_save', 10, 3);
function emptytheme_wpml_intercept_general_options_save($new_value, $old_value, $option_name) {
    if (!is_array($new_value)) {
        return $new_value;
    }

    // WPML must be active
    $current_lang = apply_filters('wpml_current_language', null);
    $default_lang = apply_filters('wpml_default_language', null);

    // Prefer posted lang from settings form to reliably detect admin language
    if (isset($_POST['lang'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $posted_lang = sanitize_text_field(wp_unslash($_POST['lang'])); // phpcs:ignore WordPress.Security.NonceVerification.Missing
        if (!empty($posted_lang)) {
            $current_lang = $posted_lang;
        }
    }

    if (empty($current_lang) || empty($default_lang) || $current_lang === $default_lang) {
        // Default language: proceed with normal save
        return $new_value;
    }

    // On non-default language: update translations in String Translation and prevent base option overwrite
    // Proceed even if function not hooked; we'll call do_action regardless

    $keys_to_translate = array(
        // Media IDs (allow per-language override; additionally rely on WPML Media if used)
        'logo_id',
        // Header
        'header_button_title', 'header_button_url',
        // Contact
        'phone', 'email', 'address',
        // Footer
        'footer_text', 'copyright',
    );

    foreach ($keys_to_translate as $key) {
        if (!array_key_exists($key, $new_value)) {
            continue;
        }

        $translated_value = is_scalar($new_value[$key]) ? (string) $new_value[$key] : '';
        // Always get base options from default language
        $base_options = get_option('emptytheme_general_options');
        $base_value = '';
        if (is_array($base_options) && array_key_exists($key, $base_options)) {
            $base_value = is_scalar($base_options[$key]) ? (string) $base_options[$key] : '';
        }

        // Ensure the string is registered (with base value if available)
        do_action('wpml_register_single_string', 'emptytheme_general_options', $key, $base_value);

        // Try to resolve string id by base value + name + domain
        $string_id = apply_filters('wpml_st_get_string_id', null, $base_value, $key, 'emptytheme_general_options');

        // Fallback: resolve by name + domain only (ignoring value)
        if (empty($string_id)) {
            $string_id = apply_filters('wpml_st_get_string_id_by_name_and_context', 0, $key, 'emptytheme_general_options');
        }

        // If still missing, register again with translated value to force creation, then try by name/context
        if (empty($string_id)) {
            do_action('wpml_register_single_string', 'emptytheme_general_options', $key, $base_value);
            $string_id = apply_filters('wpml_st_get_string_id_by_name_and_context', 0, $key, 'emptytheme_general_options');
        }

        if ($string_id) {
            // 10 == translation complete
            do_action('wpml_add_string_translation', $string_id, $current_lang, $translated_value, 10);
        }
    }

    // Persist language-specific overrides to their own option for immediate reflection in admin and frontend
    $lang_option_key = 'emptytheme_general_options__' . $current_lang;
    $existing_lang_values = get_option($lang_option_key, array());
    if (!is_array($existing_lang_values)) {
        $existing_lang_values = array();
    }
    $merged_lang_values = array_merge($existing_lang_values, $new_value);
    update_option($lang_option_key, $merged_lang_values, false);

    // For media IDs (logo_id) rely on WPML Media translations; do not overwrite base option
    // Flag admin notice to inform user
    set_transient('emptytheme_wpml_strings_saved', 1, 60);
    return $old_value; // prevent saving base options in non-default language
}

// Admin notice after saving translations from non-default language
add_action('admin_notices', function () {
    if (get_transient('emptytheme_wpml_strings_saved')) {
        delete_transient('emptytheme_wpml_strings_saved');
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Translations saved for this language via WPML String Translation.', 'emptytheme') . '</p></div>';
    }
});
