<?php
/**
 * The template for displaying Category pages
 * @package inevent
 */

get_header();

?>
<div class="page-content archive-nhansu">
    <div class="main-content">
        <div class="container">
            <div class="row">
				<div class="col-lg-2 col-md-1 hidden-sm hidden-xs"></div>
				<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
					<div class="nhansu_list">
						<div class="row">
							<section id="isotope-main" class="isotope"  style="">
								<?php if ( have_posts() ) : ?>
									<?php while (have_posts()) : the_post(); ?>
										<div class="element-item col-md-4 col-sm-6 col-xs-12">
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
									endwhile; // end of the loop. ?>
									
								
							</section>
							
						</div>
						<?php get_template_part( '/blocks/paging'); ?>
						<?php else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
						endif;?>
					</div>
				</div>
				<div class="col-lg-2 col-md-1 hidden-sm hidden-xs"></div>
			</div>
		</div>
    </div>
</div>
<?php get_footer(); ?>
