<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold"><i class="far fa-fw fa-user text-muted"></i> Nieuwe bewoners<br>
        <small class="text-muted">Welkom!</small></h5>
    </div>
    <div class="card-body">

        <?php foreach(fetch()->recentUsers() as $user) : ?>

            <?php
                $address = get_field('resident_adres', 'user_' . $user->data->ID);
            ?>

            <li class="list-group-item d-flex">
                <div class="mr-3">
                    <img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->data->ID) ?>" alt="" />
                </div>
                <div>
                    <p class="mb-0"><?= $user->display_name; ?></p>
                    <p><small>
                        <?= get_field('bewoner_sinds', 'user_' . $user->data->ID); ?>,
                        <?php if ($id = get_field('resident_house', 'user_' . $user->data->ID)) : ?>
                            <a href="<?= get_post_permalink($id); ?>"><?= $address; ?></a>
                        <?php else : ?>
                            <?= $address; ?>
                        <?php endif; ?>
                    </small></p>
                </div>
            </li>

        <?php endforeach; ?>

        <?php wp_reset_postdata(); ?>
    </div>
    <div class="card-footer bg-transparent">
        <a href="<?=get_bloginfo('url')?>/bewoners" class="btn btn-primary">Bekijk alle bewoners</a>
    </div>
</div>