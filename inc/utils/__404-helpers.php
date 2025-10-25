<?php
/**
 * 404 Page Content Helpers
 *
 * This file contains helper functions for checking content availability
 * on 404 pages and other content-related utilities.
 */

/**
 * Check if site has any published posts
 *
 * @return bool True if there are published posts
 */
function emptytheme_has_published_posts() {
    $post_count = wp_count_posts();
    return $post_count->publish > 0;
}

/**
 * Check if site has any published pages
 *
 * @return bool True if there are published pages
 */
function emptytheme_has_published_pages() {
    $page_count = wp_count_posts('page');
    return $page_count->publish > 0;
}

/**
 * Check if site has any categories
 *
 * @return bool True if there are categories
 */
function emptytheme_has_categories() {
    $category_count = wp_count_terms('category');
    return $category_count > 0;
}

/**
 * Check if site has any tags
 *
 * @return bool True if there are tags
 */
function emptytheme_has_tags() {
    $tag_count = wp_count_terms('post_tag');
    return $tag_count > 0;
}

/**
 * Check if site has any archives (published posts)
 *
 * @return bool True if there are archives available
 */
function emptytheme_has_archives() {
    return emptytheme_has_published_posts();
}

/**
 * Get recent posts for 404 page
 *
 * @param int $number Number of posts to retrieve
 * @return array Array of recent posts
 */
function emptytheme_get_recent_posts_for_404($number = 5) {
    return wp_get_recent_posts(array(
        'numberposts' => $number,
        'post_status' => 'publish',
        'post_type' => 'post'
    ));
}

/**
 * Get important pages for 404 page
 *
 * @param int $number Number of pages to retrieve
 * @return array Array of page objects
 */
function emptytheme_get_important_pages_for_404($number = 5) {
    return get_pages(array(
        'number' => $number,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC',
        'post_status' => 'publish',
        'meta_key' => '_wp_page_template',
        'meta_value' => 'default'
    ));
}

/**
 * Get popular categories for 404 page
 *
 * @param int $number Number of categories to retrieve
 * @return array Array of category objects
 */
function emptytheme_get_popular_categories_for_404($number = 5) {
    return get_categories(array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => $number,
        'hide_empty' => true
    ));
}

/**
 * Get popular tags for 404 page
 *
 * @param int $number Number of tags to retrieve
 * @return array Array of tag objects
 */
function emptytheme_get_popular_tags_for_404($number = 6) {
    return get_tags(array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => $number,
        'hide_empty' => true
    ));
}

/**
 * Get monthly archives for 404 page
 *
 * @param int $limit Number of archives to retrieve
 * @return string HTML of archives or empty string
 */
function emptytheme_get_monthly_archives_for_404($limit = 5) {
    return wp_get_archives(array(
        'type' => 'monthly',
        'format' => 'custom',
        'echo' => false,
        'limit' => $limit
    ));
}

/**
 * Check if 404 page should show helpful links section
 *
 * @return bool True if any helpful content is available
 */
function emptytheme_should_show_404_helpful_links() {
    return emptytheme_has_published_posts() || emptytheme_has_published_pages() || emptytheme_has_categories() || emptytheme_has_archives();
}

/**
 * Check if 404 page should show search suggestions
 *
 * @return bool True if tags are available
 */
function emptytheme_should_show_404_search_suggestions() {
    return emptytheme_has_tags();
}

/**
 * Get alternative content suggestions for 404 page
 *
 * @return array Array of alternative content suggestions
 */
function emptytheme_get_404_alternative_content() {
    $alternatives = array();

    // Check for pages
    $pages = get_pages(array(
        'number' => 5,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ));

    if ($pages) {
        $alternatives['pages'] = $pages;
    }

    // Check for custom post types
    $post_types = get_post_types(array(
        'public' => true,
        '_builtin' => false
    ), 'objects');

    foreach ($post_types as $post_type) {
        $posts = get_posts(array(
            'post_type' => $post_type->name,
            'numberposts' => 3,
            'post_status' => 'publish'
        ));

        if ($posts) {
            $alternatives['custom_posts'][$post_type->name] = array(
                'label' => $post_type->labels->name,
                'posts' => $posts
            );
        }
    }

    return $alternatives;
}

/**
 * Display recent posts list for 404 page
 *
 * @param int $number Number of posts to show
 */
function emptytheme_show_404_recent_posts($number = 5) {
    $recent_posts = emptytheme_get_recent_posts_for_404($number);

    if (!$recent_posts) {
        return;
    }

    echo '<ul class="error-404__recent-posts">';
    foreach ($recent_posts as $post) {
        echo '<li class="post-item">';
        echo '<a href="' . get_permalink($post['ID']) . '" class="post-link">';
        echo esc_html($post['post_title']);
        echo '</a>';
        echo '<div class="post-meta">';
        echo '<span class="post-date">' . get_the_date('M j, Y', $post['ID']) . ' </span>';
        // Add excerpt if available
        $excerpt = get_the_excerpt($post['ID']);
        if ($excerpt) {
            echo '<span class="post-excerpt">' . wp_trim_words($excerpt, 10) . '</span>';
        }
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}

/**
 * Display important pages list for 404 page
 *
 * @param int $number Number of pages to show
 */
function emptytheme_show_404_important_pages($number = 5) {
    $pages = emptytheme_get_important_pages_for_404($number);

    if (!$pages) {
        return;
    }

    echo '<ul class="error-404__pages">';
    foreach ($pages as $page) {
        echo '<li class="page-item">';
        echo '<a href="' . get_permalink($page->ID) . '" class="page-link">';
        echo esc_html($page->post_title);
        echo '</a>';
        // Add page excerpt if available
        if ($page->post_excerpt) {
            echo '<div class="page-excerpt">' . wp_trim_words($page->post_excerpt, 8) . '</div>';
        }
        echo '</li>';
    }
    echo '</ul>';
}

/**
 * Display popular categories list for 404 page
 *
 * @param int $number Number of categories to show
 */
function emptytheme_show_404_popular_categories($number = 5) {
    $categories = emptytheme_get_popular_categories_for_404($number);

    if (!$categories) {
        return;
    }

    echo '<ul class="error-404__categories">';
    foreach ($categories as $category) {
        echo '<li>';
        echo '<a href="' . get_category_link($category->term_id) . '">';
        echo esc_html($category->name);
        echo '</a>';
        echo '<span class="category-count">(' . $category->count . ')</span>';
        echo '</li>';
    }
    echo '</ul>';
}

/**
 * Display popular tags for 404 page
 *
 * @param int $number Number of tags to show
 */
function emptytheme_show_404_popular_tags($number = 6) {
    $tags = emptytheme_get_popular_tags_for_404($number);

    if (!$tags) {
        return;
    }

    echo '<div class="suggestion-tags">';
    foreach ($tags as $tag) {
        echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag">';
        echo esc_html($tag->name);
        echo '</a>';
    }
    echo '</div>';
}

/**
 * Display monthly archives for 404 page
 *
 * @param int $limit Number of archives to show
 */
function emptytheme_show_404_monthly_archives($limit = 5) {
    $archives = emptytheme_get_monthly_archives_for_404($limit);

    if (!$archives) {
        echo '<p class="no-archives">' . esc_html__('No archives available yet.', 'emptytheme') . '</p>';
        return;
    }

    echo '<div class="error-404__archives">';
    echo '<ul class="archives-list">';

    // Parse the archives HTML and make it more beautiful
    $archives_array = explode("\n", trim($archives));
    foreach ($archives_array as $archive_line) {
        if (trim($archive_line)) {
            // Extract date and count from the archive line
            preg_match('/<a[^>]*href="([^"]*)"[^>]*>([^<]*)<\/a>\s*\((\d+)\)/', $archive_line, $matches);
            if (count($matches) >= 4) {
                $url = $matches[1];
                $date = $matches[2];
                $count = $matches[3];

                echo '<li class="archive-item">';
                echo '<a href="' . esc_url($url) . '" class="archive-link">';
                echo '<span class="archive-date">' . esc_html($date) . '</span>';
                echo '<span class="archive-count">' . $count . ' posts</span>';
                echo '</a>';
                echo '</li>';
            } else {
                // Fallback for simple links
                echo '<li class="archive-item">';
                echo $archive_line;
                echo '</li>';
            }
        }
    }

    echo '</ul>';
    echo '</div>';
}
