<?php
/**
 * Theme helpers
 */

namespace App;

use Illuminate\Container\Container;

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
        return get_template_directory_uri() . '/assets/images/fallback.jpg';
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
