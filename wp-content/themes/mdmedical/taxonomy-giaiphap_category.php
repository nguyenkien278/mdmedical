<?php
/**
 * The template for displaying Category pages
 * @package inevent
 */

get_header();

?>
<div class="page-content giaiphap_tag">
    <div class="main-content">
        <div class="container">
            
                <div class="list-post-tag">
					<div class="related-items">
						<?php if ( have_posts() ) : ?>
							<div class="row">
							<?php while (have_posts()) : the_post(); ?>
								<div class="col-md-4 col-sm-6 col-xs-12 item_clear">
									<div class="related-item">
										<?php  
											$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
											$img_src = inwave_resize($img[0], 340, 235, true);
										?>
										<?php if ($img){ ?>
										<div class="related-image"><img src="<?php echo $img_src; ?>" alt="<?php the_title('', ''); ?>"></div>
										<?php } ?>
										<div class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title('', ''); ?></a></div>
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
