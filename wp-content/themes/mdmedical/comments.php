<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package inevent
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
$totalComments = get_comment_count(get_the_ID());
$totalComment = $totalComments['total_comments'];
?>
<div id="comments" class="comments">
    <div class="comments-content">
        
        <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments"><?php esc_html_e('Chức năng bình luận đã tắt.', 'mdmedical'); ?></p>
        <?php endif; ?>
        <div class="form-comment">

            <?php
            $req      = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $html_req = ( $req ? " required='required'" : '' );

            $required_text = sprintf( ' ' . esc_html__('Những trường đánh dấu (*) là bắt buộc','mdmedical'), '<span class="required">*</span>' );
			
			$fields = array(
                'author' => '<div class="row"><div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="author" class="input-text" name="author" placeholder="' . esc_html__('Name *', 'mdmedical') . '" type="text" value="" size="30" /></div>',
                'email' => '<div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="email" class="input-text" name="email" placeholder="' . esc_html__('Email address *', 'mdmedical') . '" type="email" value="" size="30" /></div>',
                'url' => '<div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="url" class="input-text" name="url" placeholder="' . esc_html__('Website', 'mdmedical') . '" type="url" value="" size="30" /></div></div>',
                'comment_field' => '<div class="row"><div class="col-xs-12 commentFormField"><textarea id="comment" class="control-text" placeholder="' . esc_html__('Your comment *', 'mdmedical') . '" name="comment" cols="45" rows="4" aria-required="true"></textarea></div></div>',
            );
			
			if (!is_user_logged_in ()){
                comment_form(array(
                    'fields' => apply_filters('comment_form_default_fields', $fields),
                    'comment_field' => '',
                    'class_submit' => 'btn-submit button',
					'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Email của bạn sẽ không hiển thị công khai.','mdmedical' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
					'comment_notes_after' => '',
					'title_reply'       => __( 'Viết bình luận' ),
					'title_reply_to'    => __( 'Trả lời bình luận %s' ),
					'cancel_reply_link' => __( 'Hủy' ),
					'label_submit'      => __( 'Gửi bình luận' ),
                ));
            }
			
			if (is_user_logged_in ()){
                comment_form(array(
                    'comment_field' => '<div class="row"><div class="col-xs-12 commentFormField"><textarea id="comment" class="control-text" placeholder="' . esc_html_x('Comment*', 'noun','injob') . '" name="comment" cols="45" rows="4" aria-required="true"></textarea></div></div>',
                    'class_submit' => 'btn-submit button',
					'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Email của bạn sẽ không hiển thị công khai.','mdmedical' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
					'comment_notes_after' => '',
					'title_reply'       => __( 'Viết bình luận' ),
					'title_reply_to'    => __( 'Trả lời bình luận %s' ),
					'cancel_reply_link' => __( 'Hủy' ),
					'label_submit'      => __( 'Gửi bình luận' ),
					'logged_in_as' => '<p class="logged-in-as">' .
						sprintf(
						__( 'Đăng nhập với tư cách <a href="%1$s">%2$s</a>. <a href="%3$s" title="Đăng xuất tài khoản">Đăng xuất?</a>' ),
						  admin_url( 'profile.php' ),
						  $user_identity,
						  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
						) . '</p>',
                ));
            }
			?>
        </div>
		<?php if (have_comments()) : ?>
            <div class="commentList">
                <div class="comments-title">
                    <?php printf(_n('%s bình luận', '%s bình luận', $totalComment, 'mdmedical'), $totalComment); ?>
                </div>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                    <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                        <div
                            class="nav-previous"><?php previous_comments_link(esc_html__('Bình luận cũ hơn', 'mdmedical')); ?></div>
                        <div
                            class="nav-next"><?php next_comments_link(esc_html__(' Bình luận mới hơn', 'mdmedical')); ?></div>
                    </nav><!-- #comment-nav-above -->
                <?php endif; // check for comment navigation ?>
                <ul class="comment_list">
                    <?php
                    wp_list_comments(array(
                        'callback' => 'inwave_comment',
                        'short_ping' => true,
                    ));
                    ?>
                </ul>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                    <nav id="comment-nav-bellow" class="comment-navigation" role="navigation">
                        <div
                            class="nav-previous"><?php previous_comments_link(esc_html__('Bình luận cũ hơn', 'mdmedical')); ?></div>
                        <div
                            class="nav-next"><?php next_comments_link(esc_html__('Bình luận mới hơn', 'mdmedical')); ?></div>
                    </nav><!-- #comment-nav-below -->
                <?php endif; // check for comment navigation ?>

            </div>
        <?php endif; ?>
		
		
		
    </div>
    <!-- #comments -->
</div><!-- #comments -->
