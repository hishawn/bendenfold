<?php
/**
 * Sidebar
 * Displays one of the registered Widget Areas of the theme
 */

if ( !class_exists( 'ea_tips' ) && ( class_exists( 'aviaShortcodeTemplate' ) ))
{
	class ea_tips extends aviaShortcodeTemplate
	{
			const VERSION = "1.0";/*** @var string */

			static $columnClass;
			static $rows;
			static $counter;
			static $columns;
			static $style;

			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']		= __('Tips', 'avia_framework' );
				$this->config['tab']		= __('Custom Elements', 'avia_framework' );
				$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-testimonials.png";
				$this->config['order']		= 20;
				$this->config['target']		= 'avia-target-insert';
				$this->config['shortcode'] 	= 'ea_tip';
				$this->config['shortcode_nested'] = array('ea_tip_single');
				$this->config['tooltip'] 	= __('Creates a Grid of Tooltips', 'avia_framework' );
			}

			/**
			 * Popup Elements
			 *
			 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
			 * opens a modal window that allows to edit the element properties
			 *
			 * @return void
			 */
			function popup_elements()
			{
				$this->elements = array(
						
						array(
							"type" 	=> "tab_container", 'nodescription' => true
						),
						
						array(
							"type" 	=> "tab",
							"name"  => __("Content" , 'avia_framework'),
							'nodescription' => true
						),
						
						array(
							"name" => __("Add/Edit Tooltip", 'avia_framework' ),
							"desc" => __("Here you can add, remove and edit your Tooltips.", 'avia_framework' ),
							"type" 			=> "modal_group",
							"id" 			=> "content",
							"modal_title" 	=> __("Edit Tooltip", 'avia_framework' ),
							"std"			=> array(

													array('name'=>__('Name', 'avia_framework' ), 'Subtitle'=>'', 'check'=>'is_empty'),

													),


							'subelements' 	=> array(

//									array(
//									"name" 	=> __("Image",'avia_framework' ),
//									"desc" 	=> __("Either upload a new, or choose an existing image from your media library",'avia_framework' ),
//									"id" 	=> "src",
//									"type" 	=> "image",
//									"fetch" => "id",
//									"title" =>  __("Insert Image",'avia_framework' ),
//									"button" => __("Insert",'avia_framework' ),
//									"std" 	=> ""),

									array(
									"name" 	=> __("Tooltip title", 'avia_framework' ),
									"desc" 	=> "Enter a short title",
									"id" 	=> "name",
									"std" 	=> "",
									"type" 	=> "input"),

									array(
									"name" 	=> __("Subtitle below", 'avia_framework' ),
									"desc" 	=> "Can be used for a short description",
									"id" 	=> "subtitle",
									"std" 	=> "",
									"type" 	=> "input"),

							        array(
									"name" 	=> __("WYSIWYG", 'avia_framework' ),
									"desc" 	=> __("Enter the Tooltip content here", 'avia_framework' ),
									"id" 	=> "content",
									"std" 	=> "",
									"type" 	=> "tiny_mce"
									),

//									array(
//									"name" 	=> __("Website Link", 'avia_framework' ),
//									"desc" 	=> "Link to the Persons website",
//									"id" 	=> "link",
//									"std" 	=> "http://",
//									"type" 	=> "input"),
//
//									array(
//									"name" 	=> __("Website Name", 'avia_framework' ),
//									"desc" 	=> "Linktext for the above Link",
//									"id" 	=> "linktext",
//									"std" 	=> "",
//									"type" 	=> "input"),

						)
					),


array(
							"name" 	=> __("Tooltip Style", 'avia_framework' ),
							"desc" 	=> __("Here you can select how to display the tooltips.", 'avia_framework' ) ,
							"id" 	=> "style",
							"type" 	=> "select",
							"std" 	=> "grid",
							"subtype" => array(	__('Tooltip Grid', 'avia_framework' ) =>'grid',
//												__('Testimonial Slider (Compact)', 'avia_framework' ) =>'slider',
//												__('Testimonial Slider (Large)', 'avia_framework' ) =>'slider_large',
							)
						),


						array(
							"name" 	=> __("Tooltip Grid Columns", 'avia_framework' ),
							"desc" 	=> __("How many columns do you want to display", 'avia_framework' ) ,
							"id" 	=> "columns",
							"required" 	=> array('style', 'equals', 'grid'),
							"type" 	=> "select",
							"std" 	=> "2",
							"subtype" => AviaHtmlHelper::number_array(1,4,1)
							),

//						array(
//						"name" 	=> __("Slideshow autorotation duration",'avia_framework' ),
//						"desc" 	=> __("Slideshow will rotate every X seconds",'avia_framework' ),
//						"id" 	=> "interval",
//						"type" 	=> "select",
//						"std" 	=> "5",
//						"required" 	=> array('style','contains','slider'),
//						"subtype" => array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),
						
						array(
							"type" 	=> "close_div",
							'nodescription' => true
									),
								
								array(
										"type" 	=> "tab",
										"name"	=> __("Colors",'avia_framework' ),
										'nodescription' => true
									),
					
								
								array(
										"name" 	=> __("Font Colors", 'avia_framework' ),
										"desc" 	=> __("Either use the themes default colors or apply some custom ones", 'avia_framework' ),
										"id" 	=> "font_color",
										"type" 	=> "select",
										"std" 	=> "",
										"subtype" => array( __('Default', 'avia_framework' )=>'',
															__('Define Custom Colors', 'avia_framework' )=>'custom'),
								),
								
								array(	
									"name" 	=> __("Name Font Color", 'avia_framework' ),
									"desc" 	=> __("Select a custom font color. Leave empty to use the default", 'avia_framework' ),
									"id" 	=> "custom_title",
									"type" 	=> "colorpicker",
									"std" 	=> "",
									"container_class" => 'av_half av_half_first',
									"required" => array('font_color','equals','custom')
										),	
										
									array(	
											"name" 	=> __("Custom Content Font Color", 'avia_framework' ),
											"desc" 	=> __("Select a custom font color. Leave empty to use the default", 'avia_framework' ),
											"id" 	=> "custom_content",
											"type" 	=> "colorpicker",
											"std" 	=> "",
											"container_class" => 'av_half',
											"required" => array('font_color','equals','custom')
									
									),	
									
								array(
										"type" 	=> "close_div",
										'nodescription' => true
									),
									
								array(
										"type" 	=> "close_div",
										'nodescription' => true
									),


				);


			}

			/**
			 * Editor Sub Element - this function defines the visual appearance of an element that is displayed within a modal window and on click opens its own modal window
			 * Works in the same way as Editor Element
			 * @param array $params this array holds the default values for $content and $args.
			 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
			 */
			function editor_sub_element($params)
			{
				$template = $this->update_template("name", __("Tooltip", 'avia_framework' ). ": {{name}}");

				$params['innerHtml']  = "";
				$params['innerHtml'] .= "<div class='avia_title_container' {$template}>".__("Tooltip", 'avia_framework' ).": ".$params['args']['name']."</div>";

				return $params;
			}



			/**
			 * Frontend Shortcode Handler
			 *
			 * @param array $atts array of attributes
			 * @param string $content text within enclosing form of shortcode element
			 * @param string $shortcodename the shortcode found, when == callback name
			 * @return string $output returns the modified html string
			 */
			function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
			{

// let's bring in some external scripts when this shortcode is used, in order to make this work
wp_register_style( 'ea_tipped_css', plugins_url( 'assets/_tipped/tipped.css', __FILE__ ), array(), self::VERSION);
wp_enqueue_style( 'ea_tipped_css' );

wp_register_script( 'ea_tipped_js', plugins_url( 'assets/_tipped/tipped.js', __FILE__ ), false, null, true);
wp_enqueue_script( 'ea_tipped_js' );

wp_register_script( 'ea_tipped_call', plugins_url( 'assets/ea_tooltip/call.js', __FILE__ ), false, null, true);
wp_enqueue_script( 'ea_tipped_call' );

wp_register_style( 'ea_tooltip_css', plugins_url( 'assets/ea_tooltip/ea_tooltip.css', __FILE__ ), array(), self::VERSION);
wp_enqueue_style( 'ea_tooltip_css' );		

				$atts =  shortcode_atts(array(
					
					'style'=> "grid",  
					'columns'=> "2", 
					"autoplay"=>true, 
					"interval"=>5,
					'font_color'=>'', 
					'custom_title'=>'', 
					'custom_content'=>'',
				
				
				), $atts, $this->config['shortcode']);
				
				
				$custom_class = !empty($meta['custom_class']) ? $meta['custom_class'] : "";
				extract($atts);
				
				$this->title_styling 		= "";
				$this->content_styling 		= "";
				$this->content_class 		= "";
				$this->subtitle_class 		= "";
				
				if($font_color == "custom")
				{
					$this->title_styling 		.= !empty($custom_title) ? "color:{$custom_title}; " : "";
					$this->content_styling 		.= !empty($custom_content) ? "color:{$custom_content}; " : "";
					
					if($this->title_styling) 	
					{
						$this->title_styling = " style='{$this->title_styling}'" ;
						$this->subtitle_class = "av_opacity_variation";	
					}
					
					if($this->content_styling) 	
					{
						$this->content_class = "av_inherit_color";
						$this->content_styling = " style='{$this->content_styling}'" ;
					}
				}
				
				$output = "";

				switch($columns)
				{
					case 1: $columnClass = "av_one_full flex_column no_margin"; break;
					case 2: $columnClass = "av_one_half flex_column no_margin"; break;
					case 3: $columnClass = "av_one_third flex_column no_margin"; break;
					case 4: $columnClass = "av_one_fourth flex_column no_margin"; break;
				}

				$data = AviaHelper::create_data_string(array('autoplay'=>$autoplay, 'interval'=>$interval, 'animation' => 'fade', 'hoverpause' => true));
				$controls = false;
				
//				if($style == "slider_large")
//				{
//					$style = "slider";
//					$custom_class .= " av-large-testimonial-slider";
//					$controls = true;
//				}
				
				
				$output .= "<div {$data} class='ea-tooltips-wrapper avia-testimonial-wrapper avia-{$style}-testimonials avia-{$style}-{$columns}-testimonials avia_animate_when_almost_visible {$custom_class}'>";

				ea_tips::$counter = 1;
				ea_tips::$rows = 1;
				ea_tips::$columnClass = $columnClass;
				ea_tips::$columns = $columns;
				ea_tips::$style = $style;

				//if we got a slider we only need a single row wrpper
				if($style != "grid") ea_tips::$columns = 100000;

				$output .= ShortcodeHelper::avia_remove_autop($content, true);

				//close unclosed wrapper containers
				if(ea_tips::$counter != 1){
				$output .= "</section>";
				}
				
//				if($controls)
//				{
//					$output .= $this->slide_navigation_arrows();
//				}
				
				
				$output .= "</div>";

				return $output;
			}
			
//			function slide_navigation_arrows()
//	        {
//	            $html  = "";
//	            $html .= "<div class='avia-slideshow-arrows avia-slideshow-controls' {$this->content_styling}>";
//				$html .= 	"<a href='#prev' class='prev-slide' ".av_icon_string('prev_big').">".__('Previous','avia_framework' )."</a>";
//				$html .= 	"<a href='#next' class='next-slide' ".av_icon_string('next_big').">".__('Next','avia_framework' )."</a>";
//	            $html .= "</div>";
//	
//	            return $html;
//	        }
			

			function ea_tip_single($atts, $content = "", $shortcodename = "")
			{
				extract(shortcode_atts(array('src'=> "",  'name'=> "",  'subtitle'=> "",  'link'=> "", 'linktext'=>"", 'custom_markup' =>'' ), $atts, 'ea_tip_single'));

				$output = "";
				$avatar = "";
				$grid = ea_tips::$style == 'grid' ? true :false;
				$class = ea_tips::$columnClass." avia-testimonial-row-".ea_tips::$rows." ";
				//if(count($testimonials) <= $rows * $columns) $class.= " avia-testimonial-row-last ";
				if(ea_tips::$counter == 1) $class .= "avia-first-testimonial";
				if(ea_tips::$counter == ea_tips::$columns) $class .= "avia-last-testimonial";
//				if($link && !$linktext) $linktext = $link;
//				if($link == 'http://') $link = "";
//                $linktext = htmlentities($linktext);

				if(ea_tips::$counter == 1)
                {
				    $output .= "<section class ='avia-testimonial-row'>";
				}


	//avatar size filter
	$avatar_size = apply_filters('avf_testimonials_avatar_size', 'square', $src, $class);

	//avatar
                $markup = avia_markup_helper(array('context' => 'single_image','echo'=>false, 'custom_markup'=>$custom_markup));
	if($src)	$avatar  = "<div class='avia-testimonial-image' $markup>".wp_get_attachment_image( $src , $avatar_size , false, array('alt'=>esc_attr(strip_tags($name))))."</div>";

	//meta
                $markup_text = avia_markup_helper(array('context' => 'entry','echo'=>false, 'custom_markup'=>$custom_markup));
                $markup_name = avia_markup_helper(array('context' => 'name','echo'=>false, 'custom_markup'=>$custom_markup));
                $markup_job = avia_markup_helper(array('context' => 'job','echo'=>false, 'custom_markup'=>$custom_markup));
                if(strstr($link, '@'))
                {
                    $markup_url = avia_markup_helper(array('context' => 'email','echo'=>false, 'custom_markup'=>$custom_markup));
                }
                else
                {
                    $markup_url = avia_markup_helper(array('context' => 'url','echo'=>false, 'custom_markup'=>$custom_markup));
                }

//final output
$tipped_id = sanitize_title_with_dashes( $name );
$markup = avia_markup_helper(array('context' => 'person','echo'=>false, 'custom_markup'=>$custom_markup));

				
$output .= "<div class='avia-testimonial ea-tooltip {$class}' $markup>";
$output .= "<div class='ea-tooltip-wrapper'>";

//$output .= "<div class='avia-testimonial-meta-mini'>";
$output .= "<span class='ea-tooltip-trigger inline' data-tipped-options=\"inline: '".$tipped_id."'\" >";

if($name)	$output .= "<div class='ea-tooltip-title' {$this->title_styling} {$markup_name}>{$name}</div>";
if($subtitle)	$output .= "<div class='ea-tooltip-subtitle {$this->subtitle_class}' {$this->title_styling}>{$subtitle}</div>";

$output .= "</span>";
//$output .= "</div>";

$output .= "<div id='".$tipped_id."' class='ea-tooltip-content'>";
$output .= "<span class='ea-tooltip-text'>".stripslashes(wpautop(trim($content)))."</span>";
$output .= "</div>";

$output .= "</div>";
$output .= "</div>";
//final output

				if(ea_tips::$counter == ea_tips::$columns)
                {
				    $output .= "</section>";
				}

				ea_tips::$counter++;
				if(ea_tips::$counter > ea_tips::$columns) { ea_tips::$counter = 1; ea_tips::$rows++; }


				return $output;
			}

	}
}