<?php
/*
Plugin Name:  Knock Knock Rewrite Rules
Plugin URI:   https://intranet.klopvaart.nl
Description:  Custom rewrite rules for Knock Knock cohousing theme
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

add_action('init', function() {
    add_rewrite_rule('^login', '/wp-login.php', 'top');
    add_rewrite_rule('^registreer', '/wp-login.php?action=register', 'top');
    add_rewrite_rule('^wachtwoord-aanvragen', '/wp-login.php?action=lostpassword', 'top');
    add_rewrite_rule('^logout', '/wp-login.php?action=logout', 'top');
});