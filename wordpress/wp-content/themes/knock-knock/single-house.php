<?php get_header(); ?>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex justify-content-between">
                    <h3  class="font-weight-bold"><i class="fas fa-fw fa-home text-muted"></i> <?php the_title(); ?></h3>
                    <a class="btn btn-primary" href="<?= get_bloginfo('url'); ?>/huizen">Alle huizen</a>
                </div>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <?php foreach(fetch()->usersByHouse(get_the_ID()) as $user) : ?>

                        <?php $userData = get_userdata($user->ID); ?> 

                        <div class="col-6 col-lg-4">
                            <div class="profile-picture" style="background-image:url('<?= App\getUserImage('medium', $user->ID) ?>')"></div>

                            <p class="mt-1"><?= $userData->first_name ?><br>
                            <small><?= get_field('resident_adres', $userData); ?></small></p>
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
