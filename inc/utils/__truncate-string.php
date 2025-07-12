<?php

/**
 * Break content on N words
 *
 * @param [type] $text
 * @param integer $counttext
 * @param string $sep
 * @return void
 */
function truncate_string($text, $counttext = 30, $sep = ' ', $suffix = '...') {
    $text = wp_strip_all_tags($text);
    $text = trim(preg_replace('/\s+/u', ' ', $text));
    $words = explode($sep, $text);

    if (count($words) > $counttext) {
        $text = implode($sep, array_slice($words, 0, $counttext)) . $suffix;
    }

    return $text;
}