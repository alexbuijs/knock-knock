<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between">
      <a href="/agenda?maand=<?= $previousMonth ?>&jaar=<?= $previousYear ?>">
        << <?= date_i18n('F', strtotime("$year-$previousMonth")); ?> <?= $previousYear; ?>
      </a>
      <a href="/agenda?maand=<?= $nextMonth ?>&jaar=<?= $nextYear ?>"><?= date_i18n('F', strtotime("$year-$nextMonth")); ?>
        <?= $nextYear; ?> >>
      </a>
    </div>
  </div>
</div>
