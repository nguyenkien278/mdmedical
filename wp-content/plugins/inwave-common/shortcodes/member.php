<?php

/*
 * Inwave_Member for Visual Composer
 */
if (!class_exists('Inwave_Member')) {

    class Inwave_Member extends Inwave_Shortcode{

        protected $name = 'inwave_member';

        function init_params() {
            return array(
                'name' => __("Team Member", 'inwavethemes'),
                'description' => __('Add a item info', 'inwavethemes'),
                'base' => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Name", "inwavethemes"),
                        "value" => "Ernesto Ryan",
                        "param_name" => "name",
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Position", "inwavethemes"),
                        "value" => "Tour Manager",
                        "param_name" => "position",
                    ),
                    array(
                        'type' => 'textarea',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "We take pride in delivering Intelligent Designs and Enaging Experiences for clients",
                        "param_name" => "description",
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Image", "inwavethemes"),
                        "value" => "",
                        "param_name" => "image",
                    ),
                    array(
                        'type' => 'exploded_textarea',
                        "heading" => __("Socials", "inwavethemes"),
                        "description" => __("Each row you can set fa-icon|link ex. fa-facebook|http://facebook.com", "inwavethemes"),
                        "value" => "fa-facebook|http://facebook.com\nfa-twitter|http://twitter.com\nfa-linkedin|http://linkedin.com\nfa-youtube|http://youtube.com",
                        "param_name" => "socials",
                    ),
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = '';
            extract(shortcode_atts(array(
                'name' => '',
                'position' => '',
                'description' => '',
                'image' => '',
                'socials' => '',
                'css' => '',
            ), $atts));

            //$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);

            $output .= '<div class="iw-member iw-effect-1">';
                if(!$image){
                    $image = it_get_placeholder_image();
                }else{
                    $image = wp_get_attachment_image_src($image, 'full');
                    $image = $image[0];
                }
                $output .= '<img src="'.esc_url($image).'" alt="">';
                $output .= '<div class="iw-member-info">';
                    $output .= '<div class="iw-member-top">';
                        $output .= '<h3>'.$name.'</h3>';
                        $output .= '<h4>'.$position.'</h4>';
                    $output .= '</div>';
                    $output .= '<div class="iw-member-bottom">';
                        $output .= '<p>'.$description.'</p>';
                        $output .= '<ul class="socials">';
                        $socials = explode(',', $socials);
                        foreach ($socials as $social){
                            $social = explode('|', $social);
                            $output .= '<li><a href="'.esc_url($social[1]).'"><i class="fa '.esc_attr($social[0]).'"></i></a></li>';
                        }
                        $output .= '</ul>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';

            return $output;
        }
    }
}

new Inwave_Member;
