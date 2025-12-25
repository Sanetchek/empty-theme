<?php

/**
 * Remove various WordPress meta elements from the page header.
 *
 * This removes the following items:
 * - RSD link
 * - WordPress version generator
 * - Feeds (RSS, Atom, etc.)
 * - Index link (rel="index")
 * - Windows Live Writer manifest link
 * - Feed links (rel="alternate")
 * - Start post link (rel="start")
 * - Parent post link (rel="up")
 * - Shortlink (rel="shortlink")
 * - Adjacent post links (rel="next" and rel="prev")
 * - Emoji detection script
 * - Emoji styles
 */
function remove_meta() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10);
    remove_action('wp_head', 'parent_post_rel_link', 10);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Disable Rest API oEmbed routes and headers
    // remove_action('rest_api_init', 'wp_oembed_add_discovery_links');
    // remove_action('rest_api_init', 'wp_oembed_register_route');
    // remove_action('wp_head', 'rest_output_link_wp_head', 10);
    // remove_action('template_redirect', 'rest_output_link_header', 11, 0);

    add_filter('xmlrpc_enabled', '__return_false');
}
add_action( 'after_setup_theme', 'remove_meta' );

/**
 * Deregisters the wp-embed script, which is responsible for adding the <script ... > tag
 * to oembeds. This is a workaround for the "Loading failed" error that appears in the
 * console when visiting a page with an oembed, and the oembed content is not visible.
 *
 * @since 1.0.0
 */
function disable_wp_embed() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'disable_wp_embed');

/**
 * Removes the query string parameter "ver" from script and style sources.
 *
 * @param string $src The source URL of the script or style.
 * @return string The modified source URL.
 */
function emptytheme_remove_query_strings($src) {
    if (strpos($src, '?ver=') !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'emptytheme_remove_query_strings', 15, 1);
add_filter('style_loader_src', 'emptytheme_remove_query_strings', 15, 1);