<?php get_header(); ?>

                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content right news clearfix">
                                  
                                        <div class="container-top"></div>
                                          
                                        <section class="page-head">
                                                <h1>
                                                    <span><?php _e('Our Team','framework'); ?></span>
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
																
																<header class="clearfix">
																		<div class="post-head">
																				<h2 class="post-title">                                                                          
																						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                                                      
																				</h2>
                                                                                <h3 class="designation"><?php echo get_post_meta($post->ID,'designation',true); ?></h3>
																		</div>
																</header>																																
																
																<?php
																if ( has_post_thumbnail() )
																{																												

                                                                        $image_id = get_post_thumbnail_id();
                                                                        $featured_image = wp_get_attachment_image_src( $image_id,'team-special-thumbnail' );
                                                                        $full_image_url = wp_get_attachment_url($image_id);
                                                                        echo '<a href="'.$full_image_url.'" title="'.get_the_title().'" class="pretty-photo">';
                                                                        echo '<img class="alignleft" src="'.$featured_image[0].'" alt="'.get_the_title().'">';
                                                                        echo '</a>';
																}
																?>
																			
																<?php the_content(); ?>																							   																
																
														</article>  
														
														<?php wp_link_pages(array('before' => '<div class="pages-nav clearfix"><strong>'.__('Pages', 'framework').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
														
												<?php 
												endwhile;											
													comments_template();
												endif; 
												?>                                                                                                
                                        
                                        </div><!-- End Main -->                                       
                                        
										<?php get_sidebar(); ?>										                                        
                                          
                                       <div class="container-bottom"></div>
              
                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->
                                                						
                        
<?php get_footer(); ?>