<?php require_login(); ?>
<?php get_header(); ?>

<section id="grid-system">

    <div class="page-header">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="row">

        <!-- Content -->
        <div class="span12">

            <?php while (have_posts()) :
                the_post();
                the_content();
            endwhile;  ?>
        </div>
        <!-- /Content -->

    </div>
    
</section>

<?php get_footer(); ?>
