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
    /* translators: %s: Required number of digits */
    $invalid_format = __('The phone number must contain %s digits for the selected country.', 'emptytheme');
    /* translators: 1: Minimum number of digits, 2: Maximum number of digits */
    $invalid_length = __('The phone number should be from %1$s to %2$s digits.', 'emptytheme');
    /* translators: %s: Example phone number */
    $pattern_example = __('Invalid phone format. Example: %s', 'emptytheme');

    $messages = [
        'empty_code' => __('Please enter the phone number.', 'emptytheme'),
        'empty_phone' => __('Please enter the phone number.', 'emptytheme'),
        'invalid_format' => $invalid_format,
        'invalid_length' => $invalid_length,
        'pattern_error' => __('Internal pattern check failed for this country.', 'emptytheme'),
        'pattern_example' => $pattern_example,
        'no_country_list_function' => __('Failed to get country list. Check get_all_countries().', 'emptytheme'),
        'no_example_phone_number_function' => __('Failed to generate an example phone number. Check generate_example_phone_number().', 'emptytheme'),
        'valid' => __('The phone number is valid.', 'emptytheme'),
    ];

    // Basic empties
    if (empty($country_code) || !is_string($country_code)) {
        return ['status' => 'error', 'message' => $messages['empty_code']];
    }
    if (empty($phone) || !is_string($phone)) {
        return ['status' => 'error', 'message' => $messages['empty_phone']];
    }

    // Normalize
    $country_code = trim($country_code);
    $phone = preg_replace('/\D+/', '', trim($phone)); // leave digits only

    // Countries data
    if (!function_exists('get_all_countries')) {
        return ['status' => 'error', 'message' => $messages['no_country_list_function']];
    }
    $countries = get_all_countries();
    $by_dial = array_column($countries, null, 'dial_code');

    // If country not found — fallback to generic 5..15 rule
    if (!isset($by_dial[$country_code]) || !is_array($by_dial[$country_code])) {
        $len = strlen($phone);
        if ($len < 5 || $len > 15) {
            $error_message = sprintf($messages['invalid_length'], 5, 15);
            return ['status' => 'error', 'message' => $error_message];
        }
        return [
            'status' => 'success',
            'message' => $messages['valid'],
            'data' => ['country_code' => $country_code, 'phone' => $phone],
        ];
    }

    $country = $by_dial[$country_code];

    // Extract length constraints for THIS country
    $len_min = null;
    $len_max = null;
    if (isset($country['length'])) {
        if (is_numeric($country['length'])) {
            $len_min = $len_max = (int)$country['length'];
        } elseif (is_array($country['length'])) {
            // Expect [min, max]
            if (count($country['length']) === 2) {
                $len_min = (int)min($country['length'][0], $country['length'][1]);
                $len_max = (int)max($country['length'][0], $country['length'][1]);
            }
        }
    }

    // Length check (if we have constraints)
    $len = strlen($phone);
    if ($len_min !== null && $len_max !== null) {
        if ($len < $len_min || $len > $len_max) {
            $error_message = ($len_min === $len_max)
                ? sprintf($messages['invalid_format'], $len_min)
                : sprintf($messages['invalid_length'], $len_min, $len_max);
            return ['status' => 'error', 'message' => $error_message];
        }
    } elseif ($len_min !== null) { // just in case someone provided only min
        if ($len < $len_min) {
            $error_message = sprintf($messages['invalid_length'], $len_min, $len_min);
            return ['status' => 'error', 'message' => $error_message];
        }
    }

    // Pattern sanity check
    $pattern = isset($country['pattern']) && is_string($country['pattern']) ? $country['pattern'] : '';
    if ($pattern === '' || @preg_match($pattern, '1234567890') === false) {
        return ['status' => 'error', 'message' => $messages['pattern_error']];
    }

    // Pattern match
    if (!preg_match($pattern, $phone)) {
        if (!function_exists('generate_example_phone_number')) {
            return ['status' => 'error', 'message' => $messages['no_example_phone_number_function']];
        }
        // Pass data correctly: country/pattern/length
        $example = generate_example_phone_number($country, $pattern, $country['length'] ?: null);
        $error_message = sprintf($messages['pattern_example'], $example);
        return ['status' => 'error', 'message' => $error_message];
    }

    // OK
    return [
        'status' => 'success',
        'message' => $messages['valid'],
        'data' => [
            'country_code' => $country_code,
            'phone' => $phone,
        ],
    ];
}
