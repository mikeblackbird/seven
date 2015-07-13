<?php get_header(); ?>

                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content right news clearfix">
                                  
                                        <div class="container-top"></div>
                                          
                                        <section class="page-head">
											<?php
												$theme_blog_title = stripslashes(get_option('theme_blog_title'));
												
												if(!empty($theme_blog_title))
												{							
													?>
													<h1>
														<span><?php echo $theme_blog_title; ?></span>
													</h1>
													<?php
												}
											?>
                                        </section>              
                       
                                        <!-- Main -->
                                        <div id="main-content">
										    <?php
												if ( have_posts() ) :
												while ( have_posts() ) : 
												the_post();
                                                    get_template_part("template-parts/blog_post_for_list");
												endwhile;											
													theme_pagination( $wp_query->max_num_pages); 																
												else : 
													?>									
													<h2><?php _e('No Posts Found', 'framework'); ?></h2>
													<?php 
												endif; 
										    ?>
                                        </div><!-- End Main -->                                       
                                        
										<?php get_sidebar(); ?>										                                        
                                          
                                       <div class="container-bottom"></div>
              
                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->
                                                						
                        
<?php get_footer(); ?>