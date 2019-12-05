<?php
/**
 * Theme helpers
 */ 

namespace App;

/**
 * Checks if user is logged in, if not it redirects to login page
 */
function require_login()
{
    if (!is_user_logged_in()) {
        auth_redirect();
    }
}

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