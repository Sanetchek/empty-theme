<?php

/**
 * Outputs HTML link tags to preload fonts from the theme's assets/fonts/
 * directory. This is done to enable font preloading in modern browsers.
 *
 * Note: This function is intended to be hooked into the `wp_head` action.
 *
 * @since 1.0.0
 */
function emptytheme_preload_all_site_fonts() {
    global $wp_styles;

    $font_urls = [];

    // 1. Local theme fonts in /assets/fonts/
    $fontPath = '/assets/fonts/';
    $fontDir = get_template_directory() . $fontPath;
    if (is_dir($fontDir)) {
        $localFontFiles = glob($fontDir . '*.{ttf,otf,woff,woff2}', GLOB_BRACE);
        foreach ($localFontFiles as $file) {
            $url = get_template_directory_uri() . $fontPath . basename($file);
            $font_urls[] = esc_url_raw($url);
        }
    }

    // 2. Fonts from enqueued styles (Google Fonts and others)
    if (!empty($wp_styles->registered)) {
        foreach ($wp_styles->registered as $style) {
            $src = $style->src;
            $url = strpos($src, '//') === 0 ? 'https:' . $src : $src;
            $url = esc_url_raw($url);

            // Detect Google Fonts
            if (strpos($url, 'fonts.googleapis.com') !== false) {
                $font_urls[] = $url;

                // Optional noscript fallback
                printf('<noscript><link rel="stylesheet" href="%s"></noscript>' . "\n", esc_url($url));
            }

            // Parse CSS file for @font-face URLs
            if (pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) === 'css') {
                $css = @file_get_contents($url);
                if ($css && preg_match_all('/url\((\'|")?(.*?\.(woff2?|ttf|otf|eot))(\\?.*?)?(\'|")?\)/i', $css, $matches)) {
                    foreach ($matches[2] as $font_url) {
                        $full_url = $font_url;

                        if (strpos($font_url, '//') === 0) {
                            $full_url = 'https:' . $font_url;
                        } elseif (strpos($font_url, 'http') !== 0) {
                            $parsed_css_url = parse_url($url);
                            $base = $parsed_css_url['scheme'] . '://' . $parsed_css_url['host'];
                            if (isset($parsed_css_url['path'])) {
                                $dir = dirname($parsed_css_url['path']);
                                $full_url = $base . $dir . '/' . ltrim($font_url, '/');
                            }
                        }

                        $font_urls[] = esc_url_raw($full_url);
                    }
                }
            }
        }
    }

    // 3. Output unique preload tags
    $font_urls = array_unique($font_urls);

    foreach ($font_urls as $font_url) {
        $ext = pathinfo(parse_url($font_url, PHP_URL_PATH), PATHINFO_EXTENSION);
        switch (strtolower($ext)) {
            case 'woff2':
                $type = 'font/woff2';
                break;
            case 'woff':
                $type = 'font/woff';
                break;
            case 'ttf':
                $type = 'font/ttf';
                break;
            case 'otf':
                $type = 'font/otf';
                break;
            case 'eot':
                $type = 'application/vnd.ms-fontobject';
                break;
            default:
                $type = 'font/' . $ext;
                break;
        }

        // Google Fonts are stylesheets, not font files
        if (strpos($font_url, 'fonts.googleapis.com') !== false) {
            printf(
                '<link rel="preload" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n",
                esc_url($font_url)
            );
        } else {
            printf(
                '<link rel="preload" href="%s" as="font" type="%s" crossorigin>' . "\n",
                esc_url($font_url),
                esc_attr($type)
            );
        }
    }
}
add_action('wp_head', 'emptytheme_preload_all_site_fonts', 1);

