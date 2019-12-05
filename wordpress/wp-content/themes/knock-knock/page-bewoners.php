<?php /* Template Name: Bewoners */ ?>
<?php get_header(); ?>

<section id="tables">
    <div class="page-header">
        <h1>Contactgegevens</h1>
    </div>

    <!-- Table structure -->
    <div class="row">
        <div class="span12">
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
                if (! empty($authors)) :     
            ?>
                <table class="table table-striped table-bordered" id="sortTableExample">
                    <thead>
                        <tr>
                            <th class="blue"></th>
                            <th class="blue">Voornaam</th>
                            <th class="green">Achternaam</th>
                            <th class="yellow">Adres</th>
                            <th class="blue">Telefoon</th>
                            <th class="green">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($authors as $author) {
                            // get all the user's data
                            $author_info = get_userdata($author->ID); 

                            // profile picture
                            $image = get_field('resident_profile_image', $author_info);
                            $image = $image ? $image['sizes']['thumbnail'] : get_template_directory_uri() . '/asset/images/fallback.jpg';
                            ?>

                            <tr>
                                <td><img src="<?php echo $image ?>" width="40" height="40" alt="" /></td>
                                <td><?php echo $author_info->first_name; ?></td>
                                <td><?php echo $author_info->last_name; ?></td>
                                <td><?php the_field('resident_adres', $author_info); ?></td>
                                <td><?php the_field('resident_phone', $author_info); ?></td>
                                <td><a
                                    href="mailto:<?php the_field('resident_email', $author_info); ?>"><?php the_field('resident_email', $author_info); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Geen bewoners gevonden</p>
            <?php endif; ?>
        </div>
    </div><!-- /row -->
</section>

<?php get_footer(); ?>