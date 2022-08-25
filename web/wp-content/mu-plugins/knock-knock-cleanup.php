<?php
/*
Plugin Name:  Knock Knock Cleanup
Plugin URI:   https://intranet.klopvaart.nl
Description:  Clean up unwanted Wordpress bloat
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

// Inspired by https://github.com/roots/soil/tree/05908dc07743b12eb938b5359f66120ef687120a/src/Modules

/**
 * Cleanup head
 */
add_filter("the_generator", "__return_false");
remove_action("wp_head", "rsd_link");
remove_action("wp_head", "wlwmanifest_link");
remove_action("wp_head", "adjacent_posts_rel_link_wp_head", 10);
remove_action("wp_head", "wp_generator");
remove_action("wp_head", "wp_shortlink_wp_head", 10);
remove_action("wp_head", "rest_output_link_wp_head", 10);
remove_action("wp_head", "wp_oembed_add_discovery_links");
remove_action("wp_head", "wp_oembed_add_host_js");

/**
 * Disable emojis
 */
remove_action("wp_head", "print_emoji_detection_script", 7);
remove_action("admin_print_scripts", "print_emoji_detection_script");
remove_action("wp_print_styles", "print_emoji_styles");
remove_action("admin_print_styles", "print_emoji_styles");
remove_filter("the_content_feed", "wp_staticize_emoji");
remove_filter("comment_text_rss", "wp_staticize_emoji");
remove_filter("wp_mail", "wp_staticize_emoji_for_email");
add_filter("emoji_svg_url", "__return_false");

/**
 * Disable gutenberg css
 */
add_action(
    "wp_enqueue_scripts",
    function () {
        wp_dequeue_style("wp-block-library");
        wp_dequeue_style("wp-block-library-theme");
        wp_dequeue_style("global-styles");
    },
    200,
);

/**
 * Disable extra RSS, recent comment css, gallery css
 */
add_filter("feed_links_show_comments_feed", "__return_false");
add_filter("show_recent_comments_widget_style", "__return_false");
add_filter("use_default_gallery_style", "__return_false");

/**
 * Clean up body classes
 */
add_filter("body_class", function ($classes) {
    $remove_classes = ["page-template-default"];

    // Add post/page slug if not present
    if (is_single() || (is_page() && !is_front_page())) {
        if (!in_array($slug = basename(get_permalink()), $classes)) {
            $classes[] = $slug;
        }
    }

    if (is_front_page()) {
        $remove_classes[] = "page-id-" . get_option("page_on_front");
    }

    $classes = array_values(array_diff($classes, $remove_classes));

    return $classes;
});

/**
 * Clean up attributes
 */
add_filter("language_attributes", function () {
    $attributes = [];

    if (is_rtl()) {
        $attributes[] = 'dir="rtl"';
    }

    $lang = get_bloginfo("language");

    if ($lang) {
        $attributes[] = "lang=\"{$lang}\"";
    }

    return implode(" ", $attributes);
});
