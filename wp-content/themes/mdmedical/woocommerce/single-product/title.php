<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php
global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>


<div class="product-name">
	<h1 class="product-detail-title" itemprop="name"><?php the_title(); ?></h1>

<div class="price-and-rating">

	<div class="price-box">
		<div class="price-box-inner">
			<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<?php echo wp_kses_post($product->get_price_html()); ?>
				<meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
				<meta itemprop="priceCurrency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
				<link itemprop="availability" href="http://schema.org/<?php if($product->is_in_stock()){ echo 'InStock';} else{echo 'OutOfStock';}; ?>" />
			</div>
		</div>
	</div>

	<?php if ( $rating_count > 0 ) : ?>
	<div class="rating-box">
		<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'mdmedical' ), $average ); ?>">
				<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
					<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'mdmedical' ), '<span itemprop="bestRating">', '</span>' ); ?>
					<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'mdmedical' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
				</span>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="clearfix"></div>
</div>

</div>