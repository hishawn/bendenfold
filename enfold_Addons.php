<?php
/*
Plugin Name: Marvin Add-ons
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
//		var $module_dir;
		var $shortcode_dir;
//		var $assets_js;
//		var $assets_css;
//		var $admin_js;
//		var $admin_css;
//		var $vc_template_dir;
//		var $vc_dest_dir;
		function __construct()
		{
//			add_action( 'init', array($this,'init_addons'));
//			$this->vc_template_dir = plugin_dir_path( __FILE__ ).'vc_templates/';
//			$this->vc_dest_dir = get_template_directory().'/vc_templates/';
			$this->module_dir = plugin_dir_path( __FILE__ ).'modules/';

			$this->shortcode_dir = plugin_dir_path( __FILE__ ).'shortcodes/';
//			$this->assets_js = plugins_url('assets/js/',__FILE__);
//			$this->assets_css = plugins_url('assets/css/',__FILE__);
//			$this->admin_js = plugins_url('admin/js/',__FILE__);
//			$this->admin_css = plugins_url('admin/css/',__FILE__);
//			$this->paths = wp_upload_dir();
//			$this->paths['fonts'] 	= 'smile_fonts';
//			$this->paths['fonturl'] = trailingslashit($this->paths['baseurl']).$this->paths['fonts'];
			add_action('init',array($this,'shortcode_init'));
//			add_action('init',array($this,'aio_init'));
//			add_action('admin_enqueue_scripts',array($this,'aio_admin_scripts'));
			add_action('wp_enqueue_scripts',array($this,'aio_front_scripts'));
//			add_action('admin_init',array($this,'toggle_updater'));
//			if(!get_option('ultimate_row')){
//				update_option('ultimate_row','enable');
//			}
			//add_action('admin_init', array($this, 'aio_move_templates'));
		}// end constructor
//		function aio_init()
//		{
//			// activate addons one by one from modules directory
//			foreach(glob($this->module_dir."/*.php") as $module)
//			{
//				require_once($module);
//			}
//		}// end aio_init
		function shortcode_init()
		{
			// activate addons one by one from modules directory
			foreach(glob($this->shortcode_dir."/*.php") as $shortcode)
			{
				require_once($shortcode);
			}
		}// end aio_init
//		function aio_admin_scripts()
//		{
//			// enqueue css files on backend
//			wp_enqueue_style('aio-icon-manager',$this->admin_css.'icon-manager.css');
//			wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.js',array('vc_inline_custom_view_js'),'1.5',true);
//			$fonts = get_option('smile_fonts');
//			if(is_array($fonts))
//			{
//				foreach($fonts as $font => $info)
//				{
//					if(strpos($info['style'], 'http://' ) !== false) {
//						wp_enqueue_style('bsf-'.$font,$info['style']);
//					} else {
//						wp_enqueue_style('bsf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
//					}
//				}
//			}
//		}// end aio_admin_scripts
		function aio_front_scripts()
		{
			// register js
//			wp_register_script('ultimate-appear',$this->assets_js.'jquery.appear.js',array('jquery'),'1.5',true);			
//			wp_register_script('ultimate-custom',$this->assets_js.'custom.js',array('jquery'),'1.5',true);
			// register css
//			wp_enqueue_style('ultimate-animate',$this->assets_css.'shortcode.css');
//			wp_register_style('ultimate-style',$this->assets_css.'style.css');
//			if(function_exists('vc_is_editor')){
//				if(vc_is_editor()){
//					wp_enqueue_style('vc-fronteditor',$this->assets_css.'vc-fronteditor.css');
//				}
//			}
//			$fonts = get_option('smile_fonts');
//			if(is_array($fonts))
//			{
//				foreach($fonts as $font => $info)
//				{
//					$style_url = $info['style'];
//					if(strpos($style_url, 'http://' ) !== false) {
//						wp_enqueue_style('bsf-'.$font,$info['style']);
//					} else {
//						wp_enqueue_style('bsf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
//					}
//				}
//			}
		}// end aio_front_scripts
/*
Load plugin css and javascript files
*/

		
//		function aio_move_templates()
//		{
//			// Make destination directory 
//			if (!is_dir($this->vc_dest_dir)) { 
//				wp_mkdir_p($this->vc_dest_dir);
//			}
//			@chmod($this->vc_dest_dir,0777);
//			foreach(glob($this->vc_template_dir.'*') as $file)
//			{
//				$new_file = basename($file);
//				@copy($file,$this->vc_dest_dir.$new_file);
//			}
//		}// end aio_move_templates
//		function toggle_updater(){
//			if(defined('ULTIMATE_USE_BUILTIN')){
//				update_option('ultimate_updater','disabled');
//			} else {
//				update_option('ultimate_updater','enabled');
//			}
//		}
	}//end class
	new enfold_Addons;
	// load admin area
//	require_once('admin/admin.php');
}// end class check