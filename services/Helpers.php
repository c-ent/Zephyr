<?php
namespace Services;
use DateTime;

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        echo '<pre>';
        foreach ($vars as $var) {
            if (is_array($var) || is_object($var)) {
                print_r($var);
            } elseif (is_string($var) && is_json($var)) {
                echo json_encode(json_decode($var), JSON_PRETTY_PRINT);
            } else {
                var_dump($var);
            }
        }
        echo '</pre>';
        die();
    }

    function is_json($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}



function formatDate($date){
    $date = new DateTime($date ?? '');
    $formattedDate = $date->format('F j, Y, g:i A');
    return $formattedDate;
}


function timeAgo($timestamp) {

    if ($timestamp == null) {
        return 'N/A';
    }
    $created_at = new DateTime($timestamp);
    $current_time = new DateTime();
    $interval = $current_time->diff($created_at);

    if ($interval->y > 0) {
        return $interval->y . ' years ago';
    } elseif ($interval->m > 0) {
        return $interval->m . ' months ago';
    } elseif ($interval->d > 0) {
        return $interval->d . ' days ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hours ago';
    } else {
        return $interval->i . ' minutes ago';
    }
}

?>
