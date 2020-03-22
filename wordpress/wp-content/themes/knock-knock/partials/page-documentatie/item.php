<?php require('delete-modal.php'); ?>

<div class="card">
  <div class="card-header bg-transparent">
    <?php if ($post->post_author == get_current_user_id() || current_user_can('administrator')): ?>
      <div class="d-flex flex-column align-items-end">
        <div class="small">
          <?php edit_post_link(__('Bewerken', 'knock-knock')); ?> |
          <a href="#delete-modal-<?= the_ID() ?>" data-toggle="modal">Verwijderen</a>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="card-body">
    <?php the_content(); ?>
  </div>

  <div class="card-footer py-3">
    <?php $author_info = get_userdata($post->post_author); ?>
    <img src="<?= App\getUserImage('thumbnail', $author_info->ID) ?>" class="thumbnail" />
    <span class="small ml-2">
      <?= App\userLink(get_user_by('ID', $author_info->ID), $linkable = true, $lastName = false) ?> is beheerder van dit document -
      <?php if (get_the_modified_date('c') == get_the_date('c')): ?>
        Aangemaakt op <?php the_modified_date(); ?> om <?php the_modified_date('H:i'); ?>
      <?php else: ?>
        Aangepast op <?php the_modified_date(); ?> om <?php the_modified_date('H:i'); ?>
      <?php endif; ?>
    </span>
  </div>
</div>
