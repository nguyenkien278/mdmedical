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
if (!class_exists('Inwave_Procedure_Work')) {

    class Inwave_Procedure_Work extends Inwave_Shortcode2{

        protected $name = 'inwave_procedure_work';
        protected $name2 = 'inwave_procedure_work_item';
        protected $procedure_work;
        protected $procedure_work_item;

        function init_params()
        {
            return array(
                "name" => __("MDmedical Procedure Work", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add procedure work step at MDmedical", "inwavethemes"),
                "as_parent" => array('only' => $this->name2),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "inwave_procedure_work_class",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Slide" => "style1",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/procedure_work_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
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
                "name" => __("Procedure Work Item", 'inwavethemes'),
                "base" => $this->name2,
                "class" => "inwave_procedure_work_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
				// "as_child" => array('only' => $this->name),
                "description" => __("Add a step in procedure work at MDmedical", "inwavethemes"),
           //     "show_settings_on_create" => true,
                "params" => array(
					array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - item in slide" => "style1",
                            "Style 2 - single item" => "style2",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_item_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/procedure_work_item_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_item_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/procedure_work_item_style2.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" =>true,
                        "heading" => __("Step number", "inwavethemes"),
                        "value" => "",
                        "param_name" => "step_number"
                    ),
					array(
                        'type' => 'textfield',
                        "admin_label" =>true,
                        "heading" => __("Title item", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title_item",
						"dependency" => array(
							'element' => 'style', 
							'value' => array('style2'),
						)
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Link đến bài viết", "inwavethemes"),
                        "description" => __("Thêm link đến bài viết tại đây", "inwavethemes"),
                        "value" => "#",
                        "param_name" => "link_item",
						"dependency" => array(
							'element' => 'style', 
							'value' => array('style2'),
						)
                    ),
					array(
                        'type' => 'textarea_html',
                        "heading" => __("Description of this step (what we do)", "inwavethemes"),
                        "value" => "",
                        "param_name" => "content"
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Image intro", "inwavethemes"),
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

            $output = $class = $title = $link_item = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
				'title' => '',
				'css' => '',
				'style' => 'style1',
				'show_navigation' => '',
				'autoplay' => '',
				// 'show_pagination' => '',
            ), $atts));
		
		
		$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
		
		ob_start();		
            $matches = array();
            //$count = preg_match_all('/\[inwave_procedure_work_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_procedure_work_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
            if ($count) {
                switch ($style){
                    case 'style1':
						wp_enqueue_style('owl-carousel');
						wp_enqueue_style('owl-theme');
						wp_enqueue_style('owl-transitions');
						wp_enqueue_script('owl-carousel');
						
						$autoplay = $autoplay ? 'true' : 'false';
						$show_navigation = $show_navigation ? 'true' : 'false';
						// $show_pagination = $show_pagination ? 'true' : 'false';
						
						$sliderConfig = '{';
						$sliderConfig .= '"navigation":'.$show_navigation;
						$sliderConfig .= ',"autoPlay":'.$autoplay;
						$sliderConfig .= ',"pagination":false';
						$sliderConfig .= ',"items":5';
						$sliderConfig .= ',"itemsDesktop":[1199,4]';
						$sliderConfig .= ',"itemsDesktopSmall":[991,3]';
						$sliderConfig .= ',"itemsTablet":[768,2]';
						$sliderConfig .= ',"itemsMobile":[479,1]';
						$sliderConfig .= ',"addClassActive":true';
						$sliderConfig .= ',"navigationText":["<i class=\"fa fa-chevron-left\"></i>","<i class=\"fa fa-chevron-right\"></i>"]';
						$sliderConfig .= '}';
				?>	
                        <div class="procedure-work <?php echo $class; ?>">
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title ?></h3>
							</div>
						<?php } ?>
						<div class="procedure-work-inner">
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

            $output = $step_number = $class = $image = $style = $title_item = '';
            extract(shortcode_atts(array(
                'step_number' => '',
                'image' => '',
				'link_item' => '',
                'style' => 'style1',
                'title_item' => '',
                'class' => ''
            ), $atts));

            if ($image) {
                $img = wp_get_attachment_image_src($image, 'full');
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }
			
			$class .= ' '.$style;
			switch ($style){
				case 'style1':
					$output.= '<div class="work-slide-item '.$class.'">';
					$output.= '<div class="slide-item-inner">';
						if ($step_number) {
							$output.= '<div class="slide-step">' . $step_number . '</div>';
						}
						if ($image) {
							$output.= '<div class="slide-image">' . $image . '</div>';
						}
						$output.= '<div class="slide-desc">' .do_shortcode($content). '</div>';
					$output.= '</div>';
					$output.= '</div>';
				break;
				case 'style2':
					$output.= '<div class="work-slide-item '.$class.'">';
					$output.= '<div class="slide-item-inner">';
						if ($step_number){
							$output.= '<div class="slide-step">' . $step_number . '</div>';
						}
						if ($image){
							$output.= '<div class="slide-image">' . $image . '</div>';
						}
						$output.= '<div class="slide-item-detail">';
							if ($title_item){
								if ($link_item){
									$output.= '<div class="title-item"><a href="'.$link_item.'">' . $title_item . '</a></div>';
								} else {
									$output.= '<div class="title-item">' . $title_item . '</div>';
								}
							}
							$output.= '<div class="slide-desc">' .do_shortcode($content). '</div>';
						$output.= '</div>';
					$output.= '</div>';
					$output.= '</div>';
				break;
			}
			
			
			
			
            return $output;
        }
    }
}

new Inwave_Procedure_Work;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Procedure_Work extends WPBakeryShortCodesContainer {}
}
