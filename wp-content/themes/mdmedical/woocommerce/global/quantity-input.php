<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="quantity add-to-cart">
    <input type="number" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( (int)$min_value ); ?>" <?php echo ($max_value ? 'max="'.esc_attr( (int)$max_value ).'"' : '') ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'mdmedical' ) ?>" class="input-text qty text" size="4" />
    
</div>
