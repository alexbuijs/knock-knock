<?php
/*
Plugin Name:  Knock Knock Login Screen
Plugin URI:   https://intranet.klopvaart.nl
Description:  Custom logo for Knock Knock cohousing theme login screen
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

/**
 * Change image
 */
add_action('login_enqueue_scripts', function() {
    $logoUrl = plugin_dir_url(__FILE__) . 'login-logo.svg';
    $logoWidth = 100;
    $logoRatio = 444.95 / 501.33;

    ob_start();
    ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?= $logoUrl ?>);
                width: <?= $logoWidth ?>px;
                height: <?= $logoWidth / $logoRatio ?>px;
                background-size: <?= $logoWidth ?>px <?= $logoWidth / $logoRatio ?>px;
            }
        </style>
    <?php

    echo ob_get_clean();
});

/**
 * Change image href from wordpress to this site
 */
add_filter('login_headerurl', function() {
    return home_url();
});