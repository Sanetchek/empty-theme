<?php
/**
 * Custom Post Types Admin Columns
 *
 * Adds custom columns to admin lists for custom post types
 */

// Simple approach - add columns directly
add_filter('manage_testimonials_posts_columns', 'emptytheme_add_testimonials_columns');

// Alternative approach using admin_init
add_action('admin_init', function() {
    add_filter('manage_testimonials_posts_columns', 'emptytheme_add_testimonials_columns');
});

function emptytheme_add_testimonials_columns($columns) {
    // Check if testimonials post type exists
    if (!post_type_exists('testimonials')) {
        return $columns;
    }

    // Check if current user can read testimonials
    if (!current_user_can('edit_posts')) {
        return $columns;
    }

    // Create new columns array with custom order
    $new_columns = array();

    foreach ($columns as $key => $value) {
        // Skip date column - we'll add it at the end
        if ($key === 'date') {
            continue;
        }

        $new_columns[$key] = $value;

        // Insert review after title
        if ($key === 'title') {
            $new_columns['testimonial_preview'] = __('Review', 'emptytheme');
        }
    }

    // Add custom columns in the correct order
    $new_columns['featured_image'] = __('Image', 'emptytheme');
    $new_columns['star_rating'] = __('Rating', 'emptytheme');
    $new_columns['views'] = __('Views', 'emptytheme');

    // Add date column at the end
    $new_columns['date'] = __('Date', 'emptytheme');

    return $new_columns;
}

// Display custom columns content for testimonials
add_action('manage_testimonials_posts_custom_column', 'emptytheme_display_testimonials_columns', 10, 2);

function emptytheme_display_testimonials_columns($column, $post_id) {
    switch ($column) {
        case 'featured_image':
            $thumbnail_id = get_post_thumbnail_id($post_id);
            if ($thumbnail_id) {
                $thumbnail = wp_get_attachment_image($thumbnail_id, array(50, 50), false, array(
                    'style' => 'width: 50px; height: 50px; object-fit: cover; border-radius: 4px;'
                ));
                echo $thumbnail;
            } else {
                echo '<div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Image</div>';
            }
            break;

        case 'testimonial_preview':
            $message = get_post_meta($post_id, '_emptytheme_message', true);
            if ($message) {
                // Strip HTML tags and limit to 50 characters
                $preview = wp_strip_all_tags($message);
                $preview = wp_trim_words($preview, 8, '...');
                echo '<div style="max-width: 200px; font-size: 12px; color: #666; line-height: 1.4;">' . esc_html($preview) . '</div>';
            } else {
                echo '<span style="color: #999;">No Review</span>';
            }
            break;

        case 'star_rating':
            $rating = get_post_meta($post_id, '_emptytheme_star_rating', true);
            if ($rating) {
                echo emptytheme_display_star_rating($rating);
            } else {
                echo '<span style="color: #999;">No Rating</span>';
            }
            break;

        case 'views':
            // Check if current user can read this post
            $post = get_post($post_id);
            if (!$post || !current_user_can('read_post', $post_id)) {
                echo '—';
                break;
            }

            $views = get_post_meta($post_id, 'views', true);
            echo $views ? $views : '0';
            break;
    }
}

// Make star rating column sortable
add_filter('manage_edit-testimonials_sortable_columns', 'emptytheme_make_testimonials_columns_sortable');

function emptytheme_make_testimonials_columns_sortable($columns) {
    $columns['star_rating'] = 'star_rating';
    return $columns;
}

// Handle sorting by star rating
add_action('pre_get_posts', 'emptytheme_handle_testimonials_sorting');

function emptytheme_handle_testimonials_sorting($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ($orderby === 'star_rating') {
        $query->set('meta_key', '_emptytheme_star_rating');
        $query->set('orderby', 'meta_value_num');
    }
}

// Helper function to display star rating
function emptytheme_display_star_rating($rating) {
    $rating = (int)$rating;
    $stars = '';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '<span style="color: #ffc107;">★</span>';
        } else {
            $stars .= '<span style="color: #ddd;">★</span>';
        }
    }

    return '<div style="font-size: 16px; line-height: 1;">' . $stars . ' <span style="font-size: 12px; color: #666; margin-left: 5px;">(' . $rating . '/5)</span></div>';
}

// Add CSS styling for custom columns
add_action('admin_head', 'emptytheme_custom_columns_css');

function emptytheme_custom_columns_css() {
    echo '<style>
        .column-featured_image {
            width: 80px;
            text-align: center;
        }
        .column-testimonial_preview {
            width: 200px;
        }
        .column-content_preview {
            width: 250px;
        }
        .column-star_rating {
            width: 120px;
            text-align: center;
        }
        .column-views {
            width: 80px;
            text-align: center;
        }
        .column-featured_image img {
            border-radius: 4px;
        }
    </style>';
}

// Add custom columns to how_it_works (if needed)
add_filter('manage_how_it_works_posts_columns', 'emptytheme_add_how_it_works_columns');

function emptytheme_add_how_it_works_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key === 'title') {
            $new_columns['content_preview'] = __('Content Preview', 'emptytheme');
            $new_columns['featured_image'] = __('Image', 'emptytheme');
        }
    }

    return $new_columns;
}

add_action('manage_how_it_works_posts_custom_column', 'emptytheme_display_how_it_works_columns', 10, 2);

function emptytheme_display_how_it_works_columns($column, $post_id) {
    switch ($column) {
        case 'content_preview':
            $post = get_post($post_id);
            if ($post && $post->post_content) {
                // Strip HTML tags and limit to 15 words
                $preview = wp_strip_all_tags($post->post_content);
                $preview = wp_trim_words($preview, 15, '...');
                echo '<div style="max-width: 250px; font-size: 12px; color: #666; line-height: 1.4;">' . esc_html($preview) . '</div>';
            } else {
                echo '<span style="color: #999;">No Content</span>';
            }
            break;

        case 'featured_image':
            $thumbnail_id = get_post_thumbnail_id($post_id);
            if ($thumbnail_id) {
                $thumbnail = wp_get_attachment_image($thumbnail_id, array(50, 50), false, array(
                    'style' => 'width: 50px; height: 50px; object-fit: cover; border-radius: 4px;'
                ));
                echo $thumbnail;
            } else {
                echo '<div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Image</div>';
            }
            break;
    }
}

// Add custom columns to FAQ (if needed)
add_filter('manage_faq_posts_columns', 'emptytheme_add_faq_columns');

function emptytheme_add_faq_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key === 'title') {
            $new_columns['answer_preview'] = __('Answer Preview', 'emptytheme');
        }
    }

    return $new_columns;
}

add_action('manage_faq_posts_custom_column', 'emptytheme_display_faq_columns', 10, 2);

function emptytheme_display_faq_columns($column, $post_id) {
    if ($column === 'answer_preview') {
        $answer = get_post_meta($post_id, '_emptytheme_answer', true);
        if ($answer) {
            $preview = wp_strip_all_tags($answer);
            $preview = wp_trim_words($preview, 15, '...');
            echo '<div style="max-width: 200px; font-size: 12px; color: #666;">' . esc_html($preview) . '</div>';
        } else {
            echo '<span style="color: #999;">No Answer</span>';
        }
    }
}

// Add bulk actions for testimonials
add_filter('bulk_actions-edit-testimonials', 'emptytheme_add_testimonials_bulk_actions');

function emptytheme_add_testimonials_bulk_actions($actions) {
    $actions['set_rating_5'] = __('Set Rating to 5 Stars', 'emptytheme');
    $actions['set_rating_4'] = __('Set Rating to 4 Stars', 'emptytheme');
    $actions['set_rating_3'] = __('Set Rating to 3 Stars', 'emptytheme');
    return $actions;
}

// Handle bulk actions for testimonials
add_filter('handle_bulk_actions-edit-testimonials', 'emptytheme_handle_testimonials_bulk_actions', 10, 3);

function emptytheme_handle_testimonials_bulk_actions($redirect_to, $doaction, $post_ids) {
    if (!in_array($doaction, array('set_rating_5', 'set_rating_4', 'set_rating_3'))) {
        return $redirect_to;
    }

    $rating = (int)str_replace('set_rating_', '', $doaction);

    foreach ($post_ids as $post_id) {
        update_post_meta($post_id, '_emptytheme_star_rating', $rating);
    }

    $redirect_to = add_query_arg('bulk_set_rating', count($post_ids), $redirect_to);
    return $redirect_to;
}

// Show bulk action notice
add_action('admin_notices', 'emptytheme_testimonials_bulk_action_notice');

function emptytheme_testimonials_bulk_action_notice() {
    if (!empty($_REQUEST['bulk_set_rating'])) {
        $count = intval($_REQUEST['bulk_set_rating']);
        printf(
            '<div id="message" class="updated notice is-dismissible"><p>' .
            /* translators: %s: Number of testimonials updated */
            _n('Rating updated for %s testimonial.', 'Rating updated for %s testimonials.', $count, 'emptytheme') .
            '</p></div>',
            $count
        );
    }
}
