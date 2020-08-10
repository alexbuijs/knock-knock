<?php
/**
 * Form actions
 */

namespace App;

add_action('wp_ajax_save_profile', function() {
    if (!check_ajax_referer('save_profile-' . get_current_user_id())) {
        wp_die();
    }

    $resultData = [];

    // Update phone number
    if (isset($_POST['phone'])) {
        if ($_POST['phone'] !== get_user_meta(get_current_user_id(), 'resident_phone')[0]) {
            $result = update_user_meta(get_current_user_id(), 'resident_phone', esc_attr($_POST['phone']));

            if (!$result) {
                wp_send_json_error('Kon telefoonnummer niet opslaan.');
            }
        }
    }

    // Update email address
    if (isset($_POST['email'])) {
        if (wp_get_current_user()->data->user_email !== $_POST['email']) {    

            // Check if email address is valid
            if (!is_email($_POST['email'])) {
                wp_send_json_error('E-mailadres lijkt niet geldig.');
            }

            // Check if email address is free to use
            if (email_exists($_POST['email'])) {
                wp_send_json_error('Er is al een account met dit emailadres.');
            }
            
            // Update
            $result = wp_update_user([
                'ID' => get_current_user_id(),
                'user_email' => esc_attr($_POST['email'])
            ]);
            
            if (is_wp_error($result)) {
                wp_send_json_error('Kon e-mailadres niet wijzigen.');
            }
        }
    }

    // Update photo
    $uploadedfile = $_FILES['profile_photo'];
    if ($uploadedfile && $uploadedfile['error'] === 0) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        
        // Check file type
        $fileType = wp_check_filetype($uploadedfile['name'])['type'];
        if ($fileType !== 'image/jpeg') {
            wp_send_json_error('Alleen jpg-bestanden zijn toegestaan.');
        }

        // Upload file
        $uploaded = wp_handle_upload($uploadedfile, ['test_form' => false]);

        if ($uploaded && !isset($uploaded['error'])) {

            $attachment = array(
                'guid' => wp_upload_dir()['url'] . '/' . basename($uploaded['file']),
                'post_mime_type' => $uploaded['type'],
                'post_title' => preg_replace('/\.[^.]+$/', ”, basename($uploaded['file'])),
                'post_content' => ”,
                'post_status' => 'inherit'
            );

            // Insert in media library
            $attachmentId = wp_insert_attachment($attachment, $uploaded['file']);

            if (!$attachmentId || is_wp_error($attachmentId)) {
                wp_send_json_error('Kon foto niet opslaan.');
            }

            // Create different sizes
            wp_update_image_subsizes($attachmentId);

            // Update the user field
            update_field('resident_profile_image', $attachmentId, 'user_' . wp_get_current_user()->ID);

            // Send back new url
            $resultData['image'] = getUserImage('large');
        }
    }

    wp_send_json_success(array_merge($resultData, [
        'message' => 'Wijzigingen opgeslagen.'
    ]));
});
