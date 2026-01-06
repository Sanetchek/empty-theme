<?php
/**
 * Block Registration System
 *
 * Automatically discovers and registers ACF blocks from blocks/ directory.
 * Supports category-based organization and automatic asset loading.
 */

/**
 * Finds CSS file with preference for minified version.
 *
 * @param string $block_folder Block folder path.
 * @param string $filename Base filename (without extension).
 * @return string|null Full path to CSS file or null if not found.
 */
function theme_find_block_css($block_folder, $filename) {
    $minified = $block_folder . '/' . $filename . '.min.css';
    $regular = $block_folder . '/' . $filename . '.css';

    // Prefer minified version, fallback to regular
    if (file_exists($minified)) {
        return $minified;
    }

    if (file_exists($regular)) {
        return $regular;
    }

    return null;
}

/**
 * Finds RTL CSS file with preference for minified version.
 *
 * @param string $block_folder Block folder path.
 * @param string $filename Base filename (without extension).
 * @return string|null Full path to RTL CSS file or null if not found.
 */
function theme_find_block_css_rtl($block_folder, $filename) {
    $minified_rtl = $block_folder . '/' . $filename . '-rtl.min.css';
    $regular_rtl = $block_folder . '/' . $filename . '-rtl.css';

    // Prefer minified RTL version, fallback to regular RTL
    if (file_exists($minified_rtl)) {
        return $minified_rtl;
    }

    if (file_exists($regular_rtl)) {
        return $regular_rtl;
    }

    return null;
}

/**
 * Collects block information from the blocks directory structure.
 *
 * @param string $base_dir Base directory path for blocks.
 * @return array Array of block data with category, slug, and paths.
 */
function theme_collect_blocks($base_dir) {
    static $cached_blocks = null;

    // Return cached results if available
    if ($cached_blocks !== null) {
        return $cached_blocks;
    }

    $output = [];

    // Validate base directory
    if (!is_dir($base_dir)) {
        return $output;
    }

    // Get category directories
    $categories = glob($base_dir . '/*', GLOB_ONLYDIR);

    if ($categories === false) {
        return $output;
    }

    foreach ($categories as $category) {
        $category_name = basename($category);

        // Get block directories within category
        $block_folders = glob($category . '/*', GLOB_ONLYDIR);

        if ($block_folders === false) {
            continue;
        }

        foreach ($block_folders as $block_folder) {
            $block_file = $block_folder . '/block.php';

            if (file_exists($block_file)) {
                $slug = basename($block_folder);

                // Try to find screenshot with different case variations
                $screenshot = null;
                $screenshot_variants = [
                    $block_folder . '/Screenshot.png',
                    $block_folder . '/screenshot.png',
                    $block_folder . '/SCREENSHOT.PNG',
                ];

                foreach ($screenshot_variants as $variant) {
                    if (file_exists($variant)) {
                        $screenshot = $variant;
                        break;
                    }
                }

                // Find CSS files with preference for minified versions
                $css_file = theme_find_block_css($block_folder, 'style');
                $css_rtl_file = theme_find_block_css_rtl($block_folder, 'style');
                $editor_css_file = theme_find_block_css($block_folder, 'editor');
                $editor_css_rtl_file = theme_find_block_css_rtl($block_folder, 'editor');

                $output[] = [
                    'category' => $category_name,
                    'slug'     => $slug,
                    'folder'   => $block_folder,
                    'php'      => $block_file,
                    'css'      => $css_file,
                    'css_rtl'  => $css_rtl_file,
                    'editor_css' => $editor_css_file,
                    'editor_css_rtl' => $editor_css_rtl_file,
                    'js'       => $block_folder . '/script.js',
                    'screenshot' => $screenshot,
                ];
            }
        }
    }

    // Cache results
    $cached_blocks = $output;

    return $output;
}

/**
 * Maps category folder names to ACF category slugs.
 *
 * @param string $category_folder Category folder name.
 * @return string ACF category slug.
 */
function theme_get_block_category($category_folder) {
    $category_map = [
        'general' => 'layout',
        'common'  => 'common',
        'formatting' => 'formatting',
        'layout'  => 'layout',
        'widgets' => 'widgets',
    ];

    $lowercase = strtolower($category_folder);

    return isset($category_map[$lowercase])
        ? $category_map[$lowercase]
        : 'layout';
}

/**
 * Gets block icon based on category or slug.
 *
 * @param string $category Block category.
 * @param string $slug Block slug.
 * @return string Dashicon name.
 */
function theme_get_block_icon($category, $slug) {
    // Category-based icons
    $category_icons = [
        'general' => 'admin-generic',
        'common'  => 'admin-appearance',
        'formatting' => 'editor-textcolor',
        'layout'  => 'layout',
        'widgets' => 'admin-widgets',
    ];

    $lowercase_category = strtolower($category);

    if (isset($category_icons[$lowercase_category])) {
        return $category_icons[$lowercase_category];
    }

    // Default icon
    return 'admin-comments';
}

/**
 * Registers block styles and scripts.
 */
add_action('wp_enqueue_scripts', function() {
    $blocks = theme_collect_blocks(get_template_directory() . '/blocks');
    $template_dir = get_template_directory();
    $template_uri = get_template_directory_uri();

    foreach ($blocks as $block) {
        $handle = "block-{$block['slug']}";

        // Register CSS (minified preferred)
        if (!empty($block['css']) && file_exists($block['css'])) {
            $css_path = str_replace($template_dir, '', $block['css']);
            wp_register_style(
                $handle,
                $template_uri . $css_path,
                [],
                filemtime($block['css'])
            );

            // WordPress automatically detects RTL files with -rtl suffix,
            // but we explicitly mark it for better compatibility
            if (!empty($block['css_rtl']) && file_exists($block['css_rtl'])) {
                wp_style_add_data($handle, 'rtl', 'replace');
            }
        }

        // Register JavaScript
        if (file_exists($block['js'])) {
            $js_path = str_replace($template_dir, '', $block['js']);
            wp_register_script(
                $handle,
                $template_uri . $js_path,
                ['jquery'],
                filemtime($block['js']),
                true
            );
        }
    }
}, 10);

/**
 * Registers ACF block types.
 */
add_action('acf/init', function() {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $blocks = theme_collect_blocks(get_template_directory() . '/blocks');

    foreach ($blocks as $block) {
        $slug = $block['slug'];
        $name = ucwords(str_replace(['-', '_'], ' ', $slug));
        $handle = "block-{$slug}";

        $args = [
            'name'            => $slug,
            'title'           => "$name Block",
            'description'     => sprintf(
                __('A custom %s block.', 'tmlnews'),
                strtolower($name)
            ),
            'render_template' => $block['php'],
            'category'        => theme_get_block_category($block['category']),
            'keywords'        => [
                $slug,
                str_replace('-', ' ', $slug),
                $block['category'],
            ],
            'mode'            => 'edit',
            'supports'        => [
                'align' => false,
                'mode'  => true,
                'multiple' => true,
            ],
        ];

        // Use screenshot if available, otherwise use icon
        // ACF doesn't support image URLs directly in icon parameter
        // We'll use a dashicon as fallback and handle image via CSS/hook
        $args['icon'] = theme_get_block_icon($block['category'], $slug);

        // Store screenshot URL for later use in hook
        $screenshot_url = null;
        if (!empty($block['screenshot']) && file_exists($block['screenshot'])) {
            $template_dir = get_template_directory();
            $template_uri = get_template_directory_uri();

            // Normalize paths for cross-platform compatibility
            $screenshot_path = str_replace(
                [ $template_dir, '\\' ],
                [ '', '/' ],
                $block['screenshot']
            );

            // Ensure path starts with /
            $screenshot_path = '/' . ltrim($screenshot_path, '/');
            $screenshot_url = $template_uri . $screenshot_path;
        }

        // Add style handle if CSS exists
        if (!empty($block['css']) && file_exists($block['css'])) {
            $args['style'] = $handle;
        }

        // Add editor style if exists (minified preferred)
        if (!empty($block['editor_css']) && file_exists($block['editor_css'])) {
            $editor_css_url = get_template_directory_uri() .
                str_replace(get_template_directory(), '', $block['editor_css']);
            $args['enqueue_style'] = $editor_css_url;

            // Enqueue RTL editor style if exists and site is RTL
            if (!empty($block['editor_css_rtl']) && file_exists($block['editor_css_rtl'])) {
                $editor_css_rtl_url = get_template_directory_uri() .
                    str_replace(get_template_directory(), '', $block['editor_css_rtl']);
                $editor_css_rtl_path = $block['editor_css_rtl'];

                // Hook to enqueue RTL editor style for RTL sites
                add_action('enqueue_block_editor_assets', function() use ($slug, $editor_css_rtl_url, $editor_css_rtl_path) {
                    if (is_rtl()) {
                        wp_enqueue_style(
                            "block-{$slug}-editor-rtl",
                            $editor_css_rtl_url,
                            [],
                            filemtime($editor_css_rtl_path)
                        );
                    }
                }, 20);
            }
        }

        // Add script handle if JS exists
        if (file_exists($block['js'])) {
            $js_path = str_replace(get_template_directory(), '', $block['js']);
            $args['enqueue_script'] = get_template_directory_uri() . $js_path;
        }

        acf_register_block_type($args);

        // Use CSS to replace icon with screenshot image
        if ($screenshot_url) {
            add_action('admin_head', function() use ($slug, $screenshot_url) {
                static $styles_added = [];
                if (isset($styles_added[$slug])) {
                    return;
                }
                $styles_added[$slug] = true;
                ?>
                <style>
                    .editor-block-list-item-acf-<?php echo esc_attr($slug); ?> .block-editor-block-types-list__item-icon {
                        color: #1e1e1e;
                        padding: 4px;
                        height: 48px !important;
                        background-image: url('<?php echo esc_url($screenshot_url); ?>') !important;
                        background-size: contain !important;
                        background-repeat: no-repeat !important;
                        background-position: center !important;
                    }
                    .editor-block-list-item-acf-<?php echo esc_attr($slug); ?> .block-editor-block-icon .dashicon {
                        background-image: none !important;
                    }
                    .editor-block-list-item-acf-<?php echo esc_attr($slug); ?> .block-editor-block-icon .dashicon::before {
                        display: none !important;
                    }
                </style>
                <?php
            });
        }
    }
});
