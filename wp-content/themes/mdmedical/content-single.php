<?php
/**
 * @package inevent
 */
$inwave_theme_option = Inwave_Helper::getConfig();
$authordata = Inwave_Helper::getAuthorData();
$show_post_infor = inwave_show_post_info();
?>
<article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('blog-single'); ?>>
    <div class="post-item fit-video">
        <div class="featured-image">
            <?php
            $post_format = get_post_format();
            $contents = get_the_content();
            $str_regux = '';
            switch ($post_format) {
                case 'video':
                    $video = inwave_getElementsByTag('embed', $contents);
                    $str_regux = $video[0];
                    if ($video) {
                        echo apply_filters('the_content', $video[0]);
                    }
                    break;

                default:
                    if ($inwave_theme_option['featured_images_single']) {
                        the_post_thumbnail();
                    }
                    break;
            }
            ?>
        </div>
        <div class="post-content">
			<div class="post-content-head">
				<div class="post-head-detail">
					<?php if ($inwave_theme_option['blog_post_title']): ?>
						<h3 class="post-title">
							<?php the_title(); ?>
						</h3>
						
					<?php endif; ?>
					<?php if ($show_post_infor){ ?>	
							<div class="post-info">
								<?php if(isset($inwave_theme_option['show_post_date']) && $inwave_theme_option['show_post_date']){ ?>
									<div class="post-info-date">
										<?php echo get_the_date("d M, Y") ?>
									</div>
								<?php } ?>
						
								<?php if(isset($inwave_theme_option['blog_category_title_listing']) && $inwave_theme_option['blog_category_title_listing']){ 
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo '<div class="post-info-category"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';
									}
								} ?>
					
							</div>
						<?php } ?>
				</div>
			</div>
			<div class="post-content-desc">
                <div class="post-text">
                    <?php echo apply_filters('the_content', str_replace($str_regux, '', get_the_content())); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'mdmedical'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>
			</div>
        </div>
		<div class="post-tags">
			<?php inwave_blog_post_tag(); ?>
		</div>
		<?php get_template_part( 'comment-tab'); ?>
    </div>
</article><!-- #post-## -->
















