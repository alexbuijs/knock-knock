<?php
/**
 * Theme filters
 */

namespace App;

use Timber;

/**
 * Show message for old members trying to log in
 */
add_filter('login_message', function ($message) {
    if (is_user_logged_in() && !current_user_can('edit_posts') && empty($message)) {
        $message = '
            <p>Je bent uitgeschreven bij de Klopvaart en kan helaas niet 
            meer inloggen op het intranet. Stuur een mailtje naar 
            <a href="mailto:internet@klopvaart.nl">internet@klopvaart.nl</a> 
            als dit niet klopt!</p>
        ';
    }

    return $message;
});

/**
 * Add custom query var for the single user page
 */
add_filter('query_vars', function($qvars) {
    $qvars[] = 'bewoner_name';
    return $qvars;
});

/**
 * Redirect after login
 */
add_filter('login_redirect', function($redirect_to) {
    return home_url();
});

/**
 * Make options available in all timber contexts
 */
add_filter('timber/context', function ($context) {
    $context['options'] = get_fields('option');
    $context['menu'] = new Timber\Menu();
    $context['current_user'] = new Timber\User();
    $context['current_user_thumbnail'] = getUserImage();
    $context['theme_uri'] = dirname(get_template_directory_uri());

    return $context;
});

add_filter('timber/twig', function($twig) {

    $twig->addFilter(new Timber\Twig_Filter('timeDiff', function($isoTime) {
        return timeDiff($isoTime);
    }));

    $twig->addFilter(new Timber\Twig_Filter('timeDiffShort', function($isoTime) {
        return timeDiff($isoTime, true);
    }));

    $twig->addFilter(new Timber\Twig_Filter('localMonth', function($month) {
        return date_i18n('F', strtotime(date('Y') . '-' . $month));
    }));

    $twig->addFunction(new Timber\Twig_Function('localDate', function($format, $date) {
        return date_i18n($format, $date);
    }));

    $twig->addFunction(new Timber\Twig_Function('userField', function($field, $user) {
        return get_field($field, $user);
    }));

    return $twig;
});
