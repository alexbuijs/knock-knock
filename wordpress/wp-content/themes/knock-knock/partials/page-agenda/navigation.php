<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between">
      <a href="/agenda?maand=<?php echo $previousMonth ?>&jaar=<?php echo $previousYear ?>">
        << <?php echo date_i18n('F', strtotime("$year-$previousMonth")); ?> <?php echo $previousYear; ?>
      </a>
      <a href="/agenda?maand=<?php echo $nextMonth ?>&jaar=<?php echo $nextYear ?>"><?php echo date_i18n('F', strtotime("$year-$nextMonth")); ?>
        <?php echo $nextYear; ?> >>
      </a>
    </div>
  </div>
</div>
