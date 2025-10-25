<?php
/**
 * Search Form Examples
 *
 * This file contains examples of how to use different search form variants
 * throughout the theme.
 */

// Example 1: Default search form (used in searchform.php)
// <form class="search-form" role="search">
//   <div class="search-form__container">
//     <input class="search-field" placeholder="Search..." />
//     <button class="search-submit">Search</button>
//   </div>
// </form>

// Example 2: Compact search form for headers/sidebars
// <form class="search-form search-form--compact" role="search">
//   <div class="search-form__container">
//     <input class="search-field" placeholder="Search..." />
//     <button class="search-submit">Search</button>
//   </div>
// </form>

// Example 3: Large search form for hero sections
// <form class="search-form search-form--large" role="search">
//   <div class="search-form__container">
//     <input class="search-field" placeholder="Search..." />
//     <button class="search-submit">Search</button>
//   </div>
// </form>

// Example 4: Dark theme search form
// <form class="search-form search-form--dark" role="search">
//   <div class="search-form__container">
//     <input class="search-field" placeholder="Search..." />
//     <button class="search-submit">Search</button>
//   </div>
// </form>

/**
 * Helper function to generate search form with specific variant
 */
function get_search_form_variant($variant = 'default', $placeholder = '') {
    $placeholder = $placeholder ?: __('Search by keyword...', 'emptytheme');

    $form = '<form action="' . esc_url(home_url('/')) . '" method="get" class="search-form';

    if ($variant !== 'default') {
        $form .= ' search-form--' . $variant;
    }

    $form .= '" role="search">';
    $form .= '<div class="search-form__container">';
    $form .= '<input type="text" name="s" class="search-field" placeholder="' . esc_attr($placeholder) . '" autocomplete="off" />';
    $form .= '<button type="submit" class="search-submit">';
    $form .= '<span class="search-submit__text">' . esc_html__('Search', 'emptytheme') . '</span>';
    $form .= '</button>';
    $form .= '</div>';
    $form .= '</form>';

    return $form;
}

/**
 * Display search form with specific variant
 */
function show_search_form_variant($variant = 'default', $placeholder = '') {
    echo get_search_form_variant($variant, $placeholder);
}
