<?php
/**
 * Breadcrumbs functionality for Theme
 *
 * @package tmlnews
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Theme_Breadcrumbs
 *
 * Generates breadcrumbs navigation for all WordPress page types
 */
class Theme_Breadcrumbs
{
    /**
     * SVG icon for home link
     *
     * @param bool $aria_hidden Whether to hide from screen readers (for decorative use)
     * @return string
     */
    private static function get_home_icon($aria_hidden = false)
    {
        $aria_attr = $aria_hidden ? ' aria-hidden="true"' : ' aria-label="' . esc_attr__('Home', 'tmlnews') . '"';
        $title_tag = $aria_hidden ? '' : '<title>' . esc_html__('Home', 'tmlnews') . '</title>';
        return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"' . $aria_attr . '>
            ' . $title_tag . '
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9353 3.90479L9.1651 0.787516C7.89509 -0.262505 6.10491 -0.262505 4.83492 0.787516L1.06468 3.90479C0.385413 4.46641 0 5.31794 0 6.20641V11.0676C0 12.6462 1.2139 14 2.8 14H4.2C4.9732 14 5.6 13.3732 5.6 12.6V10.3235C5.6 9.43621 6.26647 8.79109 7 8.79109C7.73353 8.79109 8.4 9.43621 8.4 10.3235V12.6C8.4 13.3732 9.02678 14 9.8 14H11.2C12.7861 14 14 12.6462 14 11.0676V6.20641C14 5.31794 13.6146 4.46641 12.9353 3.90479Z" fill="#012527"/>
        </svg>';
    }

    /**
     * SVG arrow separator icon (decorative, hidden from screen readers)
     *
     * @return string
     */
    private static function get_arrow_icon()
    {
        return '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M5.6892 4.2384L1.81796 0.316456C1.40147 -0.105485 0.72885 -0.105485 0.312364 0.316456C-0.104121 0.738397 -0.104121 1.41983 0.312364 1.84177L3.43184 5L0.312364 8.15823C-0.104121 8.58017 -0.104121 9.2616 0.312364 9.68355C0.72885 10.1055 1.40147 10.1055 1.81796 9.68355L5.6892 5.7616C6.1036 5.34177 6.1036 4.65823 5.6892 4.2384Z" fill="#012527"/>
        </svg>';
    }

    /**
     * Get breadcrumbs items based on current page context
     *
     * @return array Array of breadcrumb items with 'title', 'url', 'is_current' keys
     */
    private static function get_items()
    {
        $items = array();

        // Home page - show only home icon as current
        if (is_front_page()) {
            $items[] = array(
                'title' => '',
                'url' => home_url('/'),
                'is_current' => true,
                'is_home' => true,
            );
            return $items;
        }

        // Always add home
        $items[] = array(
            'title' => '',
            'url' => home_url('/'),
            'is_current' => false,
            'is_home' => true,
        );

        // WooCommerce pages (check before other checks)
        if (function_exists('is_woocommerce') && is_woocommerce()) {
            $items = array_merge($items, self::get_woocommerce_items());
            return $items;
        }

        // Taxonomy pages (check before archive, as is_archive() can be true for taxonomies)
        if (is_tax() || is_category() || is_tag()) {
            $items = array_merge($items, self::get_taxonomy_items());
            return $items;
        }

        // Regular pages
        if (is_page()) {
            $items = array_merge($items, self::get_page_items());
            return $items;
        }

        // Single post or custom post type
        if (is_singular()) {
            $items = array_merge($items, self::get_post_items());
            return $items;
        }

        // Archive pages
        if (is_archive()) {
            $items = array_merge($items, self::get_archive_items());
            return $items;
        }

        // Search results
        if (is_search()) {
            $items[] = array(
                'title' => sprintf(__('Search Results for: %s', 'tmlnews'), get_search_query()),
                'url' => '',
                'is_current' => true,
            );
            return $items;
        }

        // 404 page
        if (is_404()) {
            $items[] = array(
                'title' => __('Page Not Found', 'tmlnews'),
                'url' => '',
                'is_current' => true,
            );
            return $items;
        }

        return $items;
    }

    /**
     * Get breadcrumbs for WordPress pages (with hierarchy support)
     *
     * @return array
     */
    private static function get_page_items()
    {
        $items = array();
        global $post;

        if (!$post) {
            return $items;
        }

        // Get page hierarchy
        $ancestors = get_post_ancestors($post->ID);
        $ancestors = array_reverse($ancestors);

        // Add parent pages
        foreach ($ancestors as $ancestor_id) {
            $ancestor = get_post($ancestor_id);
            if ($ancestor) {
                $items[] = array(
                    'title' => get_the_title($ancestor),
                    'url' => get_permalink($ancestor),
                    'is_current' => false,
                );
            }
        }

        // Add current page
        $items[] = array(
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'is_current' => true,
        );

        return $items;
    }

    /**
     * Find page by title (case-insensitive, trimmed)
     *
     * @param string $title Page title to search for
     * @return WP_Post|null Page object or null if not found
     */
    private static function find_page_by_title($title)
    {
        // Try exact match first
        $page = get_page_by_title($title, OBJECT, 'page');
        if ($page) {
            return $page;
        }

        // Try case-insensitive search using WP_Query
        $query = new WP_Query(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'title' => $title,
        ));

        if ($query->have_posts()) {
            return $query->posts[0];
        }

        // Try manual search with case-insensitive comparison
        $pages = get_pages(array(
            'post_status' => 'publish',
        ));

        $title_normalized = trim(strtolower($title));
        foreach ($pages as $page) {
            if (trim(strtolower(get_the_title($page->ID))) === $title_normalized) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Find child page by title under a parent page (case-insensitive, trimmed)
     *
     * @param int $parent_id Parent page ID
     * @param string $title Child page title to search for
     * @return WP_Post|null Page object or null if not found
     */
    private static function find_child_page_by_title($parent_id, $title)
    {
        if (!$parent_id) {
            return null;
        }

        $children = get_children(array(
            'post_parent' => $parent_id,
            'post_type' => 'page',
            'post_status' => 'publish',
        ));

        if (empty($children)) {
            return null;
        }

        $title_normalized = trim(strtolower($title));
        foreach ($children as $child) {
            $child_title = trim(strtolower(get_the_title($child->ID)));
            if ($child_title === $title_normalized) {
                return $child;
            }
        }

        return null;
    }

    /**
     * Find page by template name
     *
     * @param string $template_name Template name (e.g., 'template-pages/events.php')
     * @return WP_Post|null Page object or null if not found
     */
    private static function find_page_by_template($template_name)
    {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $template_name,
            'post_status' => 'publish',
        ));

        if (!empty($pages)) {
            return $pages[0];
        }

        return null;
    }

    /**
     * Find page by slug
     *
     * @param string $slug Page slug to search for
     * @return WP_Post|null Page object or null if not found
     */
    private static function find_page_by_slug($slug)
    {
        $page = get_page_by_path($slug, OBJECT, 'page');
        if ($page && $page->post_status === 'publish') {
            return $page;
        }

        return null;
    }

    /**
     * Find child page by slug under a parent page
     *
     * @param int $parent_id Parent page ID
     * @param string $slug Child page slug to search for
     * @return WP_Post|null Page object or null if not found
     */
    private static function find_child_page_by_slug($parent_id, $slug)
    {
        if (!$parent_id) {
            return null;
        }

        $children = get_children(array(
            'post_parent' => $parent_id,
            'post_type' => 'page',
            'post_status' => 'publish',
        ));

        if (empty($children)) {
            return null;
        }

        $slug_normalized = trim(strtolower($slug));
        foreach ($children as $child) {
            $child_slug = trim(strtolower($child->post_name));
            if ($child_slug === $slug_normalized) {
                return $child;
            }
        }

        return null;
    }

    /**
     * Build breadcrumbs from rewrite slug
     * Parses rewrite slug (e.g., 'newsroom/news-impact-page' or 'where-we-work') and finds corresponding pages
     * Works for both simple slugs and nested paths
     *
     * @param string $post_type Post type name
     * @return array Array of breadcrumb items
     */
    private static function build_breadcrumbs_from_rewrite_slug($post_type)
    {
        $items = array();
        $post_type_object = get_post_type_object($post_type);

        if (!$post_type_object || !isset($post_type_object->rewrite['slug'])) {
            return $items;
        }

        $rewrite_slug = $post_type_object->rewrite['slug'];

        // Split slug into parts (works for both simple and nested slugs)
        $slug_parts = explode('/', $rewrite_slug);
        $slug_parts = array_filter($slug_parts); // Remove empty parts

        if (empty($slug_parts)) {
            return $items;
        }

        // Build path progressively to find pages
        $current_path = '';
        $last_found_page = null;

        foreach ($slug_parts as $index => $slug_part) {
            $current_path = $current_path ? $current_path . '/' . $slug_part : $slug_part;
            $page = null;

            // Try to find page by full path first
            $page = self::find_page_by_slug($current_path);

            // If not found and we have a previous page, try to find as child page by slug
            if (!$page && $last_found_page) {
                $page = self::find_child_page_by_slug($last_found_page->ID, $slug_part);
            }

            // If still not found, try to find by slug only (without path)
            if (!$page) {
                $page = self::find_page_by_slug($slug_part);
            }

            if ($page) {
                // If this is not the first page, verify it's a child of the previous page
                if ($last_found_page && $page->post_parent !== $last_found_page->ID) {
                    // Not a direct child, try to find as child of previous page by title
                    $child_page = self::find_child_page_by_title($last_found_page->ID, get_the_title($page->ID));
                    if ($child_page) {
                        $page = $child_page;
                    }
                }

                // Add ancestors if this is the first page in the chain
                if (!$last_found_page) {
                    $ancestors = get_post_ancestors($page->ID);
                    $ancestors = array_reverse($ancestors);
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_post($ancestor_id);
                        if ($ancestor && $ancestor->post_status === 'publish') {
                            $items[] = array(
                                'title' => get_the_title($ancestor->ID),
                                'url' => get_permalink($ancestor->ID),
                                'is_current' => false,
                            );
                        }
                    }
                }

                // Add the page itself
                $items[] = array(
                    'title' => get_the_title($page->ID),
                    'url' => get_permalink($page->ID),
                    'is_current' => false,
                );

                $last_found_page = $page;
            } else {
                // Page not found by slug, use post type label for the last part
                if ($index === count($slug_parts) - 1 && $post_type_object) {
                    $items[] = array(
                        'title' => $post_type_object->labels->name,
                        'url' => '',
                        'is_current' => false,
                    );
                }
            }
        }

        return $items;
    }

    /**
     * Get breadcrumbs for posts and custom post types
     *
     * @return array
     */
    private static function get_post_items()
    {
        $items = array();
        global $post;

        if (!$post) {
            return $items;
        }

        $post_type = get_post_type($post);

        // Universal handler: build breadcrumbs from rewrite slug
        // Works for all post types with custom rewrite slugs (both simple and nested)
        $post_type_object = get_post_type_object($post_type);
        $has_custom_rewrite = false;

        if ($post_type_object && isset($post_type_object->rewrite['slug'])) {
            $rewrite_slug = $post_type_object->rewrite['slug'];
            // Build breadcrumbs from rewrite slug (works for both simple and nested slugs)
            $rewrite_items = self::build_breadcrumbs_from_rewrite_slug($post_type);
            if (!empty($rewrite_items)) {
                $has_custom_rewrite = true;
                $items = array_merge($items, $rewrite_items);
            }
        }

        // Add archive link for custom post types (only if no custom rewrite was found)
        if (!$has_custom_rewrite && $post_type !== 'post') {
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object && $post_type_object->has_archive) {
                $archive_url = get_post_type_archive_link($post_type);
                if ($archive_url) {
                    $items[] = array(
                        'title' => $post_type_object->labels->name,
                        'url' => $archive_url,
                        'is_current' => false,
                    );
                }
            }
        }

        // Add taxonomy terms (categories, custom taxonomies)
        // Skip taxonomy terms for post types with custom rewrite slugs (using specific pages instead)
        // If we found pages via rewrite slug, don't add taxonomies
        if (!$has_custom_rewrite) {
            $taxonomies = get_object_taxonomies($post_type, 'objects');
            $primary_taxonomy = null;

            // Priority: hierarchical taxonomies first
            foreach ($taxonomies as $taxonomy) {
                if ($taxonomy->public && $taxonomy->hierarchical) {
                    $primary_taxonomy = $taxonomy;
                    break;
                }
            }

            // If no hierarchical taxonomy, get first public taxonomy
            if (!$primary_taxonomy) {
                foreach ($taxonomies as $taxonomy) {
                    if ($taxonomy->public) {
                        $primary_taxonomy = $taxonomy;
                        break;
                    }
                }
            }

            if ($primary_taxonomy) {
                $terms = get_the_terms($post->ID, $primary_taxonomy->name);
                if ($terms && !is_wp_error($terms)) {
                    $term = $terms[0]; // Get first term

                    // Add parent terms if hierarchical
                    if ($primary_taxonomy->hierarchical && $term->parent) {
                        $parent_terms = get_ancestors($term->term_id, $primary_taxonomy->name, 'taxonomy');
                        $parent_terms = array_reverse($parent_terms);
                        foreach ($parent_terms as $parent_id) {
                            $parent_term = get_term($parent_id, $primary_taxonomy->name);
                            if ($parent_term && !is_wp_error($parent_term)) {
                                $items[] = array(
                                    'title' => $parent_term->name,
                                    'url' => get_term_link($parent_term),
                                    'is_current' => false,
                                );
                            }
                        }
                    }

                    // Add current term
                    $items[] = array(
                        'title' => $term->name,
                        'url' => get_term_link($term),
                        'is_current' => false,
                    );
                }
            }
        }

        // Add current post
        $items[] = array(
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'is_current' => true,
        );

        return $items;
    }

    /**
     * Get breadcrumbs for archive pages
     *
     * @return array
     */
    private static function get_archive_items()
    {
        $items = array();

        if (is_post_type_archive()) {
            $post_type = get_query_var('post_type');
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object) {
                $items[] = array(
                    'title' => $post_type_object->labels->name,
                    'url' => get_post_type_archive_link($post_type),
                    'is_current' => true,
                );
            }
        } elseif (is_author()) {
            $author = get_queried_object();
            $items[] = array(
                'title' => sprintf(__('Author: %s', 'tmlnews'), $author->display_name),
                'url' => get_author_posts_url($author->ID),
                'is_current' => true,
            );
        } elseif (is_date()) {
            if (is_year()) {
                $items[] = array(
                    'title' => get_the_date('Y'),
                    'url' => '',
                    'is_current' => true,
                );
            } elseif (is_month()) {
                $items[] = array(
                    'title' => get_the_date('F Y'),
                    'url' => '',
                    'is_current' => true,
                );
            } elseif (is_day()) {
                $items[] = array(
                    'title' => get_the_date(),
                    'url' => '',
                    'is_current' => true,
                );
            }
        } elseif (is_home() && !is_front_page()) {
            $page_for_posts = get_option('page_for_posts');
            if ($page_for_posts) {
                $items[] = array(
                    'title' => get_the_title($page_for_posts),
                    'url' => get_permalink($page_for_posts),
                    'is_current' => true,
                );
            } else {
                $items[] = array(
                    'title' => __('Blog', 'tmlnews'),
                    'url' => '',
                    'is_current' => true,
                );
            }
        }

        return $items;
    }

    /**
     * Get breadcrumbs for taxonomy pages
     *
     * @return array
     */
    private static function get_taxonomy_items()
    {
        $items = array();
        $term = get_queried_object();

        if (!$term) {
            return $items;
        }

        $taxonomy = get_taxonomy($term->taxonomy);

        // Add taxonomy archive if it exists
        if ($taxonomy->object_type) {
            $post_type = $taxonomy->object_type[0];
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object && $post_type_object->has_archive) {
                $archive_url = get_post_type_archive_link($post_type);
                if ($archive_url) {
                    $items[] = array(
                        'title' => $post_type_object->labels->name,
                        'url' => $archive_url,
                        'is_current' => false,
                    );
                }
            }
        }

        // Add parent terms if hierarchical
        if (is_taxonomy_hierarchical($term->taxonomy) && $term->parent) {
            $ancestors = get_ancestors($term->term_id, $term->taxonomy, 'taxonomy');
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_term($ancestor_id, $term->taxonomy);
                if ($ancestor && !is_wp_error($ancestor)) {
                    $items[] = array(
                        'title' => $ancestor->name,
                        'url' => get_term_link($ancestor),
                        'is_current' => false,
                    );
                }
            }
        }

        // Add current term
        $items[] = array(
            'title' => $term->name,
            'url' => get_term_link($term),
            'is_current' => true,
        );

        return $items;
    }

    /**
     * Get breadcrumbs for WooCommerce pages
     *
     * @return array
     */
    private static function get_woocommerce_items()
    {
        $items = array();

        // Shop page
        if (function_exists('wc_get_page_id')) {
            $shop_page_id = wc_get_page_id('shop');
            if ($shop_page_id && !is_shop()) {
                $items[] = array(
                    'title' => get_the_title($shop_page_id),
                    'url' => get_permalink($shop_page_id),
                    'is_current' => false,
                );
            }
        }

        // Product category or tag
        if (is_product_category() || is_product_tag()) {
            $term = get_queried_object();
            if ($term) {
                // Add parent categories
                if (is_product_category() && $term->parent) {
                    $ancestors = get_ancestors($term->term_id, 'product_cat', 'taxonomy');
                    $ancestors = array_reverse($ancestors);
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, 'product_cat');
                        if ($ancestor && !is_wp_error($ancestor)) {
                            $items[] = array(
                                'title' => $ancestor->name,
                                'url' => get_term_link($ancestor),
                                'is_current' => false,
                            );
                        }
                    }
                }

                $items[] = array(
                    'title' => $term->name,
                    'url' => get_term_link($term),
                    'is_current' => true,
                );
            }
        } elseif (is_product()) {
            // Single product
            global $post;
            $product_cats = wp_get_post_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
            if ($product_cats && !is_wp_error($product_cats)) {
                $product_cat = $product_cats[0];
                // Add parent categories
                if ($product_cat->parent) {
                    $ancestors = get_ancestors($product_cat->term_id, 'product_cat', 'taxonomy');
                    $ancestors = array_reverse($ancestors);
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, 'product_cat');
                        if ($ancestor && !is_wp_error($ancestor)) {
                            $items[] = array(
                                'title' => $ancestor->name,
                                'url' => get_term_link($ancestor),
                                'is_current' => false,
                            );
                        }
                    }
                }
                $items[] = array(
                    'title' => $product_cat->name,
                    'url' => get_term_link($product_cat),
                    'is_current' => false,
                );
            }

            $items[] = array(
                'title' => get_the_title($post),
                'url' => get_permalink($post),
                'is_current' => true,
            );
        } elseif (is_shop()) {
            $items[] = array(
                'title' => __('Shop', 'woocommerce'),
                'url' => '',
                'is_current' => true,
            );
        }

        return $items;
    }

    /**
     * Render breadcrumbs HTML
     *
     * @param array $atts Shortcode attributes
     * @return string HTML output
     */
    public static function render($atts = array())
    {
        $items = self::get_items();

        if (empty($items)) {
            return '';
        }

        ob_start();
        ?>
        <nav class="breadcrumbs-block" aria-label="<?php esc_attr_e('Breadcrumb', 'tmlnews'); ?>">
            <ol class="breadcrumbs-block__list" itemscope itemtype="https://schema.org/BreadcrumbList">
                <?php foreach ($items as $index => $item): ?>
                    <?php
                    $is_last = ($index === count($items) - 1);
                    $is_first = ($index === 0);
                    $is_home = isset($item['is_home']) && $item['is_home'];
                    $position = $index + 1;
                    ?>
                    <li class="breadcrumbs-block__item <?php echo $is_first ? 'breadcrumbs-block__item--first' : ''; ?> <?php echo $item['is_current'] ? 'breadcrumbs-block__item--current' : ''; ?>"
                        itemprop="itemListElement"
                        itemscope
                        itemtype="https://schema.org/ListItem"
                        <?php echo $item['is_current'] ? 'aria-current="page"' : ''; ?>>
                        <?php if ($item['is_current'] && !$is_home): ?>
                            <span class="breadcrumbs-block__current" itemprop="name"><?php echo esc_html($item['title']); ?></span>
                            <?php if (!empty($item['url'])): ?>
                                <meta itemprop="item" content="<?php echo esc_url($item['url']); ?>" />
                            <?php endif; ?>
                            <meta itemprop="position" content="<?php echo esc_attr($position); ?>" />
                        <?php elseif ($item['is_current'] && $is_home): ?>
                            <a href="<?php echo esc_url($item['url']); ?>"
                                class="breadcrumbs-block__link"
                                itemprop="item"
                                aria-label="<?php esc_attr_e('Home', 'tmlnews'); ?>">
                                <span itemprop="name" class="screen-reader-text"><?php esc_html_e('Home', 'tmlnews'); ?></span>
                                <?php echo self::get_home_icon(true); ?>
                            </a>
                            <meta itemprop="position" content="<?php echo esc_attr($position); ?>" />
                        <?php else: ?>
                            <a href="<?php echo esc_url($item['url']); ?>"
                                class="breadcrumbs-block__link"
                                itemprop="item">
                                <?php if ($is_home): ?>
                                    <span itemprop="name" class="screen-reader-text"><?php esc_html_e('Home', 'tmlnews'); ?></span>
                                    <?php echo self::get_home_icon(true); ?>
                                <?php else: ?>
                                    <span itemprop="name"><?php echo esc_html($item['title']); ?></span>
                                    <?php if (!$is_last): ?>
                                            <span class="breadcrumbs-block__separator" aria-hidden="true">
                                                <?php echo self::get_arrow_icon(); ?>
                                            </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                            <meta itemprop="position" content="<?php echo esc_attr($position); ?>" />
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
        <?php
        return ob_get_clean();
    }
}
