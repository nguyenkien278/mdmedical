<?php

/*
 * @package Inwave Event
 * @version 1.0.0
 * @created June 21, 2017
 * @author KienNguyen
 * @email kien.nguyen@jmango360.com
 * @website http://jmango360.com
 * @copyright Copyright (c) 2017 jMango360. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of slider
 *
 * @developer kiennb
 */
if (!class_exists('Inwave_Simmple_Slide')) {

    class Inwave_Simmple_Slide extends Inwave_Shortcode{

        protected $name = 'inwave_simple_slide';

        function init_params()
        {
            return array(
                "name" => __("Simmple Slide", 'inwavethemes'),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Show a slide images or a video.", "inwavethemes"),
            //    "show_settings_on_create" => true,
            //    "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - slide images" => "style1",
							"Style 2 - youtube video" => "style2",
							"Style 3 - single image with title and description" => "style3",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/slider_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/slider_style2.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style3",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/simple-single-image.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style3')
                    ),
				/// style 1 - image slide options	
					array(
                        'type' => 'attach_images',
                        "heading" => __("Slide images", "inwavethemes"),
                        "description" => __("Add slide images here", "inwavethemes"),
                        "value" => "",
                        "param_name" => "slide_images",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
                    ),
					
					array(
                        'type' => 'checkbox',
						"group" => "Slide config",
                        'heading' => __( 'Auto play?', 'inwavethemes' ),
						"description" => __("Check this option to slide auto play", "inwavethemes"),
                        'param_name' => 'autoplay',
						'std' => 'true',
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
                    ),
					array(
                        'type' => 'checkbox',
						"group" => "Slide config",
                        'heading' => __( 'Show navigation?', 'inwavethemes' ),
						"description" => __("Check this option to show navigation slide", "inwavethemes"),
                        'param_name' => 'show_navigation',
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
                    ),
					array(
                        'type' => 'checkbox',
						"group" => "Slide config",
                        'heading' => __( 'Show pagination?', 'inwavethemes' ),
						"description" => __("Check this option to show pagination slide", "inwavethemes"),
                        'param_name' => 'show_pagination',
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
                    ),
				/// end style 1 - image slide options
				///------------------------------
				/// style 2 - youtube video options
					array(
                        'type' => 'textfield',
                        "heading" => __("Youtube link", "inwavethemes"),
                        "description" => __("Enter youtube video link here. Only support youtube video", "inwavethemes"),
                        "value" => "",
                        "param_name" => "slide_video_url",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style2'
						)
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Video width", "inwavethemes"),
                        "description" => __("Enter width of video you want. Exp: 100%, 900px, etc", "inwavethemes"),
                        "value" => "100%",
                        "param_name" => "slide_video_width",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style2'
						)
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Video height", "inwavethemes"),
                        "description" => __("Enter height of video you want. Exp: 100%, 600px, etc", "inwavethemes"),
                        "value" => "450px",
                        "param_name" => "slide_video_height",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style2'
						)
                    ),
				/// end style 2 - youtube video options
				//==style 3 option
					array(
                        'type' => 'attach_image',
                        "heading" => __("Single image", "inwavethemes"),
                        "description" => __("Add a image here", "inwavethemes"),
                        "value" => "",
                        "param_name" => "slide_image",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style3'
						)
                    ),
					array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Title", "inwavethemes"),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                    ),
					array(
                        'type' => 'textarea',
                        "heading" => __("Description", "inwavethemes"),
                        "description" => __("Add your description here", "inwavethemes"),
                        "value" => "",
                        "param_name" => "desc",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style3'
						)
                    ),
					
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
					array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
        }


        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $style = $title = $sub_title = $description = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1",
                "title" => "",
                "desc" => "",
                "slide_images" => "",
                "slide_image" => "",
                "slide_video_url" => "",
				'css' => '',
				'autoplay' => '',
				'show_navigation' => '',
				'show_pagination' => '',
				'slide_video_width' => '',
				'slide_video_height' => '',
            ), $atts));
		
			$title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
			$title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
			$title= preg_replace('/\/\/\//i', '<br />', $title);
        

		ob_start();
			
			switch ($style){
				case 'style1':
					wp_enqueue_style('owl-carousel');
					wp_enqueue_style('owl-theme');
					wp_enqueue_style('owl-transitions');
					wp_enqueue_script('owl-carousel');
				?>
				<?php 
					$image_ids = explode(',',$slide_images);
					$images_arr = array();
					foreach( $image_ids as $image_id ){
						$images = wp_get_attachment_image_src( $image_id, 'full' );
						$images_arr[] = $images[0];
					}
					$autoplay = $autoplay ? 'true' : 'false';
					$show_navigation = $show_navigation ? 'true' : 'false';
					$show_pagination = $show_pagination ? 'true' : 'false';
					
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":'.$show_navigation;
					$sliderConfig .= ',"autoPlay":'.$autoplay;
					$sliderConfig .= ',"pagination":'.$show_pagination;
					$sliderConfig .= ',"singleItem":true';
					$sliderConfig .= ',"addClassActive":true';
					$sliderConfig .= ',"navigationText":["<i class=\"fa fa-chevron-left\"></i>","<i class=\"fa fa-chevron-right\"></i>"]';
					$sliderConfig .= '}';
				?>
					<div class="jm-slideshow type_image">
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title; ?></h3>
							</div>
						<?php } ?>
						<div class="slideshow-inner">
							<?php if (!empty($images_arr)){ ?>
								<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
									<?php foreach( $images_arr as $image_item ){ ?>
										<div class="image-item">
											<img src="<?php echo $image_item; ?>" alt="" />
										</div>
									<?php } ?>
								</div>
							<?php } else { ?>
								<?php echo __('Please add image in admin', 'inwavethemes') ;?>
							<?php } ?>
						</div>
					</div>
			<?php
				break;
				case 'style2':
				
					$slide_video_width = $slide_video_width ? $slide_video_width : '100%';
					$slide_video_height = $slide_video_height ? $slide_video_height : '450px';
					
					$slide_video_url = str_replace('/watch?v=', '/embed/', $slide_video_url);
					$slide_video_url = str_replace('&list=', '?list=', $slide_video_url);
			?>	
				<div class="jm-slideshow type_video">
					<?php if ($title){ ?>
						<div class="title-group">
							<h3 class="title"><?php echo $title; ?></h3>
						</div>
					<?php } ?>
					<div class="slideshow-inner">
						<iframe width="<?php echo $slide_video_width; ?>" height="<?php echo $slide_video_height; ?>" src="<?php echo $slide_video_url; ?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			<?php
				break;
				case 'style3':
				
				$image = wp_get_attachment_image_src( $slide_image, 'full' );
				$images_url = $image[0];
				if ($image){
			?>	
				<div class="jm-simple-image">
					<div class="image-block"><img src="<?php echo $images_url; ?>" alt="" /></div>
					<?php if ($title || $desc){ ?>
						<div class="text-block">
							<?php if ($title){ ?>
								<div class="title"><?php echo $title; ?></div>
							<?php } ?>
							<?php if ($title){ ?>
								<div class="desc"><?php echo $desc; ?></div>
							<?php } ?>
						</div>
					<?php } ?>
				
				</div>
			<?php
				}
				break;
				
			}
			
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }

    }
}

new Inwave_Simmple_Slide;
