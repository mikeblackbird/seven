<?php
function generate_dynamic_css()
{

	//Body Text Color
	$theme_body_text_color = get_option('theme_body_text_color');
	$theme_body_headings_color = get_option('theme_body_headings_color');
	
	//Selection Background Color
	$theme_selection_bg_color = get_option('theme_selection_bg_color');
	
	//Theme Link Color
	$theme_link_color = get_option('theme_link_color');
	$theme_link_hover_color = get_option('theme_link_hover_color');
	


	$dynamic_css = array(
						
						//Body Text Color
						array(
							'elements'	=>	'body',
							'property'	=>	'color',
							'value'		=> 	$theme_body_text_color
							),

						//Heading Color
						array(
							'elements'	=>	'h1, h2, h3, h4, h5, h6, code, form label, form legend, #pagination, .article-date, .event h3.post-title, .news h2.post-title, .faq-list dt, .toggle dt, .accordion dt, .dropcap, th',
							'property'	=>	'color',
							'value'		=> 	$theme_body_headings_color
							),

						//Selection Background Color
						array(
							'elements'	=>	'::-moz-selection',
							'property'	=>	'background',
							'value'		=> 	$theme_selection_bg_color
							),
						//Selection Background Color  
						array(
							'elements'	=>	'::selection',
							'property'	=>	'background',
							'value'		=> 	$theme_selection_bg_color
							),
						
						//Link Color
						array(
							'elements'	=>	'a, a:visited, .widget h4, .widget li a, small, article small',
							'property'	=>	'color',
							'value'		=> 	$theme_link_color
							),
                        array(
                            'elements'	=>	'.price span, a#scroll-top',
                            'property'	=>	'background-color',
                            'value'		=> 	$theme_link_color
                        ),

						//Link Hover Color
						array(
							'elements'	=>	'a:hover, a:focus, a:active, a.read-more:hover, a.read-more:active, a.read-more:focus, .widget a:hover, .widget a:focus, .widget a:active',
							'property'	=>	'color',
							'value'		=> 	$theme_link_hover_color
							),
                        array(
                            'elements'	=>	'a#scroll-top:hover, .button, button, input[type="submit"], input[type="reset"], input[type="button"], a.readmore, .single-menu-item .price:hover span, .es-carousel li:hover .price span, .our-menu #main-content article:hover .price span ',
                            'property'	=>	'background-color',
                            'value'		=> 	$theme_link_hover_color
                        )

					);
	
	
	$prop_count = count($dynamic_css);
	
	if($prop_count > 0)
	{
		echo "<style type='text/css' id='dynamic-css'>\n\n";
		foreach($dynamic_css as $css_unit )
		{
			if(!empty($css_unit['value']))
			{
				echo $css_unit['elements']."{\n";
				echo $css_unit['property'].":".$css_unit['value'].";\n";
				echo "}\n\n";
			}
		}
		echo '</style>';
	}
	
}

add_action('wp_head', 'generate_dynamic_css');


function generate_quick_css(){
    // Quick CSS from Theme Options
    $quick_css = stripslashes(get_option('theme_quick_css'));

    if(!empty($quick_css))
    {
        echo "<style type='text/css' id='quick-css'>\n\n";
        echo $quick_css . "\n\n";
        echo "</style>";
    }
}

add_action('wp_head', 'generate_quick_css');

?>