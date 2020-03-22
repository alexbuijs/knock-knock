<?php get_header(); ?>

<?php $user = get_userdata(get_query_var('bewoner_id')) ?> 

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
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent">

            </div>
            <div class="card-body">
                <?php if ($user) : ?>
                    <?php var_dump($user) ?>
                <?php else : ?>
                    <p>Bewoner niet gevonden</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
