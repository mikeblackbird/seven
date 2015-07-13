                        <?php
						$slides = array();
						
						for($i=1; $i<=5; $i++)
						{
							$temp_slide_img = get_option('theme_'.$i.'_slide_img'); 
							if(!empty($temp_slide_img))
							{
								$temp_slide = array();
								$temp_slide['img'] = $temp_slide_img;
								$temp_slide['link'] =  get_option('theme_'.$i.'_slide_link');
								$slides[] = $temp_slide;
							}
						}
						
						$slides_count = count($slides);												
						
						if($slides_count > 0)
						{						
							?>
							<!-- Slider-->
							<div class="slider-wrapper">
							
									<div class="flexslider"> 
													 
											<ul class="slides">                                               												
													<?php
													foreach($slides as $slide)
													{
														echo '<li><a href="'.$slide['link'].'"><img src="'.$slide['img'].'" alt=""></a></li>';
													}
													?>																							
											</ul>
																		
									</div> 
																
							</div>
							<!--End Slider-->
							<?php
						}
						?>
						