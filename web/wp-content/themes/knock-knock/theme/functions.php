<?php

/**
 * Make sure composer dependencies are installed, either in main project or in theme
 */
foreach ([5, 1] as $depth) {
    $composer = dirname(__DIR__, $depth) . "/vendor/autoload.php";
    if ($found = file_exists($composer)) {
        break;
    }
}

if (!$found) {
    wp_die(
        __(
            "Autoloader not found. Run <code>composer install</code>.",
            "knock-knock",
        ),
    );
}

require_once $composer;

/**
 * Loads Knock Knock template files located in the app/ folder
 */
array_map(
    function ($file) {
        $file = "../app/{$file}.php";
        if (!locate_template($file, true, true)) {
            wp_die(
                sprintf(
                    __("Error locating <code>%s</code>.", "knock-knock"),
                    $file,
                ),
            );
        }
    },
    ["setup", "helpers", "filters", "forms"],
);

/**
 * Global functions
 */
if (!function_exists("asset")) {
    function asset($assetName)
    {
        return apply_filters("getAssetUrl", $assetName);
    }
}

if (!function_exists("fetch")) {
    function fetch()
    {
        return apply_filters("getFetch", null);
    }
}
