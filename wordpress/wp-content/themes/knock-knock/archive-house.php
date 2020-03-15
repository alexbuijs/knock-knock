<?php get_header(); ?>

<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h3 class="font-weight-bold">
                <i class="fas fa-fw fa-home text-muted"></i>
                    Huizen
            </h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent">
            </div>
            <div class="card-body"> 
                <ul class="list-group">
                    <?php foreach(fetch()->houses() as $house) : setup_postdata($house); ?>

                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <h5 class="font-weight-bold"><a class="text-body" href="<?= get_the_permalink($house->ID) ?>"><?= $house->post_title ?></a></h5>
                                <a href="<?= get_the_permalink($house->ID) ?>" class="btn btn-primary">Bekijk huis</a>
                            </div>

                            <div class="mb-3">
                                <?php foreach(fetch()->usersByHouse($house->ID) as $user) : ?>

                                    <?php $userData = get_userdata($user->ID); ?> 

                                    <img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->ID) ?>" alt="" />

                                <?php endforeach; ?>

                            </div>
                        </li>

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </ul>

            </div>
            <div class="card-footer bg-transparent">

            </div>
        </div>

        <?php wp_reset_postdata(); ?>

    </div>
</div>

<?php get_footer(); ?>