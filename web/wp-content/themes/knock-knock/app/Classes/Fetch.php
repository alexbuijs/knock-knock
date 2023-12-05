<?php

namespace App\Classes;

use Timber;
class Fetch
{
    /**
     * Fetch constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    private function includeUserMeta($users)
    {
        foreach ($users as $user) {
            $user->thumbnail = \App\getUserImage("thumbnail", $user->ID);
            $user->addressLink = \App\getUserAddress($user->ID);
            $user->since = get_field("bewoner_sinds", "user_" . $user->ID);
            $user->phone = get_field("resident_phone", "user_" . $user->ID);
            $user->url = \App\userLink($user);
            $user->link = \App\userLink($user, true);
        }

        return $users;
    }

    public function recentUsers()
    {
        $query = new \WP_User_Query([
            "number" => 5,
            "order" => "DESC",
            "meta_key" => "bewoner_sinds",
            "orderby" => "meta_value",
            "role__in" => ["administrator", "editor", "author"],
        ]);

        $results = $query->get_results();

        return $this->includeUserMeta($results);
    }

    /**
     * Get all current residents sorted by first name
     */
    public function users()
    {
        $query = new \WP_User_Query([
            "order" => "ASC",
            "posts_per_page",
            -1,
            "meta_key" => "first_name",
            "orderby" => "meta_value",
            "role__in" => ["administrator", "editor", "author"],
            "meta_query" => [
                [
                    "key" => "resident_adres",
                    "value" => "",
                    "compare" => "!=",
                ],
            ],
        ]);

        $results = $query->get_results();

        return $this->includeUserMeta($results);
    }

    /**
     * Get current residents from a certain house
     */
    public function usersByHouse($houseId)
    {
        $query = new \WP_User_Query([
            "order" => "ASC",
            "posts_per_page",
            -1,
            "meta_key" => "resident_adres",
            "orderby" => "meta_value",
            "role__in" => ["administrator", "editor", "author"],
            "meta_query" => [
                "relation" => "AND",
                [
                    "key" => "resident_adres",
                    "value" => "",
                    "compare" => "!=",
                ],
                [
                    "key" => "resident_house",
                    "value" => $houseId,
                    "compare" => "=",
                ],
            ],
        ]);

        return $query->get_results();
    }

    /**
     * Get houses
     */
    function houses()
    {
        $houses = Timber::get_posts([
            "post_type" => "house",
            "posts_per_page" => -1,
        ])->to_array();

        // Sort houses by name
        usort($houses, function ($a, $b) {
            return strnatcmp($a->post_title, $b->post_title);
        });

        return $houses;
    }
}
