<?php

namespace App\Classes;

class Fetch
{
    /**
     * Manifest constructor
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function upcomingEvents($start = null)
    {
        if (!$start) {
            $start = mktime();
        }

        $query = new \WP_Query([
            'post_type' => 'agenda',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'start',
            'meta_query' => [
                'relation' => 'AND', [
                    'key' => 'start',
                    'compare' => 'BETWEEN',
                    'value' => array(date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', strtotime('+1 month -1 second', $start))),
                ]
            ]
        ]);

        return $query->posts;
    }

    public function recentUsers()
    {
        $query = new \WP_User_Query([
            'number' => 5,
            'order' => 'DESC',
            'meta_key' => 'bewoner_sinds',
            'orderby' => 'meta_value',
            'role__in' => ['administrator', 'editor', 'author']
        ]);

        return $query->get_results();
    }

    /**
     * Get all current residents sorted by first name
     */
    public function users() 
    {
        $query = new \WP_User_Query([
            'order' => 'ASC',
            'posts_per_page', -1,
            'meta_key' => 'first_name',
            'orderby' => 'meta_value',
            'role__in' => ['administrator', 'editor', 'author'],
            'meta_query' => array(
                array(
                    'key'     => 'resident_adres',
                    'value'   => '',
                    'compare' => '!=',
                ),
            ),
        ]);

        return $query->get_results();
    }

    /**
     * Get recent posts
     */
    function recentPosts()
    {
        $query = new \WP_Query([
            'posts_per_page' => 10,
            'orderby' => 'modified',
            'order' => 'DESC',
            'post_type' => ['agenda', 'documentatie'],
        ]);

        return $query->posts;
    }
}
