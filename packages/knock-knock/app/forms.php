<?php
/**
 * Form actions
 */

namespace App;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

add_action("wp_ajax_save_profile", function () {
    if (
        !wp_verify_nonce(
            $_POST["security"],
            "security-" . get_current_user_id(),
        )
    ) {
        wp_send_json_error("Forbidden", 403);
    }

    $validator = Validation::createValidator();
    $accessor = PropertyAccess::createPropertyAccessor();
    $errors = [];
    $uploaded = null;

    // Upload file so we can assert it server side
    if (isset($_FILES["photo"])) {
        if (!function_exists("wp_handle_upload")) {
            require_once ABSPATH . "wp-admin/includes/file.php";
        }

        $uploaded = wp_handle_upload($_FILES["photo"], ["test_form" => false]);
        if (!$uploaded || isset($uploaded["error"])) {
            $accessor->setValue(
                $errors,
                "[photo]",
                isset($uploaded["error"])
                    ? $uploaded["error"]
                    : "Kon deze foto niet uploaden",
            );
            wp_send_json_error($errors);
        }
    }

    $input = [
        "phone" => isset($_POST["phone"]) ? $_POST["phone"] : "",
        "email" => isset($_POST["email"]) ? $_POST["email"] : "",
        "photo" => isset($uploaded) ? $uploaded["file"] : null,
    ];

    $constraints = new Assert\Collection([
        "phone" => [
            new Assert\Regex([
                "pattern" => '/^[0-9\-+()]*$/',
                "message" =>
                    "Alleen de karakters 0 t/m 9, +, (, ) en - zijn toegestaan",
            ]),
        ],
        "email" => [
            new Assert\Email([
                "message" => "E-mailadres lijkt niet geldig te zijn",
            ]),
            new Assert\NotBlank([
                "message" => "Dit veld mag niet leeg zijn",
            ]),
        ],
        "photo" => [
            new Assert\Optional([
                new Assert\Image([
                    "maxSize" => ini_get("upload_max_filesize"),
                    "maxSizeMessage" =>
                        "Foto mag niet groter zijn dan " .
                        ini_get("upload_max_filesize") .
                        "B",
                    "mimeTypes" => ["image/jpeg"],
                    "mimeTypesMessage" =>
                        "Alleen jpg-bestanden zijn toegestaan",
                ]),
            ]),
        ],
    ]);

    $violations = $validator->validate($input, $constraints);

    if (count($violations) > 0) {
        foreach ($violations as $violation) {
            $accessor->setValue(
                $errors,
                $violation->getPropertyPath(),
                $violation->getMessage(),
            );
        }

        wp_delete_file($input["photo"]);
        wp_send_json_error($errors);
    }

    // Update phone number
    if (
        $input["phone"] !==
        get_user_meta(get_current_user_id(), "resident_phone")[0]
    ) {
        $result = update_user_meta(
            get_current_user_id(),
            "resident_phone",
            esc_attr($input["phone"]),
        );

        if (!$result) {
            $accessor->setValue(
                $errors,
                "[phone]",
                "Kon telefoonnummer niet opslaan.",
            );
        }
    }

    // Update email
    if (wp_get_current_user()->data->user_email !== $input["email"]) {
        // Check if email address is free to use
        if (email_exists($input["email"])) {
            $accessor->setValue(
                $errors,
                "[email]",
                "Er is al een account met dit emailadres.",
            );
        } else {
            // Update
            $result = wp_update_user([
                "ID" => get_current_user_id(),
                "user_email" => esc_attr($input["email"]),
            ]);

            if (is_wp_error($result)) {
                $accessor->setValue(
                    $errors,
                    "[email]",
                    "Kon e-mailadres niet wijzigen.",
                );
            }
        }
    }

    // Update photo
    if ($_FILES["photo"] && $_FILES["photo"]["error"] === 0 && $uploaded) {
        $attachment = [
            "guid" =>
                wp_upload_dir()["url"] . "/" . basename($uploaded["file"]),
            "post_mime_type" => $uploaded["type"],
            "post_title" => preg_replace(
                '/\.[^.]+$/',
                "",
                basename($uploaded["file"]),
            ),
            "post_content" => "",
            "post_status" => "inherit",
        ];

        // Insert in media library
        $attachmentId = wp_insert_attachment($attachment, $uploaded["file"]);

        if (!$attachmentId || is_wp_error($attachmentId)) {
            $accessor->setValue($errors, "[photo]", "Kon foto niet opslaan.");
            wp_send_json_error($errors);
        }

        // Create different sizes
        wp_update_image_subsizes($attachmentId);

        // Update the user field
        update_field(
            "resident_profile_image",
            $attachmentId,
            "user_" . wp_get_current_user()->ID,
        );

        // Delete photo from input array
        unset($input["photo"]);
    }

    if (count($errors) > 0) {
        wp_send_json_error($errors);
    }

    wp_send_json_success(
        array_merge($input, [
            "newPhoto" => getUserImage("large"),
            "message" => "Wijzigingen opgeslagen.",
        ]),
    );
});

add_action("wp_ajax_save_theme_preference", function () {
    if (
        !wp_verify_nonce(
            $_POST["security"],
            "security-" . get_current_user_id(),
        )
    ) {
        wp_send_json_error("Forbidden", 403);
    }

    if (
        !in_array($_POST["theme"], [
            "system-default",
            "prefers-light",
            "prefers-dark",
        ])
    ) {
        wp_send_json_error("Bad request", 400);
    }

    $result = update_user_meta(get_current_user_id(), "theme", $_POST["theme"]);

    if (!$result) {
        wp_send_json_error("Failed to update theme");
    }

    wp_send_json_success(sprintf("Theme set to: %s", $_POST["theme"]));
});
