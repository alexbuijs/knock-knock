<?php get_header(); ?>

<?php
  $icon = 'fas fa-home';
  $url = '/bewoners';
  $title = 'Huizen';
  $buttonText = 'Lijst bewoners';

  require('partials/shared/title.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach(fetch()->houses() as $house) : setup_postdata($house); ?>

                        <li class="list-group-item">
                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <div>
                                    <h5 class="font-weight-bold"><a class="text-body" href="<?= get_the_permalink($house->ID) ?>"><?= $house->post_title ?></a></h5>
                                    <div>
                                        <?php foreach(fetch()->usersByHouse($house->ID) as $user) : ?>
                                            <?php $userData = get_userdata($user->ID); ?>
                                            <a href="<?= App\userLink($user) ?>">
                                                <img class="thumbnail mb-1" src="<?= App\getUserImage('thumbnail', $user->ID) ?>" alt="" data-toggle="tooltip" data-placement="top" title="<?= $user->first_name ?>" />
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <a href="<?= get_the_permalink($house->ID) ?>" class="btn btn-primary text-nowrap">Bekijk<span class="d-none d-sm-inline"> huis</a>
                            </div>
                        </li>

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
