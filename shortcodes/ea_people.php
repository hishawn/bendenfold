<?php
/**
 * Sidebar
 * Displays one of the registered Widget Areas of the theme
 */

if ( !class_exists( 'ea_people' ) && ( class_exists( 'aviaShortcodeTemplate' ) ))
{
	class ea_people extends aviaShortcodeTemplate
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
				$this->config['name']		= __('People', 'avia_framework' );
				$this->config['tab']		= __('Custom Elements', 'avia_framework' );
				$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-team.png";
				$this->config['order']		= 20;
				$this->config['target']		= 'avia-target-insert';
				$this->config['shortcode'] 	= 'ea_people';
				$this->config['shortcode_nested'] = array('ea_people_single');
				$this->config['tooltip'] 	= __('Creates a Grid of People', 'avia_framework' );
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
							"name" => __("Add/Edit Person", 'avia_framework' ),
							"desc" => __("Here you can add, remove and edit your People.", 'avia_framework' ),
							"type" 			=> "modal_group",
							"id" 			=> "content",
							"modal_title" 	=> __("Edit Person", 'avia_framework' ),
							"std"			=> array(

													array('name'=>__('Name', 'avia_framework' ), 'Subtitle'=>'', 'check'=>'is_empty'),

													),


							'subelements' 	=> array(

									array(
									"name" 	=> __("Image",'avia_framework' ),
									"desc" 	=> __("Either upload a new, or choose an existing image from your media library",'avia_framework' ),
									"id" 	=> "src",
									"type" 	=> "image",
									"fetch" => "id",
									"title" =>  __("Insert Image",'avia_framework' ),
									"button" => __("Insert",'avia_framework' ),
									"std" 	=> ""),

									array(
									"name" 	=> __("Name", 'avia_framework' ),
									"desc" 	=> "Enter the Name of the Person to quote",
									"id" 	=> "name",
									"std" 	=> "",
									"type" 	=> "input"),

									array(
									"name" 	=> __("Subtitle below name", 'avia_framework' ),
									"desc" 	=> "Can be used for a job description",
									"id" 	=> "subtitle",
									"std" 	=> "",
									"type" 	=> "input"),
									
//									array(
//									"name" 	=> __("Text", 'avia_framework' ),
//									"desc" 	=> "Space for a short paragraph",
//									"id" 	=> "linktext",
//									"std" 	=> "",
//									"type" 	=> "textarea"),
									
							        array(
									"name" 	=> __("WYSIWYG", 'avia_framework' ),
									"desc" 	=> __("Space for WYSIWYG content in this case contact form", 'avia_framework' ),
									"id" 	=> "content",
									"std" 	=> "",
									"type" 	=> "tiny_mce"
									),
						)
					),


array(
							"name" 	=> __("Person Style", 'avia_framework' ),
							"desc" 	=> __("Here you can select how to display the people. You can create a grid with multiple columns", 'avia_framework' ) ,
							"id" 	=> "style",
							"type" 	=> "select",
							"std" 	=> "grid",
							"subtype" => array(	__('People Grid', 'avia_framework' ) =>'grid',
//												__('Testimonial Slider (Compact)', 'avia_framework' ) =>'slider',
//												__('Testimonial Slider (Large)', 'avia_framework' ) =>'slider_large',
							)
						),


						array(
							"name" 	=> __("Grid Columns", 'avia_framework' ),
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
											"name" 	=> __("Custom Background Color", 'avia_framework' ),
											"desc" 	=> __("Select a custom background color here", 'avia_framework' ),
											"id" 	=> "box_custom_bg",
											"type" 	=> "colorpicker",
											"std" 	=> "",
									"container_class" => 'av_half av_half_first',
											"required" => array('font_color','equals','custom')
										),	
										
									array(	
											"name" 	=> __("Custom Border Color", 'avia_framework' ),
											"desc" 	=> __("Select a custom border color here", 'avia_framework' ),
											"id" 	=> "ea__custom_border",
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
				$template = $this->update_template("name", __("Person", 'avia_framework' ). ": {{name}}");

				$params['innerHtml']  = "";
				$params['innerHtml'] .= "<div class='avia_title_container' {$template}>".__("Person", 'avia_framework' ).": ".$params['args']['name']."</div>";

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

wp_register_style( 'ea_remodal_css', plugins_url( 'assets/_remodal/remodal.css', __FILE__ ), array(), self::VERSION);
wp_enqueue_style( 'ea_remodal_css' );

wp_register_style( 'ea_remodal_css2', plugins_url( 'assets/_remodal/remodal-default-theme.css', __FILE__ ), array(), self::VERSION);
wp_enqueue_style( 'ea_remodal_css2' );

wp_register_script( 'ea_remodal_js', plugins_url( 'assets/_remodal/remodal.min.js', __FILE__ ), false, null, true);
wp_enqueue_script( 'ea_remodal_js' );		

wp_register_style( 'ea_people_css', plugins_url( 'assets/ea_people/ea-people.css', __FILE__ ), array(), self::VERSION);
wp_enqueue_style( 'ea_people_css' );

				$atts =  shortcode_atts(array(
					
					'style'=> "grid",  
					'columns'=> "2", 
					"autoplay"=>true, 
					"interval"=>5,
					'font_color'=>'', 
					'custom_title'=>'', 
					'custom_content'=>'',
					'description' => '',
					'box_custom_bg' => '',
					'box_custom_border'=>'',
				
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
				
				if($style == "slider_large")
				{
					$style = "slider";
					$custom_class .= " av-large-testimonial-slider";
					$controls = true;
				}
				
				
				$output .= "<div {$data} class='avia-testimonial-wrapper avia-{$style}-testimonials avia-{$style}-{$columns}-testimonials avia_animate_when_almost_visible {$custom_class}'>";

				ea_people::$counter = 1;
				ea_people::$rows = 1;
				ea_people::$columnClass = $columnClass;
				ea_people::$columns = $columns;
				ea_people::$style = $style;

				//if we got a slider we only need a single row wrpper
				if($style != "grid") ea_people::$columns = 100000;

				$output .= ShortcodeHelper::avia_remove_autop($content, true);

				//close unclosed wrapper containers
				if(ea_people::$counter != 1){
				$output .= "</section>";
				}
				
				if($controls)
				{
					$output .= $this->slide_navigation_arrows();
				}
				
				
				$output .= "</div>";

				return $output;
			}
			
			function slide_navigation_arrows()
	        {
	            $html  = "";
	            $html .= "<div class='avia-slideshow-arrows avia-slideshow-controls' {$this->content_styling}>";
				$html .= 	"<a href='#prev' class='prev-slide' ".av_icon_string('prev_big').">".__('Previous','avia_framework' )."</a>";
				$html .= 	"<a href='#next' class='next-slide' ".av_icon_string('next_big').">".__('Next','avia_framework' )."</a>";
	            $html .= "</div>";
	
	            return $html;
	        }
			

			function ea_people_single($atts, $content = "", $shortcodename = "")
			{
				extract(shortcode_atts(array('src'=> "",  'name'=> "",  'subtitle'=> "",  'link'=> "", 'linktext'=>"", 'custom_markup' =>'' ), $atts, 'ea_people_single'));

				$output = "";
				$avatar = "";
				$grid = ea_people::$style == 'grid' ? true :false;
				$class = ea_people::$columnClass." avia-testimonial-row-".ea_people::$rows." ";
				//if(count($testimonials) <= $rows * $columns) $class.= " avia-testimonial-row-last ";
				if(ea_people::$counter == 1) $class .= "avia-first-testimonial";
				if(ea_people::$counter == ea_people::$columns) $class .= "avia-last-testimonial";
				if($link && !$linktext) $linktext = $link;
				if($link == 'http://') $link = "";
                $linktext = htmlentities($linktext);

				if(ea_people::$counter == 1)
                {
				    $output .= "<section class ='avia-testimonial-row'>";
				}


	//avatar size filter
	$avatar_size = apply_filters('avf_testimonials_avatar_size', 'square', $src, $class);
//	$str = trim( preg_replace( "/[^0-9a-z]+/i", " ", $str ));
//	$name = preg_replace('/\s+/', '_', $name);
//$remodal_link = preg_replace("#[[:punct:]]#", "", $name);
$remodal_link = preg_replace('/[^\w]+/', '_', $name);
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
				
				$markup = avia_markup_helper(array('context' => 'person','echo'=>false, 'custom_markup'=>$custom_markup));
				
$output .= "<div class='avia-testimonial ea-person {$class}' $markup>";
$output .= "<div class='ea-inner'>";
$output.= "<a class='remodal-link' data-remodal-target=".$remodal_link." href='#".$remodal_link."'>";
$output .= "<div class='avia-testimonial_inner'>";

if($grid)   $output .= $avatar;		
$output .= "<div class='avia-testimonial-meta-mini'>";
if($name)	$output .= "<div class='avia-testimonial-name'  {$this->title_styling} {$markup_name}>{$name}</div>";
if($subtitle)	$output .= "<div class='avia-testimonial-subtitle {$this->subtitle_class}' {$this->title_styling}  {$markup_job}>{$subtitle}</div>";
$output .= "</div>";

$output .= "</div>";
$output.= "</a>"; // remodal link
$output .= "</div>";
$output .= "</div>";

// start modal here
$output.="<div class='remodal person-modal' data-remodal-id=".$remodal_link.">"; //remodal container

$output.="<button data-remodal-action='close' class='remodal-close'></button>";

$output.= "<div class='remodal-wrap person-modal-wrap'>"; //remodal-wrap 
$output.= "<div class='remodal-body person-modal-body'>"; //remodal-body 

	$output.= "<div class='person-modal-header'>"; //remodal-header 
	if($grid)   $output .= $avatar;		
	$output .= "<div class='avia-testimonial-meta-mini'>";
	if($name)	$output .= "<div class='avia-testimonial-name'  {$this->title_styling} {$markup_name}>{$name}</div>";
	if($subtitle)	$output .= "<div class='avia-testimonial-subtitle {$this->subtitle_class}' {$this->title_styling}  {$markup_job}>{$subtitle}</div>";
	$output .= "</div>";
	$output .= "</div>";

	$output .= "<div class='remodal-content clearfix'>";
	$output .= 		ShortcodeHelper::avia_apply_autop(ShortcodeHelper::avia_remove_autop($content));
	$output .= "</div>";   

$output.="</div>"; //remodal-body 
$output.="</div>"; //remodal-wrap 
$output.="</div>"; //remodal container
// close modal here

				if(ea_people::$counter == ea_people::$columns)
                {
				    $output .= "</section>";
				}

				ea_people::$counter++;
				if(ea_people::$counter > ea_people::$columns) { ea_people::$counter = 1; ea_people::$rows++; }


				return $output;
			}

	}
}






