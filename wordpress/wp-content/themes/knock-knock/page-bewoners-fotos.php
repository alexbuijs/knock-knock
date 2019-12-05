<?php /* Template Name: Bewoners Fotos */ ?>
<?php require_login(); ?>
<?php get_header(); ?>

<section id="grid-system">
    <div class="page-header">
        <h1>Bewoners</h1>
    </div>

    <div class="row">
        <div class="span12 fotocollage">
            <?php
                $args = array(
                    'order'     => 'ASC',
                    'meta_key' => 'first_name',
                    'orderby'   => 'meta_value', //or 'meta_value_num'
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'status_in_expressionengine',
                            'value'   => 'Ingeschreven',
                            'compare' => '='
                        )
                    )
                );

                $wp_user_query = new WP_User_Query($args);

                // Get the results
                $authors = $wp_user_query->get_results();

                // Check for results
                if (! empty($authors)) {
                    foreach ($authors as $author) {
                        // get all the user's data
                        $author_info = get_userdata($author->ID);
                        $phone = get_field('resident_phone', $author_info);
                        $image = get_field('resident_profile_image', $author_info)['sizes']['thumbnail'];
                    ?>
                        <a href="">
                            <img src="<?php echo $image ?>" width="94" height="94" alt="" />
                    <?php } ?>

                <?php } else {
                    echo 'Geen bewoners gevonden';
                } 
            ?>
        </div>
    </div><!-- /row -->
</section>

<?php get_footer(); ?>