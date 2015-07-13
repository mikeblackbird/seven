<?php
add_action('init','of_options');

if (!function_exists('of_options')) 
{
		
	function of_options()
	{

		/*
		*	Theme Shortname
		*/
		$themename = "theme";
		$shortname = "theme";

		/*
		*	Populate the options array
		*/
		global $tt_options;
		
		$tt_options = get_option('of_options');

		/*
		*	Access the WordPress Pages via an Array
		*/
		$tt_pages = array();
		
		$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		
		foreach ($tt_pages_obj as $tt_page) 
		{
			$tt_pages[$tt_page->ID] = $tt_page->post_name; 
		}
		
		$tt_pages_tmp = array_unshift($tt_pages, "Select a page:" ); 


		/*
		*	Access the WordPress Categories via an Array
		*/
		$tt_categories = array();  
		
		$tt_categories_obj = get_categories('hide_empty=0');
		
		foreach ($tt_categories_obj as $tt_cat) 
		{
			$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;
		}
		
		$categories_tmp = array_unshift($tt_categories, "Select a category:");


		/*
		*	Sample Array for demo purposes
		*/
		$sample_array = array("1","2","3","4","5");


		/*
		*	Sample Advanced Array - The actual value differs from what the user sees
		*/
		$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 


		/*
		*	Folder Paths for "type" => "images"
		*/
		$sampleurl =  get_template_directory_uri() . '/admin/images/sample-layouts/';




/*-----------------------------------------------------------------------------------*/
/* Create The Custom Theme Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall



/* Option Page - Header Options */
$options[] = array( "name" => __('Header','framework'),
			"type" => "heading");
			

$options[] = array( "name" => __('Logo','framework'),
			"desc" => __('Upload logo for your Website.','framework'),
			"id" => $shortname."_sitelogo",
			"std" => "",
			"type" => "upload");
			
			
$options[] = array( "name" => __('Favicon','framework'),
			"desc" => __('Upload a 16px by 16px PNG image that will represent your website favicon.','framework'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Address Text','framework'),
			"desc" => __("Provide header address text.",'framework'),
			"id" => $shortname."_address_text",
			"std" => __("Las Angeles, AV 123456 - 123.456.7800", "framework"),
			"type" => "text");

$options[] = array( "name" => __('Reservation Text','framework'),
			"desc" => __("Provide header reservation text.",'framework'),
			"id" => $shortname."_reservation_text",
			"std" => __("Call 023 7526 8539  or Make Online Reservation", "framework"),
			"type" => "text");

$options[] = array( "name" => __('Reservation Button Text','framework'),
			"desc" => __("Provide header reservation button text.",'framework'),
			"id" => $shortname."_reservation_button_text",
			"std" => __("MAKE  RESERVATION NOW", "framework"),
			"type" => "text");			

$options[] = array( "name" => __('Reservation Button Target Link','framework'),
			"desc" => __("Provide header reservation button target link.",'framework'),
			"id" => $shortname."_reservation_button_link",
			"std" => __("#", "framework"),
			"type" => "text");

$options[] = array( "name" => __('Tracking Code','framework'),
			"desc" => __('Paste Google Analytics (or other) tracking code here.','framework'),
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea");


/* Option Page - Header Options */
$options[] = array( "name" => __('Slider','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Slide Image Size','framework'),
			"desc" => "",
			"id" => $shortname."_slider_img_size",
			"std" => "This theme provides fullwidth flexible image slider and demo of this theme uses images with <strong>2000px Width and 800px Height</strong>. So, it is recommeded that you use the same size or even bigger size with same width and height ratio. So, that your site looks good even on very big screens.",
			"type" => "info");				

$options[] = array( "name" => __('1st Slide Image','framework'),
			"desc" => __('Upload 1st slide image for homepage slider.','framework'),
			"id" => $shortname."_1_slide_img",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('1st Slide Target Link','framework'),
			"desc" => __("Provide 1st slide target link.",'framework'),
			"id" => $shortname."_1_slide_link",
			"std" => __("#", "framework"),
			"type" => "text");			

$options[] = array( "name" => __('2nd Slide Image','framework'),
			"desc" => __('Upload 2nd slide image for homepage slider.','framework'),
			"id" => $shortname."_2_slide_img",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('2nd Slide Target Link','framework'),
			"desc" => __("Provide 2nd slide target link.",'framework'),
			"id" => $shortname."_2_slide_link",
			"std" => __("#", "framework"),
			"type" => "text");	

$options[] = array( "name" => __('3rd Slide Image','framework'),
			"desc" => __('Upload 3rd slide image for homepage slider.','framework'),
			"id" => $shortname."_3_slide_img",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('3rd Slide Target Link','framework'),
			"desc" => __("Provide 3rd slide target link.",'framework'),
			"id" => $shortname."_3_slide_link",
			"std" => __("#", "framework"),
			"type" => "text");	

$options[] = array( "name" => __('4th Slide Image','framework'),
			"desc" => __('Upload 4th slide image for homepage slider.','framework'),
			"id" => $shortname."_4_slide_img",
			"std" => "",
			"type" => "upload");									

$options[] = array( "name" => __('4th Slide Target Link','framework'),
			"desc" => __("Provide 4th slide target link.",'framework'),
			"id" => $shortname."_4_slide_link",
			"std" => __("#", "framework"),
			"type" => "text");	
			
$options[] = array( "name" => __('5th Slide Image','framework'),
			"desc" => __('Upload 5th slide image for homepage slider.','framework'),
			"id" => $shortname."_5_slide_img",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('5th Slide Target Link','framework'),
			"desc" => __("Provide 5th slide target link.",'framework'),
			"id" => $shortname."_5_slide_link",
			"std" => __("#", "framework"),
			"type" => "text");


/* Option Page - Header Options */

$options[] = array( "name" => __('Home','framework'),
            "type" => "heading");

$options[] = array( "name" => __('Do you want to display three columns section on homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_three_columns",
            "std" => "true",
            "type" => "checkbox");

/* 1st Column */
$options[] = array( "name" => __('1st Column Heading','framework'),
            "desc" => __('Provide 1st Column Heading Text.','framework'),
            "id" => $shortname."_1_column_heading",
            "std" => __('About Elegantia','framework'),
            "type" => "text");

$options[] = array( "name" => __('1st Column Image','framework'),
            "desc" => __('Upload 1st column image for homepage. Recommended image size is 226px by 116px.','framework'),
            "id" => $shortname."_1_column_img",
            "std" => "",
            "type" => "upload");

$options[] = array( "name" => __('1st Column Sub Heading','framework'),
            "desc" => __('Provide 1st Column Sub Heading Text.','framework'),
            "id" => $shortname."_1_column_sub_heading",
            "std" => __('Elegantia Introduction','framework'),
            "type" => "text");

$options[] = array( "name" => __('1st Column Text Content','framework'),
            "desc" => __('Provide 1st Column Text Content.','framework'),
            "id" => $shortname."_1_column_text",
            "std" => "",
            "type" => "textarea");

$options[] = array( "name" => __('1st Column Read More Text','framework'),
            "desc" => __('Provide 1st Column Read More Text.','framework'),
            "id" => $shortname."_1_column_link_txt",
            "std" => __('READ MORE','framework'),
            "type" => "text");

$options[] = array( "name" => __('1st Column Read More Link','framework'),
            "desc" => __('Provide 1st Column Read More link.','framework'),
            "id" => $shortname."_1_column_link",
            "std" => "#",
            "type" => "text");

/* 2nd Column */
$options[] = array( "name" => __('2nd Column Heading','framework'),
            "desc" => __('Provide 2nd Column Heading Text.','framework'),
            "id" => $shortname."_2_column_heading",
            "std" => __('Our Menu','framework'),
            "type" => "text");

$options[] = array( "name" => __('2nd Column Image','framework'),
            "desc" => __('Upload 2nd column image for homepage. Recommended image size is 226px by 116px.','framework'),
            "id" => $shortname."_2_column_img",
            "std" => "",
            "type" => "upload");

$options[] = array( "name" => __('2nd Column Sub Heading','framework'),
            "desc" => __('Provide 2nd Column Sub Heading Text.','framework'),
            "id" => $shortname."_2_column_sub_heading",
            "std" => __('Elegantia Food','framework'),
            "type" => "text");

$options[] = array( "name" => __('2nd Column Text Content','framework'),
            "desc" => __('Provide 2nd Column Text Content.','framework'),
            "id" => $shortname."_2_column_text",
            "std" => "",
            "type" => "textarea");

$options[] = array( "name" => __('2nd Column Read More Text','framework'),
            "desc" => __('Provide 2nd Column Read More Text.','framework'),
            "id" => $shortname."_2_column_link_txt",
            "std" => __('READ MORE','framework'),
            "type" => "text");

$options[] = array( "name" => __('2nd Column Read More Link','framework'),
            "desc" => __('Provide 2nd Column Read More link.','framework'),
            "id" => $shortname."_2_column_link",
            "std" => "#",
            "type" => "text");


/* 3rd Column */
$options[] = array( "name" => __('3rd Column Heading','framework'),
            "desc" => __('Provide 3rd Column Heading Text.','framework'),
            "id" => $shortname."_3_column_heading",
            "std" => __('Special Events','framework'),
            "type" => "text");

$options[] = array( "name" => __('3rd Column Image','framework'),
            "desc" => __('Upload 3rd column image for homepage. Recommended image size is 226px by 116px.','framework'),
            "id" => $shortname."_3_column_img",
            "std" => "",
            "type" => "upload");

$options[] = array( "name" => __('3rd Column Sub Heading','framework'),
            "desc" => __('Provide 3rd Column Sub Heading Text.','framework'),
            "id" => $shortname."_3_column_sub_heading",
            "std" => __('Elegantia Events','framework'),
            "type" => "text");

$options[] = array( "name" => __('3rd Column Text Content','framework'),
            "desc" => __('Provide 3rd Column Text Content.','framework'),
            "id" => $shortname."_3_column_text",
            "std" => "",
            "type" => "textarea");

$options[] = array( "name" => __('3rd Column Read More Text','framework'),
            "desc" => __('Provide 3rd Column Read More Text.','framework'),
            "id" => $shortname."_3_column_link_txt",
            "std" => __('READ MORE','framework'),
            "type" => "text");

$options[] = array( "name" => __('3rd Column Read More Link','framework'),
            "desc" => __('Provide 3rd Column Read More link.','framework'),
            "id" => $shortname."_3_column_link",
            "std" => "#",
            "type" => "text");


$options[] = array( "name" => __('Do you want to display featured menu items on homepage ?','framework'),
            "desc" => __('Yes','framework'),
            "id" => $shortname."_display_menu_items",
            "std" => "true",
            "type" => "checkbox");

$options[] = array( "name" => __('Testimonial Text','framework'),
            "desc" => __('Provide testimonial text here.','framework'),
            "id" => $shortname."_testimonial_text",
            "std" => "",
            "type" => "textarea");

$options[] = array( "name" => __('Testimonial Author','framework'),
            "desc" => __('Provide testimonial author name here.','framework'),
            "id" => $shortname."_testimonial_author",
            "std" => "",
            "type" => "text");





/* Option Page - Styling */

$options[] = array( "name" => __('Styling','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Body Background','framework'),
			"desc" => "",
			"id" => $shortname."_background_callout",
			"std" => "This theme uses WordPress standard way to change background image or background color of body. Please visit <strong>Appearance >> Background</strong> page to change body background. ",
			"type" => "info");															

$options[] = array( "name" => __('Body Text Color','framework'),
			"desc" => __('Choose a Body Text Color. Base Theme Color is #909090','framework'),
			"id" => $shortname."_body_text_color",
			"std" => "#909090",
			"type" => "color");

$options[] = array( "name" => __('Headings Color','framework'),
			"desc" => __('Choose a Color for h1, h2, h3, h4, h5 and h6 tags. Base Theme Color is #824328','framework'),
			"id" => $shortname."_body_headings_color",
			"std" => "#824328",
			"type" => "color");

$options[] = array( "name" => __('Selection Background Color','framework'),
			"desc" => __('Choose a Background Selection Color. Base Theme Color is #f8dda8','framework'),
			"id" => $shortname."_selection_bg_color",
			"std" => "#f8dda8",
			"type" => "color");

$options[] = array( "name" => __('Link Color','framework'),
			"desc" => __('Choose a Link Color. Base Theme Color is #d3af80','framework'),
			"id" => $shortname."_link_color",
			"std" => "#d3af80",
			"type" => "color");

$options[] = array( "name" => __('Link Hover Color','framework'),
            "desc" => __('Choose a Link Hover Color. Base Theme Color is #824328','framework'),
            "id" => $shortname."_link_hover_color",
            "std" => "#824328",
            "type" => "color");

$options[] = array( "name" => __('Quick CSS','framework'),
			"desc" => __('Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file.','framework'),
			"id" => $shortname."_quick_css",
			"std" => "",
			"type" => "textarea");
			
			
/* Option Page - Social Navigation */
$options[] = array( "name" => __('Social Navigation','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Do you want to show social navigation ?','framework'),
			"desc" => __('Yes','framework'),
			"id" => $shortname."_show_social_menu",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Facebook','framework'),
			"desc" => __('Provide Facebook link to display its icon in footer social navigation.','framework'),
			"id" => $shortname."_facebook_link",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" => __('Twitter','framework'),
			"desc" => __('Provide Twitter link to display its icon in footer social navigation.','framework'),
			"id" => $shortname."_twitter_link",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Email Address','framework'),
			"desc" => __('Provide your email address to display its icon in footer social navigation.','framework'),
			"id" => $shortname."_mail_link",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus','framework'),
            "desc" => __('Provide Google Plus link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_google_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('Linked In','framework'),
            "desc" => __('Provide Linked In link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_linked_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('Pinterest','framework'),
            "desc" => __('Provide Pinterest link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_pinterest_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('Instagram','framework'),
            "desc" => __('Provide Instagram link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_instagram_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('Yahoo','framework'),
            "desc" => __('Provide Yahoo link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_yahoo_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('VK','framework'),
            "desc" => __('Provide VK link to display its icon in footer social navigation.','framework'),
            "id" => $shortname."_vk_link",
            "std" => "",
            "type" => "text");

$options[] = array( "name" => __('RSS','framework'),
			"desc" => __('Provide RSS link to display its icon in footer social navigation.','framework'),
			"id" => $shortname."_rss_link",
			"std" => "",
			"type" => "text");			


/* Option Page - Blog */
$options[] = array( "name" => __('Blog','framework'),
			"type" => "heading");		

$options[] = array( "name" => __('Blog Title','framework'),
			"desc" => __("Provide the heading words for blog page.",'framework'),
			"id" => $shortname."_blog_title",
			"std" => __("Our News", "framework"),
			"type" => "text");
					
$options[] = array( "name" => __('Do you want to open blog post image in lightbox ?','framework'),
			"desc" => __('Yes','framework'),
			"id" => $shortname."_use_lightbox",
			"std" => "true",
			"type" => "checkbox");


/* Option Page - Our Menu */
$options[] = array( "name" => __('Our Menu','framework'),
    "type" => "heading");

$options[] = array( "name" => __('Our Menu Title','framework'),
    "desc" => __("Provide the heading text for Our Menu related pages.",'framework'),
    "id" => $shortname."_menu_title",
    "std" => __("Our Menu", "framework"),
    "type" => "text");

$options[] = array( "name" => __('Do you want to open Our Menu item image in lightbox ?','framework'),
    "desc" => __('Yes','framework'),
    "id" => $shortname."_menu_use_lightbox",
    "std" => "true",
    "type" => "checkbox");



/* Option Page - Events */
$options[] = array( "name" => __('Events','framework'),
    "type" => "heading");

$options[] = array( "name" => __('Event Main Title','framework'),
    "desc" => __("Provide the heading text for Event related pages.",'framework'),
    "id" => $shortname."_event_title",
    "std" => __("Special Events", "framework"),
    "type" => "text");

$options[] = array( "name" => __('Do you want to open Event image in lightbox ?','framework'),
    "desc" => __('Yes','framework'),
    "id" => $shortname."_event_use_lightbox",
    "std" => "true",
    "type" => "checkbox");



/* Option Page - Contact */
$options[] = array( "name" => __('Contact','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Do you want to show Google Map on contact page template?','framework'),
			"desc" => __("Yes",'framework'),
			"id" => $shortname."_gmap_show",
			"type" => "checkbox");

$options[] = array( "name" => __('Google Map Latitude','framework'),
			"desc" => __("Enter Google Map Latitude",'framework'),
			"id" => $shortname."_gmap_lati",
			"std" => "48.857976",
			"type" => "text");
			
$options[] = array( "name" => __('Google Map Longitude','framework'),
			"desc" => __("Enter Google Map Longitude",'framework'),
			"id" => $shortname."_gmap_longi",
			"std" => "2.29497",
			"type" => "text");

$options[] = array( "name" => __('Google Map Zoom','framework'),
			"desc" => __("Enter Google Map Zoom Level. Example: 17",'framework'),
			"id" => $shortname."_gmap_zoom",
			"std" => "17",
			"type" => "text");

$options[] = array( "name" => __('Address','framework'),
			"desc" => __("This address will appear above contact form section.",'framework'),
			"id" => $shortname."_postal_address",
			"std" => "",
			"type" => "textarea");
			
$options[] = array( "name" => __('Contact Form Heading','framework'),
			"desc" => __("Enter heading for your contact form.",'framework'),
			"id" => $shortname."_contact_form_heading",
			"std" => __("Contact Us", "framework"),
			"type" => "text");

$options[] = array( "name" => __('Contact Form Text Below Heading','framework'),
			"desc" => __("Enter text that will appear below heading and above contact form.",'framework'),
			"id" => $shortname."_contact_form_text",
			"std" => __("Fill out the form below to send us a message and we will get back to you ASAP.", "framework"),
			"type" => "text");			

$options[] = array( "name" => __('Contact Email','framework'),
			"desc" => __("Enter target email address that will receive messages from contact form.",'framework'),
			"id" => $shortname."_contact_address",
			"std" => "",
			"type" => "text");			



/* Options Page - Reservation */
$options[] = array( "name" => __('Reservation','framework'),
    "type" => "heading");

$options[] = array( "name" => __('Reservation Form Heading','framework'),
    "desc" => __("Enter heading for your reservation form.",'framework'),
    "id" => $shortname."_reservation_form_heading",
    "std" => __("Make Reservation Now", "framework"),
    "type" => "text");

$options[] = array( "name" => __('Reservation Form Text Below Heading','framework'),
    "desc" => __("Enter text that will appear below heading and above reservation form.",'framework'),
    "id" => $shortname."_reservation_form_text",
    "std" => __("Fill out the form below to make reservation", "framework"),
    "type" => "text");

$options[] = array( "name" => __('Reservation Email','framework'),
    "desc" => __("Enter target email address that will receive reservation requests from customers.",'framework'),
    "id" => $shortname."_reservation_address",
    "std" => "",
    "type" => "text");



/* Option Page - Footer */
$options[] = array( "name" => __('Footer','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Footer Address Text','framework'),
			"desc" => __("Enter text that will appear on the right side of footer.",'framework'),
			"id" => $shortname."_footer_address_text",
			"std" => "12300 Las Angeles Main Blvd, Las Angeles, AV 123456 - 123.456.7890",
			"type" => "textarea");
			
$options[] = array( "name" => __('Copyright Text','framework'),
			"desc" => __("Enter Footer Copyright Text here.",'framework'),
			"id" => $shortname."_copyright_text",
			"std" => "Copyright &copy; 2012 Elegantia Restaurant &amp; Bar. All rights reserved.",
			"type" => "textarea");


apply_filters('framework_theme_options',$options);

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}

?>