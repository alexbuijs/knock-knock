<?php get_header(); ?>

<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h3 class="font-weight-bold">
                <i class="fas fa-fw fa-home text-muted"></i>
                <?php the_title(); ?>
            </h3>
            <a class="btn btn-primary" href="<?= get_bloginfo('url'); ?>/huizen">Overzicht</a>
        </div>
    </div>
</div>

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
                                <?= $userData->first_name ?>
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
