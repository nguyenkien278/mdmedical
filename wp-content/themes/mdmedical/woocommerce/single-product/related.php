<?php
/**
 * Related Products
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product, $post;
if (empty($product) || !$product->exists()) {
    return;
}

	$terms = get_the_terms($product->get_id(), 'product_tag');
	if (!empty($terms)){
		$term_slug = array();
		foreach($terms as $term){
			$term_slug[] = $term->slug;
		}
		
		$tax_query = array(
			array(
				'taxonomy' => 'product_tag',
				'field' => 'slug',
				'terms' => $term_slug,
			)
		);
	}
	else {
		return;
	}
	
	$args = array(
		'post_type' => 'product',
		'orderby' => $orderby,
		'post__not_in' => array($product->get_id()),
		'tax_query' => $tax_query
	);

	$products = new WP_Query($args);

	if ($products->have_posts()) : 
	
		wp_enqueue_style('owl-carousel');
		wp_enqueue_style('owl-theme');
		wp_enqueue_style('owl-transitions');
		wp_enqueue_script('owl-carousel');
		
		$sliderConfig = '{';
		$sliderConfig .= '"navigation":true';
		$sliderConfig .= ',"autoPlay":true';
		$sliderConfig .= ',"pagination":false';
		$sliderConfig .= ',"items":3';
		$sliderConfig .= ',"slideSpeed":800';
		$sliderConfig .= ',"itemsDesktop":[1199,3]';
		$sliderConfig .= ',"itemsDesktopSmall":[991,2]';
		$sliderConfig .= ',"itemsTablet":[768,1]';
		$sliderConfig .= ',"itemsMobile":[479,1]';
		$sliderConfig .= ',"addClassActive":true';
		$sliderConfig .= ',"navigationText":["<i class=\"ion-ios-arrow-left\"></i>","<i class=\"ion-ios-arrow-right\"></i>"]';
		$sliderConfig .= '}';
?>

    <div class="product-related">
		<h3 class="title"><span><?php esc_html_e('Sản phẩm liên quan', 'mdmedical'); ?></span></h3>
		<div class="product-list">
			<div class=" product-list-related product_slide style2">
				<?php woocommerce_product_loop_start(); ?>
				<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
					<?php while ($products->have_posts()) : $products->the_post(); ?>
						<div class="product-related-item-wrap">
							<div class="product-related-item">
								<?php wc_get_template_part('content', 'product'); ?>
							</div>
						</div>
					<?php endwhile; // end of the loop. ?>
				
				</div>
				<?php woocommerce_product_loop_end(); ?>

			</div>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
