<?php get_header(); ?>

<?php
  $icon = 'far fa-file';
  $url = '/documentatie';

  require('partials/shared/title.php');
?>

<?php while (have_posts()) : the_post(); ?>
  <div class="row">
    <div class="col-12 col-lg-8">
      <?php require('partials/page-documentatie/item.php'); ?>
    </div>
  <div class="col-12 col-lg-4">
    <?php require('partials/page-documentatie/downloads.php'); ?>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
