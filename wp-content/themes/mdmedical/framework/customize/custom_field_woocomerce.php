<?php


add_action( 'woocommerce_product_options_general_product_data', 'wc_custom_add_custom_fields' );
function wc_custom_add_custom_fields() {
    // Print a custom text field
    woocommerce_wp_textarea_input( array(
        'id' => '_extra_desc_1',
        'label' => 'Extra description 1',
        'description' => 'This is an extra description field, it will show on sider product on homepage',
        'desc_tip' => 'true',
        'placeholder' => 'Enter your extra description here'
    ));
	
	woocommerce_wp_textarea_input( array(
        'id' => '_extra_desc_2',
        'label' => 'Extra description 2',
        'description' => 'This is an extra description field, it will show on sider product on homepage.',
        'desc_tip' => 'true',
        'placeholder' => 'Enter your extra description here'
    ));
}



add_action( 'woocommerce_process_product_meta', 'wc_custom_save_custom_fields' );
function wc_custom_save_custom_fields( $post_id ) {
	if ( ! empty( $_POST['_extra_desc_1'] ) ) {
		update_post_meta( $post_id, '_extra_desc_1', esc_attr( $_POST['_extra_desc_1'] ) );
	}
	if ( ! empty( $_POST['_extra_desc_2'] ) ) {
		update_post_meta( $post_id, '_extra_desc_2', esc_attr( $_POST['_extra_desc_2'] ) );
	}
}

add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 98 );
function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}


add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments($fragments) {
	$count = WC()->cart->get_cart_contents_count();
	if ($count > 0){
		$fragments['span.number-product'] = '<span class="number-product">' . $count . '</span>';
	}
    return $fragments;
}


function mode_theme_update_mini_cart() {
	echo wc_get_template( 'cart/dropdown-cart.php' );
	die();
}
add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );






?>




