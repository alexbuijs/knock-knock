<?php
/**
 * Theme filters
 */

namespace App;

use Timber;
use Twig;

/**
 * Show message for old members trying to log in
 */
add_filter("login_message", function ($message) {
    if (
        is_user_logged_in() &&
        !current_user_can("edit_posts") &&
        empty($message)
    ) {
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
 * Add custom query var for the single user page and agenda
 */
add_filter("query_vars", function ($qvars) {
    $qvars[] = "bewoner_name";
    $qvars[] = "maand";
    $qvars[] = "jaar";

    return $qvars;
});

/**
 * Redirect after login
 */
add_filter("login_redirect", function ($redirect_to) {
    return home_url();
});

/**
 * Change default acf-json folder location
 */
add_filter("acf/settings/save_json", function ($path) {
    return dirname(get_stylesheet_directory()) . "/assets/acf-json";
});

add_filter("acf/settings/load_json", function ($paths) {
    unset($paths[0]);

    $paths[] = dirname(get_stylesheet_directory()) . "/assets/acf-json";

    return $paths;
});

/**
 * Make options available in all timber contexts
 */
add_filter("timber/context", function ($context) {
    $context["options"] = get_fields("option");
    $context["menu"] = Timber::get_menu("menu");
    $context["current_user"] = Timber::get_user(get_current_user_id());
    $context["current_user_thumbnail"] = getUserImage();
    $context["theme_uri"] = dirname(get_template_directory_uri());

    return $context;
});

add_filter("timber/twig", function ($twig) {
    $twig->addFilter(
        new Twig\TwigFilter("timeDiff", function ($isoTime) {
            return timeDiff($isoTime);
        }),
    );

    $twig->addFilter(
        new Twig\TwigFilter("timeDiffShort", function ($isoTime) {
            return timeDiff($isoTime, true);
        }),
    );

    $twig->addFilter(
        new Twig\TwigFilter("localMonth", function ($month) {
            return date_i18n("F", strtotime(date("Y") . "-" . $month));
        }),
    );

    $twig->addFilter(
        new Twig\TwigFilter("sanitizeTitle", function ($str) {
            return sanitize_title($str);
        }),
    );

    $twig->addFunction(
        new Twig\TwigFunction("localDate", function ($format, $date) {
            return date_i18n($format, $date);
        }),
    );

    $twig->addFunction(
        new Twig\TwigFunction("userField", function ($field, $user) {
            return get_field($field, $user);
        }),
    );

    return $twig;
});

/**
 * Map custom post types to classes
 */
add_filter("timber/post/classmap", function ($classmap) {
    $custom_classmap = [
        "agenda" => PostTypes\AgendaPost::class,
        "documentatie" => PostTypes\DocPost::class,
        "house" => PostTypes\HousePost::class,
    ];

    return array_merge($classmap, $custom_classmap);
});

/**
 * Set timber cache location
 */
add_filter("timber/twig/environment/options", function ($options) {
    $options["cache"] = true;
    $options["auto_reload"] = true;

    return $options;
});

/**
 * Apply user selected theme
 */
add_filter("body_class", function ($classes) {
    $theme = get_current_user_id()
        ? get_user_meta(get_current_user_id(), "theme", true)
        : "";

    return [$theme];
});

/**
 * Add type module to script tag and nomodule for the legacy bundles
 */
add_filter(
    "script_loader_tag",
    function ($tag, $handle, $src) {
        if (strpos($handle, "knock-knock") === false) {
            return $tag;
        }

        $defaults = ["src" => $src, "id" => $handle . "-js"];

        if (preg_match("(legacy|polyfill)", $handle) > 0) {
            return wp_get_script_tag(
                array_merge($defaults, [
                    "nomodule" => true,
                    "type" => "text/javascript",
                ]),
            );
        }

        return wp_get_script_tag(
            array_merge($defaults, [
                "type" => "module",
                "src" => $src,
            ]),
        );
    },
    10,
    3,
);
