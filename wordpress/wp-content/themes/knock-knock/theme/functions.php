<?php

/**
 * Make sure composer dependencies are installed and load them
 */
if (!file_exists($composer = dirname(__DIR__) . '/vendor/autoload.php')) {
    wp_die(__('Autoloader not found. Run <code>composer install</code> from theme directory.', 'knock-knock'));
}
require_once $composer;

/**
 * Initialize Timber
 */
$timber = new \Timber\Timber();
Timber::$dirname = ['../views'];
Timber::$cache = true;

/**
 * Loads Knock Knock template files located in the app/ folder
 */
array_map(
    function ($file) {
        $file = "../app/{$file}.php";
        if (!locate_template($file, true, true)) {
            wp_die(sprintf(__('Error locating <code>%s</code>.', 'knock-knock'), $file));
        }
    }, ['setup', 'helpers', 'filters', 'shortcodes', 'forms']
);

/**
 * Global functions
 */
if (!function_exists('asset')) {
    function asset(...$args)
    {
        return App\asset(...$args);
    }
}

if (!function_exists('fetch')) {
    function fetch(...$args) 
    {
        return App\fetch(...$args);
    }
}