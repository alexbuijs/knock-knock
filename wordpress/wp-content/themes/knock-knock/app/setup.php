<?php
/**
 * Theme setup
 */

namespace App;

use Illuminate\Container\Container;
use App\Classes\Manifest;

/**
 * Redirect non-logged in users to login
 */
add_action('template_redirect', function () {
    if (!is_user_logged_in() || !current_user_can('edit_posts')) {
        auth_redirect();
    }
});

/**
 * Register Knock Knock assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap.css');
    wp_enqueue_style('docs', get_template_directory_uri() . '/assets/docs.css');
    wp_enqueue_style('custom', get_template_directory_uri() . '/assets/custom.css');
    wp_enqueue_style('prettify', get_template_directory_uri() . '/assets/prettify.css');
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/js/css/jquery-ui-1.8.21.custom.css');

    wp_enqueue_script('main', asset('main.js'), [], null, true);
    wp_enqueue_style('main', asset('main.css'), [], null);
});

/**
 * Register Admin assets
 */
add_action('admin_enqueue_scripts', function ($hook) {
    global $post;

    // Make datepicker available in agenda post edit screen
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ('agenda' === $post->post_type) {     
            wp_enqueue_script('main', asset('main.js'), [], null, true);
            wp_enqueue_style('datepicker', asset('datepicker.css'), [], null);
        }
    }
});

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    /**
     * Register menus
     */
    register_nav_menus([
        'menu' => __('Menu', 'knock-knock'),
    ]);

    /**
     * Create ACF options page
     */
    if (function_exists('acf_add_options_page') && current_user_can('manage_options')) {
        acf_add_options_page();
    }

    /**
     * Hide WP Admin bar for normal users
     */
    if (!current_user_can('edit_pages')) {
        show_admin_bar(false);
    }

    /**
     * Register container bindings
     */
    $container = Container::getInstance();
    $container->singleton('manifest', Manifest::class);

    $container->make('manifest')->registerManifest(
        get_template_directory() . '/dist/manifest.json'
    );
});

/**
 * Sort archive pages alphabetically
 */
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC' );
        $query->set('posts_per_page', -1);
    }
});
