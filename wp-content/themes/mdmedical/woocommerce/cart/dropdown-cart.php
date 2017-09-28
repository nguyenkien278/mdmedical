<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="md-minicart">
	<div class="widget_products">
		
		<?php if ( ! WC()->cart->is_empty() ){ ?>
			<div class="title-group">
				<?php esc_html_e( 'Hàng đang chọn', 'mdmedical' ); ?>
			</div>
			<div class="list-product-cart">
				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<div class="product-cart-item">
								<div class="product-image">
									<a href="<?php echo esc_url( get_permalink( $_product->get_id() ) ); ?>"><?php echo wp_kses_post($_product->get_image()); ?></a>
									<?php if ( ! empty( $show_rating ) ) echo wp_kses_post($_product->get_rating_html()); ?>
								</div>
								<div class="info-products">
									<h3 class="product-name">
										<a class="" href="<?php echo esc_url( get_permalink( $_product->get_id() ) ); ?>"><?php echo esc_html($_product->get_title()); ?></a>
									</h3>
									<div class="price-box">
										
										<div class="price"><?php echo $product_price; ?></div>
										<div class="qtn"><?php echo $cart_item['quantity']; ?></div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
			<div class="buttons-groups">
				<div class="btn-checkout">
					<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'Đặt hàng và thanh toán', 'mdmedical' ); ?></a>
				</div>
				<div class="btn-viewcart">
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'Xem giỏ hàng', 'mdmedical' ); ?></a>
				</div>
			</div>
			
		<?php } else { ?>
			<div class="empty"><?php esc_html_e( 'Chưa có sản phẩm nào.', 'mdmedical' ); ?></div>
		<?php } ?>
	</div><!-- end product list -->
</div>

