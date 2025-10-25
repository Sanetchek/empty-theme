<?php
/**
 * Meta boxes
 */

// Add meta boxes for Testimonials
add_action('add_meta_boxes', 'emptytheme_add_testimonials_meta_box');
function emptytheme_add_testimonials_meta_box() {
    add_meta_box(
        'emptytheme_testimonials_meta',
        'Testimonials Details',
        'emptytheme_testimonials_meta_box_callback',
        'testimonials',
        'normal',
        'high'
    );
}

function emptytheme_testimonials_meta_box_callback($post) {
    wp_nonce_field('emptytheme_testimonials_meta_box', 'emptytheme_testimonials_meta_box_nonce');

    $star_rating = get_post_meta($post->ID, '_emptytheme_star_rating', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="emptytheme_star_rating">Star Rating</label></th>';
    echo '<td>';
    echo '<select id="emptytheme_star_rating" name="emptytheme_star_rating">';
    for ($i = 1; $i <= 5; $i++) {
        $selected = ($star_rating == $i) ? 'selected' : '';
        echo '<option value="' . $i . '" ' . $selected . '>' . $i . ' Star' . ($i > 1 ? 's' : '') . '</option>';
    }
    echo '</select>';
    echo '<div id="star-display" style="margin-top: 10px; font-size: 20px; color: #ffd700;"></div>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';

    // Add JavaScript for star rating display
    ?>
    <script>
    jQuery(document).ready(function($) {
        function updateStarDisplay() {
            var rating = $('#emptytheme_star_rating').val();
            var stars = '';
            for (var i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '★';
                } else {
                    stars += '☆';
                }
            }
            $('#star-display').text(stars);
        }

        $('#emptytheme_star_rating').on('change', updateStarDisplay);
        updateStarDisplay();
    });
    </script>
    <?php
}

// Save Testimonials meta box
add_action('save_post', 'emptytheme_save_testimonials_meta_box');
function emptytheme_save_testimonials_meta_box($post_id) {
    if (!isset($_POST['emptytheme_testimonials_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['emptytheme_testimonials_meta_box_nonce'], 'emptytheme_testimonials_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'testimonials' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (isset($_POST['emptytheme_star_rating'])) {
        $star_rating = intval($_POST['emptytheme_star_rating']);
        update_post_meta($post_id, '_emptytheme_star_rating', $star_rating);
    }
}