<?php
/**
 * Checkout coupon form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!WC()->cart->coupons_enabled()) {
    return;
}

?>

    <div class="checkout-row col-md-6">
		<div class="checkout-box checkout-box-coupon">
			<h3 class="title"><?php esc_html_e('Coupon', 'mdmedical'); ?></h3>
			<div class="box">
				<form method="post">

					<input type="text" name="coupon_code" class="input-text"
						   placeholder="<?php esc_attr_e('Coupon code', 'mdmedical'); ?>" id="coupon_code" value=""/>

					<button type="submit" class="button" name="apply_coupon"
							value="<?php esc_attr_e('Apply Coupon', 'mdmedical'); ?>">
							<?php esc_html_e('Apply Coupon', 'mdmedical'); ?>
						</button>

				</form>
			</div>
		</div>
    </div>

