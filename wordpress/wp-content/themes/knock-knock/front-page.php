<?php get_header();?>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4>
                    <i class="far fa-fw fa-bell text-muted"></i>
                    Recente gebeurtenissen
                </h4>
                <small class="text-muted">Watskeburt</small>
            </div>
            <div class="card-body">
                <?php $posts = App\getPosts(); if ($posts): ?>
                    <ul class='list-unstyled'>
                        <?php foreach ($posts as $post): setup_postdata($post);?>
                            <?php if (get_post_type(get_the_ID()) == 'bewoners') {?>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <div class='d-flex align-items-center'>
                                        <div class='d-flex align-items-center justify-content-center icon mr-2 user'>
                                            <i class="far fa-fw fa-user"></i>
                                        </div>
                                        <div>
                                            Het profiel van <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangepast
                                        </div>
                                    </div>
                                    <div class='d-flex align-items-center font-weight-light text-nowrap small'>
                                        <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                    </div>
                                </li>
                            <?php }?>

                            <?php if (get_post_type(get_the_ID()) == 'documentatie') {?>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <div class='d-flex align-items-center'>
                                        <div class='d-flex align-items-center justify-content-center icon mr-2 document'>
                                            <i class="far fa-fw fa-file"></i>
                                        </div>
                                        <div>
                                            Het document <a href="<?php the_permalink();?>"><?php $title = get_the_title(); echo mb_strimwidth($title, 0, 40, '...'); ?></a> is aangepast
                                        </div>
                                    </div>
                                    <div class='d-flex align-items-center font-weight-light text-nowrap small'>
                                        <?php the_modified_date('j F');?> om <?php the_modified_date('H:i');?>
                                    </div>
                                </li>
                            <?php }?>

                            <?php if (get_post_type(get_the_ID()) == 'agenda') {?>
                                <?php if (get_the_modified_date('c') == get_the_date('c')) { /* Als het bericht nieuw is */?>
                                    <li class="d-flex justify-content-between py-3 border-bottom">
                                        <div class='d-flex align-items-center'>
                                            <div class='d-flex align-items-center justify-content-center icon mr-2 calendar'>
                                                <i class="far fa-fw fa-calendar-alt"></i>
                                            </div>
                                            <div>
                                                De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangemaakt
                                            </div>
                                        </div>
                                        <div class='d-flex align-items-center font-weight-light text-nowrap small'>
                                            <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
                                        </div>
                                    </li>
                                <?php } else { /* Als het bericht is aangepast */?>
                                    <li class="d-flex justify-content-between py-3 border-bottom">
                                        <div class='d-flex align-items-center'>
                                            <div class='d-flex align-items-center justify-content-center icon mr-2 calendar'>
                                                <i class="far fa-fw fa-calendar-alt"></i>
                                            </div>
                                            <div>
                                                De activiteit <a href="<?php the_permalink();?>"><?php the_title();?></a> is aangepast
                                            </div>
                                        </div>
                                        <div class='d-flex align-items-center font-weight-light text-nowrap small'>
                                            <?php the_modified_date('');?> om <?php the_modified_date('H:i');?>
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
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4 class="font-weight-bold"><i class="far fa-fw fa-calendar-alt text-muted"></i> Agenda<br>
                <small class="text-muted">Binnenkort op de Klopvaart</small></h4>
            </div>
            <div class="card-body">
                <?php
                    $query = new WP_Query([
                        'post_type' => 'agenda',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'meta_value',
                        'meta_key' => 'start',
                        'meta_query' => [
                            'relation' => 'AND', [
                                'key' => 'start',
                                'compare' => 'BETWEEN',
                                'value' => array(date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime(' +1 month'))),
                            ]
                        ]
                    ]); 
                ?>

                <ul class="list-group">

                    <?php foreach($query->posts as $post) : setup_postdata($post); ?>

                        <?php 
                            $start = strtotime(get_field('start')); 
                            $end = strtotime(get_field('einde')); 
                        ?>

                        <li class="list-group-item d-flex">
                            <div class="mr-3">
                                <h4 class="text-center font-weight-black mb-0"><?= date_i18n("j", $start); ?></h4>
                                <p class="text-uppercase font-weight-bold text-muted mb-0"><small><?= date_i18n("D", $start); ?></small></p>
                            </div>
                            <div>
                                <p class="mb-0"><?= the_title(); ?></p>
                                <p><small><?= date_i18n("H:i", $start) . ' - ' . date_i18n("H:i", $end); ?></small></p>
                            </div>
                        </li>

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </ul>
            </div>
            <div class="card-footer bg-transparent">
                <a href="<?=get_bloginfo('url')?>/agenda" class="btn btn-primary">Bekijk alle agenda-items</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="font-weight-bold"><i class="fas fa-fw fa-user text-muted"></i> Nieuwe bewoners<br>
                <small class="text-muted">Welkom!</small></h5>
            </div>
            <div class="card-body">
                <?php
                    $query = new WP_User_Query([
                        'number' => 10,
                        'order' => 'DESC',
                        'meta_key' => 'bewoner_sinds',
                        'orderby' => 'meta_value',
                        'role__in' => ['administrator', 'editor', 'author']
                    ]);
                ?>

                <?php foreach($query->get_results() as $user) : ?>

                    <?php
                        $address = get_field('resident_adres', 'user_' . $user->data->ID);
                    ?>

                    <li class="list-group-item d-flex">
                        <div class="mr-3">
                            <img src="<?= App\getUserImage('thumbnail', $user->data->ID) ?>" alt="" />
                        </div>
                        <div>
                            <p class="mb-0"><?= $user->display_name; ?></p>
                            <p><small>
                                <?= get_field('bewoner_sinds', 'user_' . $user->data->ID); ?>,
                                <?php if ($id = get_field('resident_house', 'user_' . $user->data->ID)) : ?>
                                    <a href="<?= get_post_permalink($id); ?>"><?= $address; ?></a>
                                <?php else : ?>
                                    <?= $address; ?>
                                <?php endif; ?>
                            </small></p>
                        </div>
                    </li>

                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            </div>
            <div class="card-footer bg-transparent">
                <a href="<?=get_bloginfo('url')?>/bewoners" class="btn btn-primary">Bekijk alle bewoners</a>
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
