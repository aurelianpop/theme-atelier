<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 3/5/2016
 * Time: 3:52 PM
 */

add_action('wp_ajax_save_user_settings', 'save_user_settings_action');
add_action('wp_ajax_nopriv_save_user_settings', 'save_user_settings_action');

/**
 * put comment here mo fo
 */
function save_user_settings_action() {

    // check the nonce so we know the data is comming from where we want it
    check_ajax_referer('save_user_data', $_POST['nonce'], false);

    // get the current user
    $user = wp_get_current_user();
    // check which kind of a user sends us the data
    if ( in_array( 'partner', $user->roles ) ) {
        $args = array(
            'ID' => $user->ID,
            'first_name' => sanitize_text_field( $_POST['first_name'] ),
            'user_url' => sanitize_text_field( $_POST['user_url'] ),
        );

        wp_update_user( $args );
        update_user_meta( $user->ID, 'contact_name', sanitize_text_field( $_POST['contact_name'] ) );
        update_user_meta( $user->ID, 'contact_surname', sanitize_text_field( $_POST['contact_surname'] ) );
        update_user_meta( $user->ID, 'contact_function', sanitize_text_field( $_POST['contact_function'] ) );
        update_user_meta( $user->ID, 'contact_phone', sanitize_text_field( $_POST['contact_phone'] ) );


        //require the needed files
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        //then loop over the files that were sent and store them using  media_handle_upload();
        if ($_FILES) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    echo "upload error : " . $_FILES[$file]['error'];
                    die();
                }
                $upload_overrides = array( 'test_form' => false );
                $attach_id = media_handle_upload( $file, $upload_overrides );
                $image_attributes = wp_get_attachment_image_src( $attach_id );
                update_user_meta( $user->ID, 'logo', $image_attributes[0] );

                print_r($image_attributes[0]);
                die();
            }
        }
        // Do partner save
    }

    if ( in_array( 'parent', $user->roles ) ) {
        //Do parent save
    }

    echo('Saved');
    die();
}