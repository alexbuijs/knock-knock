<?php
/**
 * Theme shortcodes
 */ 

namespace App;

/**
 * Add shortcodes after WP init
 */
add_action('init', function() {
    
    /**
     * Create shortcode which returns the first name of current user
     */
    add_shortcode('user_firstname', function() {
        global $current_user;
        return $current_user->first_name;
    });
});