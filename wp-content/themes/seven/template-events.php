<?php
/*
 *  Template Name: All Events
 */

get_header(); ?>

                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content event-listing clearfix">
                                  
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



                                            // - query -
                                            global $wpdb;

                                            $querystr =    "SELECT * FROM $wpdb->posts wposts, $wpdb->postmeta metastart, $wpdb->postmeta metaend
                                                            WHERE (wposts.ID = metastart.post_id AND wposts.ID = metaend.post_id)
                                                            AND metaend.meta_key = 'event_enddate'
                                                            AND metastart.meta_key = 'event_enddate'
                                                            AND wposts.post_type = 'event'
                                                            AND wposts.post_status = 'publish'
                                                            ORDER BY metastart.meta_value DESC";

                                            $events = $wpdb->get_results($querystr, OBJECT);

											if ($events):
                                            global $post;
                                            foreach ($events as $post):
                                                setup_postdata($post);
                                                get_template_part("template-parts/event_for_list");
                                            endforeach;
                                            else :
                                                ?>
                                                <h3><?php _e('No Event Found !', 'framework'); ?></h3>
                                                <?php
                                            endif;
											?>
                                        
                                        </div><!-- End Main -->                                       
                                        
										<?php get_sidebar('event'); ?>
                                          
                                       <div class="container-bottom"></div>
              
                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->
                                                						
                        
<?php get_footer(); ?>