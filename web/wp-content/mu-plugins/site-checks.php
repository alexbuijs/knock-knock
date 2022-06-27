<?php
/*
Plugin Name:  Site Checks
Description:  Disables the background updates check, which are handled through git
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

add_filter('site_status_tests', function($tests) {
    unset($tests['async']['background_updates']);
    return $tests;
});

// Allow for automatic updates even under version control
add_filter('automatic_updates_is_vcs_checkout', '__return_false', 1);