<?php get_header(); ?>

<?php
  $icon = 'far fa-file';
  $url = '/wp-admin/post-new.php?post_type=documentatie';
  $title = 'Documentatie';
  $button = '<i class="fas fa-plus fa-fw"></i> Document toevoegen';

  require('partials/shared/title.php');
?>

<div class="row">
    <div class="col-12">

        <?php foreach(fetch()->docs() as $key => $category) : ?>

            <div class="card">
                <div class="card-header bg-transparent">
                    <h5 class="font-weight-bold"><?= $key ?></h5>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <ul class="list-unstyled list-sm row mb-3">

                            <?php if (!empty($category)) : ?>

                                <?php foreach($category as $doc) : ?>
                                    <li class="list-group-item col-12 col-sm-6 d-flex">
                                        <div class="mr-1">
                                            <i class="far fa-fw fa-file text-muted"></i>
                                        </div>
                                        <a href="<?= get_the_permalink($doc->ID); ?>"><?= $doc->post_title ?></a>
                                    </li>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <p class="text-muted">Geen documenten in deze categorie</p>

                            <?php endif; ?>

                        </ul>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php get_footer(); ?>
