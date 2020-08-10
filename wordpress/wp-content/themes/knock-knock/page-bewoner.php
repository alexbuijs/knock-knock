<?php get_header(); ?>

<?php $user = App\getUserBySlug(get_query_var('bewoner_name')); ?>

<?php
  $icon = 'far fa-user';
  $url = get_bloginfo('url') . '/bewoners';
  $title = $user ? $user->display_name : 'Bewoner';

  require('partials/shared/title.php');
?>

<div class="row">
    <?php if ($user) : ?>
        <div class="col-12 col-sm-6">
            <div class="card p-3">
                <div class="profile-picture" style="background-image:url('<?= App\getUserImage('large', $user->ID) ?>')"></div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header bg-transparent">

                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-3">
                            Info
                        </h5>
                        <?php if ($user->ID == get_current_user_id()) : ?>
                            <a href="<?= get_bloginfo('url') . '/profiel' ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-pencil-alt mr-1"></i> Bewerken
                            </a>
                        <?php endif; ?>
                    </div>
                    <p><i class="fas fa-map-marker fa-fw mr-2"></i><?= App\getUserAddress($user->ID) ?></p>
                    <p><i class="fas fa-envelope fa-fw mr-2"></i><a href="mailto:<?= $user->user_email ?>"><?= $user->user_email ?></a></p>
                    <?php if ($phone = get_field('resident_phone', $user)) : ?>
                        <p><i class="fas fa-phone fa-fw mr-2"></i><a href="tel:<?= $phone ?>"><?= $phone ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-3">
                    <p>Bewoner niet gevonden</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
