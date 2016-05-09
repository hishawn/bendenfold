<?php 	
function shortcode_css() {
	wp_enqueue_style('shortcode_css',plugins_url('/',__FILE__).'shortcode.css');		
}
add_action('wp_enqueue_scripts', 'shortcode_css');