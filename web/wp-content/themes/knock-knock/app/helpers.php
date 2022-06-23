<?php
/**
 * Theme helpers
 */

namespace App;

use Carbon\Carbon;

/**
 * Get user profile picture
 */
function getUserImage($size = 'thumbnail', $userId = null)
{
    if (!$userId) {
        $userId = get_current_user_id();
    }

    $image = get_field('resident_profile_image', 'user_' . $userId);

    if (!$image) {
        return dirname(get_template_directory_uri()) . '/assets/images/fallback.png';
    }

    return $image['sizes'][$size];
}

/**
 * Get user address, make it a link if attached to a house
 */
function getUserAddress($userId = null)
{
    if (!$userId) {
        $userId = get_current_user_id();
    }

    $address = get_field('resident_adres', 'user_' . $userId);

    if ($houseId = get_field('resident_house', 'user_' . $userId)) {
        $permalink = get_post_permalink($houseId);

        return "<a href='$permalink'>$address</a>";
    }

    return $address;
}

/**
 * Change time into diff format (e.g. n minutes ago)
 */
function timeDiff($date, $short = false) {
    return Carbon::parse($date)->locale('nl_NL')->diffForHumans([
        'short' => $short
    ]);
}

/**
 * Get user by slug
 */
function getUserBySlug($slug) {
    if (!$slug) {
        return false;
    }

    $userQuery = new \WP_User_Query([
        'search' => $slug,
        'search_columns' => ['user_nicename']
    ]);

    $result = $userQuery->get_results();

    // Result should be one user
    return (count($result) == 1) ? $result[0] : [];
}

/**
 * Get user page URL
 *
 * @param User $user object
 */
function userLink($user, $linkable = false, $lastName = true)
{
    $url = get_bloginfo('url') . '/bewoner/' . $user->user_nicename;

    if ($linkable) {
        return "<a href='$url'>" . $user->first_name . ($lastName ? ' ' . $user->last_name : ''). "</a>";
    }

    return $url;
}
