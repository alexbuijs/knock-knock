<?php get_header(); ?>

<?php
  $postDate = strtotime(get_field('start', false, false));
  $month = date('m', $postDate);
  $year = date('Y', $postDate);
  $icon = 'far fa-calendar-alt';
  $url = "/agenda?maand=$month&jaar=$year";

  require('partials/shared/title.php');
?>

<?php while (have_posts()) : the_post(); ?>
  <?php $singleItem = true ?>
  <?php require('partials/page-agenda/item.php'); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
