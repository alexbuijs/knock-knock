<?php get_header();?>

<?php
  $icon = 'far fa-user';
  $url = '/huizen';
  $title = 'Bewoners';
  $button = '<i class="fas fa-list"></i> Bekijk per huis';

  require('partials/shared/title.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body mt-1">
                <table class="table table-responsive-lg table-hover">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Voornaam</th>
                            <th scope="col">Achternaam</th>
                            <th scope="col">Adres</th>
                            <th scope="col">Telefoon</th>
                            <th scope="col">E-mailadres</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach(fetch()->users() as $user) : ?>

                            <?php $userData = get_userdata($user->ID); ?>

                            <tr data-href="<?= get_bloginfo('url') . '/bewoner/' . $user->user_nicename ?>">
                                <td><img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->ID) ?>" alt="" /></td>
                                <td><?= $userData->first_name; ?></td>
                                <td><?= $userData->last_name; ?></td>
                                <td><?= App\getUserAddress($user->ID) ?></td>
                                <td><a href="tel:<?= get_field('resident_phone', $userData) ?>"><?= get_field('resident_phone', $userData); ?></a></td>
                                <td><a href="mailto:<?= $userData->user_email ?>"><?= $userData->user_email ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>
