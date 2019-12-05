<?php App\require_login(); ?>
<?php get_header(); ?>

<section id="grid-system">

    <div class="page-header">
        <h1>Blog bericht (single)</h1>
    </div>

    <div class="row">
        <!-- Content -->
        <div class="span8">

            <?php if (have_posts()) :
                while (have_posts()) :
                    the_post();

                    get_template_part('content-single', get_post_format());

                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile;
            endif; ?>

        </div><!-- /Content -->

        <?php get_sidebar(); ?>
    </div>

</section>

<?php get_footer(); ?>
