<?php

$context = Timber::context();

switch (get_post_type()) {
    case "agenda":
        $post = Timber::get_post(false, "App\PostTypes\AgendaPost");
        $postDate = strtotime(get_field("start", $post->ID));
        $month = date("m", $postDate);
        $year = date("Y", $postDate);
        $context["agendaUrl"] =
            get_bloginfo("url") . "/agenda?maand=$month&jaar=$year";
        break;
    case "documentatie":
        $post = Timber::get_post(false, "App\PostTypes\DocPost");
        $context["authorThumbnail"] = App\getUserImage(
            "thumbnail",
            $post->post_author,
        );
        $context["authorLink"] = App\userLink(
            get_user_by("ID", $post->post_author),
            $linkable = true,
            $lastName = false,
        );
        break;
    case "house":
        $post = Timber::get_post(false, "App\PostTypes\HousePost");
        $context["houses"] = fetch()->houses();
        break;
}

$post = $post ?: Timber::get_post();
$context["post"] = $post;

Timber::render(
    [
        "single-" . $post->ID . ".twig",
        "single-" . $post->post_type . ".twig",
        "single-" . $post->slug . ".twig",
        "single.twig",
    ],
    $context,
);
