<?php get_header(); ?>

<section id="bewoners">
    <div class="page-header">
        <h1><?php the_title(); ?></h1>
    </div>

    <?php echo do_shortcode('[wpuf_form id="64"]'); ?>

    <div class="row">
        <div class="span3 member-profile-image">
            <img src="<?php the_field('resident_profile_image'); ?>" width="220" height="220" alt="" />
        </div>

        <div class="span6">
            <h3>Introductie</h3>
            <p>... heeft zijn introductie nog niet ingevuld. :(</p>
            <h3>Waar word ik blij van?</h3>
            <p>... heeft nog niet laten weten waar hij blij van wordt. :(</p>
            <h3>Waar word jij graag voor uitgenodigd?</h3>
            <p>... heeft nog niet laten weten waar hij graag voor uitgenodigd wordt. :(</p>
        </div>

        <div class="span3">
            <table class="table table-striped table-bordered zebra-striped member-profile-meta-data">
                <thead>
                    <tr>
                        <th>Contactgegevens</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="tel:<?php the_field('resident_phone'); ?>"><?php the_field('resident_phone'); ?></a></td>
                    </tr>
                    <tr>
                        <td><?php the_field('resident_unit'); ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php the_field('resident_email'); ?>"><?php the_field('resident_email'); ?></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="primary">
        <div id="content" role="main">

            <?php while (have_posts()) :
                the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php the_content(); ?>

                <p>My custom field: <?php the_field('my_custom_field'); ?></p>

                <?php acf_form(); ?>

            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

    <?php /* Start Nieuwe bewoners */

    $posts = get_posts(array(
        'posts_per_page'    => -1,
        'order' => 'DESC',
        'post_type'         => 'bewoners',
        'order'             => 'DESC',
        'orderby'           => 'meta_value',
        'meta_key'          => 'resident_unit',
        'meta_type'         => 'DATETIME'
    ));

    if ($posts) : ?>
    <div class="row">
        <div class="span12">
            <h2>Andere bewoners van <?php the_field('resident_unit'); ?></h2>
        </div>
    </div><!-- /row -->
    <br>
    <div class="row show-grid">

        <?php foreach ($posts as $post) :
            setup_postdata($post); ?>

            <div class="span4 float-member">
                <div class="member-image">
                    <img src="<?php the_field('resident_profile_image'); ?>" width="40" height="40" alt="" />
                </div>
                <a class="member-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

        <?php endforeach; ?>

    </div><!-- /row -->

    <?php wp_reset_postdata(); ?>

    <?php endif;    /* Einde bewoners */  ?>

</section>

<?php get_footer(); ?>
