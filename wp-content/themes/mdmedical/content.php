<?php

/**
 * The default template for displaying content
 * @package inevent
 */
$inwave_theme_option = Inwave_Helper::getConfig();

?>
<article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class(); ?>>
    <div class="post-item">
        <div class="featured-image">
            <?php 
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
				$img_src = count($img) ? $img[0] : '';
				$img_src = inwave_resize($img_src, 215, 170, true);
			?>
			<img src="<?php echo $img_src; ?>" alt="">
        </div>
        <div class="post-content">
			<div class="post-content-detail">				
				<h3 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title('', ''); ?></a>
				</h3>
				<div class="post-content-desc">
					
					<div class="post-text">
						<?php /* translators: %s: Name of current post */
						echo get_the_excerpt();
						?>
					</div>
					
				</div>
				<?php if (($inwave_theme_option['show_post_date']) || $inwave_theme_option['blog_category_title_listing']){ ?>	
					<div class="post-info">
						<?php if(isset($inwave_theme_option['blog_category_title_listing']) && $inwave_theme_option['blog_category_title_listing']): ?>
						<!--	<div class="post-info-category"><?php the_category(',') ?></div>-->
							<?php 
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								echo '<div class="post-info-category"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';
							}
							?>
						<?php endif; ?>
						<?php if(isset($inwave_theme_option['show_post_date']) && $inwave_theme_option['show_post_date']){ ?>
							<div class="post-info-date">
								<?php echo get_the_date("d/m/Y") ?>
							</div>
						<?php } ?>
						
					</div>
				<?php } ?>
				
			</div>
			
			
        </div>
    </div>
</article><!-- #post-## -->