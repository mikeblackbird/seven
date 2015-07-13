<?php
/*
*	Template Name: Contact Us
*/ 
get_header(); ?>

                    <!-- Start Container -->
                    <div id="container">

                        <!-- Content -->
                        <div class="content clearfix">

                            <div class="container-top"></div>

                            <section class="page-head">
                                <h1>
                                    <span><?php the_title(); ?></span>
                                </h1>
                            </section>

                            <!-- Main -->
                            <div id="main-content">

                                <?php
                                if ( have_posts() ) :
                                    while ( have_posts() ) :
                                        the_post();
                                        ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                                            <?php

                                            the_content();

                                            $postal_address = stripslashes(get_option('theme_postal_address'));
                                            if(!empty($postal_address))
                                            {
                                                ?>
                                                <address>
                                                    <?php echo $postal_address; ?>
                                                </address>
                                                <?php
                                            }

                                            ?>
                                        </article>
                                        <?php
                                    endwhile;
                                endif;

                                // contact map
                                $show_map = get_option('theme_gmap_show');

                                if($show_map == 'true')
                                {

                                    $map_lati = get_option('theme_gmap_lati');
                                    $map_longi = get_option('theme_gmap_longi');
                                    $map_zoom = get_option('theme_gmap_zoom');
                                    ?>
                                    <div class="map-container clearfix">

                                        <div id="map_canvas"></div>

                                        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                                        <script type="text/javascript">

                                            function initialize()
                                            {
                                                var geocoder  = new google.maps.Geocoder();
                                                var map;
                                                var latlng = new google.maps.LatLng(<?php echo $map_lati; ?>, <?php echo $map_longi; ?>);
                                                var infowindow = new google.maps.InfoWindow();
                                                var myOptions = {
                                                    zoom: <?php echo $map_zoom; ?>,
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                };

                                                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                                geocoder.geocode( { 'location': latlng },
                                                        function(results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK)
                                                            {
                                                                map.setCenter(results[0].geometry.location);
                                                                var marker = new google.maps.Marker({
                                                                    map: map,
                                                                    position: results[0].geometry.location
                                                                });
                                                            }
                                                            else
                                                            {
                                                                alert("Geocode was not successful for the following reason: " + status);
                                                            }
                                                        });

                                            }

                                            initialize();

                                        </script>
                                    </div>
                                    <?php
                                }
                                ?>

                                <!-- separator -->
                                <hr class="separator">

                                <section id="contact-form">

                                    <h2 class="form-heading"><?php echo stripslashes(get_option('theme_contact_form_heading')); ?></h2>

                                    <p><?php echo stripslashes(get_option('theme_contact_form_text')); ?></p>

                                    <form  class="contact-form clearfix" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post" >

                                        <p class="adjust">
                                            <label for="name"><?php _e( 'Ваше имя', 'framework') ?> <span>*</span> </label>
                                            <input type="text" name="name" id="name" class="required"  value="" title="<?php _e( '* Пожалуйста, введите ваше имя', 'framework') ?>">
                                        </p>

                                        <p>
                                            <label for="pn"><?php _e( 'Телефон', 'framework') ?> </label>
                                            <input type="text" name="pn" id="pn"  value="">
                                        </p>

                                        <p class="adjust">
                                            <label for="email"><?php _e( 'Email', 'framework') ?> <span>*</span></label>
                                            <input type="text" name="email" id="email" class="email required"  value="" title="<?php _e( '* Пожалуйста, введите ваш email', 'framework') ?>">
                                        </p>

                                        <p>
                                            <label for="reason"><?php _e( 'Тема', 'framework') ?> </label>
                                            <input type="text" name="reason" id="reason"  value="">
                                        </p>


                                        <label for="message"><?php _e( 'Сообщение', 'framework') ?> <span>*</span> </label>
                                        <textarea name="message" id="message" class="required" title="<?php _e( '* Пожалуйста, введите ваше сообщение', 'framework') ?>"></textarea>

                                        <div class="captcha-container">
                                            <label><?php _e( 'Введите код', 'framework') ?></label>
                                            <img class="captcha-img" src="<?php echo get_template_directory_uri(); ?>/captcha/captcha.php" alt=""/>
                                            <input type="text" class="captcha required" name="captcha" maxlength="5" title="<?php _e( '* Пожалуйста, введите код указанный на картинке!', 'framework') ?>"/>
                                        </div>

                                        <input type="submit" name="submit" value="<?php _e( 'Отправить', 'framework') ?>" class="submit">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="contact-loader" alt="Loading...">

                                        <input type="hidden" name="action" value="send_message" />
                                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('send_message_nonce'); ?>"/>

                                    </form>

                                    <div class="error-container"></div>

                                    <p id="message-sent">&nbsp;</p>


                                </section>

                            </div><!-- End Main -->

                            <?php get_sidebar('contact'); ?>

                            <div class="container-bottom"></div>

                        </div> <!-- End Content-->

                    </div><!-- End Container -->


<?php get_footer(); ?>


