<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * Loads Knock Knock template files located in the app/ folder
 */
array_map(function($file) {
    $file = "app/{$file}.php";
    if (!locate_template($file, true, true)) {
        wp_die(sprintf(__('Error locating <code>%s</code>.', 'knock-knock'), $file));
    }
}, ['setup', 'helpers', 'filters', 'shortcodes']);


add_theme_support('knock-knock');
App\boot();