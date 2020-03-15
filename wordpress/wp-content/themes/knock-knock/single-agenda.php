<?php get_header(); ?>

<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between">
      <h3 class="font-weight-bold">
        <i class="far fa-fw fa-calendar-alt text-muted"></i>
        <?php
          $postDate = strtotime(get_field('start', false, false));
          $month = date('m', $postDate);
          $year = date('Y', $postDate);
        ?>
        <a href="/agenda?maand=<?= $month ?>&jaar=<?= $year ?>">Agenda</a>
      </h3>
    </div>
  </div>
</div>

<?php while (have_posts()) : the_post(); ?>
  <?php $singleItem = true ?>
  <?php require('partials/page-agenda/item.php'); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
