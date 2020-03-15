<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold">
            <i class="fas fa-fw fa-home text-muted"></i>
            Andere huizen
        </h5>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <?php foreach(fetch()->houses([get_the_ID()]) as $house) : setup_postdata($house); ?>

                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <h5 class="font-weight-bold"><a href="<?= get_the_permalink($house->ID) ?>"><?= $house->post_title ?></a></h5>
                    </div>

                    <div class="mb-3">
                        <?php foreach(fetch()->usersByHouse($house->ID) as $user) : ?>

                            <?php $userData = get_userdata($user->ID); ?> 

                            <img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->ID) ?>" alt="" />

                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); ?>

                    </div>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>
