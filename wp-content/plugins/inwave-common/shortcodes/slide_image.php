<?php

/*
 * @package Inwave Event
 * @version 1.0.0
 * @created May 5, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of testimonials
 *
 * @developer duongca
 */
if (!class_exists('Inwave_Prize_Brand')) {

    class Inwave_Prize_Brand extends Inwave_Shortcode2{

        protected $name = 'inwave_prize_brand';
        protected $name2 = 'inwave_prize_brand_item';
        protected $prize_brand;
        protected $prize_brand_item;
		protected $style = '';

        function init_params()
        {
            return array(
                "name" => __("Slide image", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a slide image with jcarousel", "inwavethemes"),
                "as_parent" => array('only' => $this->name2),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "inwave_prize_brand_class",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Slide brand" => "style1",
							"Style 2 - Slide nhân sự" => "style2",
							"Style 3 - Slide single image" => "style3",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/prize_brand_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/prize_brand_style2.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style3",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/prize_brand_style3.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style3')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Title", "inwavethemes"),
                        "description" => __("Add your title for this slider here", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
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
							"value" => array('style1','style2','style3'),
						)
                    ),
					array(
                        'type' => 'checkbox',
						"group" => "Slide config",
                        'heading' => __( 'Show navigation?', 'inwavethemes' ),
						"description" => __("Check this option to show navigation slide", "inwavethemes"),
						'std' => 'true',
						'param_name' => 'show_navigation',
						"dependency" => array(
							'element' => 'style', 
							"value" => array('style1','style2'),
						)
                    ),
					array(
                        'type' => 'checkbox',
						"group" => "Slide config",
                        'heading' => __( 'Show pagination?', 'inwavethemes' ),
						"description" => __("Check this option to show pagination slide", "inwavethemes"),
                        'param_name' => 'show_pagination',
						'std' => 'true',
						"dependency" => array(
							'element' => 'style', 
							"value" => array('style1','style2','style3'),
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

        function init_params2() {
            return array(
                "name" => __("Slide image item", 'inwavethemes'),
                "base" => $this->name2,
                "class" => "inwave_prize_brand_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
				"as_child" => array('only' => $this->name),
                "description" => __("Add a slide image item", "inwavethemes"),
           //     "show_settings_on_create" => true,
                "params" => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title image", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title_item"
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Choose Image", "inwavethemes"),
                        "param_name" => "image",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
					
                )
            );
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $title = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
				'title' => '',
				'css' => '',
				'style' => 'style1',
				'show_navigation' => '',
				'autoplay' => '',
				'show_pagination' => '',
            ), $atts));
		
			
			$this->style = $style;
			$class .=  ' '.$class.' '.$style.' '. vc_shortcode_custom_css_class( $css);
		
		ob_start();		
            $matches = array();
            //$count = preg_match_all('/\[inwave_prize_brand_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_prize_brand_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
            if ($count) {
				wp_enqueue_style('owl-carousel');
				wp_enqueue_style('owl-theme');
				wp_enqueue_style('owl-transitions');
				wp_enqueue_script('owl-carousel');
                switch ($style){
                    case 'style1':
					case 'style2':
						$autoplay = $autoplay ? 'true' : 'false';
						$show_navigation = $show_navigation ? 'true' : 'false';
						$show_pagination = $show_pagination ? 'true' : 'false';
						
						$sliderConfig = '{';
						$sliderConfig .= '"navigation":'.$show_navigation;
						$sliderConfig .= ',"autoPlay":'.$autoplay;
						$sliderConfig .= ',"pagination":false';
						$sliderConfig .= ',"slideSpeed":800';
						$sliderConfig .= ',"items":3';
						$sliderConfig .= ',"itemsDesktop":[1199,3]';
						$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
						$sliderConfig .= ',"itemsTablet":[768,1]';
						$sliderConfig .= ',"itemsMobile":[479,1]';
						$sliderConfig .= ',"addClassActive":true';
						$sliderConfig .= ',"navigationText":["<i class=\"ion-ios-arrow-left\"></i>","<i class=\"ion-ios-arrow-right\"></i>"]';
						$sliderConfig .= '}';
				?>	
                        <div class="prize-brand-slide<?php echo $class; ?>">
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title ?></h3>
							</div>
						<?php } ?>
						<div class="prize-brand-inner">
						<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
                       <?php echo do_shortcode($content); ?>
						</div>
                        </div>
                       </div>
               <?php
				break;
				case 'style3':
					$autoplay = $autoplay ? 'true' : 'false';
					$show_pagination = $show_pagination ? 'true' : 'false';
					
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":false';
					$sliderConfig .= ',"autoPlay":'.$autoplay;
					$sliderConfig .= ',"pagination":'.$show_pagination;
					$sliderConfig .= ',"slideSpeed":800';
					$sliderConfig .= ',"singleItem":true';
					$sliderConfig .= ',"addClassActive":true';
					// $sliderConfig .= ',"navigationText":["<i class=\"ion-ios-arrow-left\"></i>","<i class=\"ion-ios-arrow-right\"></i>"]';
					$sliderConfig .= '}';
				?>	
					 <div class="prize-brand-slide<?php echo $class; ?>">
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title ?></h3>
							</div>
						<?php } ?>
						<div class="prize-brand-inner">
						<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
                       <?php echo do_shortcode($content); ?>
						</div>
                        </div>
                    </div>
				<?php
				break;
                }
            }
			$html = ob_get_contents();
            ob_end_clean();

            return $html;
		}

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name2, $atts ) : $atts;

            $output = $title_item = $image = $class = '';
            extract(shortcode_atts(array(
                'title_item' => '',
                'image' => '',
                'class' => ''
            ), $atts));
			
			$style_item = $this->style;
			
			// var_dump($style_item);
			
            if ($image) {
                $img = wp_get_attachment_image_src($image, 'full');
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }

            switch ($style_item){
				case 'style1':
				$output.= '<div class="slide-item">';
					$output.= '<div class="slide-image">' . $image . '</div>';
					if ($title_item){
						$output.= '<h3 class="slide-title">' . $title_item . '</h3>';
					}
				$output.= '</div>';
				
				break;
				case 'style2':
				case 'style3':
					$output.= '<div class="slide-item">';
					$output.= '<div class="slide-image">' . $image . '</div>';
					$output.= '</div>';
				break;
			
			}
			
            return $output;
        }
    }
}

new Inwave_Prize_Brand;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Prize_Brand extends WPBakeryShortCodesContainer {}
}
