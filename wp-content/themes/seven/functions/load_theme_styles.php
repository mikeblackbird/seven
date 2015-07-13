<?php
/**
 * File Name: load_theme_styles.php
 * Programmer : Saqib Sarwar
 * Date: 11/26/12
 * Time: 2:17 PM.
 *
 * Function For Loading Required CSS Files
 *
 */

if(!function_exists('load_theme_styles'))
{
    function load_theme_styles()
    {
        if (!is_admin())
        {
            // register styles
            wp_register_style('main-css',  get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
            wp_register_style('media-queries',  get_template_directory_uri() . '/css/media-queries.css', array(), '1.0', 'all');
            wp_register_style('prettyPhoto',  get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array(), '3.1.6', 'all');
            wp_register_style('flexslidercss',  get_template_directory_uri() . '/js/flexslider/flexslider.css', array(), '1.8', 'all');
            wp_register_style('jquery-ui-css',  'http://code.jquery.com/ui/1.9.1/themes/trontastic/jquery-ui.css', array(), '1.9.1', 'all');
            wp_register_style('the-tooltip',  get_template_directory_uri() . '/js/the-tooltip/the-tooltip.css', array(), '3.0', 'all');

            // register custom styles
            wp_register_style('custom-css',  get_template_directory_uri() . '/css/custom.css', array(), '1.0', 'all');

            // enqueue styles
            wp_enqueue_style('main-css');

            // enqueue styles
            wp_enqueue_style('media-queries');

            //if( is_page_template('template-home.php')  || is_page_template('template-home-with-sidebar.php'))
            //{
            wp_enqueue_style('flexslidercss');
            //}

            wp_enqueue_style('prettyPhoto');
            wp_enqueue_style('jquery-ui-css');
            wp_enqueue_style('the-tooltip');
            wp_enqueue_style('custom-css');

        }
    }
}

add_action('wp_enqueue_scripts', 'load_theme_styles');

?>