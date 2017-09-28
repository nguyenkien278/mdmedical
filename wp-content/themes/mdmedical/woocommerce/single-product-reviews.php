<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments">
        <!--
		<h2><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'mdmedical' ), $count, get_the_title() );
			else
				esc_html_e( 'Reviews', 'mdmedical' );
		?></h2>
-->
		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'Chưa có đánh giá nào.', 'mdmedical' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => '<span>'.esc_html__( 'Thêm đánh giá', 'mdmedical' ).'</span>',
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'mdmedical' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="row"><div class="col-sm-6 col-xs-12"><div class="comment-form-author"><input id="author" class="woo-review-form-field" name="author" placeholder="Họ tên (*)" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
							'email'  => '<div class="col-sm-6 col-xs-12"><div class="comment-form-email"><input id="email" class="woo-review-form-field" name="email" placeholder="Email (*)" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div></div>',
						),
						'label_submit'  => esc_html__( 'Gửi', 'mdmedical' ),
						'class_submit'  =>'btn-submit',
						'id_submit'  =>'btn-submit',
						'logged_in_as'  => '',
						'comment_field' => ''
					);
					
					$comment_form['comment_field'] = '<div class="row"><div class="col-xs-12"><div class="comment-form-comment"><textarea id="comment" class="control" placeholder="Đánh giá của bạn (*)" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div></div>'."";

                    if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                        $comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( esc_html__( 'Bạn phải <a href="%s">đăng nhập</a> để dánh giá.', 'mdmedical' ), esc_url( $account_page_url ) ) . '</p>';
                    }

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] .= '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'mdmedical' ) .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'mdmedical' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'mdmedical' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'mdmedical' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'mdmedical' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'mdmedical' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'mdmedical' ) . '</option>
						</select></div>';
					}
					
					'<div class="woo-review-rate">'.comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) ).'</div>';
					
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'mdmedical' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
