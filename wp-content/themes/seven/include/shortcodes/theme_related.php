<?php

// Page Title
function page_title($atts, $content = null) {
	return '<section class="page-head"><h1><span>'.do_shortcode($content).'</span></h1></section>';
}
add_shortcode('page_title', 'page_title');


// Title Heading
function title_heading($atts, $content = null) {
    return '<h2 class="title-heading">'.do_shortcode($content).'</h2>';
}
add_shortcode('title_heading', 'title_heading');


// Separator
function separator($atts, $content = null) {
	return '<hr class="separator">';
}
add_shortcode('separator', 'separator');


?>