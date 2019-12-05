<?php get_header(); ?>

<section id="grid-system">

    <div class="page-header">
        <h1>Berichten (index)</h1>
    </div>

    <div class="row">
        <!-- Content -->
        <div class="span8">

            <?php if (have_posts()) :
                while (have_posts()) :
                    the_post();

                    get_template_part('content', get_post_format());
                endwhile; ?>

            <nav>
                <ul class="pager">
                    <li><?php next_posts_link('Vorige'); ?></li>
                    <li><?php previous_posts_link('Volgende'); ?></li>
                </ul>
            </nav>

            <?php endif; ?>

        </div><!-- /Content -->

        <?php get_sidebar(); ?>

    </div>

</section>

<?php get_footer(); ?>
