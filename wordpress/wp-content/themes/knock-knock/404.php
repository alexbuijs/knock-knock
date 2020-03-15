<?php get_header(); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent">
                <h3  class="font-weight-bold"><i class="fas fa-fw fa-question text-muted"></i> 404</h3>
            </div>
            <div class="card-body mt-3">
                <p>Oh oh, deze pagina konden we niet vinden!</p>
            </div>
            <div class="card-footer bg-transparent">
                <a class="btn btn-primary" href="<?= get_bloginfo('url') ?>">Keer terug naar Home</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>