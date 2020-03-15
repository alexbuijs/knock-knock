<div id="delete-modal-<?= the_ID() ?>" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agenda item verwijderen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Weet je zeker dat je dit agenda item wilt verwijderen?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
        <a href="<?php echo get_delete_post_link(); ?>" class="btn btn-primary">Verwijderen</a>
      </div>
    </div>
  </div>
</div>
