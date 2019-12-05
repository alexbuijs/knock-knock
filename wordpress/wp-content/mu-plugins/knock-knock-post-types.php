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
    $labels = array(
        'name' => __('Documenten', 'knock-knock'),
        'singular_name' => __('Document', 'knock-knock'),
        'menu_name' => __('Documentatie', 'knock-knock'),
        'all_items' => __('Alle documenten', 'knock-knock'),
        'add_new' => __('Document toevoegen', 'knock-knock'),
        'add_new_item' => __('Document toevoegen', 'knock-knock'),
        'edit_item' => __('Bewerk document', 'knock-knock'),
        'new_item' => __('Nieuw document', 'knock-knock'),
        'view_item' => __('Bekijk docuement', 'knock-knock'),
        'view_items' => __('Toon documenten', 'knock-knock'),
        'search_items' => __('Zoek document', 'knock-knock'),
        'not_found' => __('Geen documenten gevonden', 'knock-knock'),
    );

    $args = array(
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
        'rewrite' => array( 'slug' => 'documentatie', 'with_front' => true ),
        'query_var' => true,
        'supports' => array( 'title', 'editor', 'thumbnail','author' ),
        'menu_icon' => 'dashicons-text-page'
    );

    register_post_type('documentatie', $args);
});

/**
 * Post type: Berichten
 */
add_action('init', function() {
    $labels = array(
        'name' => __('Berichten', 'knock-knock'),
        'singular_name' => __('Bericht', 'knock-knock'),
    );

    $args = array(
        'label' => __('Berichten', 'knock-knock'),
        'labels' => $labels,
        'description' => 'Messages for Knock Knock cohousing theme',
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
        'rewrite' => array( 'slug' => 'berichten', 'with_front' => true ),
        'query_var' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon' => 'dashicons-format-chat'
    );

    register_post_type('berichten', $args);
});

/**
 * Post type: Agenda
 */
add_action('init', function() {
    $labels = array(
        'name' => __('Agenda items', 'knock-knock'),
        'singular_name' => __('Agenda item', 'knock-knock'),
        'menu_name' => __('Agenda', 'knock-knock'),
        'all_items' => __('Alle agenda items', 'knock-knock'),
        'add_new' => __('Agenda item toevoegen', 'knock-knock'),
        'add_new_item' => __('Voeg een agenda item toe', 'knock-knock'),
    );

    $args = array(
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
        'rewrite' => array( 'slug' => 'agenda', 'with_front' => true ),
        'query_var' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
        'menu_icon' => 'dashicons-calendar-alt'
    );

    register_post_type('agenda', $args);
});

