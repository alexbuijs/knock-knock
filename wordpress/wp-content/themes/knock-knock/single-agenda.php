<?php App\require_login(); ?>
<?php get_header(); ?>

<?php /* The loop */ ?>
<?php while (have_posts()) :
    the_post(); ?>

<section id="grid-system">

    <div class="page-header">
        <h1><a href="/agenda">Agenda</a></h1>
    </div>

    <div class="row">
        <div class="span12">
            <div class="message span12">
                <div class="message-header">
                    <?php if ($post->post_author == get_current_user_id() || current_user_can('administrator')) {  ?>
                        <span class="comment-count">
                            <?php edit_post_link($link, $before, $after, $id, $class); ?> |
                            <a href="<?php echo get_delete_post_link($id); ?>">Verwijderen</a>
                        </span>
                    <?php } ?>

                    <h3>
                        <?php the_title(); ?>
                    </h3>

                    <span style="color:#888;">
                        <?php the_field('type'); ?>
                    </span>

                    <?php
                        $datestart     =  get_field('start', false, false);
                        $datestartday  = date_i18n("l j F", strtotime($datestart));
                        $datestarttime = date_i18n("H:i", strtotime($datestart));
                        $dateend       = get_field('einde', false, false);
                        $dateendday    = date_i18n("l j F", strtotime($dateend));
                        $dateendtime   = date_i18n("H:i", strtotime($dateend));
                    ?>
            
                    <p>
                        <strong>
                            <?php echo ucfirst($datestartday); ?> van
                            <?php echo $datestarttime; ?> tot
                            <?php echo ($datestartday != $dateendday) ? $dateendday : ''; ?>
                            <?php echo $dateendtime; ?>
                        </strong> 
                        <span style="color: #ddd;">.</span>
                    </p>
                </div>

                <div class="message-body">
                    <?php the_content(); ?>
                </div>

                <div class="message-footer">
                    <img
                        src="<?php echo get_field('resident_profile_image', 'user_'. $post->post_author)['sizes']['thumbnail']; ?>"
                        width="40" height="40" alt="" />
                    Organisator:
                    <?php echo the_author_firstname($post->post_author); ?>
                    <?php echo the_author_lastname($post->post_author); ?> -
                    <?php if (get_the_modified_date('c') == get_the_date('c')) { ?>
                    Aangemaakt op
                            <?php the_modified_date(''); ?> om
                            <?php the_modified_date('H:i'); ?>
                    <?php } else { ?>
                    Aangepast op
                            <?php the_modified_date(''); ?> om
                            <?php the_modified_date('H:i'); ?>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>