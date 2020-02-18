<?php get_header(); ?>

<section id="grid-system">
    <div class="page-header">
        <a href="<?= get_bloginfo('url'); ?>/bewoners" class="btn btn-large pull-right">Bekijk lijst bewoners</a>
        <h1>Alle huizen</h1>
    </div>

    <?php /* The loop */ ?>
    <?php while (have_posts()) : the_post(); ?>
        <a href="<?= the_permalink(); ?>"><h1><?= the_title(); ?></h1></a>
    <?php wp_reset_postdata(); ?>

</section>

<?php endwhile; ?>

<?php get_footer(); ?>