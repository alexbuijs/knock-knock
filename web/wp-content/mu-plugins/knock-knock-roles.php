<?php
/*
Plugin Name:  Knock Knock Roles
Plugin URI:   https://intranet.klopvaart.nl
Description:  Custom roles for Knock Knock cohousing theme
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

add_action('init', function() {
    /**
     * Add old-member role
     */
    add_role('old-member', __('Uitgeschreven'), [
        'read' => true, 
        'edit_posts' => false,
        'edit_pages' => false,
        'edit_others_posts' => false,
        'create_posts' => false,
        'manage_categories' => false,
        'publish_posts' => false,
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
        'install_plugins' => false,
        'update_plugin' => false,
        'update_core' => false
    ]);


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
    $roles = wp_roles();

    $roles->roles['administrator']['name'] = 'Admin';
    $roles->role_names['administrator'] = 'Admin';
    $roles->roles['editor']['name'] = 'Beheerder';
    $roles->role_names['editor'] = 'Beheerder';
    $roles->roles['author']['name'] = 'Bewoner';
    $roles->role_names['author'] = 'Bewoner';
});

/**
 * Edit dashboard menu links for non-admins
 */
add_action('admin_menu', function() {
    if (! current_user_can('manage_options')) {
        remove_menu_page('edit.php');
        remove_menu_page('upload.php');
        remove_menu_page('edit-comments.php');
        remove_menu_page('tools.php');
    }
});

/**
 * Disallow access for normal users to some admin pages
 */
add_action('current_screen', function() {
    if (current_user_can('manage_options')) {
        return;
    }

    $screen = get_current_screen();

    if (in_array($screen->id, ['edit-post', 'upload', 'edit-comments', 'tools'])) {
        wp_die(__('Sorry, je hebt niet het juiste toegangsniveau om deze pagina te bekijken', 'knock-knock'), 403);
    }
});