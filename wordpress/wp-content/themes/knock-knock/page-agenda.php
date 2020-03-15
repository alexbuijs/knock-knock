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
        Agenda -
        <?php echo date_i18n('F', strtotime("$year-$month")); ?>
        <?php echo $year; ?>
      </h3>
      <div class="d-flex align-items-center">
        <a href="/wp-admin/post-new.php?post_type=agenda" class="btn btn-primary">Agenda item toevoegen</a>
      </div>
    </div>
  </div>
</div>

<div class="mb-3">
  <?php require('partials/page-agenda/navigation.php'); ?>
</div>

<?php foreach($posts as $post) : setup_postdata($post); ?>
  <div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header bg-transparent">
          <div class="d-flex justify-content-between align-items-center">
            <h4>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h4>
            <?php if ($post->post_author == get_current_user_id() || current_user_can('administrator')) {  ?>
              <div class="small">
                <?php edit_post_link(__('Bewerken', 'knock-knock')); ?> |
                <a href="<?php echo get_delete_post_link(); ?>">Verwijderen</a>
            </div>
            <?php } ?>
          </div>
        </div>

        <div class="card-body">
          <div class="text-muted">
            <?php the_field('type'); ?>
          </div>
          <?php
            $datestart     = get_field('start', false, false);
            $datestartday  = date_i18n("l j F", strtotime($datestart));
            $datestarttime = date_i18n("H:i", strtotime($datestart));
            $dateend       = get_field('einde', false, false);
            $dateendday    = date_i18n("l j F", strtotime($dateend));
            $dateendtime   = date_i18n("H:i", strtotime($dateend));
          ?>
          <p>
            <strong>
              <?php echo ucfirst($datestartday); ?> van
              <?php echo $datestarttime; ?> tot
              <?php echo ($datestartday != $dateendday) ? $dateendday : ''; ?>
              <?php echo $dateendtime; ?>
            </strong>
          </p>
        </div>

        <div class="card-footer py-3">
          <?php $author_info = get_userdata($post->post_author); ?>
            <img src="<?= App\getUserImage('thumbnail', $author_info->ID) ?>" class="thumbnail" />
            <span class="small ml-2">
              Organisator:
                <?php echo the_author_meta('first_name'); ?> -
                <?php if (get_the_modified_date('c') == get_the_date('c')) { ?>
              Aangemaakt op
                <?php the_modified_date('j F'); ?> om <?php the_modified_date('H:i'); ?><?php } else { ?>
              Aangepast op
                <?php the_modified_date('j F'); ?> om <?php the_modified_date('H:i'); ?>
            </span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

<?php endforeach; ?>

<?php if ($posts): require('partials/page-agenda/navigation.php'); endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer();?>
