<?php get_header(); ?>
                        <!-- Start Container -->		
                        <div id="container">           
                                
                                  <!-- Content -->
                                <div class="content right news clearfix">
                                  
                                        <div class="container-top"></div>

                                        <?php
                                        // Menu Heading
                                        get_template_part("template-parts/menu_head");
                                        ?>
                       
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
																				<small>
                                                                                        <?php the_taxonomies( array( 'post' => $post->ID, 'before' => '', 'sep' => ', ', 'after' => '', 'template' => '<span>%s:</span>  %l' )); ?>
																				</small>
																		</div>
                                                                        <div class="price"><span><?php echo get_post_meta( $post->ID, 'menu_price', true); ?></span></div>
																</header>																																
																
																<?php
																if ( has_post_thumbnail() )
																{																												
																		?>
																		<div class="post-thumb clearfix">													
																				<?php
																				$image_id = get_post_thumbnail_id();
																				$featured_image = wp_get_attachment_image_src( $image_id,'std-blog-thumbnail' );
																				
																				$theme_menu_use_lightbox = get_option('theme_menu_use_lightbox');
																				if($theme_menu_use_lightbox == 'true')
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

												<?php
												endwhile;
												endif;
												?>                                                                                                
                                        
                                        </div><!-- End Main -->                                       
                                        
										<?php get_sidebar('menu'); ?>
                                          
                                       <div class="container-bottom"></div>
              
                                </div> <!-- End Content-->				
                                                      
                        </div><!-- End Container -->

<?php get_footer(); ?>