<?php

/*
 * Inwave_Item_Info for Visual Composer
 */
if (!class_exists('Inwave_Item_Info')) {

    class Inwave_Item_Info extends Inwave_Shortcode{

        protected $name = 'inwave_item_info';

        function init_params() {
            return array(
                'name' => __("Item Info", 'inwavethemes'),
                'description' => __('Add a item info', 'inwavethemes'),
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
							"Infor item - style special" => "special",
							"Infor item - style circle" => "circle",
                        )
                    ),
					// array(
                        // "type" => "iwevent_preview_image",
                        // "heading" => __("Preview Style", "inwavethemes"),
                        // "param_name" => "preview_default",
                        // "value" => get_template_directory_uri() . '/assets/images/shortcodes/info-item-1.jpg',
                        // "dependency" => array('element' => 'style', 'value' => 'default')
                    // ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_special",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/info-item-special.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'special')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_circle",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/infor-item-circle.png',
                        "dependency" => array('element' => 'style', 'value' => 'circle')
                    ),
                    array(
                        'type' => 'textfield',
                        "admin_label" => true,
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Sub Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "sub_title",
						"dependency" => array('element' => 'style', 'value' => array('special'))
                    ),

					array(
                        "type" => "dropdown",
                        // "admin_label" => true,
                        "param_name" => "level",
                        "value" => array(
                            "Level 1" => "level1",
                            "Level 2" => "level2",
                            "Level 3" => "level3",
                            "Level 4" => "level4",
                            "Level 5" => "level5",
                        ),
						"dependency" => array('element' => 'style', 'value' => array('circle'))
                    ),
					// array(
                        // 'type' => 'textarea_html',
                        // "heading" => __("Info Item Content", "inwavethemes"),
                        // "value" => "",
                        // "param_name" => "content",
						// "dependency" => array('element' => 'style', 'value' => array('special'))
                    // ),
					array(
						"type" => "attach_image",
						"heading" => __("Client Image", "inwavethemes"),
						"param_name" => "image",
						"value" => "",
						"dependency" => array('element' => 'style', 'value' => array('special'))
					),
					array(
                        "type" => "textfield",
                        "heading" => __("Height Item", "inwavethemes"),
                        "param_name" => "item_height",
                        "description" => __('Height Item. Exp: 500px', "inwavethemes"),
                        "value" => "500px",
						"dependency" => array('element' => 'style', 'value' => array('special'))
                    ),
					// array(
                        // "type" => "dropdown",
                        // "group" => "Style",
                        // "heading" => __("Text align", "inwavethemes"),
                        // "param_name" => "align",
                        // "value" => array(
                            // "Default" => "",
                            // "Left" => "left",
                            // "Right" => "right",
                            // "Center" => "center"
                        // )
                    // ),
					array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $style = $title = $sub_title = $level = $image = $item_height = $css = $class = '';
            extract(shortcode_atts(array(
                'style' => 'special',
                'title' => '',
                'sub_title' => '',
                'level' => '',
                'image' => '',
                'item_height' => '',
                'css' => '',
				'class' => '',
            ), $atts));

            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
			
			if ($image) {
                $img = wp_get_attachment_image_src($image, 'full');
                $image = '<img src="' . $img[0] . '" alt=""/>';
            }

            switch ($style) {
                // Normal style
				case 'special':
					if ($item_height){
						$style = 'height:'.$item_height;
					} else {
						$style = '';
					}
					$output .= '<div class="iw-item-info ' . $class . '">';
					$output .= '<div class="iw-item-info-inner" style="'.$style.'">';
						// $output .= '<p class="description">'.do_shortcode($content).'</p>';
						$output .= '<h3 class="title"><i class="fa fa-clock-o"></i>'.$title.'</h3>';
						$output .= '<h4 class="sub-title"><i class="fa fa-phone"></i>'.$sub_title.'</h4>';
						if($image){
							$output.= '<div class="info-image">' . $image . '</div>';
						}
					$output .= '</div>';
					$output .= '</div>';
                break;
				
				case 'circle':
					$output .= '<div class="iw-item-info '. $level . $class . '">';
						$output .= '<div class="iw-item-info-inner">';
							$output .= '<h3 class="title">'.$title.'</h3>';
						$output .= '</div>';
					$output .= '</div>';
				break;
				
            }
            return $output;
        }
    }
}

new Inwave_Item_Info;
