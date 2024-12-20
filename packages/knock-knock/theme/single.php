<?php

$context = Timber::context();
$post = Timber::get_post();

switch (get_post_type()) {
    case "agenda":
        $postDate = strtotime(get_field("start", $post->ID));
        $month = date("m", $postDate);
        $year = date("Y", $postDate);

        $context["calendar"] = apply_filters("getCalendarLinks", $post);
        $context["agendaUrl"] =
            get_bloginfo("url") . "/agenda?maand=$month&jaar=$year";
        break;
    case "documentatie":
        $lastEdited = App\lastEditedBy($post->ID);
        $context["authorThumbnail"] = App\getUserImage(
            "thumbnail",
            $lastEdited,
        );
        $context["authorLink"] = App\userLink(
            get_user_by("ID", $lastEdited),
            $linkable = true,
            $lastName = false,
        );
        break;
    case "house":
        $context["houses"] = fetch()->houses();
        break;
}

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
