<?php

/*
 * @package Inwave Event
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
if (!class_exists('Inwave_Product_Slide')) {

    class Inwave_Product_Slide extends Inwave_Shortcode{

        protected $name = 'inwave_product_slide';

        function init_params()
        {
			
			$args = array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
            );

            $product_cats = get_terms($args);
            $select_product_cats = array();
            $select_product_cats[__("All", "inwavethemes")] = '0';
            if(!is_wp_error($product_cats) && $product_cats){
                foreach ($product_cats as $product_cat){
                    $select_product_cats[$product_cat->name] = $product_cat->slug;
                }
            }
			
			
            return array(
                "name" => __("Product Slide", 'inwavethemes'),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Show a slide images or a video.", "inwavethemes"),
            //    "show_settings_on_create" => true,
            //    "js_view" => 'VcColumnView',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Style",
						"admin_label" =>true,
                        "param_name" => "style",
                        "value" => array(
                            "Product slide 2 item, gray background" => "style1",
							"Product slide 3 item, no background" => "style2",
                        )
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/product_slide_style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					
					array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", "inwavethemes"),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, <br />{TEXT_EXAMPLE} to specify colorful words, <br />'///' to insert line break tag (br)", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => __("Select product category", 'inwavethemes'),
                        "param_name" => "select_product_cat",
                        "value" => $select_product_cats,
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Limit", "inwavethemes"),
                        "param_name" => "limit",
                        "value" => '8',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Include Product IDs", "inwavethemes"),
                        "param_name" => "include_ids",
                        "value" => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Exclude Product IDs", "inwavethemes"),
                        "param_name" => "exclude_ids",
                        "value" => '',
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


        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $style = $title = $select_product_cat = $limit = $include_ids = $exclude_ids = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1",
                "title" => "",
                "select_product_cat" => "",
                "limit" => "",
                "include_ids" => "",
                "exclude_ids" => "",
				'css' => '',
				
            ), $atts));
		
			$title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
			$title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
			$title= preg_replace('/\/\/\//i', '<br />', $title);
        
			
			$include_ids = $include_ids ? explode(',', $include_ids) : array();
            $exclude_ids = $exclude_ids ? explode(',', $exclude_ids) : array();
			
				$args = array(
                    'numberposts' => ($limit ? $limit : -1),
                    'post_type' => 'product',
                    'include' => $include_ids,
                    'exclude' => $exclude_ids,
                    'product_cat' => $select_product_cat,
                );

                $products = get_posts($args);
		
		
			$class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);

		ob_start();
			
			switch ($style){
				case 'style1':
				case 'style2':
					wp_enqueue_style('owl-carousel');
					wp_enqueue_style('owl-theme');
					wp_enqueue_style('owl-transitions');
					wp_enqueue_script('owl-carousel');
					
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":true';
					$sliderConfig .= ',"autoPlay":true';
					$sliderConfig .= ',"pagination":false';
				if ($style=='style1'){
					$sliderConfig .= ',"items":2';
					$sliderConfig .= ',"itemsDesktop":[1199,2]';
					$sliderConfig .= ',"itemsDesktopSmall":[991,1]';
				} else if ($style=='style2'){
					$sliderConfig .= ',"items":3';
					$sliderConfig .= ',"itemsDesktop":[1199,3]';
					$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
				}
					$sliderConfig .= ',"itemsTablet":[768,1]';
					$sliderConfig .= ',"itemsMobile":[479,1]';
					$sliderConfig .= ',"addClassActive":true';
					$sliderConfig .= ',"navigationText":["<i class=\"ion-ios-arrow-left\"></i>","<i class=\"ion-ios-arrow-right\"></i>"]';
					$sliderConfig .= '}';
					
				
				?>
					<div class="product_slide <?php echo $class; ?>">
					<?php 
						global $woocommerce;
						$currency_symbol = get_woocommerce_currency_symbol();
					?>
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title; ?></h3>
							</div>
						<?php } ?>
						<div class="product-slide-inner">
								<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
									<?php foreach( $products as $product ){
										$_product = wc_get_product($product->ID);
									//	$purchase_note = get_post_meta($product->ID, '_purchase_note', true);
										$extra_field = get_post_meta($product->ID, '_extra_desc_1', true);
										$extra_field2 = get_post_meta($product->ID, '_extra_desc_2', true);
										$price = $_product->get_price();
										$price_display = wc_price($price,array());
										
										$img = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'full');
										$img_src = count($img) ? $img[0] : '';
										$img_src = inwave_resize($img_src, 500, 500, true);
										if(!$img_src){
											$img_src = inwave_get_placeholder_image();
										}							
									?>
										<div class="product-slide-item">
											<div class="product-image">
												<img src="<?php echo $img_src; ?>" alt="">
											</div>
											<h3 class="product-title">
												<a href="<?php echo get_permalink($product->ID); ?>"><?php echo $product->post_title; ?></a>
											</h3>
											<div class="product-desc">
												<?php if ($extra_field){ ?>
													<div class="product-extra1"><?php echo $extra_field; ?></div>
												<?php } ?>
												<?php if ($extra_field2){ ?>
													<div class="product-extra2"><?php echo $extra_field2; ?></div>
												<?php } ?>
											</div>
											<div class="product-price"><?php echo $price_display; ?></div>
											
										<?php
										// product rating
											$rating_count = $_product->get_rating_count();
											$review_count = $_product->get_review_count();
											$average      = $_product->get_average_rating();
											$rating_html = '';
											if ( $rating_count > 0 ){
												$vote_text = $rating_count > 1 ? 'votes' : 'vote';
												$rating_html .= '<div class="product-review-rating">';
												$rating_html .= '<span class="review-rating">';
												$rating_html .= '<span style="width:'.(( $average/5)* 100).'%"></span>';
												$rating_html .= '</span>';
												$rating_html .= '<span class="rating-count">'.$rating_count.' '.$vote_text.'</span>';
												$rating_html .= '</div>';
											
											echo '<div class="product-rating">';
											echo $rating_html;
											echo '</div>';
											}
										// end product rating
										?>
										</div>
									<?php } ?>
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

new Inwave_Product_Slide;
