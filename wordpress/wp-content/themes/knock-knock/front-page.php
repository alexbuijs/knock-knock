<?php get_header();?>

<div class="row">
    <div class="col-12 col-lg-8">
        <?php get_template_part('partials/front-page/recent-events'); ?>
    </div>
    <div class="col-12 col-lg-4">
        <?php get_template_part('partials/front-page/agenda'); ?>
        <?php get_template_part('partials/front-page/recent-residents'); ?>
    </div>
</div>

<?php get_footer();?>
