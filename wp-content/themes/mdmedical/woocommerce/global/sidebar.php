<?php
/**
 * Sidebar
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/sidebar.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div id="secondary" class="widget-area" role="complementary">
    <?php
    $sidebar_name = '';
    if(is_single()){
        $post = get_post();
        $sidebar_name = get_post_meta($post->ID, 'inwave_sidebar_name', true);
    }
    if(!$sidebar_name){
        $sidebar_name = 'sidebar-woocommerce';
    }
    dynamic_sidebar($sidebar_name);
    ?>
</div><!-- #secondary -->
