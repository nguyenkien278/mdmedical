<?php

/*
 * Inwave_Heading for Visual Composer
 */
if (!class_exists('Inwave_Heading')) {

    class Inwave_Heading extends Inwave_Shortcode{

        protected $name = 'inwave_heading';

        function init_params() {
            $google_fonts = function_exists('inwave_get_googlefonts') ? inwave_get_googlefonts() : array();
            $font_weight = function_exists('inwave_get_fonts_weight') ? inwave_get_fonts_weight() : array();
            $text_transform = function_exists('inwave_get_text_transform') ? inwave_get_text_transform() : array();
            return array(
                'name' => __("Heading", 'inwavethemes'),
                'description' => __('Add a heading & some information', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Normal" => "style1",
                            "Style 2 - Underline - Button link bottom" => "style2",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_normal",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/preview-heading-v1.png',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/heading-v2.png',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
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
                        'type' => 'textfield',
                        "heading" => __("Sub title", "inwavethemes"),
                        "description" => __("Sub title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "sub_title",
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "description",
                        "dependency" => array(
                            "element" => "style",
                            "value" => array("style1", "style2")
                        )
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Link button", "inwavethemes"),
                        "value" => "#",
                        "description" => __('Link to view more', "inwavethemes"),
                        "param_name" => "link_button",
						"dependency" => array(
                            "element" => "style",
                            "value" => array("style2")
                        )
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Text button", "inwavethemes"),
                        "value" => "Chi tiết",
                        "description" => __('Text of button link to view more', "inwavethemes"),
                        "param_name" => "text_button",
						"dependency" => array(
                            "element" => "style",
                            "value" => array("style2")
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Width Heading", "inwavethemes"),
                        "value" => "",
                        "description" => __('Custom width heading. Exp: 100%, 800px', "inwavethemes"),
                        "param_name" => "width_heading",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => "Text align",
                        "param_name" => "align",
                        "value" => array(
                            "Default" => "",
                            "Left" => "left",
                            "Right" => "right",
                            "Center" => "center"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),

                    //title style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Title Color", "inwavethemes"),
                        "group" => "Title Style",
                        "param_name" => "color_title",
                        "description" => __('Color for Title', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Title Style",
                        "heading" => __("Title Font Size", "inwavethemes"),
                        "value" => "",
                        "description" => __('Custom font-size title. Example: 30px', "inwavethemes"),
                        "param_name" => "font_size_title",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Title Font Family", "inwavethemes"),
                        "group" => "Title Style",
                        "param_name" => "font_family_title",
                        "description" => __('Font family of Title', "inwavethemes"),
                        "value" => $google_fonts,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Load Font Family from google", "inwavethemes"),
                        "param_name" => "load_font_title",
                        "value" => array(
                            __('No', "inwavethemes") => '',
                            __('Yes', "inwavethemes") => '1',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Title Font Weight", "inwavethemes"),
                        "param_name" => "font_weight_title",
                        "description" => __('Font weight of Title', "inwavethemes"),
                        "value" => $font_weight,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Title Style",
                        "heading" => __("Title Text Transform", "inwavethemes"),
                        "param_name" => "text_transform_title",
                        "description" => __('Text Transform of Title', "inwavethemes"),
                        "value" => $text_transform,
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Line Height", "inwavethemes"),
                        "param_name" => "line_height_title",
                        "description" => __('Line height of Title. Example: 30px or 1', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Margin-bottom", "inwavethemes"),
                        "param_name" => "margin_bottom_title",
                        "description" => __('Margin bottom of Title. Exp: 20px', "inwavethemes"),
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Title Style",
                        "heading" => __("Title Letter Spacing", "inwavethemes"),
                        "param_name" => "margin_letter_spacing",
                        "description" => __('Letter spacing of Title', "inwavethemes"),
                        "value" => '',
                    ),

                    //subtitle style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Sub Title Color", "inwavethemes"),
                        "group" => "Sub Title Style",
                        "param_name" => "color_sub_title",
                        "description" => __('Color for Sub Title', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Sub Title Style",
                        "heading" => __(" Sub Title Font Size", "inwavethemes"),
                        "value" => "",
                        "description" => __('Custom font-size title. Example: 30px', "inwavethemes"),
                        "param_name" => "font_size_sub_title",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Sub Title Font Family", "inwavethemes"),
                        "group" => "Sub Title Style",
                        "param_name" => "font_family_sub_title",
                        "description" => __('Font family of Sub Title', "inwavethemes"),
                        "value" => $google_fonts,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Load Font Family from google", "inwavethemes"),
                        "param_name" => "load_font_sub_title",
                        "value" => array(
                            __('No', "inwavethemes") => '',
                            __('Yes', "inwavethemes") => '1',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Font Weight", "inwavethemes"),
                        "param_name" => "font_weight_sub_title",
                        "description" => __('Font weight of Sub Title', "inwavethemes"),
                        "value" => $font_weight,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Text Transform", "inwavethemes"),
                        "param_name" => "text_transform_sub_title",
                        "description" => __('Text Transform of Sub Title', "inwavethemes"),
                        "value" => $text_transform,
                    ),
					array(
                        "type" => "dropdown",
                        "group" => "Sub Title Style",
                        "heading" => __("Font style", "inwavethemes"),
                        "param_name" => "sub_title_font_style",
                        "value" => array(
                            __('Default', "inwavethemes") => '',
                            __('Italic', "inwavethemes") => 'italic',
                            __('Normal', "inwavethemes") => 'normal',
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Sub Title Style",
                        "heading" => __("Sub Title Line Height", "inwavethemes"),
                        "param_name" => "line_height_sub_title",
                        "description" => __('Line height of Sub Title', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Sub Title Style",
                        "heading" => __("Margin bottom", "inwavethemes"),
                        "param_name" => "margin_bottom_sub_title",
                        "description" => __('Margin bottom of Sub Title. Example: 30px', "inwavethemes"),
                        "value" => "",
                    ),

                    //Description style
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Description Color", "inwavethemes"),
                        "group" => "Description Style",
                        "param_name" => "color_description",
                        "description" => __('Color for Description', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        "group" => "Description Style",
                        "heading" => __(" Description Font Size", "inwavethemes"),
                        "value" => "",
                        "description" => __('Custom font-size Description. Example: 30px', "inwavethemes"),
                        "param_name" => "font_size_description",
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Description Font Family", "inwavethemes"),
                        "group" => "Description Style",
                        "param_name" => "font_family_description",
                        "description" => __('Font family of Description', "inwavethemes"),
                        "value" => $google_fonts,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Load Font Family from google", "inwavethemes"),
                        "param_name" => "load_font_description",
                        "value" => array(
                            __('No', "inwavethemes") => '',
                            __('Yes', "inwavethemes") => '1',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Description Font Weight", "inwavethemes"),
                        "param_name" => "font_weight_description",
                        "description" => __('Font weight of Description', "inwavethemes"),
                        "value" => $font_weight,
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Description Style",
                        "heading" => __("Description Text Transform", "inwavethemes"),
                        "param_name" => "text_transform_description",
                        "description" => __('Text Transform of Description', "inwavethemes"),
                        "value" => $text_transform,
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Description Style",
                        "heading" => __("Description Line Height", "inwavethemes"),
                        "param_name" => "line_height_description",
                        "description" => __('Line height of description', "inwavethemes"),
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Description Style",
                        "heading" => __("Margin top", "inwavethemes"),
                        "param_name" => "margin_top_description",
                        "description" => __('Margin bottom of Description. Example: 30px', "inwavethemes"),
                        "value" => "",
                    ),

                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        // 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $link_button = $text_button = '';
            $content = preg_replace('/^\<\/p\>(.*)\<p\>$/Usi','$1',$content);
            extract(shortcode_atts(array(
                'title' => '',
                'sub_title' => '',
                'description' => '',
                'link_button' => '',
                'text_button' => '',
                'width_heading' => '100%',
                'heading_type' => '',
                'align' => '',
                'style' => 'style1',

                'color_title' => '',
                'font_size_title' => '',
                'font_family_title' => '',
                'load_font_title' => '',
                'font_weight_title' => '',
                'text_transform_title' => '',
                'line_height_title' => '',
                'margin_bottom_title' => '',
                'margin_letter_spacing' => '',

                'color_sub_title' => '',
                'font_size_sub_title' => '',
                'font_family_sub_title' => '',
                'load_font_sub_title' => '',
                'font_weight_sub_title' => '',
                'text_transform_sub_title' => '',
                'line_height_sub_title' => '',
                'sub_title_font_style' => '',
                'margin_bottom_sub_title' => '',

                'color_description' => '',
                'font_size_description' => '',
                'font_family_description' => '',
                'load_font_description' => '',
                'font_weight_description' => '',
                'text_transform_description' => '',
                'line_height_description' => '',
                'margin_top_description' => '',

                'image_vertical'    => '',

                'css' => '',
                'class' => ''
            ), $atts));

            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
            if($align){
                $class.= ' text-'.$align;
            }
            $width_heading_css = '';
            if($width_heading){
                $width_heading_css.= 'width: '.esc_attr($width_heading);
            }
            //title
            $title_style = array();
            if($color_title){
                $title_style[] = 'color: '.esc_attr($color_title);
            }
            if($font_size_title){
                $title_style[] = 'font-size: '.esc_attr($font_size_title);
            }
            if($font_family_title){
                if($load_font_title && !isset(Inwave_Shortcode::$loadfonts[$font_family_title.$font_weight_title])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_title}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_title.$font_weight_title)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_title.$font_weight_title] = true;
                }
                $title_style[] = 'font-family: '.esc_attr($font_family_title);
            }
            if($font_weight_title){
                $title_style[] = 'font-weight: '.esc_attr($font_weight_title);
            }
            if($text_transform_title){
                $title_style[] = 'text-transform: '.esc_attr($text_transform_title);
            }
            if($line_height_title){
                $title_style[] = 'line-height: '.esc_attr($line_height_title);
            }
            if($margin_bottom_title || $margin_bottom_title != 0){
                $title_style[] = 'margin-bottom: '.esc_attr($margin_bottom_title);
            }
            if($margin_letter_spacing){
                $title_style[] = 'letter-spacing: '.esc_attr($margin_letter_spacing);
            }

            //subtitle
            $sub_title_style = array();
            if($color_sub_title){
                $sub_title_style[] = 'color: '.esc_attr($color_sub_title);
            }
            if($font_size_sub_title){
                $sub_title_style[] = 'font-size: '.esc_attr($font_size_sub_title);
            }
            if($font_family_sub_title){
                if($load_font_sub_title && !isset(Inwave_Shortcode::$loadfonts[$font_family_sub_title.$font_weight_sub_title])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_sub_title}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_sub_title.$font_weight_sub_title)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_sub_title.$font_weight_sub_title] = true;
                }
                $sub_title_style[] = 'font-family: '.esc_attr($font_family_sub_title);
            }
            if($font_weight_sub_title){
                $sub_title_style[] = 'font-weight: '.esc_attr($font_weight_sub_title);
            }
            if($text_transform_sub_title){
                $sub_title_style[] = 'text-transform: '.esc_attr($text_transform_sub_title);
            }
            if($sub_title_font_style){
                $sub_title_style[] = 'font-style: '.esc_attr($sub_title_font_style);
            }
            if($line_height_sub_title){
                $sub_title_style[] = 'line-height: '.esc_attr($line_height_sub_title);
            }
            if($margin_bottom_sub_title || $margin_bottom_sub_title != 0){
                $sub_title_style[] = 'margin-bottom: '.esc_attr($margin_bottom_sub_title);
            }

            //description
            $description_style = array();
            if($color_description){
                $description_style[] = 'color: '.esc_attr($color_description);
            }
            if($font_size_description){
                $description_style[] = 'font-size: '.esc_attr($font_size_description);
            }
            if($font_family_description){
                if($load_font_description && !isset(Inwave_Shortcode::$loadfonts[$font_family_description.$font_weight_description])){
                    $font_url = "http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$font_family_description}";
                    wp_enqueue_style('google-font-'.strtolower(str_replace(" ", "-", $font_family_description.$font_weight_description)), $font_url);
                    Inwave_Shortcode::$loadfonts[$font_family_description.$font_weight_description] = true;
                }
                $description_style[] = 'font-family: '.esc_attr($font_family_description);
            }
            if($font_weight_description){
                $description_style[] = 'font-weight: '.esc_attr($font_weight_description);
            }
            if($text_transform_description){
                $description_style[] = 'text-transform: '.esc_attr($text_transform_description);
            }
            if($line_height_description){
                $description_style[] = 'line-height: '.esc_attr($line_height_description);
            }
            if($margin_top_description){
                $description_style[] = 'margin-top: '.esc_attr($margin_top_description);
            }

            $title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
            $title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
            $title= preg_replace('/\/\/\//i', '<br />', $title);

            $sub_title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$sub_title);
            $sub_title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$sub_title);
            $sub_title= preg_replace('/\/\/\//i', '<br />', $sub_title);

            $description= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$description);
            $description= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$description);
            $description= preg_replace('/\/\/\//i', '<br />', $description);
			
			$content= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$content);
            $content= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$content);
            $content= preg_replace('/\/\/\//i', '<br />', $content);
			
            if(!$heading_type){
                $heading_type = 'h3';
            }
            switch ($style) {
                // Normal style
                case 'style1':
                $output .= '<div class="iw-heading ' . $class . '" style="' .$width_heading_css. '">';
                
				if ($title){
					$output .= '<h3 class="iwh-title" style="'.implode("; ",$title_style).'">' . $title . '</h3>';
				}
				if ($sub_title) {
                    $output .= '<div class="iwh-sub-title" style="'.implode("; ",$sub_title_style).'">' . $sub_title . '</div>';
                }
                if ($description) {
                    $output .= '<div class="iwh-description" style="'.implode("; ",$description_style).'">' . $description . '</div>';
                }
                $output .= '</div>';
                break;

                case 'style2':
                    $output .= '<div class="iw-heading ' . $class . '" style="' .$width_heading_css. '">';
					if ($title) {
						$output .= '<h3 class="iwh-title" style="'.implode("; ",$title_style).'">' . $title . '</h3>';
					}
					if ($sub_title) {
						$output .= '<div class="iwh-sub-title" style="'.implode("; ",$sub_title_style).'">' . $sub_title . '</div>';
					}
                    if ($description) {
                        $output .= '<div class="iwh-description" style="'.implode("; ",$description_style).'">' . $description . '</div>';
                    }
					if ($link_button){
						$output .= '<div class="iwh-viewmore"><a href="'.$link_button.'">'.$text_button.'</a></div>';
					}
                    $output .= '</div>';
                break;

            }
            return $output;
        }
    }
}

new Inwave_Heading;
