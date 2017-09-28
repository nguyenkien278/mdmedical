<?php
/**
 * The template for displaying Category pages
 * @package inevent
 */

get_header();

?>
<div class="page-content landa_tag">
    <div class="main-content">
        <div class="container">
            
                <div class="list-post-tag">
					<div class="related-items iw-post-filter">
						<?php if ( have_posts() ) : ?>
							<div class="row">
							<?php while (have_posts()) : the_post(); ?>
								<div class="col-md-4 col-sm-6 col-xs-12 item_clear">
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
							endwhile; // end of the loop. ?>
							</div>
							<?php get_template_part( '/blocks/paging'); 
						endif;?>
					</div>
					
					<?php if (term_description()){ ?>
						<div class="term_description">
							<?php echo term_description(); ?>
						</div>
					<?php } ?>
					
				</div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
