<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Klopvaart Intranet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-toggle" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="menu-toggle" class="collapse navbar-collapse">
        <?php wp_nav_menu([
    'menu' => 'Hoofd',
    'menu_class' => 'navbar-nav mr-auto',
    'container' => false,
    'depth' => 2,
    'show_home' => '1']);?>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=wp_get_current_user()->display_name?>
                        <img class="user" src="<?=App\getUserImage()?> " alt=""/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Profiel</a>
                        <a class="dropdown-item" href="#">Uitloggen</a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>
