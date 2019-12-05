<?php /* Template Name: Documentatie */ ?>
<?php App\require_login(); ?>
<?php get_header(); ?>

<section id="documentation">

    <div class="page-header">
        <a href="/wp-admin/post-new.php?post_type=documentatie" class="btn btn-large pull-right">Document toevoegen</a>
        <h1>Documentatie</h1>
    </div>

    <div class="row">
        <div class="span8 overview">
            <div class="message span8">
                <div class="message-header">
                    <h3>Algemeen</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'algemeen'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>
                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>Bestuur</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => 999,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'bestuur'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>Commissies</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'commissies'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>Faciliteiten</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'faciliteiten'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>Huur en nieuwe huurders</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'huur-en-nieuwe-huurders'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>In, op en om het huis</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'in-op-en-om-het-huis'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

            <div class="message span8">
                <div class="message-header">
                    <h3>Overige</h3>
                </div>
                <div class="message-body">
                    <ul class="overview">

                        <?php $posts = get_posts(array(
                            'posts_per_page'    => -1,
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'post_type'         => 'documentatie',
                            'meta_key'      => 'categorie',
                            'meta_value'    => 'overige'
                        )); if ($posts) : ?>
                        <?php foreach ($posts as $post) :
                            setup_postdata($post); ?>

                            <li><i class="icon-file"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                        <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif;    /* Einde Agenda */  ?>

                    </ul>

                </div>
            </div>

        </div>

        <div class="span4">

            <div class="alert alert-info">
                <h3>Ter info</h3>
                <?php the_content(); ?>
            </div>

        </div>
    </div>

</section>

<?php get_footer(); ?>
