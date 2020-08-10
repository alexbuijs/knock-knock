<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="font-weight-bold title">
        <i class="<?= $icon ?> fa-fw text-muted"></i>
        <?= $title ?: the_title() ?>
      </h3>
      <a class="btn btn-primary" href="<?= $url ?>">
        <i class="fas <?= isset($buttonIcon) ? $buttonIcon : 'fa-list' ?>"></i>
        <div class="ml-2 d-inline"><?= isset($buttonText) ? $buttonText : 'Overzicht' ?></div>
      </a>
    </div>
  </div>
</div>
