<?php

/**
 * Validates a phone number against country-specific criteria.
 *
 * This function checks if a given phone number is valid based on the country code.
 * It validates against country-specific patterns and length requirements, and
 * provides error messages if validation fails. If the phone number is valid, it
 * returns a success message along with the validated number data.
 *
 * @param string $country_code The country dialing code.
 * @param string $phone The phone number to validate.
 *
 * @return array An associative array with keys:
 *               - 'status': The status of the validation ('success' or 'error').
 *               - 'message': A message detailing the result of the validation.
 *               - 'data' (optional): An array containing 'country_code' and 'phone'
 *                 if the validation is successful.
 */

function phone_number_validation($country_code, $phone) {
    $messages = [
        'empty_code' => __('Please enter the phone number.', 'emptytheme'),
        'empty_phone' => __('Please enter the phone number.', 'emptytheme'),
        'invalid_format' => __('The phone number must contain %s of numbers for the country selected.', 'emptytheme'),
        'invalid_length' => __('The phone number should be from %S to %s of numbers.', 'emptytheme'),
        'pattern_error' => __('Internal Failed Pattern check for this country.', 'emptytheme'),
        'pattern_example' => __('The butt of the correct number: %s.', 'emptytheme'),
        'no_country_list_function' => __('Country list failed. Check out the function get_all_countries().', 'emptytheme'),
        'no_example_phone_number_function' => __('Failed to generate an example phone number. Check out the function generate_example_phone_number().', 'emptytheme'),
    ];

    // Empty country code
    if (empty($country_code) || !is_string($country_code)) {
        return [
            'status' => 'error',
            'message' => $messages['empty_code'],
        ];
    }

    // Empty phone
    if (empty($phone) || !is_string($phone)) {
        return [
            'status' => 'error',
            'message' => $messages['empty_phone'],
        ];
    }

    // Trim the inputs to remove any leading or trailing whitespace
    $country_code = trim($country_code);
    $phone = trim($phone);

    // Delete everything except the numbers
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Obtaining patterns of countries
    if (!function_exists('get_all_countries')) {
        return [
            'status' => 'error',
            'message' => $messages['no_country_list_function'],
        ];
    }

    $countries = get_all_countries();
    $patterns = array_column($countries, null, 'dial_code');
    $countries_length = array_column($countries, 'length');
    $min_length = min($countries_length);
    $max_length = max($countries_length);

    // Check if there is data on the selected code of the country
    if (!isset($patterns[$country_code]) || !is_array($patterns[$country_code])) {
        // Checking the range (common for all countries)
        if (strlen($phone) < 5 || strlen($phone) > 15) {
            $error_message = sprintf($messages['invalid_length'], 5, 15);
            return [
                'status' => 'error',
                'message' => $error_message,
            ];
        }

        return [
            'status' => 'success',
            'message' => __('The phone number is valid.', 'emptytheme'),
            'data' => [
                'country_code' => $country_code,
                'phone' => $phone,
            ],
        ];
    }

    $country_data = $patterns[$country_code];

    // Check the structure of the country: pattern, length
    if (
        !isset($country_data['pattern']) ||
        empty($country_data['pattern']) ||
        !is_string($country_data['pattern']) ||
        @preg_match($country_data['pattern'], '') === false
    ) {
        return [
            'status' => 'error',
            'message' => $messages['pattern_error'],
        ];
    }

    // Checking the range (common for all countries)
    if (strlen($phone) < $min_length || strlen($phone) > $max_length) {
        $error_message = sprintf($messages['invalid_length'], $min_length, $max_length);
        return [
            'status' => 'error',
            'message' => $error_message,
        ];
    }

    // Country-specific length
    if (strlen($phone) != $country_data['length']) {
        $error_message = sprintf($messages['invalid_format'], $country_data['length']);
        return [
            'status' => 'error',
            'message' => $error_message,
        ];
    }

    // Country-specific pattern
    if (!empty($country_data['pattern']) && !preg_match($country_data['pattern'], $phone)) {
        if (!function_exists('generate_example_phone_number')) {
            return [
                'status' => 'error',
                'message' => $messages['no_example_phone_number_function'],
            ];
        }

        $example = generate_example_phone_number($country_data[$country_code], $country_data['pattern'], $country_data['length']);
        $error_message = sprintf($messages['pattern_example'], $example);
        return [
            'status' => 'error',
            'message' => $error_message,
        ];
    }

    return [
        'status' => 'success',
        'message' => __('The phone number is valid.', 'emptytheme'),
        'data' => [
            'country_code' => $country_code,
            'phone' => $phone,
        ],
    ];
}
