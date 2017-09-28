<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="image_product">
    <?php do_action( 'woocommerce_showproduct_newlabel' ); ?>
	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id(), 'full');
			$image       = get_the_post_thumbnail( $post->ID, 'full', array(
				'title' => $image_title
				) );
			
			$image_crop_url = inwave_resize($image_link, 500, 500, true);
			$image_crop = '<img src="'.$image_crop_url.'" />';

			$attachment_count = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto %s">%s</a>', esc_url($image_link), esc_attr($image_title), esc_attr($gallery), $image_crop ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'mdmedical' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
