<?php get_header(); ?>

                <!-- Start Container -->
                <div id="container">

                        <!-- Content -->
                        <div class="content our-menu clearfix">

                            <div class="container-top"></div>

                            <?php
                            // Menu Heading
                            get_template_part("template-parts/menu_head");
                            ?>

                            <!-- Main -->
                            <div id="main-content">

                                    <h2 class="title-heading">
                                        <?php
                                        $current_term = get_term_by( 'slug', get_query_var('term') ,'menu-item-type' );
                                        echo $current_term->name ;
                                        ?>
                                    </h2>

                                    <?php
                                    /* Change Default Query to Display All Menu Items */
                                    global $wp_query;
                                    $args = array_merge( $wp_query->query_vars, array( 'nopaging' => true ) );
                                    query_posts( $args );

                                    if(have_posts()):
                                        while(have_posts()):
                                            the_post();
                                            get_template_part("template-parts/menu_item_for_list");
                                        endwhile;
                                    endif;

                                    ?>

                            </div><!-- End Main -->

                            <?php get_sidebar('menu'); ?>

                            <div class="container-bottom"></div>

                        </div> <!-- End Content-->

                </div><!-- End Container -->
						                        
<?php get_footer(); ?>