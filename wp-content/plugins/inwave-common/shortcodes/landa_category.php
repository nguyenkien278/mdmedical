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
if (!class_exists('Inwave_LanDa_Category')) {

    class Inwave_LanDa_Category extends Inwave_Shortcode{

        protected $name = 'inwave_landa_category';

        function getLandaCategories() {
            $args = array("taxonomy"=>'lan_da_categories');
            $_categories = get_categories($args);
			// var_dump($_categories);
			
			// echo '<style>#adminmenumain{display:none!important;}</style>';
            $cats = array();
            $cats[__("Tất cả", "inwavethemes")] = '0';
            foreach ($_categories as $cat) {
                $cats[$cat->name] = $cat->slug;
            }
            return $cats;
        }

        function init_params(){
            return array(
                "name" => __("Làn da Category", 'inwavethemes'),
				"description" => __('Display list Post in "Làn da".', "inwavethemes"),
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
                        "type" => "dropdown",
                        "heading" => "Select Category",
                        "admin_label" => true,
                        "param_name" => "category",
                        "value" => $this->getLandaCategories(),
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

            $output = $style = $category = $post_number = $class = '';
            extract(shortcode_atts(array(
                "style" => 'style1',
                "category" => '',
                "post_number" => '',
                "class" => ""
            ), $atts));

            $tax_query = array(
                array(
                    'taxonomy' => 'lan_da_categories',
                    'field' => 'slug',
                    'terms' => $category,

                )
            );

            $args = array();

			$args['posts_per_page'] = $post_number;
			// $args['posts_per_page'] = 3;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args['paged'] = $paged;
            $args['post_type'] = 'lan_da';
            $args['post_status'] = 'publish';
            if ($category != "0"){
                $args['tax_query'] = $tax_query;
            }

            $query = new WP_Query($args);
            $class = ' ' . $style;

            ob_start();

            switch ($style) {
                case 'style1':
					wp_enqueue_script('isotope.pkgd.min');
					wp_enqueue_script('imagesloaded');
					wp_enqueue_script('filtering');
                   
                    $gallery = $this->getLandaCategories();
                    if (in_array('0', $gallery)) {
                        $categories = get_terms('lan_da_categories', 'hide_empty=1');
                    } else {
                        $categories = get_terms('lan_da_categories', array('hide_empty'=>'1', 'include'=>$gallery));
                    }
                    ?>

                    <div class="iw-post-filter post-filter <?php echo $class; ?>">
                        <?php if ($category == "0"){ ?>
                            <div class="filters button-group" id="filters">
                                <?php
                                if (!empty($categories)) {
                                    echo '<button class="filter is-checked" data-filter="*">' . __('Tất cả', 'inwavethemes') . '</button>';
                                    foreach ($categories as $cat) {
                                        echo '<button class="filter" data-filter=".' . $cat->slug . '">' . $cat->name . '</button>';
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>

                        <div class="post-main">
                            <div class="row">
                                <section id="isotope-main" class="isotope"  style="">
                                    <?php

                                    while ($query->have_posts()) : $query->the_post(); //$post = get_post();

                                        $terms = wp_get_post_terms(get_the_ID(), 'lan_da_categories');
                                        $terms_cats = get_the_terms(get_the_ID(),'lan_da_categories');
                                        //var_dump($terms);
                                        if (!empty($terms)) {
                                            $data_cat = $terms[0]->slug;
                                            $class_filter = array();
                                            foreach ($terms as $cat) {
                                                $class_filter[] = $cat->slug;
                                            }
                                        }
                                        ?>
                                        <div data-category="<?php echo $data_cat ? $data_cat : ''; ?>" class="<?php echo $class_filter ? implode(' ', $class_filter) : ''; ?>  element-item col-md-4 col-sm-6 col-xs-12">
                                            <div class="post-item">
                                                <div class="post-item-inner">

                                                    <div class="image">
                                                        <?php
                                                        $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
														$img_thum = inwave_resize($img[0], 300, 200);
														if ($img){
                                                        ?>
                                                        <img class="" src="<?php echo $img_thum; ?>" alt="" />
														<?php 
														}
														?>
														
                                                    </div>
                                                    <div class="post-info">
                                                        <h3 class="title"><a class="" href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
														<div class="post-date"><?php echo get_the_date("d/m/Y"); ?></div>
														<div class="desc"><?php echo get_the_excerpt(); ?></div>
														<div class="view-detail">
															<a class="" href="<?php the_permalink(); ?>"><?php echo __('Xem chi tiết', 'inwavethemes'); ?></a>
														</div>
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

new Inwave_LanDa_Category();