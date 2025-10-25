<?php
/**
 * Theme Shortcodes
 *
 * @package emptytheme
 */

// Logo shortcode
add_shortcode('theme_logo', 'emptytheme_logo_shortcode');
function emptytheme_logo_shortcode($atts) {
    $atts = shortcode_atts(array(
        'size' => 'full',
        'class' => '',
        'alt' => get_bloginfo('name')
    ), $atts, 'theme_logo');

    $logo_id = emptytheme_get_option('logo_id');

    if (empty($logo_id)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    $alt = esc_attr($atts['alt']);

    // Use liteimage for better optimization if plugin is available
    return function_exists('liteimage') ? liteimage($logo_id, [
        'thumb' => $atts['size'],
        'args' => ['class' => $atts['class'], 'alt' => $alt]
    ]) : get_image($logo_id, $atts['size'], ['class' => $atts['class'], 'alt' => $alt]);
}

// Phone shortcode
add_shortcode('theme_phone', 'emptytheme_phone_shortcode');
function emptytheme_phone_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => '',
        'text' => '',
        'show_icon' => 'true'
    ), $atts, 'theme_phone');

    $phone = emptytheme_get_option('phone');

    if (empty($phone)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    $text = !empty($atts['text']) ? $atts['text'] : $phone;
    $icon = $atts['show_icon'] === 'true' ? '<i class="icon-phone"></i> ' : '';

    return sprintf(
        '<a href="tel:%s"%s>%s%s</a>',
        esc_attr($phone),
        $class,
        $icon,
        esc_html($text)
    );
}

// Email shortcode
add_shortcode('theme_email', 'emptytheme_email_shortcode');
function emptytheme_email_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => '',
        'text' => '',
        'show_icon' => 'true'
    ), $atts, 'theme_email');

    $email = emptytheme_get_option('email');

    if (empty($email)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    $text = !empty($atts['text']) ? $atts['text'] : $email;
    $icon = $atts['show_icon'] === 'true' ? '<i class="icon-email"></i> ' : '';

    return sprintf(
        '<a href="mailto:%s"%s>%s%s</a>',
        esc_attr($email),
        $class,
        $icon,
        esc_html($text)
    );
}

// Address shortcode
add_shortcode('theme_address', 'emptytheme_address_shortcode');
function emptytheme_address_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => '',
        'show_icon' => 'true'
    ), $atts, 'theme_address');

    $address = emptytheme_get_option('address');

    if (empty($address)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    $icon = $atts['show_icon'] === 'true' ? '<i class="icon-location"></i> ' : '';

    return sprintf(
        '<span%s>%s%s</span>',
        $class,
        $icon,
        wp_kses_post($address)
    );
}

// Copyright shortcode
add_shortcode('theme_copyright', 'emptytheme_copyright_shortcode');
function emptytheme_copyright_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => ''
    ), $atts, 'theme_copyright');

    $copyright = emptytheme_get_option('copyright');

    if (empty($copyright)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';

    return sprintf(
        '<span%s>%s</span>',
        $class,
        esc_html($copyright)
    );
}

// Footer text shortcode
add_shortcode('theme_footer_text', 'emptytheme_footer_text_shortcode');
function emptytheme_footer_text_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => ''
    ), $atts, 'theme_footer_text');

    $footer_text = emptytheme_get_option('footer_text');

    if (empty($footer_text)) {
        return '';
    }

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';

    return sprintf(
        '<div%s>%s</div>',
        $class,
        wp_kses_post($footer_text)
    );
}

// Preloader shortcode
add_shortcode('theme_preloader', 'emptytheme_preloader_shortcode');
function emptytheme_preloader_shortcode($atts) {
    $atts = shortcode_atts(array(
        'class' => '',
        'text' => '',
        'show_progress' => 'true',
        'show_text' => 'false'
    ), $atts, 'theme_preloader');

    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    $text = esc_html($atts['text']);
    $show_progress = $atts['show_progress'] === 'true';
    $show_text = $atts['show_text'] === 'true';

    $html = '<div id="preloader"' . $class . '>';
    $html .= '<div class="preloader-content">';
    $html .= '<div class="preloader-spinner"></div>';

    if ($show_text && !empty($text)) {
        $html .= '<div class="preloader-text">' . $text . '</div>';
    }

    if ($show_progress) {
        $html .= '<div class="preloader-progress">';
        $html .= '<div class="preloader-progress-bar"></div>';
        $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;
}