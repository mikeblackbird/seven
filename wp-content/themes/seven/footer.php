                        <!-- Start Footer -->
                        <div id="footer-wrapper">            
                                <footer id="footer">

										<!-- Footer Menu -->
										<nav id="footer-menu">												
												<?php 
												wp_nav_menu( array( 
													'theme_location' => 'footer-menu',
													'container' => false,
													'menu_class' => 'clearfix'
												)); 
												?>                     
										</nav>
										
										<?php										
										$show_social = get_option('theme_show_social_menu');
										
										if($show_social == 'true')
										{
                                                $sl_faceook = get_option('theme_facebook_link');
                                                $sl_twitter = get_option('theme_twitter_link');
                                                $sl_rss = get_option('theme_rss_link');
                                                $sl_mail = get_option('theme_mail_link');
                                                $sl_google = get_option('theme_google_link');
                                                $sl_linked = get_option('theme_linked_link');
                                                $sl_pinterest = get_option('theme_pinterest_link');
                                                $sl_instagram = get_option('theme_instagram_link');
                                                $sl_yahoo = get_option('theme_yahoo_link');
                                                $sl_vk = get_option('theme_vk_link');
		                        				?>         
												<!-- Social Icons -->                          
                                                <ul class="social-nav">
                                                    <?php
														echo ($sl_twitter) ? '<li class="twitter"><a target="_blank" href="'.$sl_twitter.'"></a></li>' : '';
														echo ($sl_faceook) ? '<li class="facebook"><a target="_blank" href="'.$sl_faceook.'"></a></li>' : '';
                                                        echo ($sl_google) ? '<li class="google-pluse"><a target="_blank" href="'.$sl_google.'"></a></li>' : '';
                                                        echo ($sl_pinterest) ? '<li class="pinterest"><a target="_blank" href="'.$sl_pinterest.'"></a></li>' : '';
                                                        echo ($sl_vk) ? '<li class="vk"><a target="_blank" href="'.$sl_vk.'"></a></li>' : '';
                                                        echo ($sl_instagram) ? '<li class="instgram"><a target="_blank" href="'.$sl_instagram.'"></a></li>' : '';
                                                        echo ($sl_yahoo) ? '<li class="yahoo"><a target="_blank" href="'.$sl_yahoo.'"></a></li>' : '';
														echo ($sl_mail) ? '<li class="mail"><a target="_blank" href="mailto:'.$sl_mail.'"></a></li>' : '';
                                                        echo ($sl_linked) ? '<li class="in"><a target="_blank" href="'.$sl_linked.'"></a></li>' : '';
														echo ($sl_rss) ? '<li class="rss"><a target="_blank" href="'.$sl_rss.'"></a></li>' : '';
													?>
                                                </ul>
                                				<?php 
										} 
										?>																				
		
										<address><?php echo stripslashes(get_option('theme_footer_address_text')); ?></address>
										<p class="copyright"><?php echo stripslashes(get_option('theme_copyright_text')); ?></p>		

                                </footer>
                        </div><!-- End Footer -->
						
                </div><!-- End Page wrap -->

				<a href="#top" id="scroll-top"></a>

                <?php get_template_part("js/localized-js"); ?>

                <?php wp_footer(); ?>
        </body>
</html>