<?php get_header(); ?>

<?php
  $user = wp_get_current_user();
  $userMeta = get_user_meta($user->ID);

  $icon = 'far fa-user';
  $title = 'Profiel';
  $url = App\userLink($user);
  $buttonText = 'Bekijk profiel';
  $buttonIcon = 'far fa-user';

  require('partials/shared/title.php');
?>

<form id="profileForm" >
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-transparent">
                </div>
                <div class="card-body">
                    <div class="alert alert-success d-none" role="alert"></div>
                    <h5 class="font-weight-bold">Persoonlijke gegevens</h5>
                    <div class="form-group mt-2">
                        <label for="phone">E-mailadres</label>
                        <input type="text" class="form-control" name="email" placeholder="E-mailadres" value="<?= $user->data->user_email; ?>">
                    </div>    
                    <div class="form-group">
                        <label for="phone">Telefoonnummer</label>
                        <input type="text" class="form-control" name="phone" placeholder="Telefoonnummer" value="<?= $userMeta['resident_phone'][0]; ?>">
                    </div>                    
                    <h5 class="font-weight-bold">Foto</h5>
                    <div class="form-group">
                        <label>Selecteer een nieuwe foto en klik op opslaan.</label>
                        <input type="file" class="form-control-file" name="profile_photo">
                    </div>
                    <?php wp_nonce_field('save_profile-' . $user->ID); ?>
                    <input name="action" value="save_profile" type="hidden">
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="body">Opslaan</span>
                    </button>
                </div>
                <div class="card-footer bg-transparent mt-3">
                    <small>Wil je je wachtwoord wijzigen? Dat kan <a href="<?= admin_url('profile.php'); ?>">hier</a>.</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card p-3">
                <div class="profile-picture" style="background-image:url('<?= App\getUserImage('large') ?>')"></div>
            </div>
        </div>
    </div>
</form>

<?php get_footer(); ?>
