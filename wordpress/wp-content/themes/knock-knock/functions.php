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