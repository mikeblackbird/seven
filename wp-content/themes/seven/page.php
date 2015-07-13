<?php get_header(); ?>

                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content right clearfix">
                                  
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
																if ( has_post_thumbnail() )
																{																												
																		?>
																		<div class="post-thumb clearfix">													
																				<?php
																				$image_id = get_post_thumbnail_id();
																				$featured_image = wp_get_attachment_image_src( $image_id,'std-blog-thumbnail' );
																				
																				$theme_use_lightbox = get_option('theme_use_lightbox');
																				if($theme_use_lightbox == 'true')
																				{																	
																					$full_image_url = wp_get_attachment_url($image_id);																																		
																					echo '<a href="'.$full_image_url.'" title="'.get_the_title().'" class="pretty-photo">';																	
																					echo '<img src="'.$featured_image[0].'" alt="'.get_the_title().'">';
																					echo '</a>';
																				}
																				else
																				{
																					echo '<a href="'.get_permalink().'" title="'.get_the_title().'" >';
																					echo '<img src="'.$featured_image[0].'" alt="'.get_the_title().'">';
																					echo '</a>';
																				}
																				?>												
																		</div><!-- end of post thumb -->
																		<?php
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

                                        <?php get_sidebar('page'); ?>
                                          
                                       <div class="container-bottom"></div>
              
                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->
                        
<?php get_footer(); ?>