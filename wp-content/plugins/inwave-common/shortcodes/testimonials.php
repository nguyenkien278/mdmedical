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
if (!class_exists('Inwave_Testimonials')) {

    class Inwave_Testimonials extends Inwave_Shortcode2{

        protected $name = 'inwave_testimonials';
        protected $name2 = 'inwave_testimonial_item';
        protected $testimonials;
        protected $testimonial_item;
        protected $style;


        function register_scripts()
        {
            wp_enqueue_script('iw-testimonials', plugins_url('inwave-common/assets/js/iw-testimonials.js'), array('jquery'), INWAVE_COMMON_VERSION);
            wp_enqueue_style('iw-testimonials', plugins_url('inwave-common/assets/css/iw-testimonials.css'), array(), INWAVE_COMMON_VERSION);
        }

        function init_params()
        {
            return array(
                "name" => __("Testimonials", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of testimonial and give some custom style.", "inwavethemes"),
                "as_parent" => array('only' => $this->name2),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Scroll" => "style1",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/testimonial-v1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Title", "inwavethemes"),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Height", "inwavethemes"),
                        "description" => __("Enter height value to make scroll list. Exp: 400px", "inwavethemes"),
                        "value" => "400px",
                        "param_name" => "max_height",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Sub Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "sub_title",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "description",
                        "dependency" => array('element' => 'style', 'value' => 'style1')
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
                "name" => __("Testimonial Item", 'inwavethemes'),
                "base" => $this->name2,
                "class" => "inwave_testimonial_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
//                "as_child" => array('only' => $this->name),
                "description" => __("Add a list of testimonials with some content and give some custom style.", "inwavethemes"),
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
                        "admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/testimonial-v1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Name", "inwavethemes"),
                        "value" => "This is Name",
                        "param_name" => "name"
                    ),
                    array(
                        'type' => 'textarea_html',
                        /*"holder" => "div",*/
                        "heading" => __("Testimonial Content", "inwavethemes"),
                        "value" => "",
                        "param_name" => "content"
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Client Image", "inwavethemes"),
                        "param_name" => "image",
                        "value" => "",
                        "dependency" => array('element' => 'style', 'value' => array('style1', 'style3'))
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

            $output = $class = $style = $title = $sub_title = $description = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1",
                "title" => "",
                "sub_title" => "",
                "description" => "",
				'css' => '',
            ), $atts));

            $this->style = $style;
			
			$sub_title= preg_replace('/\/\/\//i', '<br />', $sub_title);

            $matches = array();
            //$count = preg_match_all('/\[inwave_testimonial_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_testimonial_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );

            if ($count) {
                switch ($style){
                    case 'style1':
                        $output .= '<div class="iw-testimonals style1">';
						$output .= '<div id="scrollbox3" class="iw-testimonals-inner">';
                        $output .= do_shortcode($content);
						$output .= '</div>';
                        $output .= '</div>';
                        break;
                }
            }

            return $output;
        }

        // Shortcode handler function for item
        function init_shortcode2($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name2, $atts ) : $atts;

            $output = $style = $name = $image = $class = '';
            extract(shortcode_atts(array(
                'style' => '',
                'name' => '',
                'image' => '',
                'class' => ''
            ), $atts));

            if ($image) {
                $img = wp_get_attachment_image_src($image);
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }

            switch ($style){
                case 'style1':
					$output.= '<div class="iw-testimonial-item style1">';
						$output.= '<div class="testi-info-wrap">';
							$output.= '<div class="testi-top">';
								if($image){
									$output.= '<div class="testi-image">' . $image . '</div>';
								}
								$output.= '<div class="testi-name">';
									if($name){
										$output.= '<div class="testi-client-name">' . $name . '</div>';
									}
								$output.= '</div>';
							$output.= '</div>';
							if($content){
								$output.= '<div class="testi-content">' .do_shortcode($content) . '</div>';
							}
						$output.= '</div>';
					$output.= '</div>';
                break;

                
            }
            return $output;
        }
    }
}

new Inwave_Testimonials;
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Testimonials extends WPBakeryShortCodesContainer {}
}
