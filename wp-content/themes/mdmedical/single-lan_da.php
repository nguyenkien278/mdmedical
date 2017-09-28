<?php 
get_header(); 
	global $post;
		$terms = get_the_terms($post->ID, 'lan_da_categories');
		if (!empty($terms)){
			// $term = array_shift($terms);
			$term_slug = array();
			foreach($terms as $term){
				$term_slug[] = $term->slug;
			}
			
			$tax_query = array(
				array(
					'taxonomy' => 'lan_da_categories',
					'field' => 'slug',
					'terms' => $term_slug,
				)
			);
		}
		else {
			$tax_query = array();
		}
		
		$args = array();

		$args['posts_per_page'] = '10';
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		$args['paged'] = $paged;
		$args['post_type'] = 'lan_da';
		$args['post__not_in'] = array($post->ID);
		$args['post_status'] = 'publish';
		$args['tax_query'] = $tax_query;

		$menu_query = get_posts($args);
?>

<div class="single-lan-da">
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
			<?php endwhile;?>
			</div>
			
		
			
			<?php get_template_part( 'comment-tab'); ?>
				
		</div>
	</div>
</div>
<?php get_footer(); ?>