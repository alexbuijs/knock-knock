
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <?php wp_head(); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/asset/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-57-precomposed.png">

    <script src="<?php bloginfo('template_directory');?>/js/jquery.js"></script>
</head>

<body data-spy="scroll" data-target=".subnav" data-offset="50">

    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top first" style=" z-index: 20;">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?php bloginfo('wpurl');?>">
                    <?php echo get_bloginfo('name'); ?>
                </a>

                <?php if (is_user_logged_in()) : ?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo get_option('say_hello'); ?>
                                <?php 
                                    $current_user = wp_get_current_user();
                                    echo $current_user->display_name;
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <?php /*
                                <li><a href="/">Nog niet beschikbaar</a></li>
                                <li><a href="/">Profiel bewerken</a></li>
                                <li><a href="/">Wachtwoord aanpassen</a></li>
                                <li class="divider"></li>
                                */ ?>
                                <li><a href="<?php echo wp_logout_url(home_url()); ?>">Uitloggen</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
        
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top second" style="top: -5px; z-index: 10;">
        <div class="navbar-inner">
            <div class="container">
    
                <?php if (is_user_logged_in()) {
                    wp_nav_menu(array(
                        'menu'      => 'Hoofd',
                        'menu_class'        => 'nav',
                        'container' => false,
                        'depth' => 2,
                        'show_home'         => '1'
                    ));
                } ?>
            </div>
        </div>
    </div>
    <div class="container page">