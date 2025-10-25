<?php
/**
 * Accessibility Functions
 *
 * @package emptytheme
 */

/**
 * Customize archive and search page titles for better accessibility
 */
add_filter('document_title_parts', 'emptytheme_customize_document_title', 10);
function emptytheme_customize_document_title($title) {
    if (is_category()) {
        /* translators: %s: Category name */
        $title['title'] = sprintf(__('Posts in category: %s', 'emptytheme'), single_cat_title('', false));
    } elseif (is_tag()) {
        /* translators: %s: Tag name */
        $title['title'] = sprintf(__('Posts tagged: %s', 'emptytheme'), single_tag_title('', false));
    } elseif (is_author()) {
        /* translators: %s: Author name */
        $title['title'] = sprintf(__('Posts by author: %s', 'emptytheme'), get_the_author());
    } elseif (is_date()) {
        if (is_year()) {
            /* translators: %s: Year */
            $title['title'] = sprintf(__('Posts from year: %s', 'emptytheme'), get_the_date('Y'));
        } elseif (is_month()) {
            /* translators: %s: Month and year */
            $title['title'] = sprintf(__('Posts from month: %s', 'emptytheme'), get_the_date('F Y'));
        } elseif (is_day()) {
            /* translators: %s: Date */
            $title['title'] = sprintf(__('Posts from date: %s', 'emptytheme'), get_the_date());
        }
    } elseif (is_search()) {
        /* translators: %s: Search query */
        $title['title'] = sprintf(__('Search Results for: %s', 'emptytheme'), get_search_query());
    }

    return $title;
}

/**
 * Add descriptive text for search results page
 */
add_action('archive_description', 'emptytheme_add_search_description');
function emptytheme_add_search_description() {
    if (is_search()) {
        global $wp_query;
        /* translators: %d: Number of search results */
        printf(
            esc_html__('Found %d results', 'emptytheme'),
            $wp_query->found_posts
        );
    }
}
