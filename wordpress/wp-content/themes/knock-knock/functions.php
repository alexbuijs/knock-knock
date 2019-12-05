<?php

/**
 * Loads Knock Knock template files located in the app/ folder
 */
array_map(function($file) {
    $file = "app/{$file}.php";
    if (!locate_template($file, true, true)) {
        wp_die(sprintf(__('Error locating <code>%s</code>.', 'knock-knock'), $file));
    }
}, ['setup', 'helpers', 'filters', 'shortcodes']);


// Create Post Types for Knock Knock
function cptui_register_my_cpts()
{
    /**
     * Post Type: Documenten.
     */
    $labels = array(
        "name" => __('Documenten', ''),
        "singular_name" => __('Document', ''),
        "menu_name" => __('Documentatie', ''),
        "all_items" => __('Alle documenten', ''),
        "add_new" => __('Document toevoegen', ''),
        "add_new_item" => __('Vo', ''),
        "edit_item" => __('Bewerk document', ''),
        "new_item" => __('Nieuw document', ''),
        "view_item" => __('Bekijk docuement', ''),
        "view_items" => __('Toon documenten', ''),
        "search_items" => __('Zoek document', ''),
        "not_found" => __('Geen documenten gevonden', ''),
    );

    $args = array(
        "label" => __('Documenten', ''),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "documentatie", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail","author" ),
    );

    register_post_type("documentatie", $args);

    /**
     * Post Type: Berichten.
     */

    $labels = array(
        "name" => __('Berichten', ''),
        "singular_name" => __('Bericht', ''),
    );

    $args = array(
        "label" => __('Berichten', ''),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "berichten", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
    );

    register_post_type("berichten", $args);

    /**
     * Post Type: Agenda items.
     */

    $labels = array(
        "name" => __('Agenda items', ''),
        "singular_name" => __('Agenda item', ''),
        "menu_name" => __('Agenda', ''),
        "all_items" => __('Alle agenda items', ''),
        "add_new" => __('Agenda item toevoegen', ''),
        "add_new_item" => __('Voeg een agenda item toe', ''),
    );

    $args = array(
        "label" => __('Agenda items', ''),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "agenda", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail", "author" ),
    );

    register_post_type("agenda", $args);
}

add_action('init', 'cptui_register_my_cpts');

/**
 * Add user old-member
 */

add_role('old-member', __('Uitgeschreven'), array(
    'read' => true, // true allows this capability
    'edit_posts' => false, // Allows user to edit their own posts
    'edit_pages' => false, // Allows user to edit pages
    'edit_others_posts' => false, // Allows user to edit others posts not just their own
    'create_posts' => false, // Allows user to create new posts
    'manage_categories' => false, // Allows user to manage post categories
    'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode'edit_themes' => false, // false denies this capability. User can’t edit your theme
    'edit_files' => false,
    'edit_theme_options' => false,
    'manage_options' => false,
    'moderate_comments' => false,
    'manage_categories' => false,
    'manage_links' => false,
    'edit_others_posts' => false,
    'edit_pages' => false,
    'edit_others_pages' => false,
    'edit_published_pages' => false,
    'publish_pages' => false,
    'delete_pages' => false,
    'delete_others_pages' => false,
    'delete_published_pages' => false,
    'delete_others_posts' => false,
    'delete_private_posts' => false,
    'edit_private_posts' => false,
    'read_private_posts' => false,
    'delete_private_pages' => false,
    'edit_private_pages' => false,
    'read_private_pages' => false,
    'unfiltered_html' => false,
    'edit_published_posts' => false,
    'upload_files' => false,
    'publish_posts' => false,
    'delete_published_posts' => false,
    'delete_posts' => false,
    'install_plugins' => false, // User cant add new plugins
    'update_plugin' => false, // User can’t update any plugins
    'update_core' => false // user cant perform core updates
));

/**
 * Remove unused user roles
 */

if (get_role('subscriber')) {
      remove_role('subscriber');
}
if (get_role('contributor')) {
      remove_role('contributor');
}

/**
 * Rename existing user roles
 */

function change_role_name()
{
    global $wp_roles;
    if (! isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }
    //You can use any of the roles "administrator" "editor", "author", "contributor" or "subscriber"...
    $wp_roles->roles['administrator']['name'] = 'Admin';
    $wp_roles->role_names['administrator'] = 'Admin';
    $wp_roles->roles['editor']['name'] = 'Beheerder';
    $wp_roles->role_names['editor'] = 'Beheerder';
    $wp_roles->roles['author']['name'] = 'Bewoner';
    $wp_roles->role_names['author'] = 'Bewoner';
}
add_action('init', 'change_role_name');