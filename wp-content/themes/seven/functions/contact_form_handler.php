<?php
/**
 * File Name: contact_form_handler.php
 * Programmer : Saqib Sarwar
 * Date: 11/26/12
 * Time: 2:14 PM
 *
 * Send message function to process contact form submission
 *
 */

add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
add_action( 'wp_ajax_send_message', 'send_message' );

function send_message()
{

    if (isset($_POST['email'])) {

        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'send_message_nonce' ) ) {
            die ( __('Unverified Nonce!', 'framework') );
        }

        if ( $_POST['captcha'] != $_SESSION['rand_code'] ) {
            die ( __('Wrong Code!', 'framework') );
        }

        /* Sanitize and Validate Target email address that will be configured from theme options */
        $to_email = sanitize_email( get_option( 'theme_contact_address' ) );
        $to_email = is_email( $to_email );
        if ( !$to_email ) {
            die (__('Target Email address is not properly configured!', 'framework'));
        }

        /* Sanitize and Validate contact form input data */
        $from_name = sanitize_text_field( $_POST['name'] );
        $phone_number = sanitize_text_field( $_POST['pn'] );
        $subject = sanitize_text_field( $_POST['reason'] );
        $message = stripslashes( $_POST['message'] );
        $from_email = sanitize_email( $_POST['email'] );
        $from_email = is_email( $from_email );
        if ( !$from_email ) {
            die ( __('Provided Email address is invalid!', 'framework') );
        }

        $email_subject = __('New message sent by', 'framework') . ' ' . $from_name . ' ' . __('using contact form at', 'framework') . ' ' . get_bloginfo('name');

        $email_body = __("You have received a message from: ", 'framework') . $from_name . " <br/>";

        if ( !empty( $subject ) ) {
            $email_body .= __("Subject : ", 'framework') . $subject . " <br/>";
        }

        if ( !empty( $phone_number ) ) {
            $email_body .= __("Phone Number : ", 'framework') . $phone_number . " <br/>";
        }

        $email_body .= __("Their additional message is as follows.", 'framework') . " <br/>";
        $email_body .= wpautop($message) . " <br/>";
        $email_body .= __("You can contact ", 'framework') . $from_name . __(" via email, ", 'framework') . $from_email;

        $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header = apply_filters("inspiry_contact_mail_header", $header);
        $header .= 'From: ' . $from_name . " <" . $from_email . "> \r\n";

        if (wp_mail($to_email, $email_subject, $email_body, $header)) {
            _e("Message Sent Successfully!", 'framework');
        } else {
            _e("Server Error: WordPress mail method failed!", 'framework');
        }

    } else {
        _e("Invalid Request !", 'framework');
    }

    die;

}


?>