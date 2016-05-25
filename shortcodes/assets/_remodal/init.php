<?php 
function remodal_init() {
	wp_enqueue_style( 'remodal_css', get_stylesheet_directory_uri() . '/mods/remodal/jquery.remodal.css', false, null, false );
	wp_enqueue_script('remodal_js', get_stylesheet_directory_uri() . '/mods/remodal/jquery.remodal.js', false, null, true);
//	wp_enqueue_script('remodal_call', get_stylesheet_directory_uri() . '/mods/remodal/call.js', false, null, true);
}
add_action('wp_enqueue_scripts', 'remodal_init');