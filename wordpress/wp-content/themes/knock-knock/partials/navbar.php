<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
    <div class="container-lg">
        <a class="navbar-brand" href="<?=get_bloginfo('url')?>">
            <svg role="img" class="normal" title="<?=get_bloginfo('name')?>">
                <use xlink:href="<?=get_template_directory_uri() . '/assets/images/logo.svg#logo'?>"/>
            </svg>
        </a>
        <ul class="navbar-nav ml-auto d-lg-none">
            <?php get_template_part('partials/navbar/user-badge'); ?>
        </ul>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-toggle" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="menu-toggle" class="collapse navbar-collapse">
            <?php 
                wp_nav_menu([
                    'menu' => 'Hoofd',
                    'menu_class' => 'navbar-nav mr-auto',
                    'container' => false,
                    'depth' => 2,
                    'show_home' => '1'
                ]);
            ?>

            <ul class="navbar-nav ml-auto d-none d-lg-block">
                <?php get_template_part('partials/navbar/user-badge'); ?>
            </ul>
        </div>


    </div>
</nav>
