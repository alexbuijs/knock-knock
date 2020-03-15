<?php get_header(); ?>

<div class="row mb-3">
  <div class="col-12">
    <div class="d-flex justify-content-between">
      <h3 class="font-weight-bold">
        <i class="far fa-fw fa-file text-muted"></i>
        <a href="/documentatie">Documentatie</a>
      </h3>
    </div>
  </div>
</div>

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
