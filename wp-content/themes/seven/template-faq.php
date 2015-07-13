<?php
/*
*  Template Name: FAQ Template
*/ 
get_header(); ?>

                <!-- Start Container -->
                <div id="container">

                    <!-- Content -->
                    <div class="content full-width clearfix">

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


                                // Custom Query for FAQs
                                $faq_query = new WP_Query(array(
                                    'post_type' => 'faq',
                                    'posts_per_page' => -1
                                ));

                                if ( $faq_query->have_posts() && !post_password_required( $post ) ) :
                                    ?>
                                    <!-- separator -->
                                    <hr class="separator">

                                    <section>
                                        <dl class="toggle clearfix">
                                            <?php
                                            while ( $faq_query->have_posts() ) :
                                                $faq_query->the_post();
                                                ?>
                                                <dt><span></span><?php the_title(); ?></dt>
                                                <dd>
                                                    <?php the_content(); ?>
                                                </dd>
                                                <?php
                                            endwhile;
                                            ?>
                                        </dl>
                                    </section>
                                    <?php
                                endif;
                                ?>

                            </div><!-- End Main -->

                            <div class="container-bottom"></div>

                    </div> <!-- End Content-->

                </div><!-- End Container -->

<?php get_footer(); ?>
