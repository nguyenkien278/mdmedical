<?php
/*
 * @package Inwave Athlete
 * @version 1.0.0
 * @created Mar 27, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of wp_posts
 *
 * @Developer duongca
 */
if (!class_exists('Inwave_Posts')) {

    class Inwave_Posts extends Inwave_Shortcode{

        protected $name = 'inwave_posts';

        function init_params() {
            $_categories = get_categories();
            $cats = array(__("All", "inwavethemes") => '');
            foreach ($_categories as $cat) {
                $cats[$cat->name] = $cat->term_id;
            }

            return array(
                'name' => __('Posts', 'inwavethemes'),
                'description' => __('Display a list of posts ', 'inwavethemes'),
                'base' => $this->name,
                'icon' => 'iw-default',
                'category' => 'Custom',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "admin_label" => true,
                        "heading" => __("Style", "inwavethemes"),
                        "param_name" => "style",
                        "value" => array(
                            'Style 1 - jcarousel v1' => 'style1',
							'Style 2 - jcarousel v2' => 'style2',
							'Style 3 - jcarousel v3' => 'style3',
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/posts-style1.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style2",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/posts-style2.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
					array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style3",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/posts-style3.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style3')
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Post Ids", "inwavethemes"),
                        "value" => "",
                        "param_name" => "post_ids",
                        "description" => __('Id of posts you want to get. Separated by commas.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Post Category", "inwavethemes"),
                        "param_name" => "category",
                        "value" => $cats,
                        "description" => __('Category to get posts.', "inwavethemes")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Post number", "inwavethemes"),
                        "param_name" => "post_number",
                        "value" => "3",
						"admin_label" => true,
                        "description" => __('Number of posts to display on box.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order By", "inwavethemes"),
                        "param_name" => "order_by",
                        "value" => array(
                            'ID' => 'ID',
                            'Title' => 'title',
                            'Date' => 'date',
                            'Modified' => 'modified',
                            'Ordering' => 'menu_order',
                            'Random' => 'rand'
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order Type", "inwavethemes"),
                        "param_name" => "order_type",
                        "value" => array(
                            'ASC' => 'ASC',
                            'DESC' => 'DESC'
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show date", "inwavethemes"),
                        "param_name" => "show_date",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
					array(
                        "type" => "dropdown",
                        "heading" => __("Show Category", "inwavethemes"),
                        "param_name" => "show_category",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show read-more", "inwavethemes"),
                        "param_name" => "show_readmore",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        ),
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Number word of title", "inwavethemes"),
						'description' => __('Trim title word. Exp: 5', 'inwavethemes'),
                        "param_name" => "number_title",
                        "value" => '',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
					array(
                        "type" => "textfield",
                        "heading" => __("Number word of description", "inwavethemes"),
						'description' => __('Trim description. Exp: 15', 'inwavethemes'),
                        "param_name" => "number_desc",
                        "value" => '',
                        "dependency" => array('element' => 'style', 'value' => 'style2')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                )
            );
        }

        // Shortcode handler function for list Icon
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;
            $output = $title = $post_ids = $category = $post_number = $order_by = $order_type = $style = $show_date = $show_category = $show_readmore = $number_title = $number_desc = $class = '';
            extract(shortcode_atts(array(
                'title' => '',
                'post_ids' => '',
                'category' => '',
                'post_number' => 3,
                'order_by' => 'ID',
                'order_type' => 'DESC',
                'style' => 'style1',
                'show_date' => '1',
				'show_category' => '1',
                'show_readmore' => '1',
				'number_title' => '',
				'number_desc' => '17',
                'class' => ''
                            ), $atts));

            $args = array();
            if ($post_ids) {
                $args['post__in'] = explode(',', $post_ids);
            } else {
                if ($category) {
                    $args['category__in'] = $category;
                }
            }
            $args['posts_per_page'] = $post_number;
            $args['order'] = $order_type;
            $args['orderby'] = $order_by;
            $query = new WP_Query($args);
            $class .= ' '. $style;

            ob_start();
            switch ($style) {
                case 'style1':
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":false';
					$sliderConfig .= ',"autoPlay":false';
					$sliderConfig .= ',"pagination":false';
					$sliderConfig .= ',"items":3';
					$sliderConfig .= ',"itemsDesktop":[1199,3]';
					$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
					$sliderConfig .= ',"itemsTablet":[768,2]';
					$sliderConfig .= ',"itemsMobile":[479,1]';
					$sliderConfig .= '}';
					
					wp_enqueue_style('owl-carousel');
					wp_enqueue_style('owl-theme');
					wp_enqueue_style('owl-transitions');
					wp_enqueue_script('owl-carousel');
					?>
					<div class="iw-posts <?php echo $class ?>">
                        <div class="iw-posts-list">
							<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
							<?php
								while ($query->have_posts()) :
								$query->the_post();
									$post = get_post();
									$contents = $post->post_content;
									$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
									$img_src = count($img) ? $img[0] : '';
									if(!$img_src){
										$img_src = inwave_get_placeholder_image();
									}
									$img_src = inwave_resize($img_src, 370, 404, true);
									?>
									<div class="post-item iw-effect-img">
										<div class="post-item-inner">
											<div class="post-image-wrap">
												<div class="post-image effect-1">
													<img src="<?php echo $img_src; ?>" alt="">
												</div>
												<div class="post-content">
													<div class="post-content-inner">
														<div class="post-description">
															<?php
															if($post->post_excerpt){
																the_excerpt();
															} else {
																the_content('');
															}
															?>
														</div>
														<?php if($show_readmore){ ?>
															<a class="read-more theme-bg" href="<?php echo get_permalink(); ?>"><?php echo esc_html__('Read more', 'inwavethemes') ;?></a>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="post-info">
												<h3 class="post-title">
													<a class="theme-color-hover" href="<?php echo get_permalink(); ?>"><?php the_title() ?></a>
												</h3>
												<div class="post-meta">
													<div class="post-date">
														<i class="ion-ios-clock-outline"></i> <?php echo get_the_date("d M, Y"); ?>
													</div>
													<div class="post-category">
														<i class="ion-android-folder-open"></i><?php the_category(',') ?>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
								?>	
							</div>
                        </div>
					</div>
				<?php
                break;
				
				case 'style2':
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":false';
					$sliderConfig .= ',"autoPlay":false';
					$sliderConfig .= ',"autoHeight":false';
					$sliderConfig .= ',"pagination":true';
					$sliderConfig .= ',"items":3';
					$sliderConfig .= ',"addClassActive" : true';
			//		$sliderConfig .= ',"singleItem" : true';
					$sliderConfig .= ',"itemsDesktop":[1199,3]';
					$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
					$sliderConfig .= ',"itemsTablet":[768,1]';
					$sliderConfig .= ',"itemsMobile":[479,1]';
					$sliderConfig .= '}';
					
					wp_enqueue_style('owl-carousel');
					wp_enqueue_style('owl-theme');
					wp_enqueue_style('owl-transitions');
					wp_enqueue_script('owl-carousel');
					?>
					<div class="iw-posts <?php echo $class ?>">
                        <div class="iw-posts-list">
							<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
							<?php
								while ($query->have_posts()) :
								$query->the_post();
									$post = get_post();
									$contents = $post->post_content;
									$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
									$img_src = count($img) ? $img[0] : '';
                                    if(!$img_src){
                                        $img_src = inwave_get_placeholder_image();
                                    }
									$img_src = inwave_resize($img_src, 370, 404, true);
									?>
									<div class="post-item">
										<div class="post-item-inner">
											<div class="post-info">
												<div class="post-meta">
													<div class="post-date">
														<i class="ion-ios-clock-outline"></i> <?php echo get_the_date("F, dS, Y"); ?>
													</div>
													<?php 
														$category = get_the_category();
														if ($category[0]){ 
													?>
													<div class="post-category">
														<i class="ion-android-folder-open"></i>
														<?php echo '<a href="'.get_category_link($category[0]->cat_ID).'">' . $category[0]->cat_name . '</a>';?>
													</div>
													<?php } ?>
												</div>
												
												<h3 class="post-title">
													<a class="theme-color-hover" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
														<?php 
															if ($number_title){
																echo wp_trim_words(get_the_title(),$number_title,''); 
															} else {
																echo get_the_title();
															}
														?>
													</a>
												</h3>
												
											</div>
											
												<div class="post-content">
													<div class="post-content-inner">
														<div class="post-description">
															<?php
															if($post->post_excerpt){
																if ($number_desc){
																	echo wp_trim_words(get_the_excerpt(), $number_desc, '' );
																} else {
																	the_excerpt();
																}
															} else {
																if ($number_desc){
																	echo wp_trim_words(get_the_content(), $number_desc, '' );
																} else {
																	the_content();
																}
															}
															?>
														</div>
														<?php if($show_readmore){ ?>
														<div class="read-more">
															<a class="theme-color" href="<?php echo get_permalink(); ?>"><?php echo esc_html__('Read more', 'inwavethemes') ;?></a>
														</div>
														<?php } ?>
													</div>
												</div>
											
										</div>
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
								?>	
							</div>
                        </div>
					</div>
				<?php
                break;
				
				case 'style3':
					$sliderConfig = '{';
					$sliderConfig .= '"navigation":false';
					$sliderConfig .= ',"autoPlay":true';
					$sliderConfig .= ',"pagination":false';
					$sliderConfig .= ',"items":3';
					$sliderConfig .= ',"itemsDesktop":[1199,3]';
					$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
					$sliderConfig .= ',"itemsTablet":[768,2]';
					$sliderConfig .= ',"itemsMobile":[479,1]';
					$sliderConfig .= '}';
			
					wp_enqueue_style('owl-carousel');
					wp_enqueue_style('owl-theme');
					wp_enqueue_style('owl-transitions');
					wp_enqueue_script('owl-carousel');
				?>
					<div class="iw-posts <?php echo $class ?>">
                        <div class="iw-posts-list">
							<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
							<?php
							while ($query->have_posts()) :
							$query->the_post();
								?>
								<div class="post-item-wrap">
									<div class="post-item iw-effect-img">
										<div class="post-item-inner">
												<div class="post-thumbnail featured-image effect-1">
													<?php
													$post = get_post();
													$contents = $post->post_content;
                                                    $post_format = get_post_format();
													switch ($post_format) {
														case 'video':
															$video = inwave_getElementsByTag('embed', $contents);
															if (count($video)) {
																echo apply_filters('the_content', $video[0]);
															}
															else{
																$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                                                $img_src = count($img) ? $img[0] : '';
                                                                if(!$img_src){
                                                                    $img_src = inwave_get_placeholder_image();
                                                                }
                                                                $img_src = inwave_resize($img_src, 372, 275, true);
																echo '<img src="'.$img_src.'" alt="">';
															}
															break;
														default :
															$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
															$img_src = count($img) ? $img[0] : '';
                                                            if(!$img_src){
                                                                $img_src = inwave_get_placeholder_image();
                                                            }
                                                            $img_src = inwave_resize($img_src, 372, 275, true);
															?>
															<img src="<?php echo $img_src; ?>" alt="">
															<?php
													}
												?>
												</div>
												<div class="post-content">
													<div class="post-date">
														<?php echo get_the_date('F, dS, Y'); ?>
													</div>
													<h3 class="post-title">
														<a class="theme-color-hover" href="<?php echo get_permalink(); ?>"><?php the_title() ?></a>
													</h3>

													<?php if($show_readmore){ ?>
														<div class="read-more">
															<a class="" href="<?php echo get_permalink(); ?>">
																<?php echo __('Continue', 'inhotel') ;?> <i class="fa fa-long-arrow-right"></i>
															</a>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
								</div>
									<?php
								endwhile;
								wp_reset_postdata();
								?>	
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

new Inwave_Posts();