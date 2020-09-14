<?php
/**
 * Form actions
 */

namespace App;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

add_action('wp_ajax_save_profile', function() {
    if (!wp_verify_nonce($_POST['security'], 'save_profile-' . get_current_user_id())) {
        wp_send_json_error('Fordbidden', 403);
    }

    $validator = Validation::createValidator();
    $accessor = PropertyAccess::createPropertyAccessor();
    $errorMessages = [];

    $input = [
        'phone' => $_POST['phone'], 
        'email' => $_POST['email'], 
        'profilePhoto' => $_FILES['profilePhoto']
    ];

    $constraints = new Assert\Collection([
        'phone' => [new Assert\Regex([
            'pattern' => '/^[0-9\-+()]*$/',
            'message' => 'Alleen de karakters 0 t/m 9, +, (, ) en - zijn toegestaan'
        ])],
        'email' => [
            new Assert\Email([
                'message' => 'E-mailadres lijkt niet geldig te zijn']
            ), new Assert\notBlank([
                'message' => 'Dit veld mag niet leeg zijn'
            ]
        )],
        'profilePhoto' => [new Assert\Optional()]
    ]);

    $violations = $validator->validate($input, $constraints);

    if (count($violations) > 0) {
        foreach ($violations as $violation) {
            $accessor->setValue($errorMessages,
                $violation->getPropertyPath(),
                $violation->getMessage());
        }

        wp_send_json_error($errorMessages);
    } 

    if ($input['phone'] !== get_user_meta(get_current_user_id(), 'resident_phone')[0]) {
        $result = update_user_meta(get_current_user_id(), 'resident_phone', esc_attr($input['phone']));

        if (!$result) {
            $accessor->setValue($errorMessages, 'phone', 'Kon telefoonnummer niet opslaan.');
        }
    }

    if (wp_get_current_user()->data->user_email !== $input['email']) {    
        // Check if email address is free to use
        if (email_exists($input['email'])) {
            $accessor->setValue($errorMessages, 'email', 'Er is al een account met dit emailadres.');
        } else {
            // Update
            $result = wp_update_user([
                'ID' => get_current_user_id(),
                'user_email' => esc_attr($input['email'])
            ]);
            
            if (is_wp_error($result)) {
                $accessor->setValue($errorMessages, 'email', 'Kon e-mailadres niet wijzigen.');
            }
        }
    }

    // Update photo
    $resultData = [];
    if ($input['profilePhoto'] && $input['profilePhoto']['error'] === 0) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        
        // Check file type
        $fileType = wp_check_filetype($input['profilePhoto']['name'])['type'];
        if ($fileType !== 'image/jpeg') {
            $accessor->setValue($errorMessages, 'profilePhoto', 'Alleen jpg-bestanden zijn toegestaan.');
            wp_send_json_error($errorMessages);
        }

        // Upload file
        $uploaded = wp_handle_upload($input['profilePhoto'], ['test_form' => false]);

        if ($uploaded && !isset($uploaded['error'])) {

            $attachment = array(
                'guid' => wp_upload_dir()['url'] . '/' . basename($uploaded['file']),
                'post_mime_type' => $uploaded['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($uploaded['file'])),
                'post_content' => '',
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

    if (count($errorMessages) > 0) {
        wp_send_json_error($errorMessages);
    }

    wp_send_json_success(array_merge($resultData, [
        'message' => 'Wijzigingen opgeslagen.'
    ]));
});
