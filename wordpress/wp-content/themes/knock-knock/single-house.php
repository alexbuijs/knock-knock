<?php get_header(); ?>

<?php
  $icon = 'fas fa-home';
  $url = '/huizen';

  require('partials/shared/title.php');
?>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body mt-3">
                <div class="row">
                    <?php foreach(fetch()->usersByHouse(get_the_ID()) as $user) : ?>

                        <?php $userData = get_userdata($user->ID); ?>

                        <div class="col-6 col-lg-4">
                            <div class="profile-picture" style="background-image:url('<?= App\getUserImage('medium', $user->ID) ?>')"></div>

                            <div class="mt-1 mb-3">
                                <?= App\userLink($user, $linkable = true, $lastName = false) ?>
                                <div class="small">
                                    <?= get_field('resident_adres', $userData); ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <?php get_template_part('partials/bewoners/other-houses'); ?>
    </div>
</div>

<?php get_footer(); ?>
