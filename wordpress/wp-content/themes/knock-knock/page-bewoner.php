<?php get_header(); ?>

<?php $user = App\getUserBySlug(get_query_var('bewoner_name')); ?> 

<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="font-weight-bold">
                <i class="far fa-fw fa-user text-muted"></i>
                    <?= $user ? $user->display_name : 'Bewoner' ?>
            </h3>
            <a href="<?= get_bloginfo('url'); ?>/bewoners" class="btn btn-primary">Terug naar overzicht</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card p-3">
            <div class="profile-picture" style="background-image:url('<?= App\getUserImage('large', $user->ID) ?>')"></div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header bg-transparent">

            </div>
            <div class="card-body">
                <?php if ($user) : ?>
                    <h5 class="font-weight-bold mb-3">
                        Info
                    </h5>
                    <p><i class="fas fa-map-marker fa-fw mr-2"></i><?= App\getUserAddress($user->ID) ?></p>
                    <p><i class="fas fa-envelope fa-fw mr-2"></i><a href="mailto:<?= $user->user_email ?>"><?= $user->user_email ?></a></p>
                    <?php if ($phone = get_field('resident_phone', $user)) : ?>
                        <p><i class="fas fa-phone fa-fw mr-2"></i><a href="tel:<?= $phone ?>"><?= $phone ?></a></p>
                    <?php endif; ?>
                <?php else : ?>
                    <p>Bewoner niet gevonden</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
