<?php get_header(); ?>

<?php /* The loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<section id="grid-system">
    <div class="page-header">
        <a href="<?= get_bloginfo('url'); ?>/huizen" class="btn btn-large pull-right">Alle huizen</a>
        <h1><?php the_title(); ?></h1>
    </div>

    <?php 
        global $wpdb;
        $capabilitiesFieldName = $wpdb->prefix . 'capabilities';

        $args = [
            'role__in' => ['author', 'editor', 'administrator'],
            'order' => 'ASC',
            'meta_key' => 'first_name',
            'orderby' => 'meta_value',
            'meta_query' => [
                'relation' => 'AND', [
                    'key'     => 'resident_house',
                    'value'   => get_the_ID(),
                    'compare' => '='
                ]
            ]
        ];

        $wp_user_query = new WP_User_Query($args);

        $users = $wp_user_query->get_results();
    ?>

    <?php foreach($users as $user) : 
        $userData = get_userdata($user->ID); 
        $image = get_field('resident_profile_image', $userData);
        $image = $image ? $image['sizes']['thumbnail'] : get_template_directory_uri() . '/assets/images/fallback.jpg';
    ?>

        <img src="<?php echo $image ?>" alt="" />
        <p><?= $userData->first_name ?></p>
    <?php endforeach; ?>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>