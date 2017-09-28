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
if (!class_exists('Inwave_Solution')) {

    class Inwave_Solution extends Inwave_Shortcode2{

        protected $name = 'inwave_solution';
        protected $name2 = 'inwave_solution_item';
        protected $solution;
        protected $solution_item;

        function init_params()
        {
            return array(
                "name" => __("Solution at MDmedical", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add list solution at MDmedical", "inwavethemes"),
                "as_parent" => array('only' => $this->name2),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "inwave_solution_class",
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
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/solution_list_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
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
                "name" => __("Solution Item", 'inwavethemes'),
                "base" => $this->name2,
                "class" => "inwave_solution_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
				"as_child" => array('only' => $this->name),
                "description" => __("Add a step in procedure work at MDmedical", "inwavethemes"),
           //     "show_settings_on_create" => true,
                "params" => array(
                    
					array(
                        'type' => 'textfield',
                        "heading" => __("Title item", "inwavethemes"),
                        "value" => "",
						"admin_label" =>true,
						"description" => __("You can add '///' to insert line break tag (br)", "inwavethemes"),
                        "param_name" => "item_title"
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Item Link", "inwavethemes"),
						"description" => __('Link to open when click on title item', "inwavethemes"),
                        "value" => "",
						"admin_label" =>true,
                        "param_name" => "item_url"
                    ),
					array(
                        'type' => 'textarea',
                        "heading" => __("Item description", "inwavethemes"),
						"description" => __('Description of this step (what we do)', "inwavethemes"),
                        "value" => "",
                        "param_name" => "item_desc"
                    ),
					
					array(
                        "type" => "colorpicker",
                        "heading" => __("Background item", "inwavethemes"),
                        "group" => "Item Style",
                        "param_name" => "item_background",
                        "description" => __('Background of item', "inwavethemes"),
                        "value" => "rgba(242,215,93,0.5)",
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Item size", "inwavethemes"),
                        "group" => "Item Style",
                        "param_name" => "item_size",
                        "description" => __('Size of item (height + width). Exp: 250px', "inwavethemes"),
                        "value" => "250px",
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => "Item position",
						"group" => "Item Style",
                        "param_name" => "item_position",
                        "value" => array(
							"Default" => "static",
                            "Relative" => "relative",
                            "Absolute" => "absolute",
                        )
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Left space", "inwavethemes"),
                        "group" => "Item Style",
                        "param_name" => "item_left_space",
                        "description" => __('Item Left Space. Exp: 250px', "inwavethemes"),
                        "value" => "250px",
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Top space", "inwavethemes"),
                        "group" => "Item Style",
                        "param_name" => "item_top_space",
                        "description" => __('Item Top Space. Exp: 250px', "inwavethemes"),
                        "value" => "250px",
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Padding", "inwavethemes"),
                        "group" => "Item Style",
                        "param_name" => "item_padđing",
                        "description" => __('Item Padding. Exp: 30px 30px 30px 30px', "inwavethemes"),
                        "value" => "30px",
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
            ), $atts));

		
		$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
		
		ob_start();		
            $matches = array();
            //$count = preg_match_all('/\[inwave_procedure_work_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_solution_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
            if ($count) {
                switch ($style){
                    case 'style1':
				?>	
                        <div class="jm-solution <?php echo $class; ?>">
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title ?></h3>
							</div>
						<?php } ?>
							<div class="solution-inner">
								<div >
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

            $output = $step_number = $desc = $class = '';
            extract(shortcode_atts(array(
                'item_title' => '',
                'item_url' => '',
                'item_desc' => '',
                'item_background' => '',
                'item_size' => '',
                'item_position' => '',
                'item_left_space' => '',
                'item_top_space' => '',
                'item_padđing' => '',
                'class' => ''
            ), $atts));
			
			
			
			
			$item_style = array();
			if($item_background){
                $item_style[] = 'background: '.esc_attr($item_background);
            }
			if($item_size){
                $item_style[] = 'width: '.esc_attr($item_size);
            }
			if($item_size){
                $item_style[] = 'height: '.esc_attr($item_size);
            }
			if($item_position){
                $item_style[] = 'position: '.esc_attr($item_position);
            }
			if($item_left_space){
                $item_style[] = 'left: '.esc_attr($item_left_space);
            }
			if($item_top_space){
                $item_style[] = 'top: '.esc_attr($item_top_space);
            }
			if($item_padđing){
                $item_style[] = 'padding: '.esc_attr($item_padđing);
            }
			
			$item_title= preg_replace('/\/\/\//i', '<br />', $item_title);
            
			$has_desc = $item_desc ? '' : 'no-desc';
			
			$output.= '<div class="solution-item" style="'.implode("; ",$item_style).'">';
			$output.= '<div class="solution-item-inner '.$has_desc.'">';
			if ($item_url){
				$output .= '<a href="'.$item_url.'">';
			}
				$output.= '<h3 class="solution-title">' . $item_title . '</h3>';
				$output.= '<div class="slide-desc">' . $item_desc . '</div>';
			if ($item_url){
				$output .= '</a>';
			}	
			$output.= '</div>';
			$output.= '</div>';
			
            return $output;
        }
    }
}

new Inwave_Solution;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Solution extends WPBakeryShortCodesContainer {}
}
