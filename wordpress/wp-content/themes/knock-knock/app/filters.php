<?php
/**
 * Theme filters
 */

namespace App;

/**
 * Show message for old members trying to log in
 */
add_filter('login_message', function ($message) {
    if (is_user_logged_in() && !current_user_can('edit_posts') && empty($message)) {
        $message = '
            <p>Je bent uitgeschreven bij de Klopvaart en kan helaas niet 
            meer inloggen op het intranet. Stuur een mailtje naar 
            <a href="mailto:internet@klopvaart.nl">internet@klopvaart.nl</a> 
            als dit niet klopt!</p>
        ';
    }

    return $message;
});

/**
 * Add custom query var for the single user page
 */
add_filter('query_vars', function($qvars) {
    $qvars[] = 'bewoner_name';
    return $qvars;
});