<?php
/*
 * @package inChurch
 * @version 1.0.0
 * @created Jun 8, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */


/**
 * Description of Rooms
 *
 * @developer hientran
 */
if (!class_exists('Inwave_Nhansu_List')) {

    class Inwave_Nhansu_List extends Inwave_Shortcode{

        protected $name = 'inwave_nhansu_list';

        function init_params(){
            return array(
                "name" => __("Nhân sự list", 'inwavethemes'),
				"description" => __('Display list Nhân Sự tại MDmedical.', "inwavethemes"),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => "Style",
                        "admin_label" => true,
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Post list grid" => "style1",
                        )
                    ),
                    array(
                        "type" => "iwevent_preview_image",
                        "heading" => __("Preview Style", "inwavethemes"),
                        "param_name" => "preview_style1",
                        "value" => get_template_directory_uri() . '/assets/images/shortcodes/lan_da_categories.jpg',
                        "dependency" => array('element' => 'style', 'value' => 'style1')
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Post item load per page", "inwavethemes"),
                        "value" => "6",
                        "param_name" => "post_number"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    )
                )
            );
        }

        // Shortcode handler function for item
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $style = $post_number = $class = '';
            extract(shortcode_atts(array(
                "style" => 'style1',
                "post_number" => '',
                "class" => ""
            ), $atts));

            $args = array();

			$args['posts_per_page'] = $post_number;
			// $args['posts_per_page'] = "-1";
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args['paged'] = $paged;
            $args['post_type'] = 'nhansu';
            $args['post_status'] = 'publish';
            $args['order'] = 'ASC';
        
            $query = new WP_Query($args);
            $class = ' ' . $style;

            ob_start();

            switch ($style) {
                case 'style1':
                    ?>

                    <div class="nhansu_list <?php echo $class; ?>">
                        <div class="post-main">
                            <div class="row">
                                <section id="isotope-main" class="isotope"  style="">
                                    <?php

                                    while ($query->have_posts()) : $query->the_post(); //$post = get_post();
                                        ?>
                                        <div data-category="" class="element-item col-md-4 col-sm-6 col-xs-12">
                                            <div class="post-item">
                                                <div class="post-item-inner">
                                                    <div class="image">
                                                        <?php
                                                        $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
														$img_thum = inwave_resize($img[0], 400, 400, true);
														if ($img){
                                                        ?>
                                                        <img class="" src="<?php echo $img_thum; ?>" alt="" />
														<?php 
														}
														?>
														
                                                    </div>
                                                    <div class="post-info">
                                                        <h3 class="title"><a class="" href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
														<?php 
															$position = get_post_meta(get_the_ID(), 'nhansu_position', true);
															if ($position){
														?>
														<div class="position"><?php echo $position; ?></div>
														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </section>
                            </div>
                        </div>
						
						<div class="">
							<?php 
								$paginate_links = paginate_links(array(
									'format'			=> '?paged=%#%',
									'type'				=>'plain',
									'prev_next' 		=> true,
									'current' 			=> max(1, get_query_var('paged')),
									'show_all'			=>false,
									'prev_text'         => __('Previous'),
									'next_text'         => __('Next'),
									'total' 			=> $query->max_num_pages
								));
								// Display the pagination if more than one page is found
								$html_page = '';
								if ($paginate_links) :
									$html_page .= '<div class="post-pagination clearfix">';
									$html_page .= $paginate_links;
									$html_page .= '</div>';
									echo $html_page;
								endif;
							?>
						</div>

                 <!--       <div class="load-more-post">
                            <?php
                            // $rs = inwave_display_pagination_none($query);
                            // if ($rs['success']) {
                                // echo '<button class="load-more load-posts" id="load-more-class"><span class="ajax-loading-icon"><i class="fa fa-spinner fa-spin fa-2x"></i></span>' . __('Thêm bài viết...', 'inwavethemes') . '</button>';
                                // echo $rs['data'];
                            // } 
							//else {
                            //	echo '<button class="load-more load-posts all-loaded" id="load-more-class"><span class="ajax-loading-icon"><i class="fa fa-spinner fa-spin fa-2x"></i></span>' . __('All loaded', 'inwavethemes') . '</button>';
                            //}
                            // wp_reset_postdata();
                            ?>
                        </div>
                    </div> -->
                    <?php
                    break;
            }

            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}

new Inwave_Nhansu_List();