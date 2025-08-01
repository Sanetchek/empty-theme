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
        'tumblr' => 'Tumblr',
        'viber' => 'Viber'
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
    $output = '<div class="social_share"><div class="article-social">';

    $platforms = array(
        'facebook' => array(
            'url' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'title' => 'Facebook',
            'icon' => 'facebook'
        ),
        'twitter' => array(
            'url' => "http://twitter.com/intent/tweet?text={$title}&url={$url}",
            'title' => 'Twitter',
            'icon' => 'twitter'
        ),
        'whatsapp' => array(
            'url' => "https://api.whatsapp.com/send?text={$title} {$url}",
            'title' => 'WhatsApp',
            'icon' => 'whatsapp'
        ),
        'linkedin' => array(
            'url' => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
            'title' => 'LinkedIn',
            'icon' => 'linkedin'
        ),
        'pinterest' => array(
            'url' => "https://pinterest.com/pin/create/button/?url={$url}&description={$title}",
            'title' => 'Pinterest',
            'icon' => 'pinterest2'
        ),
        'reddit' => array(
            'url' => "https://reddit.com/submit?url={$url}&title={$title}",
            'title' => 'Reddit',
            'icon' => 'reddit'
        ),
        'telegram' => array(
            'url' => "https://t.me/share/url?url={$url}&text={$title}",
            'title' => 'Telegram',
            'icon' => 'telegram'
        ),
        'email' => array(
            'url' => "mailto:?subject={$title}&body={$url}",
            'title' => 'Email',
            'icon' => 'envelope'
        ),
        'tumblr' => array(
            'url' => "https://www.tumblr.com/widgets/share/tool?canonicalUrl={$url}&title={$title}",
            'title' => 'Tumblr',
            'icon' => 'tumblr'
        ),
        'viber' => array(
            'url' => "viber://forward?text={$title}%20{$url}",
            'title' => 'Viber',
            'icon' => 'viber'
        )
    );

    foreach ($platforms as $key => $platform) {
        if (isset($options[$key]) && $options[$key]) {
            $output .= "<a class=\"social_share_link social_share_{$key}\" href=\"{$platform['url']}\" title=\"{$platform['title']}\" rel=\"nofollow noopener\" target=\"_blank\">";
            $output .= "<span class=\"social_share_svg\"><svg><use xlink:href=\"" . social_sprite($platform['icon']) . "\"></use></svg></span>";
            $output .= "</a>";
        }
    }

    $output .= '</div></div>';
    return $output;
}
