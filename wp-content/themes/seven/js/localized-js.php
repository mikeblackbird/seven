<?php
/**
 * File Name: localized-js.php
 * Programmer : Saqib Sarwar
 * Date: 11/30/12
 * Time: 5:51 PM
 */
?>
<script type="text/javascript">
    jQuery(document).ready(function(e) {

        $ = jQuery;

        /*-----------------------------------------------------------------------------------*/
        /*	Responsive Nav for Header
        /*-----------------------------------------------------------------------------------*/
        var $mainNav    = $('.main-menu > div').children('ul');
        var optionsList = '<option value="" selected><?php _e("Go to...", 'framework'); ?></option>';

        $mainNav.find('li').each(function() {
            var $this   = $(this),
                    $anchor = $this.children('a'),
                    depth   = $this.parents('ul').length - 1,
                    indent  = '';
            if( depth ) {
                while( depth > 0 ) {
                    indent += ' - ';
                    depth--;
                }
            }
            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end().last()
                .after('<select class="responsive-nav">' + optionsList + '</select>');

        $('.responsive-nav').on('change', function() {
            window.location = $(this).val();
        });



        /*-----------------------------------------------------------------------------------*/
        /*	Responsive Nav for Footer
        /*-----------------------------------------------------------------------------------*/
        var $mainNav    = $('#footer-menu').children('ul');
        var optionsList = '<option value="" selected><?php _e("Go to...", 'framework'); ?></option>';

        $mainNav.find('li').each(function() {
            var $this   = $(this),
                    $anchor = $this.children('a'),
                    depth   = $this.parents('ul').length - 1,
                    indent  = '';
            if( depth ) {
                while( depth > 0 ) {
                    indent += ' - ';
                    depth--;
                }
            }
            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end()
                .after('<select class="responsive-nav">' + optionsList + '</select>');

        $('.responsive-nav').on('change', function() {
            window.location = $(this).val();
        });



        /*----------------------------------------------------------------------------------*/
        /*	Contact Form AJAX validation and submition
        /*  Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
        /*	Form Ajax Plugin : http://www.malsup.com/jquery/form/
        /*---------------------------------------------------------------------------------- */

        if(jQuery().validate && jQuery().ajaxSubmit)
        {
            // Contact Form Handling
            var contact_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(responseText, statusText, xhr, $form){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');

                    if( responseText == "<?php _e("Wrong Code!", 'framework'); ?>" )
                    {
                        // wrong code
                    }
                    else if( responseText == "<?php _e("Message Sent Successfully!", 'framework'); ?>" )
                    {
                        $('.contact-form').resetForm();
                    }
                }
            };

            $('#contact-form .contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(contact_options);
                }
            });


            // Reservation Form Handling
            var reservation_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(responseText, statusText, xhr, $form){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');

                    if( responseText == "<?php _e("Wrong Code!", 'framework'); ?>" )
                    {
                        // wrong code
                    }
                    else if( responseText == "<?php _e("Message Sent Successfully!", 'framework'); ?>" )
                    {
                        $('.contact-form').resetForm();
                    }
                }
            };

            $('#reservation-form .contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(reservation_options);
                }
            });
        }


        /* ---------------------------------------------------- */
        /*	jQuery UI Date Picker
        /* ---------------------------------------------------- */
        if( jQuery().datepicker )
        {
            /*
            *   For localization of Datepicker
            *   Visit - http://docs.jquery.com/UI/Datepicker/Localization
            *   And Modify the code below after removing comments
            */


            $( "#date" ).datepicker();
        }


    });

</script>
