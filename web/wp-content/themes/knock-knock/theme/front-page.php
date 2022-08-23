<?php

$context = Timber::context();
$templates = ["index.twig"];

// Recent events
$args = [
    "posts_per_page" => 15,
    "orderby" => "modified",
    "order" => "DESC",
    "post_type" => ["agenda", "documentatie"],
];

$context["recentEvents"] = Timber::get_posts($args, "App\PostTypes\EventPost");

// Upcoming activities
$start = time();

$args = [
    "post_type" => "agenda",
    "posts_per_page" => -1,
    "order" => "ASC",
    "orderby" => "meta_value",
    "meta_key" => "start",
    "meta_query" => [
        [
            "key" => "start",
            "compare" => "BETWEEN",
            "value" => [
                date("Y-m-d H:i:s", $start),
                date("Y-m-d H:i:s", strtotime("+1 month -1 second", $start)),
            ],
        ],
        [
            "key" => "type",
            "compare" => "!=",
            "value" => "pr-prive",
        ],
    ],
];

$context["upcomingActivities"] = Timber::get_posts(
    $args,
    "App\PostTypes\AgendaPost",
);

// Recent users
$context["recentUsers"] = fetch()->recentUsers();

// Check if user has a profile image
$context["userImage"] = get_field(
    "resident_profile_image",
    "user_" . get_current_user_id(),
);

array_unshift($templates, "front-page.twig");

Timber::render($templates, $context);
