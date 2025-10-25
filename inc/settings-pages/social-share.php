<?php
// Register settings
add_action('admin_init', 'emptytheme_social_settings_init');
function emptytheme_social_settings_init() {
    // Social Share Settings
    register_setting('emptytheme_social_share_settings_group', 'emptytheme_social_share_options');

    add_settings_section(
        'emptytheme_social_share_section',
        'Social Media Platforms',
        null,
        'emptytheme-social-share'
    );

    $platforms = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'whatsapp' => 'WhatsApp',
        'linkedin' => 'LinkedIn',
        'pinterest' => 'Pinterest',
        'reddit' => 'Reddit',
        'telegram' => 'Telegram',
        'email' => 'Email',
        'tumblr' => 'Tumblr'
    );

    foreach ($platforms as $key => $label) {
        add_settings_field(
            "emptytheme_social_share_{$key}",
            $label,
            'emptytheme_social_share_checkbox_callback',
            'emptytheme-social-share',
            'emptytheme_social_share_section',
            array('platform' => $key)
        );
    }
}

// Social Share Settings page callback
function emptytheme_social_share_settings_page() {
    ?>
    <div class="wrap theme-settings">
        <form method="post" action="options.php">
            <?php
            settings_fields('emptytheme_social_share_settings_group');
            do_settings_sections('emptytheme-social-share');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Checkbox callback for social share
function emptytheme_social_share_checkbox_callback($args) {
    $options = get_option('emptytheme_social_share_options');
    $platform = $args['platform'];
    $checked = isset($options[$platform]) ? $options[$platform] : 0;
    ?>
    <input type="checkbox" name="emptytheme_social_share_options[<?php echo $platform; ?>]" value="1" <?php checked($checked, 1); ?>>
    <?php
}

// Social share function
function emptytheme_social_share($url, $title) {
    $options = get_option('emptytheme_social_share_options');

    // Validate inputs
    if (empty($url) || empty($title)) {
        return '';
    }

    // URL encode the parameters
    $encoded_url = urlencode($url);
    $encoded_title = urlencode($title);
    $encoded_text = urlencode($title . ' ' . $url);

    $output = '<div class="social_share"><div class="article-social">';

    $platforms = array(
        'facebook' => array(
            'url' => "https://www.facebook.com/sharer/sharer.php?u={$encoded_url}",
            'title' => 'Facebook',
            'icon' => 'facebook'
        ),
        'twitter' => array(
            'url' => "https://twitter.com/intent/tweet?text={$encoded_title}&url={$encoded_url}",
            'title' => 'Twitter',
            'icon' => 'twitter'
        ),
        'whatsapp' => array(
            'url' => "https://api.whatsapp.com/send?text={$encoded_text}",
            'title' => 'WhatsApp',
            'icon' => 'whatsapp'
        ),
        'linkedin' => array(
            'url' => "https://www.linkedin.com/sharing/share-offsite/?url={$encoded_url}",
            'title' => 'LinkedIn',
            'icon' => 'linkedin'
        ),
        'pinterest' => array(
            'url' => "https://pinterest.com/pin/create/button/?url={$encoded_url}&description={$encoded_title}",
            'title' => 'Pinterest',
            'icon' => 'pinterest2'
        ),
        'reddit' => array(
            'url' => "https://reddit.com/submit?url={$encoded_url}&title={$encoded_title}",
            'title' => 'Reddit',
            'icon' => 'reddit'
        ),
        'telegram' => array(
            'url' => "https://t.me/share/url?url={$encoded_url}&text={$encoded_title}",
            'title' => 'Telegram',
            'icon' => 'telegram'
        ),
        'email' => array(
            'url' => "mailto:?subject={$encoded_title}&body={$encoded_text}",
            'title' => 'Email',
            'icon' => 'envelope'
        ),
        'tumblr' => array(
            'url' => "https://www.tumblr.com/widgets/share/tool?posttype=link&title={$encoded_title}&caption={$encoded_title}&content={$encoded_url}&canonicalUrl={$encoded_url}&shareSource=tumblr_share_button",
            'title' => 'Tumblr',
            'icon' => 'tumblr'
        )
    );

    foreach ($platforms as $key => $platform) {
        if (isset($options[$key]) && $options[$key]) {
            $output .= "<a class=\"social_share_link social_share_{$key}\" href=\"{$platform['url']}\" aria-label=\"" . esc_attr($platform['title']) . "\" rel=\"nofollow noopener\" target=\"_blank\">";
            $output .= "<span class=\"social_share_svg\"><svg aria-hidden=\"true\"><use xlink:href=\"" . social_sprite($platform['icon']) . "\"></use></svg></span>";
            $output .= "</a>";
        }
    }

    $output .= '</div></div>';
    return $output;
}

/**
 * Get social share links for current post
 *
 * @param string $url Optional URL to share (defaults to current post URL)
 * @param string $title Optional title to share (defaults to current post title)
 * @return string HTML output for social share links
 */
function emptytheme_get_social_share($url = '', $title = '') {
    // If no URL provided, get current post URL
    if (empty($url)) {
        $url = get_permalink();
    }

    // If no title provided, get current post title
    if (empty($title)) {
        $title = get_the_title();
    }

    // Fallback if still empty
    if (empty($url)) {
        $url = home_url();
    }

    if (empty($title)) {
        $title = get_bloginfo('name');
    }

    return emptytheme_social_share($url, $title);
}
