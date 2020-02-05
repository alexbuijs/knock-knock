<?php
/*
Plugin Name:  Knock Knock Post Types
Plugin URI:   https://intranet.klopvaart.nl
Description:  Custom Post Types for Knock Knock cohousing theme
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

/**
 * Post type: Documentatie
 */
add_action('init', function() {
    $labels = [
        'name' => __('Documenten', 'knock-knock'),
        'singular_name' => __('Document', 'knock-knock'),
        'menu_name' => __('Documentatie', 'knock-knock'),
        'all_items' => __('Alle documenten', 'knock-knock'),
        'add_new' => __('Document toevoegen', 'knock-knock'),
        'add_new_item' => __('Document toevoegen', 'knock-knock'),
        'edit_item' => __('Bewerk document', 'knock-knock'),
        'new_item' => __('Nieuw document', 'knock-knock'),
        'view_item' => __('Bekijk document', 'knock-knock'),
        'view_items' => __('Toon documenten', 'knock-knock'),
        'search_items' => __('Zoek document', 'knock-knock'),
        'not_found' => __('Geen documenten gevonden', 'knock-knock'),
    ];

    $args = [
        'label' => __('Documenten', 'knock-knock'),
        'labels' => $labels,
        'description' => 'Documents for Knock Knock cohousing theme',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'has_archive' => false,
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => [ 'slug' => 'documentatie', 'with_front' => true],
        'query_var' => true,
        'supports' => [ 'title', 'editor', 'thumbnail','author'],
        'menu_icon' => 'dashicons-text-page'
    ];

    register_post_type('documentatie', $args);
});

/**
 * Post type: Agenda
 */
add_action('init', function() {
    $labels = [
        'name' => __('Agenda items', 'knock-knock'),
        'singular_name' => __('Agenda item', 'knock-knock'),
        'menu_name' => __('Agenda', 'knock-knock'),
        'all_items' => __('Alle agenda items', 'knock-knock'),
        'add_new' => __('Agenda item toevoegen', 'knock-knock'),
        'add_new_item' => __('Voeg een agenda item toe', 'knock-knock'),
    ];

    $args = [
        'label' => __('Agenda items', 'knock-knock'),
        'labels' => $labels,
        'description' => 'Agenda items for Knock Knock cohousing theme',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'has_archive' => false,
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => ['slug' => 'agenda', 'with_front' => true],
        'query_var' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'author'],
        'menu_icon' => 'dashicons-calendar-alt'
    ];

    register_post_type('agenda', $args);
});

/**
 * Post type: House
 */
add_action('init', function() {
    $labels = [
        'name' => __('Huizen', 'knock-knock'),
        'singular_name' => __('Huis', 'knock-knock'),
        'menu_name' => __('Huizen', 'knock-knock'),
        'all_items' => __('Alle Huizen', 'knock-knock'),
        'add_new' => __('Huis toevoegen', 'knock-knock'),
        'add_new_item' => __('Voeg een huis toe', 'knock-knock'),
    ];

    $args = [
        'label' => __('Huizen', 'knock-knock'),
        'labels' => $labels,
        'description' => 'Resident units for Knock Knock cohousing theme',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'has_archive' => true,
        'show_in_menu' => true,
        'exclude_from_search' => false,
        // Make available only for administrators
        'capabilities' => [
            'edit_post' => 'update_core',
            'read_post' => 'update_core',
            'delete_post' => 'update_core',
            'edit_posts' => 'update_core',
            'edit_others_posts' => 'update_core',
            'delete_posts' => 'update_core',
            'publish_posts' => 'update_core',
            'read_private_posts' => 'update_core'
        ],        
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => ['slug' => 'huizen', 'with_front' => true],
        'query_var' => true,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-admin-home'
    ];

    register_post_type('house', $args);
});


