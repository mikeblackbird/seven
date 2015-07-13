<?php
/**
 * File Name: load_theme_scripts.php
 * Programmer : Saqib Sarwar
 * Date: 11/26/12
 * Time: 2:18 PM
 *
 * For Loading Required JS Files
 *
 */


if(!function_exists('load_theme_scripts')){

    function load_theme_scripts(){

        if (!is_admin()) {

            // Defining scripts directory url
            $js_script_url = get_template_directory_uri().'/js/';

            // Registering Scripts
            wp_register_script('prettyphoto', $js_script_url.'prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.1.6', false);
            wp_register_script('easing', $js_script_url.'elastislide/jquery.easing.1.3.js', array('jquery'), '1.3', false);
            wp_register_script('validate', $js_script_url.'jquery.validate.min.js', array('jquery'), '1.10.0', false);
            wp_register_script('forms', $js_script_url.'jquery.form.js', array('jquery'), '3.18', false);
            wp_register_script('flexslider', $js_script_url.'flexslider/jquery.flexslider-min.js', array('jquery'), '2.0', false);
            wp_register_script('elastislide', $js_script_url.'elastislide/jquery.elastislide.js', array('jquery'), '1.0', false);
            wp_register_script('the-tooltip-js', $js_script_url.'the-tooltip/the-tooltip.min.js', array('jquery'), '3.0', false);
            wp_register_script('isotope', $js_script_url.'jquery.isotope.min.js',array('jquery'), '1.5.19', false);

            // Custom Script
            wp_register_script('custom',$js_script_url.'custom.js', array('jquery'), '1.0', true);


            // Enqueuing Scripts that are needed all the pages
            wp_enqueue_script('jquery');
            wp_enqueue_script('easing');
            wp_enqueue_script('elastislide');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('prettyphoto');
            wp_enqueue_script('validate');
            wp_enqueue_script('forms');

            // load cycle plugin, easing plugin and flex slider files for specific pages
            if( is_page_template('template-home.php')   )
            {
                wp_enqueue_script('flexslider');
            }

            // load Isotope for gallery pages
            if( is_page_template( 'template-4-columns-gallery.php' || 'template-3-columns-gallery.php' || 'template-2-columns-gallery.php' || 'taxonomy-gallery-item-type.php' ) )
            {
                wp_enqueue_script('isotope');
            }

            // load Isotope for gallery pages

            wp_enqueue_script('the-tooltip-js');
            wp_enqueue_script('custom');


        }
    }
}

add_action('wp_enqueue_scripts', 'load_theme_scripts');

?>