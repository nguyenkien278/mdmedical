<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $product, $inwave_theme_option;

// $cat_count = sizeof(get_the_terms($product->get_id(), 'product_cat'));

// Ensure visibility
if (!$product || !$product->is_visible()) {
    return;
}


// Extra post classes
$classes = array('product-image-wrapper', 'woo-list-product-grid');
?>
<div <?php post_class($classes); ?>>
    <div class="product-content">
        <div class="product-image">
            <a href="<?php echo esc_url(get_the_permalink()); ?>">
			
			<?php //echo wp_kses_post($product->get_image()); 
				$img = wp_get_attachment_image_src($product->get_image_id(), 'full');
				$img_src = inwave_resize($img[0], 450, 450, true);
			?>
				<img src="<?php echo $img_src; ?>" />
			</a>
            <?php if ($product->is_on_sale()): ?>
                <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale-label">' . esc_html__('Sale!', 'mdmedical') . '</span>', $post, $product); ?>
            <?php endif; ?>

            <?php do_action('woocommerce_showproduct_newlabel'); ?>

            <div class="actions">
				<div class="addcart-wrap">
					<a class="add_to_cart_button product_type_simple ajax_add_to_cart" data-product_id="<?php echo esc_attr($product->get_id()) ?>" data-product_sku="<?php echo esc_attr($product->get_sku()) ?>" href="<?php echo esc_url($product->add_to_cart_url()) ?>" data-quantity="1">
						<i class="fa fa-shopping-cart"></i>
						<?php _e('Thêm giỏ hàng'); ?>
					</a>
				</div>
				
                <?php if ($inwave_theme_option['woocommerce_quickview']): ?>
					<div class="quickview-wrap">
                    <a href="#<?php echo esc_attr(get_the_ID()); ?>" class="arrows quickview">
                        <i class="fa fa-eye"></i> <?php _e('Xem nhanh'); ?>
                        <input type="hidden" value="<?php echo esc_attr($inwave_theme_option['woocommerce_quickview_effect']); ?>" />
                    </a>
					</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="info-products">
			<h3 class="product-title">
                <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
            </h3>
			<?php 
				$extra_field = get_post_meta($product->get_id(), '_extra_desc_1', true);
				$extra_field2 = get_post_meta($product->get_id(), '_extra_desc_2', true);
				// var_dump($extra_field); echo '<br />';
				// var_dump($extra_field2);
			?>
			<div class="product-desc">
				<?php if ($extra_field){ ?>
					<div class="product-extra1"><?php echo $extra_field; ?></div>
				<?php } ?>
				<?php if ($extra_field2){ ?>
					<div class="product-extra2"><?php echo $extra_field2; ?></div>
				<?php } ?>
			</div>
			<?php 
				$price = $product->get_price();
				$price_display = wc_price($price,array());
			?>
			<div class="product-price"><?php echo $price_display; ?></div>
			<?php
			// product rating
				$rating_count = $product->get_rating_count();
				$review_count = $product->get_review_count();
				$average      = $product->get_average_rating();
				$rating_html = '';
				if ( $rating_count > 0 ){
					$vote_text = $rating_count > 1 ? 'votes' : 'vote';
					$rating_html .= '<div class="product-review-rating">';
					$rating_html .= '<span class="review-rating">';
					$rating_html .= '<span style="width:'.(( $average/5)* 100).'%"></span>';
					$rating_html .= '</span>';
					$rating_html .= '<span class="rating-count">'.$rating_count.' '.$vote_text.'</span>';
					$rating_html .= '</div>';
				
					echo '<div class="product-rating">';
					echo $rating_html;
					echo '</div>';
				}
			// end product rating
			?>
            
				
            
            
        </div>
		
		<?php 
		wc_get_template_part('content', 'quickview-product-down'); 
		?>
		
    </div>

</div>
