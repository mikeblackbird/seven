<?php
/**
 * File Name: reservation_form_handler.php
 * Programmer : Saqib Sarwar
 * Date: 11/26/12
 * Time: 2:06 PM
 *
 * Make reservation request function to process reservation form submission
 *
 */

add_action( 'wp_ajax_nopriv_make_reservation', 'make_reservation' );
add_action( 'wp_ajax_make_reservation', 'make_reservation' );

function make_reservation()
{
    if(isset($_POST['email'])):

        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'send_reservation_nonce' ) ) {
            die ( __('Unverified Nonce!', 'framework') );
        }

        if ( $_POST['captcha'] != $_SESSION['res_rand_code'] ) {
            die ( __('Wrong Code!', 'framework') );
        }

        /* Sanitize and Validate Target email address that will be configured from theme options */
        $to_email = sanitize_email( get_option( 'theme_reservation_address' ) );
        $to_email = is_email( $to_email );
        if ( !$to_email ) {
            die (__('Target Email address is not properly configured!', 'framework'));
        }

        /* Sanitize and Validate contact form input data */
        $from_name = sanitize_text_field( $_POST['name'] );
        $phone_number = sanitize_text_field( $_POST['pn'] );
        $number_of_guests = sanitize_text_field( $_POST['guests'] );
        $res_date = sanitize_text_field( $_POST['date'] );
        $res_time = sanitize_text_field( $_POST['time'] );
        $message = stripslashes( $_POST['message'] );
        $from_email = sanitize_email( $_POST['email'] );
        $from_email = is_email( $from_email );
        if ( !$from_email ) {
            die ( __('Provided Email address is invalid!', 'framework') );
        }

        $email_subject = __('Reservation request sent by', 'framework') . ' ' . $from_name . ' ' . __('using reservation form at', 'framework') . ' ' . get_bloginfo('name');

        $email_body = __("You have received a reservation request from: ", 'framework') . $from_name . " <br/>";

        if ( !empty( $phone_number ) ) {
            $email_body .= __("Phone Number : ", 'framework') . $phone_number . " <br/>";
        }

        if ( !empty( $number_of_guests ) ) {
            $email_body .= __("Number of Guests: ", 'framework') . $number_of_guests . " <br/>";
        }

        if ( !empty( $res_date ) ) {
            $email_body .= __("Reservation Date : ", 'framework') . $res_date . " <br/>";
        }

        if ( !empty( $res_time ) ) {
            $email_body .= __("Reservation Time : ", 'framework') . $res_time . " <br/>";
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

    else:
        _e("Invalid Request !", 'framework');
    endif;

    die;

}

?>
