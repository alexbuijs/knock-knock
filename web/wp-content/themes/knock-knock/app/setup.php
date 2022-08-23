<?php
/**
 * Theme setup
 */

namespace App;

use App\Classes\Fetch;
use App\Classes\Vite;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use App\Classes\ViteAssetVersionStrategy;
use Timber\Timber;

/**
 * Redirect non-logged in users to login
 */
add_action("template_redirect", function () {
    if (!is_user_logged_in() || !current_user_can("edit_posts")) {
        auth_redirect();
    }
});

/**
 * Register Knock Knock assets
 */
add_action("wp_enqueue_scripts", function () {
    Vite::enqueueScript("assets/js/main.js");

    if (!Vite::isRunning()) {
        wp_enqueue_style(
            "knock-knock/main",
            Vite::asset("assets/js/main.css"),
            [],
            null,
        );
    }

    if (is_page("profiel")) {
        Vite::enqueueScript("assets/js/profile.jsx");
    }
});

/**
 * Register Admin assets
 */
add_action("admin_enqueue_scripts", function ($hook) {
    global $post;

    // Make datepicker available in agenda post edit screen
    if (
        ($hook !== "post-new.php" && $hook !== "post.php") ||
        "agenda" !== $post->post_type
    ) {
        return;
    }

    Vite::enqueueScript("assets/js/admin.js");

    if (!Vite::isRunning()) {
        wp_enqueue_style("admin", Vite::asset("assets/js/admin.css"), [], null);
    }
});

/**
 * Theme setup
 */
add_action("after_setup_theme", function () {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");

    /**
     * Register menus
     */
    register_nav_menus([
        "menu" => __("Menu", "knock-knock"),
    ]);

    /**
     * Create ACF options page
     */
    if (
        function_exists("acf_add_options_page") &&
        current_user_can("manage_options")
    ) {
        acf_add_options_page();
    }

    /**
     * Hide WP Admin bar for normal users
     */
    if (!current_user_can("edit_pages")) {
        show_admin_bar(false);
    }

    /**
     * Initialize Timber
     */
    $timber = new Timber();
    Timber::$dirname = ["../views"];
    Timber::$cache = true;

    /**
     * Create app container
     */
    $container = new ContainerBuilder();

    $container
        ->register("asset", Package::class)
        ->addArgument(
            new ViteAssetVersionStrategy(
                dirname(__DIR__) . "/dist/manifest.json",
            ),
        );

    $container->register("fetch", Fetch::class);

    /**
     * Helper filters
     */
    add_filter("getAssetUrl", function ($assetName) use ($container) {
        $uriBase = dirname(get_template_directory_uri()) . "/dist/";
        return $uriBase . $container->get("asset")->getUrl($assetName);
    });

    add_filter("getFetch", function () use ($container) {
        return $container->get("fetch");
    });
});

/**
 * Rewrite rule for the single user page
 */
add_action("init", function () {
    add_rewrite_rule(
        "^bewoner/([0-9a-z-]+)/?",
        'index.php?pagename=bewoner&bewoner_name=$matches[1]',
        "top",
    );
});
