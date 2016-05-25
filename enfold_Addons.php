<?php

/*
Plugin Name: Enfold Add-ons
Plugin URI: https://github.com/boywondercreative
Description: Adds custom elements to Enfold theme
Version: 1.0
Author: the boywonder
Author URI: https://github.com/boywondercreative
License: GPLv2 or later
Text Domain: smile
*/

if(!class_exists('enfold_Addons'))
{
	class enfold_Addons
	{
		var $paths = array();
		var $shortcode_dir;

		function __construct()
		{
			$this->module_dir = plugin_dir_path( __FILE__ ).'modules/';
			$this->shortcode_dir = plugin_dir_path( __FILE__ ).'shortcodes/';
			add_action('init',array($this,'shortcode_init'));
		}// end constructor

		function shortcode_init()
		{
			// activate addons one by one from modules directory
			foreach(glob($this->shortcode_dir."/*.php") as $shortcode)
			{
				require_once($shortcode);
			}
		}// end aio_init
	}//end class
	new enfold_Addons;
	// load admin area
//	require_once('admin/admin.php');
}// end class check