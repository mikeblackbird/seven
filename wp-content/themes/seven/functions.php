<?php
session_start();

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/	
        load_theme_textdomain( 'framework' );
	
	

/*-----------------------------------------------------------------------------------*/
/*	Include Theme Options Framework
/*-----------------------------------------------------------------------------------*/	
		require_once(get_template_directory() . '/admin/admin-functions.php');
		require_once(get_template_directory() . '/admin/admin-interface.php');
		require_once(get_template_directory() . '/admin/theme-settings.php');



/*-----------------------------------------------------------------------------------*/
/*	Include Theme Functions for Various Important Features
/*-----------------------------------------------------------------------------------*/
        require_once(get_template_directory() . '/functions/reservation_form_handler.php');
        require_once(get_template_directory() . '/functions/contact_form_handler.php');
        require_once(get_template_directory() . '/functions/load_theme_styles.php');
        require_once(get_template_directory() . '/functions/load_theme_scripts.php');
        require_once(get_template_directory() . '/functions/theme_comment.php');



/*-----------------------------------------------------------------------------------*/
/*	Add Custom Background
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'custom-background' );



/*-----------------------------------------------------------------------------------*/
/*	Add Automatic Feed Links Support
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'automatic-feed-links' );



/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Type For Services
/*-----------------------------------------------------------------------------------*/	
		require_once ( get_template_directory() . '/include/menu-item-post-type.php' );
        require_once ( get_template_directory() . '/include/event-post-type.php' );
        require_once ( get_template_directory() . '/include/team-member-post-type.php' );
		require_once ( get_template_directory() . '/include/gallery-post-type.php' );
        require_once ( get_template_directory() . '/include/faq-post-type.php' );




/*-----------------------------------------------------------------------------------*/
/*	Include Meta Boxes
/*-----------------------------------------------------------------------------------*/	
        require_once( get_template_directory() . '/include/meta-box.php');




/*-----------------------------------------------------------------------------------*/	
//	Widgets
/*-----------------------------------------------------------------------------------*/
		require_once( get_template_directory() . '/widgets/' . 'recent-posts-widget.php');
		require_once( get_template_directory() . '/widgets/' . 'menu-item-types-widget.php');
		require_once( get_template_directory() . '/widgets/' . 'featured-menu-items-widget.php');
		require_once( get_template_directory() . '/widgets/' . 'upcoming-events-widget.php');



/*-----------------------------------------------------------------------------------*/
//	Register Widgets
/*-----------------------------------------------------------------------------------*/
		add_action( 'widgets_init', 'register_theme_widgets' );
		
		function register_theme_widgets() {
				register_widget( 'Recent_Posts_With_Thumb' );
				register_widget( 'Menu_Item_Types_Widget' );
				register_widget( 'Featured_Menu_Items_Widget' );
				register_widget( 'Upcoming_Events_Widget' );
		}



/*-----------------------------------------------------------------------------------*/
//	Shortcodes
/*-----------------------------------------------------------------------------------*/
	    require_once( get_template_directory() . '/include/shortcodes/columns.php' );
		require_once( get_template_directory() . '/include/shortcodes/elements.php' );
		require_once( get_template_directory() . '/include/shortcodes/theme_related.php' );		



/*-----------------------------------------------------------------------------------*/
//	Dynamic CSS
/*-----------------------------------------------------------------------------------*/
	    require_once( get_template_directory() . '/css/dynamic-css.php' );



/*-----------------------------------------------------------------------------------*/
/*	Adding Default Thumbnail Sizes
/*-----------------------------------------------------------------------------------*/
		if( function_exists( 'add_theme_support' ) ) 
		{				
				add_theme_support( 'post-thumbnails' );
								
				// For blog
				add_image_size( 'std-blog-thumbnail', 548, 9999); // For Standard Post Thumbnails
				
				// For Menu
				add_image_size( 'std-menu-thumbnail', 110, 90, true); // For Our Menu Template
				add_image_size( 'square-menu-thumbnail', 89, 89, true); // For Menu Carousel
                add_image_size( 'small-menu-thumbnail', 50, 50, true); // For Menu sidebar widget

                // For Team
                add_image_size( 'team-special-thumbnail', 310, 9999); // For Special Team Member
                add_image_size( 'team-member-thumbnail', 170, 9999); // For Standard Team Member

                // for gallery
                add_image_size( 'gallery-4-columns', 178, 108, true);	// for gallery 4 columns
                add_image_size( 'gallery-3-columns', 241, 147, true);	// for gallery 3 columns
                add_image_size( 'gallery-2-columns', 383, 233, true);	// for gallery 2 columns
                add_image_size( 'gallery-single', 808, 9999 );	// for gallery detail page
		}
				
	


/*-----------------------------------------------------------------------------------*/
/*	Enables Wigitized Sidebars
/*-----------------------------------------------------------------------------------*/
		if ( function_exists('register_sidebar') ){

				// Location: Blog Sidebar
				register_sidebar(array(
                        'id' => 'sidebar-1',
                        'name'=>'Blog Sidebar',
                        'before_widget' => '<section class="widget">',
                        'after_widget' => '</section>',
                        'before_title' => '<h3 class="title">',
                        'after_title' => '</h3>'
				));


                // Location: Page Sidebar
                register_sidebar(array(
                        'id' => 'sidebar-2',
                        'name'=>'Pages Sidebar',
                        'before_widget' => '<section class="widget">',
                        'after_widget' => '</section>',
                        'before_title' => '<h3 class="title">',
                        'after_title' => '</h3>'
                ));


				// Location: Our Menu Sidebar
				register_sidebar(array(
                        'id' => 'sidebar-3',
                        'name'=>'Our Menu Sidebar',
						'before_widget' => '<section class="widget">',
						'after_widget' => '</section>',
						'before_title' => '<h3 class="title">',
						'after_title' => '</h3>'
				));


                // Location: Event Sidebar
                register_sidebar(array(
                        'id' => 'sidebar-4',
                        'name'=>'Event Sidebar',
                        'before_widget' => '<section class="widget">',
                        'after_widget' => '</section>',
                        'before_title' => '<h3 class="title">',
                        'after_title' => '</h3>'
                ));


				// Location: Contact Sidebar
				register_sidebar(array(
                        'id' => 'sidebar-5',
                        'name'=>'Contact Sidebar',
						'before_widget' => '<section class="widget">',
						'after_widget' => '</section>',
						'before_title' => '<h3 class="title">',
						'after_title' => '</h3>'
				));


		}



/*-----------------------------------------------------------------------------------*/
/*	Creating Menu Places
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'menus' );
		if ( function_exists( 'register_nav_menus' ) ) {
			  	register_nav_menus(
				  		array(
				  		  'left-main-menu' => 'Left Side Main Menu',
						  'right-main-menu' => 'Right Side Main Menu',
						  'footer-menu' => 'Footer Menu'
				  		)
			  	);
		}



/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Method
/*-----------------------------------------------------------------------------------*/
		function framework_excerpt($len=15, $trim="&hellip;"){
			  	
				$limit = $len+1;
			  	$excerpt = explode(' ', get_the_excerpt(), $limit);
			  	$num_words = count($excerpt);
			  	if($num_words >= $len){
					
			  		$last_item = array_pop($excerpt);
			  	
				}
			  	else {
			  		
					$trim = "";
			  	
				}
				
			  	$excerpt = implode(" ",$excerpt)."$trim";
			  	
			  	echo $excerpt;
				
	  	}
	  	
	  	function get_framework_excerpt($len=15, $trim="&hellip;"){
			
	  		$limit = $len+1;
	  		$excerpt = explode(' ', get_the_excerpt(), $limit);
	  		$num_words = count($excerpt);
		  	if($num_words >= $len){
		  			$last_item=array_pop($excerpt);
		  	}
		  	else{
				
		  		$trim="";
		  	
			}
			
	  		$excerpt = implode(" ",$excerpt)."$trim";
	  
	  		return $excerpt;
	  	}



/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/

    if ( ! isset( $content_width ) ) $content_width = 560;



/*-----------------------------------------------------------------------------------*/
//	Theme Pagination Method
/*-----------------------------------------------------------------------------------*/
	
	function theme_pagination($pages = ''){
		global $paged;
		$paged = get_query_var( 'paged' );
		
		if(empty($paged))$paged = 1;
		
		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 2; // only change it to show more links
		$showitems = ($range * 2)+1;
		
		if($pages == '')
		{	
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if(!$pages)
				{
						$pages = 1;
				}
		}
		
		
		if(1 != $pages){
				echo "<div id='pagination'>";
				echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='readmore'>&laquo; ".__('First', 'framework')."</a> ":"";
				echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='readmore'>&laquo; ". __('Previous', 'framework')."</a> ":"";
				
					
				for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='readmore current'>".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='readmore'>".$i."</a> "; 
						}
				}
				
				echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='readmore'>". __('Next', 'framework') ." &raquo;</a> " :"";
				echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='readmore'>". __('Last', 'framework') ." &raquo;</a> ":"";
				echo "</div>";
				}
	}



/*-----------------------------------------------------------------------------------*/
//	Redirect User to Theme Options Page after Theme Activation
/*-----------------------------------------------------------------------------------*/
    global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    {
        wp_redirect( admin_url( 'admin.php?page=siteoptions' ) );
        exit;
    }
	
	

/*-----------------------------------------------------------------------------------*/
/*	Get first Term with link
/*-----------------------------------------------------------------------------------*/	

	function get_first_term_with_link( $post_id, $taxonomy)
	{
		$link = '';		
		$terms = get_the_terms( $post_id, $taxonomy );					
		if ( $terms && ! is_wp_error( $terms ) ) :
			foreach ( $terms as $term ) 
			{				
				$link = '<a href="'.get_term_link($term->slug, $taxonomy).'">'.$term->name.'</a>';
				break;
			}			
			return $link;										
		endif; 
		
		return $link;
	}	



/*-----------------------------------------------------------------------------------*/
/*	Remove rel attribute from the category list
/*-----------------------------------------------------------------------------------*/	

    function remove_category_list_rel($output)
	{
		$output = str_replace(' rel="category tag"', '', $output);
		return $output;
	}
	add_filter('wp_list_categories', 'remove_category_list_rel');
	add_filter('the_category', 'remove_category_list_rel');
		


/*-----------------------------------------------------------------------------------*/
/*	Custom Title
/*-----------------------------------------------------------------------------------*/

    function get_custom_title( $ID , $len=20 )
    {

        $title = get_the_title($ID);

        if( strlen($title) <= ( $len + 2 ) )
        {
            return $title;
        }
        else
        {
            return substr( $title, 0, $len ) . '..';
        }

    }
show_admin_bar(false);
?>