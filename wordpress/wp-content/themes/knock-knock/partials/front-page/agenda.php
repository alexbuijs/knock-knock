<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold"><i class="far fa-fw fa-calendar-alt text-muted"></i> Agenda<br>
        <small class="text-muted">Binnenkort op de Klopvaart</small></h5>
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