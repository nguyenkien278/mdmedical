<?php

/**
 * The default template for displaying content quote
 * @package inevent
 */
$authordata = Inwave_Helper::getAuthorData();
$inwave_theme_option = Inwave_Helper::getConfig();
$show_post_infor = inwave_show_post_info();
?>
<article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class(); ?>>
    <div class="post-item post-item-quote">
		<div class="featured-image">
            <?php the_post_thumbnail(); ?>
            <?php $featured_image = get_the_post_thumbnail(); ?>
        </div>
		
		<div class="post-content">
			<div class="post-content-detail">
				
				<div class="post-quote theme-bg">
					<i class="fa fa-quote-left"></i>
					<div class="quote-text">
						<?php
						$post = get_post();
						$quote = inwave_getElementsByTag('blockquote', $post->post_content, 3);
						$text = $quote[2];
						$text = ltrim($text, '"');
						$text = rtrim($text, '"');
						echo wp_kses_post($text);
						?>
					</div>
				</div>
				
				<div class="post-content-head">
					<?php if (is_sticky()){echo '<span class="feature-post">'.esc_html__('Feature', 'mdmedical').'</span>';} ?>
					
					<div class="post-head-detail">
						<div class="post-icon theme-bg">
							<i class="fa fa-quote-left"></i>
						</div>
						
						<div class="post-main-info">
							<h3 class="post-title">
								<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title('', ''); ?></a>
							</h3>
							<?php if ($show_post_infor){ ?>	
								<div class="post-info">
									<?php if(isset($inwave_theme_option['show_post_date']) && $inwave_theme_option['show_post_date']){ ?>
										<div class="post-info-date">
											<i class="fa fa-clock-o"></i> <?php echo get_the_date("d M, Y") ?>
										</div>
									<?php } ?>
									<?php if(isset($inwave_theme_option['show_post_author']) && $inwave_theme_option['show_post_author']){ ?>
										<div class="post-info-author">
											<?php echo esc_html__('By', 'mdmedical'); ?> <span><?php echo get_the_author_link(); ?></span>
										</div>
									<?php } ?>
									<?php if(isset($inwave_theme_option['blog_category_title_listing']) && $inwave_theme_option['blog_category_title_listing']): ?>
										<div class="post-info-category"><i class="fa fa-bars"></i><?php the_category(',') ?></div>
									<?php endif; ?>
									<?php
									if(isset($inwave_theme_option['show_post_comment']) && $inwave_theme_option['show_post_comment']){
										if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
											echo '<div class="post-info-comment"><i class="fa fa-comments"></i>';
											comments_popup_link(esc_html__('0 comment', 'mdmedical'), esc_html__('1 Comment', 'mdmedical'), esc_html__('% Comments', 'mdmedical'));
											echo '</div>';
										}
									}
									?>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php if($inwave_theme_option['social_sharing_box_category']): ?>
						<div class="post-share-buttons">
							<div class="post-share-buttons-inner">
									<?php
									inwave_social_sharing_category_listing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
									?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="post-content-desc">
					<div class="post-text">
						<?php the_excerpt(); ?>
					</div>
					
				
					<?php if (isset($inwave_theme_option['show_post_tag']) && $inwave_theme_option['show_post_tag']): ?>
							<?php inwave_blog_post_tag(); ?>
						<?php endif ?>
					<div class="post-content-readmore">
						<?php echo '<a class="more-link" href="' . get_the_permalink() . '"><i class="fa fa-arrow-circle-o-right"></i>'.esc_html__('Read more', 'mdmedical') .'</a>'; ?>
					</div>
					<?php edit_post_link( esc_html__( 'Edit', 'mdmedical' ), '<span class="edit-link">', '</span>' );?>
				</div>

			</div>
			
			<div class="clearfix"></div>
			
		</div>
		
	</div>
    
</article><!-- #post-## -->