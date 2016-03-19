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
 * Save user settings
 */
function save_user_settings_action()
{

    // check the nonce so we know the data is comming from where we want it
    check_ajax_referer('save_user_data', $_POST['nonce'], false);

    // get the current user
    $user = wp_get_current_user();
    // check which kind of a user sends us the data
    if (in_array('partner', $user->roles)) {
        $args = array(
            'ID' => $user->ID,
            'first_name' => sanitize_text_field($_POST['first_name']),
            'user_url' => sanitize_text_field($_POST['user_url']),
        );

        wp_update_user($args);
        update_user_meta($user->ID, 'contact_name', sanitize_text_field($_POST['contact_name']));
        update_user_meta($user->ID, 'contact_surname', sanitize_text_field($_POST['contact_surname']));
        update_user_meta($user->ID, 'contact_function', sanitize_text_field($_POST['contact_function']));
        update_user_meta($user->ID, 'contact_phone', sanitize_text_field($_POST['contact_phone']));


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
                $upload_overrides = array('test_form' => false);
                $attach_id = media_handle_upload($file, $upload_overrides);
                $image_attributes = wp_get_attachment_image_src($attach_id);
                update_user_meta($user->ID, 'logo', $image_attributes[0]);

                print_r($image_attributes[0]);
                die();
            }
        }
    }

    if (in_array('parent', $user->roles)) {
        //Do parent save
        echo('Saved');
        die();
    }
}

add_action('wp_ajax_save_news', 'save_news_action');
add_action('wp_ajax_nopriv_save_news', 'save_news_action');

/**
 * Save news as draft
 */
function save_news_action()
{
    // check the nonce so we know the data is comming from where we want it
    check_ajax_referer('save_new_post', $_POST['nonce'], false);

    $postarr = array(
        'post_title' => sanitize_text_field($_POST['post_title']),
        'post_content' => esc_textarea($_POST['post_content']),
        'post_type' => sanitize_text_field($_POST['post_type']),
    );

    $post_id = wp_insert_post ( $postarr, false );

    if(isset($_POST['at-activity-category'])) {
        $category = array($_POST['at-activity-category']);
        $taxonomy = 'atelier_activities_type';
        wp_set_post_terms( $post_id, $category, $taxonomy );
    }

    //require the needed files
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    //then loop over the files that were sent and store them using  media_handle_upload();
    $img_array = [];
    $_FILES = reArrayFiles($_FILES['fileToUpload']);

    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                echo "upload error : " . $_FILES[$file]['error'];
                die();
            }
            $upload_overrides = array('test_form' => false);
            $attach_id = media_handle_upload($file, $upload_overrides);
            set_post_thumbnail($post_id, $attach_id);

            $image_attributes = wp_get_attachment_image_src($attach_id);

            if($_POST['post_type'] === 'atelier_activities') {
                $img_array[] = $attach_id;
            }
        }
    }

    if(!empty($img_array)) {
        $comma_separated = implode(",", $img_array);
        $gallery = '<h2>Galerie Imagini</h2><br/>[gallery link="file" columns="4" size="large" ids="' . $comma_separated .  '"]';
        $content = esc_textarea($_POST['post_content']) . $gallery ;

        $args = array(
            'ID'           => $post_id,
            'post_title' => sanitize_text_field($_POST['post_title']),
            'post_content' => $content,
        );

        // Update the post into the database
        wp_update_post( $args );
    }

    $result ='<li class="at-news-item-' . $post_id . ' collection-item avatar">';
    $result .= '<img src="'. $image_attributes[0] .'" alt="" class="circle">';
    $result .= '<span class="title">'. $_POST['post_title'] .'</span>';
    $result .= '<p>';
    $result .= substr($_POST['post_content'], 0, 300);
    $result .= '</p>';
    $result .= '<a href="#at-delete-news-modal" data-id="'. $post_id .'" class="delete-item-modal modal-trigger lock_open secondary-content light-blue-text text-accent-4"><i class="material-icons">delete</i></a>';
    $result .= '</li>';

    echo $result;
    die();
}


function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

add_action('wp_ajax_delete_post', 'delete_post_action');
add_action('wp_ajax_nopriv_delete_post', 'delete_post_action');

/**
 * Delete post by post ID
 */
function delete_post_action()
{
    if(isset($_POST['post_id'])) {
        $response = wp_delete_post( $_POST['post_id'], true );
    }

    echo $response->ID;

    die();
}

add_action('wp_ajax_send_partner_email', 'send_partner_email_action');
add_action('wp_ajax_nopriv_send_partner_email', 'send_partner_email_action');

function send_partner_email_action () {

    // check the nonce so we know the data is comming from where we want it
    check_ajax_referer('send_partner_email', $_POST['nonce'], false);

    $subject  = $_POST['subject'];
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
    $headers .= "From: <".$_POST['email'].">" . "\r\n";

    $message = $_POST['first_name'] . " " . $_POST['last_name'] . "\r\n\r\n"  . $_POST['partner_email'];

    $response = wp_mail($_POST['partner_email'], $subject, $message, $headers);

    if($response === false) {
        echo "false";
        wp_send_json_error();
    }

    die();
}
