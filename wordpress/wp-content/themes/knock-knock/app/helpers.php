<?php
/**
 * Theme helpers
 */

namespace App;

use Illuminate\Container\Container;

/**
 * Returns first and last date of a certain month
 */
function month_period($month, $year)
{
    $monthStart = mktime(0, 0, 0, $month, 1, $year);
    $monthEnd = mktime(23, 59, 59, $month, date('t', $monthStart), $year);

    return [
        date('Y-m-d H:i:s', $monthStart),
        date('Y-m-d H:i:s', $monthEnd),
    ];
}

/**
 * Get user profile picture
 */
function getUserImage($size = 'thumbnail', $userID = null)
{
    if (!$userID) {
        $userID = get_current_user_id();
    }

    $image = get_field('resident_profile_image', 'user_' . $userID);

    if (!$image) {
        return get_template_directory_uri() . '/assets/images/fallback.jpg';
    }

    return $image['sizes'][$size];
}

/**
 * Get available manifest instance
 *
 * @return mixed
 */
function manifest()
{
    return Container::getInstance()->make('manifest');
}

/**
 * Get instance of the fetch class
 */
function fetch() 
{
    return Container::getInstance()->make('fetch');
}

/**
 * Get publicly accessible asset uri
 *
 * @param string $assetName Asset filename
 */
function asset($assetName)
{
    $uriBase = get_template_directory_uri() . '/dist/';
    return $uriBase . manifest()->get($assetName);
}
