
	<div class="total-comment-blocks">
		<div class="comments-tab">
			<div class="iw-tab-items">
				<div class="share-box-detail">
					<div class="post-share-buttons">
						<div class="sharepost-title"><?php echo esc_html__('Chia sẻ bài viết', 'mdmedical') ?></div>
							<div class="post-share-buttons-inner">
									<?php
									inwave_social_sharing_category_listing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
									?>
								<div class="clearfix"></div>
							</div>
						</div>
				</div>
				<div class="label-tab-comments"><?php echo esc_html__('Bình luận về bài viết', 'mdmedical') ?></div>
				
				<div class="iw-tab-item fb-tab active">
					<span><?php echo esc_html__('Facebook', 'mdmedical') ?></span>
				</div>
				<div class="iw-tab-item wp-tab">
					<span><?php echo esc_html__('Tài khoản', 'mdmedical') ?></span>
				</div>
				<div class="iw-tab-item gg-tab">
					<span><?php echo esc_html__('Google', 'mdmedical') ?></span>
				</div>
			</div>
			
			<div class="iw-tab-content">
				<div class="iw-tab-item-content active">
					<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="860" data-numposts="5" data-include-parent="true"></div>
				</div>
				<div class="iw-tab-item-content">
					<div class="wp-comment">
						<?php comments_template(); ?>
					</div>
				</div>
				<div class="iw-tab-item-content">
					<div class="google-comment-content">
						<script src="https://apis.google.com/js/plusone.js"></script>
							<div id="google-comments"></div>
							<script>
							gapi.comments.render('google-comments', {
								href: window.location,
								width: '860',
								first_party_property: 'BLOGGER',
								view_type: 'FILTERED_POSTMOD'
							});
							</script>
					</div>
				</div>
			</div>
		</div>
	</div>