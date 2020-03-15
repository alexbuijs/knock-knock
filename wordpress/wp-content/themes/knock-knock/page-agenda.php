<?php /* Template Name: Agenda */ ?>
<?php get_header();?>

<?php
  $year          = isset($_GET['jaar']) ? $_GET['jaar'] : date('Y');
  $month         = isset($_GET['maand']) ? $_GET['maand'] : date('m');
  $previousDate  = date_create("$year-$month previous month");
  $previousMonth = $previousDate->format('m');
  $previousYear  = $previousDate->format('Y');
  $nextDate      = date_create("$year-$month next month");
  $nextMonth     = $nextDate->format('m');
  $nextYear      = $nextDate->format('Y');
  $posts         = fetch()->upcomingEvents(mktime(0, 0, 0, $month, 1, $year));
?>

<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between">
      <h3 class="font-weight-bold">
        <i class="far fa-fw fa-calendar-alt text-muted"></i>
        Agenda <small class="text-muted"><?php echo date_i18n('F', strtotime("$year-$month")); ?> <?php echo $year; ?></small>
      </h3>
      <a href="/wp-admin/post-new.php?post_type=agenda" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> Agenda item toevoegen</a>
    </div>
  </div>
</div>

<div class="mb-3">
  <?php require('partials/page-agenda/navigation.php'); ?>
</div>

<?php foreach($posts as $post) : setup_postdata($post); ?>
  <?php require('partials/page-agenda/item.php'); ?>
<?php endforeach; ?>

<?php wp_reset_postdata(); ?>

<?php if ($posts): require('partials/page-agenda/navigation.php'); endif; ?>

<?php get_footer();?>
