<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold">
            <i class="far fa-fw fa-bell text-muted"></i>
            Recente wijzigingen
        </h5>
    </div>
    <div class="card-body">
        <?php $posts = fetch()->recentPosts(); if ($posts): ?>
            <ul class='list-unstyled'>
                <?php foreach ($posts as $post): setup_postdata($post);?>

                    <?php if (get_post_type(get_the_ID()) == 'documentatie') {?>
                        <li class="d-flex justify-content-between py-3 border-bottom">
                            <div class='d-flex align-items-center'>
                                <div class='d-flex align-items-center justify-content-center mr-3 icon document'>
                                    <i class="far fa-fw fa-file"></i>
                                </div>
                                <div>
                                    Het document <a href="<?php the_permalink();?>"><?php $title = get_the_title(); echo mb_strimwidth($title, 0, 40, '...'); ?></a> is aangepast
                                </div>
                            </div>
                            <div class='d-flex align-items-center text-nowrap text-muted small ml-1'>
                                <?php the_modified_date('j F');?> om <?php the_modified_date('H:i');?>
                            </div>
                        </li>
                    <?php }?>

                    <?php if (get_post_type(get_the_ID()) == 'agenda') {?>
                        <?php if (get_the_modified_date('c') == get_the_date('c')) { /* Als het bericht nieuw is */?>
                            <li class="d-flex justify-content-between py-3 border-bottom">
                                <div class='d-flex align-items-center'>
                                    <div class='d-flex align-items-center justify-content-center mr-3 icon calendar'>
                                        <i class="far fa-fw fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangemaakt
                                    </div>
                                </div>
                                <div class='d-flex align-items-center text-nowrap text-muted small ml-1'>
                                    <?php the_modified_date('j F');?> om <?php the_modified_date('H:i');?>
                                </div>
                            </li>
                        <?php } else { /* Als het bericht is aangepast */?>
                            <li class="d-flex justify-content-between py-3 border-bottom">
                                <div class='d-flex align-items-center'>
                                    <div class='d-flex align-items-center justify-content-center mr-3 icon calendar'>
                                        <i class="far fa-fw fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangepast
                                    </div>
                                </div>
                                <div class='d-flex align-items-center text-nowrap text-muted small ml-1'>
                                    <?php the_modified_date('j F');?> om <?php the_modified_date('H:i');?>
                                </div>
                            </li>
                        <?php }?>
                    <?php }?>
                <?php endforeach;?>
                <?php wp_reset_postdata();?>
            </ul>
        <?php endif;?>
    </div>
</div>
