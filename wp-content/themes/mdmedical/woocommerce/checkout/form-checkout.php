<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="product-check-out ">
<div class="checkout">
    <div class="row">
<?php
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'mdmedical' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>
<div class="col-xs-12">
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		<div id="customer_details">
			<div class="row">
				<div class="checkout-row col-md-6">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
			
				<div class="checkout-row col-md-6">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					<div class="checkout-box checkout-box-order">	
						<div id="order_review_heading"><h3 class="title"><?php esc_html_e( 'Your order', 'mdmedical' ); ?></h3></div>
						<div class="box">
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
					</div>
						
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				<!-- close tag div .row in payment.php line 23 -->
		</div><!-- end #customer_details -->
	<?php endif; ?>
	
</form>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>
</div>
</div>
