<?php

$context = Timber::context();

$post = Timber::get_post();
$context["post"] = $post;
$templates = ["page-" . $post->post_name . ".twig", "index.twig"];

// Get data for the different pages
switch ($post->post_name) {
    /**
     * Page agenda
     */
    case "agenda":
        $year = get_query_var("jaar") ?: date("Y");
        $month = get_query_var("maand") ?: date("m");
        $previousDate = date_create("$year-$month previous month");
        $context["previousMonth"] = $previousDate->format("n");
        $context["previousYear"] = $previousDate->format("Y");
        $nextDate = date_create("$year-$month next month");
        $context["nextMonth"] = $nextDate->format("n");
        $context["nextYear"] = $nextDate->format("Y");
        $start = mktime(0, 0, 0, $month, 1, $year);
        $context["month"] = date_i18n("F", strtotime("$year-$month"));
        $context["year"] = $year;

        $args = [
            "post_type" => "agenda",
            "posts_per_page" => -1,
            "order" => "ASC",
            "orderby" => "meta_value",
            "meta_key" => "start",
            "meta_query" => [
                "key" => "start",
                "compare" => "BETWEEN",
                "value" => [
                    date("Y-m-d H:i:s", $start),
                    date(
                        "Y-m-d H:i:s",
                        strtotime("+1 month -1 second", $start),
                    ),
                ],
            ],
        ];

        $context["agendaItems"] = Timber::get_posts($args);
        break;

    /**
     * Page Bewoners
     */
    case "bewoners":
        $context["users"] = fetch()->users();
        break;

    /**
     * Page single bewoner
     */
    case "bewoner":
        $user = App\getUserBySlug(get_query_var("bewoner_name"));
        $context["user"] = $user;
        if ($user) {
            $context["userImage"] = App\getUserImage("large", $user->ID);
            $context["userAddress"] = App\getUserAddress($user->ID);
        } else {
            array_unshift($templates, "404.twig");
        }
        break;

    /**
     * Page profiel
     */
    case "profiel":
        $context["userImage"] = App\getUserImage(
            "large",
            get_current_user_id(),
        );
        $context["userLink"] = App\userLink(wp_get_current_user(), false);
        break;

    /**
     * Page Documentatie
     */
    case "documentatie":
        $categories = [
            "Algemeen" => "algemeen",
            "Bestuur" => "bestuur",
            "Commissies" => "commissies",
            "Faciliteiten" => "faciliteiten",
            "Huur en nieuwe huurders" => "huur-en-nieuwe-huurders",
            "In, op en om het huis" => "in-op-en-om-het-huis",
            "Overige" => "overige",
        ];

        $context["docs"] = [];

        foreach ($categories as $key => $category) {
            $args = [
                "post_type" => "documentatie",
                "posts_per_page" => -1,
                "orderby" => "title",
                "order" => "ASC",
                "meta_query" => [
                    [
                        "key" => "categorie",
                        "value" => $category,
                        "compare" => "=",
                    ],
                ],
            ];

            $context["docs"][$key] = Timber::get_posts($args);
        }

        break;
}

Timber::render($templates, $context);
