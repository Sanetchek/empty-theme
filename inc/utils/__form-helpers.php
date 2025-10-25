<?php
/**
 * Form Elements Helper Functions
 *
 * This file contains helper functions for generating form elements
 * with consistent styling and functionality.
 */

/**
 * Generate form input field
 *
 * @param string $name Input name attribute
 * @param string $type Input type (text, email, password, etc.)
 * @param string $value Input value
 * @param array $args Additional arguments
 * @return string HTML for input field
 */
function get_form_input($name, $type = 'text', $value = '', $args = []) {
    $defaults = [
        'id' => $name,
        'class' => 'form-input',
        'placeholder' => '',
        'required' => false,
        'disabled' => false,
        'readonly' => false,
        'autocomplete' => 'on',
        'label' => '',
        'description' => '',
        'error' => '',
        'success' => '',
        'wrapper_class' => 'form-group',
        'label_class' => 'form-label',
        'input_class' => 'form-input'
    ];

    $args = wp_parse_args($args, $defaults);

    // Auto-detect autocomplete based on type and name
    if ($args['autocomplete'] === 'on') {
        if ($type === 'email') {
            $args['autocomplete'] = 'email';
        } elseif ($type === 'tel') {
            $args['autocomplete'] = 'tel';
        } elseif ($name === 'password' || strpos($name, 'password') !== false) {
            $args['autocomplete'] = 'current-password';
        } elseif ($name === 'name' || strpos($name, 'name') !== false) {
            $args['autocomplete'] = 'name';
        } elseif ($name === 'phone' || strpos($name, 'phone') !== false) {
            $args['autocomplete'] = 'tel';
        }
    }

    $html = '<div class="' . esc_attr($args['wrapper_class']) . '">';

    // Label
    if (!empty($args['label'])) {
        $label_class = $args['label_class'];
        if ($args['required']) {
            $label_class .= ' required';
        }
        $html .= '<label for="' . esc_attr($args['id']) . '" class="' . esc_attr($label_class) . '">' . esc_html($args['label']) . '</label>';
    }

    // Input
    $input_class = $args['input_class'];
    if (!empty($args['error'])) {
        $input_class .= ' error';
    }
    if (!empty($args['success'])) {
        $input_class .= ' success';
    }

    $error_id = $args['id'] . '_error';
    $desc_id = $args['id'] . '_description';
    $aria_describedby = [];

    if (!empty($args['description'])) {
        $aria_describedby[] = $desc_id;
    }
    if (!empty($args['error'])) {
        $aria_describedby[] = $error_id;
    }

    $html .= '<input type="' . esc_attr($type) . '"';
    $html .= ' name="' . esc_attr($name) . '"';
    $html .= ' id="' . esc_attr($args['id']) . '"';
    $html .= ' class="' . esc_attr($input_class) . '"';
    $html .= ' value="' . esc_attr($value) . '"';

    if (!empty($args['placeholder'])) {
        $html .= ' placeholder="' . esc_attr($args['placeholder']) . '"';
    }

    if ($args['required']) {
        $html .= ' required';
    }

    if ($args['disabled']) {
        $html .= ' disabled';
    }

    if ($args['readonly']) {
        $html .= ' readonly';
    }

    if (!empty($args['autocomplete'])) {
        $html .= ' autocomplete="' . esc_attr($args['autocomplete']) . '"';
    }

    if (!empty($aria_describedby)) {
        $html .= ' aria-describedby="' . esc_attr(implode(' ', $aria_describedby)) . '"';
    }

    $html .= ' />';

    // Description
    if (!empty($args['description'])) {
        $html .= '<div id="' . esc_attr($desc_id) . '" class="form-description">' . esc_html($args['description']) . '</div>';
    }

    // Error message
    if (!empty($args['error'])) {
        $html .= '<div id="' . esc_attr($error_id) . '" class="form-error" role="alert" aria-live="polite">' . esc_html($args['error']) . '</div>';
    }

    // Success message
    if (!empty($args['success'])) {
        $html .= '<div class="form-success" role="status" aria-live="polite">' . esc_html($args['success']) . '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Generate form textarea field
 *
 * @param string $name Textarea name attribute
 * @param string $value Textarea value
 * @param array $args Additional arguments
 * @return string HTML for textarea field
 */
function get_form_textarea($name, $value = '', $args = []) {
    $defaults = [
        'id' => $name,
        'class' => 'form-textarea',
        'placeholder' => '',
        'required' => false,
        'disabled' => false,
        'readonly' => false,
        'rows' => 4,
        'cols' => 50,
        'label' => '',
        'description' => '',
        'error' => '',
        'success' => '',
        'wrapper_class' => 'form-group',
        'label_class' => 'form-label',
        'textarea_class' => 'form-textarea'
    ];

    $args = wp_parse_args($args, $defaults);

    $html = '<div class="' . esc_attr($args['wrapper_class']) . '">';

    // Label
    if (!empty($args['label'])) {
        $label_class = $args['label_class'];
        if ($args['required']) {
            $label_class .= ' required';
        }
        $html .= '<label for="' . esc_attr($args['id']) . '" class="' . esc_attr($label_class) . '">' . esc_html($args['label']) . '</label>';
    }

    // Textarea
    $textarea_class = $args['textarea_class'];
    if (!empty($args['error'])) {
        $textarea_class .= ' error';
    }
    if (!empty($args['success'])) {
        $textarea_class .= ' success';
    }

    $error_id = $args['id'] . '_error';
    $desc_id = $args['id'] . '_description';
    $aria_describedby = [];

    if (!empty($args['description'])) {
        $aria_describedby[] = $desc_id;
    }
    if (!empty($args['error'])) {
        $aria_describedby[] = $error_id;
    }

    $html .= '<textarea';
    $html .= ' name="' . esc_attr($name) . '"';
    $html .= ' id="' . esc_attr($args['id']) . '"';
    $html .= ' class="' . esc_attr($textarea_class) . '"';
    $html .= ' rows="' . esc_attr($args['rows']) . '"';
    $html .= ' cols="' . esc_attr($args['cols']) . '"';

    if (!empty($args['placeholder'])) {
        $html .= ' placeholder="' . esc_attr($args['placeholder']) . '"';
    }

    if ($args['required']) {
        $html .= ' required';
    }

    if ($args['disabled']) {
        $html .= ' disabled';
    }

    if ($args['readonly']) {
        $html .= ' readonly';
    }

    if (!empty($aria_describedby)) {
        $html .= ' aria-describedby="' . esc_attr(implode(' ', $aria_describedby)) . '"';
    }

    $html .= '>' . esc_textarea($value) . '</textarea>';

    // Description
    if (!empty($args['description'])) {
        $html .= '<div id="' . esc_attr($desc_id) . '" class="form-description">' . esc_html($args['description']) . '</div>';
    }

    // Error message
    if (!empty($args['error'])) {
        $html .= '<div id="' . esc_attr($error_id) . '" class="form-error" role="alert" aria-live="polite">' . esc_html($args['error']) . '</div>';
    }

    // Success message
    if (!empty($args['success'])) {
        $html .= '<div class="form-success">' . esc_html($args['success']) . '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Generate form select field
 *
 * @param string $name Select name attribute
 * @param array $options Select options
 * @param string $selected Selected value
 * @param array $args Additional arguments
 * @return string HTML for select field
 */
function get_form_select($name, $options = [], $selected = '', $args = []) {
    $defaults = [
        'id' => $name,
        'class' => 'form-select',
        'required' => false,
        'disabled' => false,
        'label' => '',
        'description' => '',
        'error' => '',
        'success' => '',
        'wrapper_class' => 'form-group',
        'label_class' => 'form-label',
        'select_class' => 'form-select',
        'placeholder' => ''
    ];

    $args = wp_parse_args($args, $defaults);

    $html = '<div class="' . esc_attr($args['wrapper_class']) . '">';

    // Label
    if (!empty($args['label'])) {
        $label_class = $args['label_class'];
        if ($args['required']) {
            $label_class .= ' required';
        }
        $html .= '<label for="' . esc_attr($args['id']) . '" class="' . esc_attr($label_class) . '">' . esc_html($args['label']) . '</label>';
    }

    // Select
    $select_class = $args['select_class'];
    if (!empty($args['error'])) {
        $select_class .= ' error';
    }
    if (!empty($args['success'])) {
        $select_class .= ' success';
    }

    $html .= '<select';
    $html .= ' name="' . esc_attr($name) . '"';
    $html .= ' id="' . esc_attr($args['id']) . '"';
    $html .= ' class="' . esc_attr($select_class) . '"';

    if ($args['required']) {
        $html .= ' required';
    }

    if ($args['disabled']) {
        $html .= ' disabled';
    }

    $html .= '>';

    // Placeholder option
    if (!empty($args['placeholder'])) {
        $html .= '<option value="" disabled' . (empty($selected) ? ' selected' : '') . '>' . esc_html($args['placeholder']) . '</option>';
    }

    // Options
    foreach ($options as $value => $label) {
        $is_selected = ($value == $selected) ? ' selected' : '';
        $html .= '<option value="' . esc_attr($value) . '"' . $is_selected . '>' . esc_html($label) . '</option>';
    }

    $html .= '</select>';

    // Description
    if (!empty($args['description'])) {
        $html .= '<div class="form-description">' . esc_html($args['description']) . '</div>';
    }

    // Error message
    if (!empty($args['error'])) {
        $html .= '<div class="form-error">' . esc_html($args['error']) . '</div>';
    }

    // Success message
    if (!empty($args['success'])) {
        $html .= '<div class="form-success">' . esc_html($args['success']) . '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Generate form checkbox field
 *
 * @param string $name Checkbox name attribute
 * @param string $value Checkbox value
 * @param bool $checked Whether checkbox is checked
 * @param array $args Additional arguments
 * @return string HTML for checkbox field
 */
function get_form_checkbox($name, $value = '1', $checked = false, $args = []) {
    $defaults = [
        'id' => $name,
        'class' => 'form-checkbox',
        'required' => false,
        'disabled' => false,
        'label' => '',
        'description' => '',
        'error' => '',
        'success' => '',
        'wrapper_class' => 'form-group',
        'checkbox_class' => 'form-checkbox',
        'label_class' => 'form-checkbox-label'
    ];

    $args = wp_parse_args($args, $defaults);

    $html = '<div class="' . esc_attr($args['wrapper_class']) . '">';

    // Checkbox with label
    $html .= '<label class="' . esc_attr($args['label_class']) . '">';
    $html .= '<input type="checkbox"';
    $html .= ' name="' . esc_attr($name) . '"';
    $html .= ' id="' . esc_attr($args['id']) . '"';
    $html .= ' class="' . esc_attr($args['checkbox_class']) . '"';
    $html .= ' value="' . esc_attr($value) . '"';

    if ($checked) {
        $html .= ' checked';
    }

    if ($args['required']) {
        $html .= ' required';
    }

    if ($args['disabled']) {
        $html .= ' disabled';
    }

    $html .= ' />';

    if (!empty($args['label'])) {
        $html .= '<span>' . esc_html($args['label']) . '</span>';
    }

    $html .= '</label>';

    // Description
    if (!empty($args['description'])) {
        $html .= '<div class="form-description">' . esc_html($args['description']) . '</div>';
    }

    // Error message
    if (!empty($args['error'])) {
        $html .= '<div class="form-error">' . esc_html($args['error']) . '</div>';
    }

    // Success message
    if (!empty($args['success'])) {
        $html .= '<div class="form-success">' . esc_html($args['success']) . '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Generate form radio field
 *
 * @param string $name Radio name attribute
 * @param string $value Radio value
 * @param bool $checked Whether radio is checked
 * @param array $args Additional arguments
 * @return string HTML for radio field
 */
function get_form_radio($name, $value, $checked = false, $args = []) {
    $defaults = [
        'id' => $name . '_' . $value,
        'class' => 'form-radio',
        'required' => false,
        'disabled' => false,
        'label' => '',
        'description' => '',
        'error' => '',
        'success' => '',
        'wrapper_class' => 'form-group',
        'radio_class' => 'form-radio',
        'label_class' => 'form-radio-label'
    ];

    $args = wp_parse_args($args, $defaults);

    $html = '<div class="' . esc_attr($args['wrapper_class']) . '">';

    // Radio with label
    $html .= '<label class="' . esc_attr($args['label_class']) . '">';
    $html .= '<input type="radio"';
    $html .= ' name="' . esc_attr($name) . '"';
    $html .= ' id="' . esc_attr($args['id']) . '"';
    $html .= ' class="' . esc_attr($args['radio_class']) . '"';
    $html .= ' value="' . esc_attr($value) . '"';

    if ($checked) {
        $html .= ' checked';
    }

    if ($args['required']) {
        $html .= ' required';
    }

    if ($args['disabled']) {
        $html .= ' disabled';
    }

    $html .= ' />';

    if (!empty($args['label'])) {
        $html .= '<span>' . esc_html($args['label']) . '</span>';
    }

    $html .= '</label>';

    // Description
    if (!empty($args['description'])) {
        $html .= '<div class="form-description">' . esc_html($args['description']) . '</div>';
    }

    // Error message
    if (!empty($args['error'])) {
        $html .= '<div class="form-error">' . esc_html($args['error']) . '</div>';
    }

    // Success message
    if (!empty($args['success'])) {
        $html .= '<div class="form-success">' . esc_html($args['success']) . '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Display form input field
 */
function show_form_input($name, $type = 'text', $value = '', $args = []) {
    echo get_form_input($name, $type, $value, $args);
}

/**
 * Display form textarea field
 */
function show_form_textarea($name, $value = '', $args = []) {
    echo get_form_textarea($name, $value, $args);
}

/**
 * Display form select field
 */
function show_form_select($name, $options = [], $selected = '', $args = []) {
    echo get_form_select($name, $options, $selected, $args);
}

/**
 * Display form checkbox field
 */
function show_form_checkbox($name, $value = '1', $checked = false, $args = []) {
    echo get_form_checkbox($name, $value, $checked, $args);
}

/**
 * Display form radio field
 */
function show_form_radio($name, $value, $checked = false, $args = []) {
    echo get_form_radio($name, $value, $checked, $args);
}
