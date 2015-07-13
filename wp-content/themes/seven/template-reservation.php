<?php
/*
*	Template Name: Reservation Template
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
                                            <?php the_content(); ?>
                                        </article>
                                        <?php
                                    endwhile;
                                endif;
                                ?>

                                <!-- separator -->
                                <hr class="separator">

                                <section id="reservation-form">

                                    <h2 class="title-heading"><?php echo stripslashes(get_option('theme_reservation_form_heading')); ?></h2>

                                    <p><?php echo stripslashes(get_option('theme_reservation_form_text')); ?></p>

                                    <form class="contact-form  clearfix" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post">

                                        <p class="adjust">
                                            <label for="name"><?php _e('Имя', 'framework'); ?><span>*</span> </label>
                                            <input type="text" name="name" id="name" class="required"  value="" title="<?php _e( '* Пожалуйста, введите ваше имя', 'framework'); ?>">
                                        </p>

                                        <p>
                                            <label for="pn"><?php _e( 'Телефон', 'framework'); ?><span>*</span></label>
                                            <input type="text" name="pn" class="required" id="pn"  value="" title="<?php _e( '* Пожалуйста, введите ваш телефон', 'framework'); ?>">
                                        </p>

                                        <p class="adjust">
                                            <label for="email"><?php _e( 'Email', 'framework'); ?></label>
                                            <input type="text" name="email" id="email" class=" email"  value="" title="<?php _e( 'Пожалуйста, введите ваш email', 'framework'); ?>">
                                        </p>

                                        <p>
                                            <label for="guests"><?php _e( 'Количество гостей', 'framework'); ?></label>
                                            <input type="text" name="guests" id="guests" class=""  value="" title="<?php _e( 'Количество гостей', 'framework'); ?>">
                                        </p>


                                        <p class="adjust">
                                            <label for="date"><?php _e( 'Дата', 'framework'); ?><span>*</span></label>
                                            <input type="text" name="date" id="date" class="required"  value="" title="<?php _e( '* Пожалуйста, выберите дату бронирования', 'framework'); ?>">
                                        </p>

                                        <p>
                                            <label for="time"><?php _e( 'Время', 'framework'); ?></label>
                                            <input type="text" name="time" id="time" class=""  value="" title="<?php _e( 'Введите время', 'framework'); ?>">
                                        </p>

                                        <label for="message"><?php _e( 'Пожелания', 'framework'); ?></label>
                                        <textarea name="message" id="message"></textarea>

                                        <div class="captcha-container">
                                            <label><?php _e( 'Введите код', 'framework'); ?></label>
                                            <img class="captcha-img" src="<?php echo get_template_directory_uri(); ?>/captcha/reservation_captcha.php" alt=""/>
                                            <input type="text" class="captcha required" name="captcha" maxlength="5" title="<?php _e( '* Пожалуйста, введите код с картинки', 'framework'); ?>"/>
                                        </div>

                                        <input type="submit" name="submit" value="<?php _e( 'Забронировать', 'framework'); ?>" class="readmore">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="contact-loader" alt="<?php _e( 'Loading...', 'framework'); ?>">

                                        <input type="hidden" name="action" value="make_reservation" />
                                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('send_reservation_nonce'); ?>"/>

                                    </form>

                                    <div class="error-container"></div>
                                    <p id="message-sent">&nbsp;</p>

                                </section>

                            </div><!-- End Main -->

                            <?php// get_sidebar(); ?>

                            <div class="container-bottom"></div>

                        </div> <!-- End Content-->

                    </div><!-- End Container -->


<?php get_footer(); ?>


