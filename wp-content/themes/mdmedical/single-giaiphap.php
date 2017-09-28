<?php 
get_header(); 
	global $post;
		$terms = get_the_terms($post->ID, 'giaiphap_category');
		
		if (!empty($terms)){
			$term = array_shift($terms);
		
			$tax_query = array(
				array(
					'taxonomy' => 'giaiphap_category',
					'field' => 'slug',
					'terms' => array($term->slug),
				)
			);
		} else {
			$tax_query = array();
		}
		
		$args = array();
		$args['posts_per_page'] = '10';
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		$args['paged'] = $paged;
		$args['post_type'] = 'giaiphap';
		$args['post__not_in'] = array($post->ID);
		$args['post_status'] = 'publish';
		$args['tax_query'] = $tax_query;
		
		$menu_query = get_posts($args);
?>

<div class="single-lan-da giaiphap">
	<div class="container">
		<div class="single-lan-da-inner">
			<?php if (!empty($menu_query)){ ?>
				<div class="single-lan-da-category-block">
					<div class="list-icon"><img src="<?php echo get_template_directory_uri().'/assets/images/icon-landa-block-cart.png'; ?>" /><span class="arrow"></span></div>
					<div class="title-block"><?php echo esc_html__('Các bài viết cùng chuyên mục:', 'mdmedical') ?></div>
					<ul>
						<?php  foreach( $menu_query as $item ){ ?>
							<li><a href="<?php echo get_permalink($item->ID); ?>"><i class="fa fa-chevron-right"></i><?php echo $item->post_title; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
			<div class="single-lan-da-maincontent">
			<?php while (have_posts()) : the_post(); ?>
				<h3 class="single-lan-da-title"><?php the_title('', ''); ?></h3>
				
				<div class="post-content-desc">
							<div class="post-text">
								<?php echo apply_filters('the_content', get_the_content()); ?>
							</div>
				</div>
			<?php 
				endwhile;
				// endif;
			?>
			</div>
			
			<?php 
				$terms = get_the_terms($post->ID, 'giaiphap_tag' );	
				if (!empty($terms)){
			?>
			<div class="single-field-tag">
				<h3 class="title"><?php echo esc_html__('Từ khóa', 'mdmedical') ?></h3>
				<div class="tags-list">
					<?php 
						foreach ( $terms as $tag ) {
							$tag_link = get_tag_link( $tag->term_id );
							echo '<a class="" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';
						}
					?>
				</div>
			</div>
			<?php 
			} ?>

			<?php if (!empty($menu_query)){ ?>
				<div class="list-post-tag">
					<div class="title-block"><?php echo esc_html__('Các bài viết liên quan', 'mdmedical') ?></div>
					<div class="related-items">
						<div class="row">
							<?php  
							$i = 0;
							foreach( $menu_query as $item ){ 
								$img = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full');
								$img_thum = inwave_resize($img[0], 340, 235, true);
								$img_src = count($img) ? $img_thum : '';
							?>	
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="related-item">
										<div class="related-image"><img src="<?php echo $img_src; ?>" alt="<?php echo $item->post_title; ?>"></div>
										<div class="related-title"><a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></div>
									</div>
								</div>
							<?php 
							$i++;
							if ($i == 3) {break;}
							} ?>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php get_template_part( 'comment-tab'); ?>
				
		</div>
	</div>
</div>
<?php get_footer(); ?>