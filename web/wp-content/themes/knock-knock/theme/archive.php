<?php

$templates = ["index.twig"];
$context = Timber::context();

if (is_post_type_archive()) {
    $context["title"] = post_type_archive_title("", false);

    switch (get_post_type()) {
        case "house":
            $context["houses"] = Timber::get_posts([
                "post_type" => "house",
                "posts_per_page" => -1,
            ])->to_array();

            // Sort houses by name
            usort($context["houses"], function ($a, $b) {
                return strnatcmp($a->post_title, $b->post_title);
            });

            break;
    }

    array_unshift($templates, "archive-" . get_post_type() . ".twig");
}

Timber::render($templates, $context);
