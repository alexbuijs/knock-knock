<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="font-weight-bold">
            <i class="far fa-fw fa-calendar-alt text-muted"></i>
            Agenda
            <div class="text-muted small mt-1">Binnenkort op de Klopvaart</div>
        </h5>
    </div>

    <div class="card-body">
        <ul class="list-group list-md">

            <?php foreach(fetch()->upcomingEvents() as $post) : setup_postdata($post); ?>
                <?php
                    $start = strtotime(get_field('start'));
                    $end = strtotime(get_field('einde'));
                ?>

                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3 text-right date">
                        <h4 class="font-weight-bold mb-0"><?= date_i18n("j", $start); ?></h4>
                        <div class="text-uppercase font-weight-bold text-muted mb-0 small"><?= date_i18n("M", $start); ?></div>
                    </div>
                    <div class="text-truncate">
                        <a class="text-body" href="<?php the_permalink(); ?>">
                            <?= the_title(); ?>
                        </a>
                        <div class="text-muted small"><?= date_i18n("l", $start); ?> <?= date_i18n("H:i", $start) . ' - ' . date_i18n("H:i", $end); ?></div>
                    </div>
                </li>

            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>
        </ul>
    </div>

    <div class="card-footer bg-transparent">
        <a href="<?= get_bloginfo('url'); ?>/agenda" class="btn btn-primary">Bekijk alle agenda-items</a>
    </div>
</div>
