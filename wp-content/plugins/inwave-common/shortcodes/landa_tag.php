<?php

/*
 * @package MDmedical
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
if (!class_exists('Inwave_Landa_Tag')) {

    class Inwave_Landa_Tag extends Inwave_Shortcode{

        protected $name = 'inwave_landa_tag';
		
		function getLandaPost() {
            $args['posts_per_page'] = '-1';
			$args['post_type'] = 'lan_da';
			$args['post_status'] = 'publish';
			
            $all_posts = get_posts($args);
			// var_dump($_categories);
			
			// echo '<style>#adminmenumain{display:none!important;}</style>';
            $posts_arr = array();
            $posts_arr[__("Chọn bài viết", "inwavethemes")] = '';
            foreach ($all_posts as $item_post) {
                $posts_arr[$item_post->ID.' - '.$item_post->post_title] = $item_post->ID;
            }
			// var_dump($posts_arr);
            return $posts_arr;
        }
		
		
		
        function init_params(){	
            return array(
                "name" => __("Tag post Làn Da", 'inwavethemes'),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Get tag list in a post Làn Da Của Bạn.", "inwavethemes"),
                "params" => array(
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
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/preview-nangcap-tag.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => "Select Post",
                        "admin_label" => true,
                        "param_name" => "select_post",
                        "value" => $this->getLandaPost(),
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

            $output = $class = $style = $select_post = $css = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "style" => "style1",
                "select_post" => "",
				'css' => '',
            ), $atts));

        
		$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
		ob_start();
			
			switch ($style){
				case 'style1':
					if ($select_post){
						$terms = get_the_terms($select_post, 'landa_tag' );	
						if (!empty($terms)){
							?>
							<div class="single-field-tag landa_tag">
								<h3 class="title"><?php echo esc_html__('Từ khóa', 'mdmedical') ?></h3>
								<div class="tags-list">
									<?php 
										foreach ( $terms as $tag ) {
											$tag_link = get_tag_link( $tag->term_id );
											echo '<a class="" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';
										}
									?>
								</div>
							</div>
					<?php 
						}
					}
				break;
			}
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}
new Inwave_Landa_Tag;
