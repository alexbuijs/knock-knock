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
        date('Y-m-d H:i:s', $monthEnd)
    ];
}

/**
 * Returns month name
 */
function month_name($month)
{
    return [
        'Januari',
        'Februari',
        'Maart',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Augustus',
        'September',
        'Oktober',
        'November',
        'December'
    ][$month - 1];
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
 * Get publicly accessible asset uri
 * 
 * @param string $assetName Asset filename
 */
function asset($assetName)
{
    $uriBase = get_template_directory_uri() . '/dist/';
    return $uriBase . manifest()->get($assetName);
}