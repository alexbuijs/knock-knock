<?php
    $image = get_field('resident_profile_image', 'user_' . get_current_user_id());

    if (!$image) : ?>

        <div class="alert alert-primary" role="alert">
            Hoi <?= get_user_meta(get_current_user_id(), 'first_name', true ); ?>! Welkom op het intranet. <a href="<?= get_bloginfo('url') . '/profiel'; ?>" class="alert-link">Klik hier</a> om een profielfoto toe te voegen!</a>
        </div>

    <?php endif;
?>