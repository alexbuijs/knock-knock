<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold"><i class="far fa-fw fa-user text-muted"></i> Nieuwe bewoners<br>
        <small class="text-muted">Welkom!</small></h5>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <?php foreach(fetch()->recentUsers() as $user) : ?>

                <?php
                    $address = get_field('resident_adres', 'user_' . $user->data->ID);
                ?>

                <li class="list-group-item d-flex">
                    <div class="mr-3">
                        <img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->data->ID) ?>" alt="" />
                    </div>
                    <div>
                        <p class="mb-0">
                            <?= App\userLink($user, $linkable = true) ?>
                        </p>
                        <p><small>
                            <?= get_field('bewoner_sinds', 'user_' . $user->data->ID); ?>,
                            <?= App\getUserAddress($user->data->ID); ?>
                        </small></p>
                    </div>
                </li>

            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
    <div class="card-footer bg-transparent">
        <a href="<?=get_bloginfo('url')?>/bewoners" class="btn btn-primary">Bekijk alle bewoners</a>
    </div>
</div>
