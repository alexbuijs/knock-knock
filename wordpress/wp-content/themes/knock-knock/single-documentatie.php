<?php require_login(); ?>
<?php get_header(); ?>

<?php /* The loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<section id="grid-system">
    <div class="page-header">
        <h1><a href="/documentatie">Documentatie</a></h1>
    </div>

    <div class="row">
        <div class="span8">
            <div class="message span8">
                <div class="message-header">
                    <span class="comment-count">
                        <?php edit_post_link($link, $before, $after, $id, $class); ?>
                    </span>

                    <h3><?php the_title(); ?></h3>
                </div>

                <div class="message-body">
                    <?php the_content(); ?>
                </div>

                <div class="message-footer">
                    <img
                        src="<?php echo get_field('resident_profile_image', 'user_'. $post->post_author)['sizes']['thumbnail']; ?>"
                        width="40" height="40" alt="" />
                    <?php echo the_author_firstname($post->post_author); ?> is beheerder van dit document. -

                    <?php if (get_the_modified_date() == get_the_date()) {  /* Als het bericht nieuw is */  ?>
                    Aangemaakt op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
                    <?php } else {  /* Als het bericht is aangepast */  ?>
                    Aangepast op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
                        <?php } ?>
                </div>
            </div>
        </div>

        <div class="span4">
            <?php // Document relations
                $post = get_field('relatie');
                if ($post) : setup_postdata($post); ?>

                <div class="message span4">
                    <div class="message-header">
                        <h3>Dit document hoort bij</h3>
                    </div>
                    <div class="message-body">
                        <ul class="overview">
                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        </ul>
                    </div>
                </div>

                <?php wp_reset_postdata(); ?>

            <?php endif; // End document relations ?>

            <?php // Download overzicht
            if (have_rows('downloads')) : ?>

                <div class="message span4">

                    <div class="message-header">
                        <h3>Downloads</h3>
                    </div>

                    <div class="message-body">
                        <ul class="overview">

                            <?php while (have_rows('downloads')) :
                                the_row(); ?>
                                <?php $bestand = get_sub_field('bestand'); ?>
                                <?php if ($bestand) { ?>
                            <li><i class="icon-file"></i><a
                                href="<?php echo $bestand['url']; ?>"><?php the_sub_field('omschrijving'); ?></a></li>
                                <?php } ?>
                            <?php endwhile; ?>

                        </ul>
                    </div>
                </div>
            <?php endif; // Einde Download overzicht ?>

            <?php if (current_user_can('administrator')) {  

                $relatedpostid = get_the_ID();
                // query events
                $posts = get_posts(array(
                    'posts_per_page'    => 100,
                    'post_type'         => 'documentatie',
                    'orderby' => 'title',
                    'order'   => 'ASC'
                ));

                if ($posts) : ?>
                    <div class="message span4">
                        <div class="message-header">
                            <h3>Gerelateerde Documenten</h3>
                        </div>
                        <div class="message-body">
                            <ul class="overview">
                                <?php foreach ($posts as $post) :
                                    setup_postdata($post); ?>

                                    <?php if (get_field('relatie') == $relatedpostid) { ?>
                                        <li>
                                            <i class="icon-file"></i>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <br />
                                        </li>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                <?php wp_reset_postdata(); ?>

                <?php endif; /* End Related */  ?>

            <?php } ?>

            <?php /* Items from the same category */
                $category = get_field('categorie');
                // query events
                $posts = get_posts(array(
                    'posts_per_page'    => 100,
                    'post_type'         => 'documentatie',
                    'orderby' => 'title',
                    'order'   => 'ASC'
                ));

                if ($posts) : ?>
                    <div class="message span4">
                        <div class="message-header">
                            <h3>Andere documenten in de categorie: <?php the_field('categorie'); ?></h3>
                        </div>
                        <div class="message-body">
                            <ul class="overview">
                                <?php foreach ($posts as $post) :
                                    setup_postdata($post); ?>

                                    <?php if (get_field('categorie') == $category) { ?>
                                        <li>
                                            <i class="icon-file"></i>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
                                        </li>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                <?php wp_reset_postdata(); ?>

                <?php endif; /* Einde Categorie */  ?>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>