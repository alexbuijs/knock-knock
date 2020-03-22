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
                <table class="table table-responsive-lg">
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

                            <tr>
                                <td><img class="thumbnail" src="<?= App\getUserImage('thumbnail', $user->ID) ?>" alt="" /></td>
                                <td><?= $userData->first_name; ?></td>
                                <td><?= $userData->last_name; ?></td>
                                <td><?= App\getUserAddress($user->ID) ?></td>
                                <td><?= get_field('resident_phone', $userData); ?></td>
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
