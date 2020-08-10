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

<?php
  $icon = 'far fa-calendar-alt';
  $url = get_bloginfo('url') . '/wp-admin/post-new.php?post_type=agenda';
  $title = 'Agenda';
  $buttonIcon = 'fas fa-plus';
  $buttonText = 'Agenda item toevoegen';

  require('partials/shared/title.php');
?>

<div class="mb-3">
  <?php require('partials/page-agenda/navigation.php'); ?>
</div>

<?php foreach($posts as $post) : setup_postdata($post); ?>
  <?php require('partials/page-agenda/item.php'); ?>
<?php endforeach; ?>

<?php wp_reset_postdata(); ?>

<?php if ($posts): require('partials/page-agenda/navigation.php'); endif; ?>

<?php get_footer();?>
