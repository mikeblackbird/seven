<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
		<head>
				<!-- META TAGS -->
				<meta charset="<?php bloginfo( 'charset' ); ?>" />
				<meta name="viewport" content="width=device-width" />
				
				<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
                				               				                
                <?php
				$favicon = get_option('theme_favicon');
				if( !empty($favicon) )
				{
					?>
					<!-- FAVICON -->
					<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
					<?php
				}
				?>
                
                
				<!-- Google Web Fonts-->
                <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>


				<!-- Style Sheet-->
				<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>                                         
                
                <!-- Pingback URL -->
                <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
                
                <!-- RSS -->
                <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
                <link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />                                
                
                <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

                
                <!--[if lt IE 9]>
	           		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	    		<![endif]-->
				
				<!--[if (gte IE 6)&(lte IE 8)]>
				<script defer src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.4-min.js"></script>
				<script defer src="<?php echo get_template_directory_uri(); ?>/js/the-tooltip/selectivizr-min.js"></script>
				<![endif]-->
				
                
                <?php 
				// Google Analytics From Theme Options
				echo stripslashes(get_option('theme_google_analytics')); 
				?>

                <?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>				
        		
				<!-- Start wrap -->    
                <div id="page-content-wrap">
                
                        <!-- Start Header -->
                        <div id="header-wrapper"> 
                                   
                                <header id="header">

										<?php
										$theme_address_text = get_option('theme_address_text');
										
										if(!empty($theme_address_text))
										{
											?>
											 <h6><?php echo stripslashes($theme_address_text); ?></h6>
											<?php
										}
										?>
										
                                        <!--Left Menu -->
                                        <nav class="main-menu left clearfix">  
												<?php 
												wp_nav_menu( array( 
													'theme_location' => 'left-main-menu',
													'container' => 'div',
													'menu_class' => 'clearfix'
												)); 
												?>                                                                                      
                                        </nav>  

                                        <!-- Header Logo -->
                                        <div id="logo">                        
												<!-- Website Logo -->
												<a href="<?php echo home_url(); ?>"  title="<?php bloginfo( 'name' ); ?>">                                    	
													<?php 
													$logo_path = get_option('theme_sitelogo'); 
													
													if(!empty($logo_path))
													{
														?>
														<img src="<?php echo $logo_path; ?>" alt="<?php  bloginfo( 'name' ); ?>">
														<?php
													}
													?>
												</a>                    
                                        </div>	

                                        <!-- Right Menu -->
                                        <nav class="main-menu right clearfix">                    
                                                <?php 
												wp_nav_menu( array( 
													'theme_location' => 'right-main-menu',
													'container' =>  'div',
													'menu_class' => 'clearfix'
												)); 
												?>                   
                                        </nav>
                                                           
                                </header>
                                
                        </div>
						<!-- End Header -->
                        
						<?php
						if( is_page_template('template-home.php') )
						{
							get_template_part( 'sliders/slider' );
						}
						?>						
						
                        <!-- Bottom Strip -->
                        <div class="bottom-strip-wrapper">
                                <div class="bottom-strip">
                                        <p>
											<?php
											$theme_reservation_text = get_option('theme_reservation_text');
											$theme_reservation_button_text = get_option('theme_reservation_button_text');
											$theme_reservation_button_link = get_option('theme_reservation_button_link');
											
											if(!empty($theme_reservation_text))
											{
												echo '<span>'.stripslashes($theme_reservation_text).'</span>';
											}
											
											if(!empty($theme_reservation_button_text))
											{
												echo '<a href="'.$theme_reservation_button_link.'">'.stripslashes($theme_reservation_button_text).'</a>';
											}
											?>                                 
                                        </p>
                                </div>
                        </div>
				
				
				