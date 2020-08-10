<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?=wp_get_current_user()->first_name?> <span class="d-none d-lg-inline"><?=wp_get_current_user()->last_name?></span>
        <img class="user" src="<?=App\getUserImage()?> " alt=""/>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="<?= get_bloginfo('url') . '/profiel' ?>">Profiel</a>
        <a class="dropdown-item" href="<?= wp_logout_url(home_url()); ?>"><i class="fas fa-fw fa-power-off text-danger"></i> Uitloggen</a>
    </div>
</li>