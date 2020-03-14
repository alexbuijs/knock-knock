<?php get_header();?>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5><i class="far fa-fw fa-bell text-muted"></i> Recente gebeurtenissen</h5>
                <small class="text-muted">Watskeburt</small>
            </div>
            <div class="card-body">
                <?php $posts = App\getPosts(); if ($posts): ?>
                    <ul>
                        <?php foreach ($posts as $post): setup_postdata($post);?>
                            <?php if (get_post_type(get_the_ID()) == 'bewoners') {?>
                                <li class="stream-item-body small">
                                    <i class="fas fa-fw fa-user-edit"></i>
                                    Het profiel van <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangepast op <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                </li>
                            <?php }?>

                            <?php if (get_post_type(get_the_ID()) == 'documentatie') {?>
                                <li class="stream-item-body small">
                                    <i class="far fa-fw fa-file"></i>
                                    Het document<a href="<?php the_permalink();?>"><?php $title = get_the_title(); echo mb_strimwidth($title, 0, 40, '...'); ?></a> is aangepast op <?php the_modified_date('j F');?> om <?php the_modified_date('H:i');?>
                                </li>
                            <?php }?>

                            <?php if (get_post_type(get_the_ID()) == 'berichten') {?>
                                <?php if (get_the_modified_date() == get_the_date()) { /* Als het bericht nieuw is */?>
                                    <div class="stream-item">
                                        <div class="stream-item-body small">
                                            <i class="icon-bullhorn"></i> Het bericht <a href="<?php the_permalink();?>"><?php the_title();?></a> is
                                            geplaatst op <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                        </div>
                                    </div>
                                <?php } else { /* Als het bericht is aangepast */?>
                                    <div class="stream-item">
                                        <div class="stream-item-body small">
                                            <i class="icon-bullhorn"></i> Het bericht <a href="<?php the_permalink();?>"><?php the_title();?></a> is
                                            aangepast op <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php }?>

                            <?php if (get_post_type(get_the_ID()) == 'agenda') {?>
                                <?php if (get_the_modified_date('c') == get_the_date('c')) { /* Als het bericht nieuw is */?>
                                    <div class="stream-item">
                                        <div class="stream-item-body small">
                                            <i class="icon-calendar"></i> De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is
                                            aangemaakt op <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                        </div>
                                    </div>
                                <?php } else { /* Als het bericht is aangepast */?>
                                    <div class="stream-item">
                                        <div class="stream-item-body small">
                                            <i class="icon-calendar"></i> De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is
                                            aangepast op <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php }?>
                        <?php wp_reset_postdata();?>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5><i class="far fa-fw fa-calendar-alt text-muted"></i> Agenda</h5>
                <small class="text-muted">Binnenkort op de Klopvaart</small>
            </div>
            <div class="card-body">
                <p>Morbi lobortis luctus quam ut condimentum. Cras a risus augue. Aenean fringilla viverra lacus, sit amet convallis augue hendrerit eu. Sed vitae mollis dolor. Fusce nec eleifend metus, id fermentum nunc. Aenean vitae efficitur justo, sit amet pharetra urna. Duis rutrum libero quis dolor eleifend, ut dignissim risus ultrices. Vivamus nulla nisi, dignissim eu risus eget, tincidunt tempus leo. Cras ut ante id diam dignissim ornare. Sed facilisis elit purus, eget tristique ipsum facilisis viverra. Aenean nisi augue, facilisis eget elit at, euismod pharetra lorem. Maecenas sagittis nunc ut est ornare, non ullamcorper ex posuere. Curabitur sit amet tellus viverra, elementum elit nec, ullamcorper libero. Mauris posuere neque eu ipsum fringilla, ut dapibus nunc aliquet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed pharetra elementum pellentesque.</p>
            </div>
            <div class="card-footer bg-transparent">
                <button class="btn btn-primary">Bekijk alle agenda-items</button>
            </div>
        </div>
    </div>
</div>

    <?php if (have_posts()): ?>

    <?php while (have_posts()):
    the_post();

    get_template_part('content', get_post_format());
endwhile;?>

	    <?php endif;?>

<?php get_footer();?>
