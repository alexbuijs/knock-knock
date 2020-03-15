<?php require('delete-modal.php'); ?>

<div class="card">
  <div class="card-header bg-transparent">
    <div class="d-flex justify-content-between align-items-center">
      <h4>
        <?php the_title(); ?>
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
    <?php the_content(); ?>
  </div>

  <div class="card-footer py-3">
    <?php $author_info = get_userdata($post->post_author); ?>
    <img src="<?= App\getUserImage('thumbnail', $author_info->ID) ?>" class="thumbnail" />
    <span class="small ml-2">
      <?= the_author_meta('first_name'); ?> is beheerder van dit document -
      <?php if (get_the_modified_date('c') == get_the_date('c')): ?>
        Aangemaakt op <?php the_modified_date(); ?> om <?php the_modified_date('H:i'); ?>
      <?php else: ?>
        Aangepast op <?php the_modified_date(); ?> om <?php the_modified_date('H:i'); ?>
      <?php endif; ?>
    </span>
  </div>
</div>
