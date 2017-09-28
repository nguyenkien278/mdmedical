<?php
/*
 * Inwave_Funfact_List for Visual Composer
 */
if (!class_exists('Inwave_Funfact_List')) {

    class Inwave_Funfact_List extends Inwave_Shortcode2{

        protected $name = 'inwave_funfact_list';
        protected $name2 = 'inwave_funfact_item';

        function init_params() {
            return array(
                "name" => __("Funfact List", 'inwavethemes'),
                "base" => $this->name,
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of list info and give some custom style.", "inwavethemes"),
                "as_parent" => array('only' => 'inwave_funfact_item'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
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

        function init_params2() {
            return array(
                'name' => __("Funfact Item", 'inwavethemes'),
                "base" => $this->name2,
                'description' => __('Insert a funfact style', 'inwavethemes'),
                "class" => "inwave_info_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
                "show_settings_on_create" => true,
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Style",
                        "admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("Number",'inwavethemes'),
                        "param_name" => "number",
                        "value" => "550",
                        "description" => __("Add number funfact on for element",'inwavethemes')
                    ),
                    array(
                        "type" => "textfield",
                        "admin_label" => true,
                        "heading" => __("title",'inwavethemes'),
                        "param_name" => "title",
                        "value" => "",
                        "description" => __("Add title Funfacr for element",'inwavethemes')
                    ),
                    array(
                        'type' => 'textarea_html',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "content"
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Image", "inwavethemes"),
                        "param_name" => "img",
                        "description" => __("Image", "inwavethemes"),
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),

                )
            );
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = '';
            extract(shortcode_atts(array(
                "class" => "",
            ), $atts));

            $output .= '<div class="inwave-funfact-list ' . $class . '">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            return $output;
        }

        function init_shortcode2($atts, $content = null){
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name2, $atts ) : $atts;

            $output = $style = $number = $title = $img = '';
            extract( shortcode_atts(
                array(
                    'style' => 'style1',
                    'number' => '',
                    'title' => '',
                    'img' => '',
                ), $atts ));

            $img_tag = '';
            if ($img) {
                $img = wp_get_attachment_image_src($img, 'large');
                $img = $img[0];
                $img_tag .= '<img src="' . $img . '" alt="' . $title . '">';
            }

            switch ($style){
                case 'style1':
                    $output .='<div class="inwave-funfact-item style1 theme-bg">';
                    $output .='<div class="funfact-img">';
                    $output .= $img_tag;
                    $output .='</div>';
                    $output .='<div class="funfact-info">';
                    if($number){
                        $output .='<div class="funfact-number">'.$number.'</div>';
                    }
                    if($title){
                        $output .='<div class="funfact-title">'.$title.'</div>';
                    }
                    $output .='</div>';
                    $output .='<div class="iw-clear_both"></div>';
                    $output .='</div>';
                    break;
            }

            return $output;
        }
    }
}

new Inwave_Funfact_List();
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Inwave_Funfact_List extends WPBakeryShortCodesContainer {
    }
}
