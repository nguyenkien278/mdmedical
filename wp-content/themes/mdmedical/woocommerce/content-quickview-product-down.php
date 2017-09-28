<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $product;
?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>
<div id="quickview" class="quickview-box">
	<span class="arrow-view"></span>
    <div class="quickview-box-inner">
		<button class="close-quickview"><i class="ion-ios-close-empty"></i></button>
        <div class="quickview-body">
            <div class="product-detail">
                <div class="product-view">
                    <div id="product-<?php the_ID(); ?>">
                        <div class="product-essential">
							<div class="product-detail-row">
								<div class="product-detail-left">
									<div class="product-img-box">
										<?php
											do_action( 'woocommerce_before_single_product_summary' );
										?>
									</div>
									<div class="fb-like-share">
										<div class="fb-like" data-href="<?php the_permalink($product->get_id()); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
									</div>
								</div>
								<div class="product-detail-right">
									<div class="product-shop">
										<div class="product-quickview-top">
											<h3 class="product-title"><?php the_title(); ?></h3>
											<?php $extra_field2 = get_post_meta($product->get_id(), '_extra_desc_2', true); ?>
											<div class="extra-desc"><?php echo $extra_field2; ?></div>
											<?php
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
											?>
										</div>
										<div class="box-price-cart">
											<div class="price-box">
												<div class="price-box-inner">
													<?php echo wp_kses_post($product->get_price_html()); ?>
												</div>
											</div>
											<div class="product-add-to-cart">
												<a class="add_to_cart_button product_type_simple ajax_add_to_cart" data-product_id="<?php echo esc_attr($product->get_id()) ?>" data-product_sku="<?php echo esc_attr($product->get_sku()) ?>" href="<?php echo esc_url($product->add_to_cart_url()) ?>" data-quantity="1"> <i class="fa fa-shopping-cart"></i><?php _e('Thêm giỏ hàng'); ?></a>
											</div>
											
										</div>
										<div class="product-desc">
											<?php 
												echo $product->get_description();
											?>
										</div>
										
										
							
									</div><!-- .product-shop -->
								</div>
							</div><!-- .row -->
                        </div>
                        <!-- .product-essential -->

                    </div>
                    <!-- #product -->

                    <?php do_action('woocommerce_after_single_product'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
