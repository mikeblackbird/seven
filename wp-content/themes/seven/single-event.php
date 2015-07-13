<?php get_header(); ?>

                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content event-single clearfix">
                                  
                                        <div class="container-top"></div>
                                          
                                        <section class="page-head">
												<?php                                
												$theme_event_title = stripslashes(get_option('theme_event_title'));
												
												if(!empty($theme_event_title))
												{							
													?>
													<h1>
														<span><?php echo $theme_event_title; ?></span>
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

                                                $startd = get_post_meta($post->ID,'event_startdate',true);
                                                $endd = get_post_meta($post->ID,'event_enddate',true);

                                                $date_format = get_option('date_format');
                                                $time_format = get_option('time_format');

                                                $startdate = date($date_format, $startd);
                                                $enddate = date($date_format, $endd);

                                                $starttime = date($time_format, $startd);
                                                $endtime = date($time_format, $endd);

														?>																										
														<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

																<div class="article-date">
																	<?php echo date('M', $startd);  ?>
																	<span><?php echo date('j', $startd); ?></span>
																</div>

																<header class="post-head clearfix">

                                                                    <h2 class="post-title">
                                                                        <?php the_title(); ?>
                                                                    </h2>

                                                                    <p>
                                                                        <small>
                                                                            <?php
                                                                            if($startdate == $enddate):
                                                                                ?>
                                                                                <span><?php _e('Start Date:', 'framework'); ?> </span> <?php echo $startdate; ?>
                                                                                <?php
                                                                            else:
                                                                                ?>
                                                                                <span><?php _e('Dates:', 'framework'); ?> </span> <?php echo $startdate; ?> <span><?php _e('-', 'framework'); ?></span> <?php echo $enddate; ?>
                                                                                <?php
                                                                            endif;
                                                                            ?>
                                                                            <br/>
                                                                            <span><?php _e('Time:', 'framework'); ?> </span> <?php echo $starttime; ?>  <span><?php _e('-', 'framework'); ?></span>  <?php echo $endtime; ?>
                                                                        </small>
                                                                    </p>
																																																																								
																</header>																																
																
																<?php
																if ( has_post_thumbnail() )
																{																												
																		?>
																		<div class="post-thumb clearfix">													
																				<?php
																				$image_id = get_post_thumbnail_id();
																				$featured_image = wp_get_attachment_image_src( $image_id,'std-blog-thumbnail' );
																				
																				$theme_event_use_lightbox = get_option('theme_event_use_lightbox');
																				if($theme_event_use_lightbox == 'true')
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
                                        
										<?php get_sidebar('event'); ?>
                                          
                                       <div class="container-bottom"></div>

                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->
                                                						
                        
<?php get_footer(); ?>