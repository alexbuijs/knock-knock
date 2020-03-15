<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <a href="/agenda?maand=<?= $previousMonth ?>&jaar=<?= $previousYear ?>">
        << <?= date_i18n('F', strtotime("$year-$previousMonth")); ?> <?= $previousYear; ?>
      </a>
      <h4 class="font-weight-bold text-muted">
        <?= ucfirst(date_i18n('F', strtotime("$year-$month"))); ?> <?= $year; ?>
      </h4>
      <a href="/agenda?maand=<?= $nextMonth ?>&jaar=<?= $nextYear ?>"><?= date_i18n('F', strtotime("$year-$nextMonth")); ?>
        <?= $nextYear; ?> >>
      </a>
    </div>
  </div>
</div>
