<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

    <div id="comment-<?php esc_attr(comment_ID()); ?>" class="comment_container">
		<?php if ( '0' === $comment->comment_approved ) { ?>
			<p class="meta"><em class="woocommerce-review__awaiting-approval"><?php esc_attr_e( 'Your review is awaiting approval', 'woocommerce' ); ?></em></p>
		<?php 
		} else { ?>
			<div class="wc-comment-detail">
				<div class="wc-comment-author" itemprop="author"><?php comment_author(); ?></div>
				<div class="wc-comment-content">
					<div class="wc-comment-date"><?php echo get_comment_date( wc_date_format() ); ?></div>
					
					<div class="wc-comment-rating">
						<?php 
							if ( $rating && 'yes' === get_option( 'woocommerce_enable_review_rating' ) ) {
								echo wc_get_rating_html($rating);
							}
						?>
					</div>
					<div class="wc-comment-text">
						<?php
						echo '<div class="description">';
						comment_text();
						echo '</div>';
						?>

					</div>
				</div>
			</div>
		<?php 
		} ?>
    </div>
