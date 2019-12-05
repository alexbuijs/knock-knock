<div class="message span12">
    <div class="message-header">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> (Content)
            
            <a href="<?php comments_link(); ?>">
                <?php printf(_nx('One Comment', '%1$s reacties', get_comments_number(), 'comments title', 'textdomain'), number_format_i18n(get_comments_number())); ?>
            </a>    
        </h3>
    </div>
    <?php if (has_post_thumbnail()) { ?>
    <div class="images-body">
        <div id="myCarousel2228" class="carousel slide" data-pause="hover">
            <div class="carousel-inner">
                <div class="item active">

        <?php the_post_thumbnail(array(620, 620)); ?>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="message-body">
            <?php the_content(); ?>
    </div>
    <div class="message-footer">
        <img src="/images/made/content/member_photos/Screen_Shot_2014-01-18_at_12.36_.54___40_40_all_3_c1.png" width="40" height="40" alt="">
        Auteur: <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a>
        Laatste wijziging: <?php the_date(); ?> 
    </div>
</div>
