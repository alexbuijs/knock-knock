<?php require('delete-modal.php'); ?>

<div class="row">
  <div class="col-12">
    <div class="card">

      <div class="card-header bg-transparent">
        <div class="d-flex justify-content-between align-items-center">
          <h4>
            <?php if (isset($singleItem) && $singleItem == true): ?>
              <?php the_title(); ?>
            <?php else: ?>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            <?php endif; ?>
          </h4>
          <?php if ($post->post_author == get_current_user_id() || current_user_can('administrator')): ?>
            <div class="small">
              <?php edit_post_link(__('Bewerken', 'knock-knock')); ?> |
              <a href="#delete-modal-<?= the_ID() ?>" data-toggle="modal">Verwijderen</a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card-body">
        <div class="text-muted">
          <?php the_field('type'); ?>
        </div>
        <?php
          $datestart     = get_field('start', false, false);
          $datestartday  = date_i18n("l j F", strtotime($datestart));
          $datestarttime = date_i18n("H:i", strtotime($datestart));
          $dateend       = get_field('einde', false, false);
          $dateendday    = date_i18n("l j F", strtotime($dateend));
          $dateendtime   = date_i18n("H:i", strtotime($dateend));
        ?>
        <p>
          <strong>
            <?= ucfirst($datestartday); ?> van
            <?= $datestarttime; ?> tot
            <?= ($datestartday != $dateendday) ? $dateendday : ''; ?>
            <?= $dateendtime; ?>
          </strong>
        </p>
        <?php if (isset($singleItem) && $singleItem == true): ?>
          <p>
            <?php the_content(); ?>
          </p>
        <?php endif; ?>
      </div>

      <div class="card-footer py-3">
        <?php $author_info = get_userdata($post->post_author); ?>
        <img src="<?= App\getUserImage('thumbnail', $author_info->ID) ?>" class="thumbnail" />
        <span class="small ml-2">
          Organisator: <?= the_author_meta('first_name'); ?> -
          <?php if (get_the_modified_date('c') == get_the_date('c')): ?>
            Aangemaakt op <?php the_modified_date('j F'); ?> om <?php the_modified_date('H:i'); ?>
          <?php else: ?>
            Aangepast op <?php the_modified_date('j F'); ?> om <?php the_modified_date('H:i'); ?>
          <?php endif; ?>
        </span>
      </div>
    </div>
  </div>
</div>
