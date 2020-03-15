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
            $start = time();
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
            'meta_query' => [
                [
                    'key'     => 'resident_adres',
                    'value'   => '',
                    'compare' => '!=',
                ],
            ],
        ]);

        return $query->get_results();
    }

    /**
     * Get current residents from a certain house
     */
    public function usersByHouse($houseId) 
    {
        $query = new \WP_User_Query([
            'order' => 'ASC',
            'posts_per_page', -1,
            'meta_key' => 'first_name',
            'orderby' => 'meta_value',
            'role__in' => ['administrator', 'editor', 'author'],
            'meta_query' => [
                'relation' => 'AND', [
                    'key'     => 'resident_adres',
                    'value'   => '',
                    'compare' => '!=',
                ], [
                    'key'     => 'resident_house',
                    'value'   => $houseId,
                    'compare' => '='
                ]
            ],
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

    /**
     * Get houses
     */
    function houses($excludeIds = []) 
    {
        $query = new \WP_Query([
            'post_type' => 'house',
            'posts_per_page' => -1,
            'post__not_in' => $excludeIds
        ]);

        usort($query->posts, function($a, $b) {
            return strnatcmp($a->post_title, $b->post_title);
        });

        return $query->posts;
    }

    /**
     * Get documentation, split per given categories
     */
    function docs($categories = null) 
    {
        $categories = $categories ?: [
            'Algemeen' => 'algemeen',
            'Bestuur' => 'bestuur',
            'Commissies' => 'commissies',
            'Faciliteiten' => 'faciliteiten',
            'Huur en nieuwe huurders' => 'huur-en-nieuwe-huurders',
            'In, op en om het huis' => 'in-op-en-om-het-huis',
            'Overige' => 'overige'
        ];

        $result = []; 

        foreach($categories as $key => $category) 
        {
            $query = new \WP_Query([
                'post_type' => 'documentatie',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => [
                    [
                        'key' => 'categorie',
                        'value' => $category,
                        'compare' => '=',
                    ]
                ]
            ]);
    
            $result[$key] = $query->posts;
        }

        return $result;
    }
}
