<?php 	
function shortcode_stuff() {
//	wp_enqueue_style( 'tbwa_shortcode_css', plugins_url('shortcode.css', __FILE__));
//	wp_enqueue_style( 'tbwa_shortcode_css', plugins_url( 'shortcode.css' , dirname(__FILE__) ));
	 
	wp_enqueue_style('biotabs_css',plugins_url('/',__FILE__).'shortcode.css');	
	
//	echo '<img src="' . plugins_url( 'images/wordpress.png' , dirname(__FILE__) ) . '" > ';
}
add_action('wp_enqueue_scripts', 'shortcode_stuff');