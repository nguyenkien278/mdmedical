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
if (!class_exists('Inwave_Block_Content')) {

    class Inwave_Block_Content extends Inwave_Shortcode{

        protected $name = 'inwave_block_content';

        function init_params()
        {
            return array(
                "name" => __("Block Content", 'inwavethemes'),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a block content with title, description, image intro (or slide).", "inwavethemes"),
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
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/block_content_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        'type' => 'textfield',
                        "admin_label" =>true,
                        "heading" => __("Title block content", "inwavethemes"),
                        "description" => __("Title block content", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                    ),
					array(
                        'type' => 'textfield',
                        "admin_label" =>true,
                        "heading" => __("Title item content", "inwavethemes"),
                        "description" => __("Title item content", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title_item",
                    ),
					
					array(
                        'type' => 'attach_images',
                        "heading" => __("Slide images", "inwavethemes"),
                        "description" => __("Add slide images here.", "inwavethemes"),
                        "value" => "",
						"admin_label" =>true,
                        "param_name" => "slide_images",
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Image width", "inwavethemes"),
                        "description" => __("Enter your image width here. Example: 250px", "inwavethemes"),
                        "value" => "",
                        "param_name" => "width_image",
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => "Image align",
                        "param_name" => "image_align",
                        "value" => array(
                            "Image Left" => "image-left",
							"Image Right" => "image-right",
                        )
                    ),
					array(
                        'type' => 'textarea_html',
                        "heading" => __("Description", "inwavethemes"),
                        "description" => __("Add your description here", "inwavethemes"),
                        "value" => "",
						'holder' => 'div',
                        "param_name" => "content",
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
                        'heading' => __( 'Show pagination?', 'inwavethemes' ),
						"description" => __("Check this option to show pagination slide", "inwavethemes"),
                        'param_name' => 'show_pagination',
						'std' => 'true',
						"dependency" => array(
							'element' => 'style', 
							'value' => 'style1'
						)
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

            $output = $class = $style = $title = $sub_title = $description = $title_item = $width_image = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1",
                "title" => "",
                "image_align" => "image-left",
                "slide_images" => "",
                "title_item" => "",
				'css' => '',
				'width_image' => '',
				'autoplay' => '',
				'show_pagination' => '',
            ), $atts));
		
			$title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
			$title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
			$title= preg_replace('/\/\/\//i', '<br />', $title);
        
		$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);
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
					$show_pagination = $show_pagination ? 'true' : 'false';
					
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":false';
					$sliderConfig .= ',"autoPlay":'.$autoplay;
					$sliderConfig .= ',"pagination":'.$show_pagination;
					// $sliderConfig .= ',"pagination":true';
					$sliderConfig .= ',"singleItem":true';
					$sliderConfig .= ',"addClassActive":true';
					$sliderConfig .= '}';
				
				$style_width_image = $width_image ? 'style="width:'.$width_image.'"' : '';
				
				
				// var_dump(do_shortcode($content));
				$style_margin_content = '';
				if (!empty($slide_images)){
					if ($width_image){
						if ($image_align == 'image-left'){
							$style_margin_content = 'style="margin-left:calc('.$width_image.' + 25px);"';
						} else {
							$style_margin_content = 'style="margin-right:calc('.$width_image.' + 25px);"';
						}
					}
				}
				
				?>
					<div class="block-content <?php echo $class.' '.$image_align; ?>">
						<div class="block-content-inner">
							<?php if ($title){ ?>
								<div class="title-group">
									<h3 class="title"><span><?php echo $title; ?></span></h3>
								</div>
							<?php } ?>
							<div class="block-content-detail">
								
								<?php if (!empty($slide_images)){ ?>
									<div class="block-content-image" <?php echo $style_width_image; ?>>
										<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
											<?php foreach( $images_arr as $image_item ){ ?>
												<div class="image-item">
													<img src="<?php echo $image_item; ?>" alt="" />
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
								
								<div class="block-detail-info" <?php echo $style_margin_content; ?>>
									<?php if ($title_item){ ?>
										<div class="block-detail-title"><?php echo $title_item; ?></div>
									<?php } ?>
									<div class="block-content-desc">
										<p><?php echo do_shortcode($content); ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php
				break;
			}
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}
new Inwave_Block_Content;
