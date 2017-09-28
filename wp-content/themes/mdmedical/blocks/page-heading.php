<?php
$inwave_theme_option = Inwave_Helper::getConfig();
$post = get_post();
$show_page_heading = Inwave_Helper::getPostOption('show_pageheading', 'show_page_heading');
?>

<?php if ($show_page_heading && $show_page_heading != 'no') { ?>

	<?php 
	$tagline = Inwave_Helper::getPostOption('tagline');
	if(($post->post_type == 'giaiphap') && $tagline){ ?>
		<div class="page-heading giaiphap_special">
			<div class="container">
				<div class="container-inner">
					<div class="container-inner-2">
						<div class="page-title">
							<div class="iw-heading-title">
								<h1>
									<?php
									if($tagline){
										echo wp_kses_post($tagline); 
									} else {
										echo esc_html($page_title);
									}
									?>
								</h1>
								<?php
								
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php 
	} else { ?>
    <div class="page-heading <?php if (!is_404()) echo $post->post_type; ?>">
        <div class="container">
			<div class="container-inner">
				<div class="container-inner-2">
					
					<div class="page-title">
						<div class="iw-heading-title">
							<h1>
								<?php
								// $text['home']     = esc_html__('Home', 'mdmedical'); // text for the 'Home' link
								// $text['category'] = esc_html__('Archive by Category "%s"', 'mdmedical'); // text for a category page
								// $text['tax'] 	  = esc_html__('Archive for "%s"', 'mdmedical'); // text for a taxonomy page
								// $text['search']   = esc_html__('Search Results for "%s" Query', 'mdmedical'); // text for a search results page
								// $text['tag']      = esc_html__('Posts Tagged "%s"', 'mdmedical'); // text for a tag page
								// $text['author']   = esc_html__('Articles Posted by %s', 'mdmedical'); // text for an author page
								// $text['404']      = esc_html__('Oops! That page can&rsquo;t be found', 'mdmedical'); // text for the 404 page
								
								$text['home']     = esc_html__('Trang chủ', 'mdmedical'); // text for the 'Home' link
								$text['category'] = esc_html__('%s', 'mdmedical'); // text for a category page
								$text['tax'] 	  = esc_html__('%s', 'mdmedical'); // text for a taxonomy page
								$text['search']   = esc_html__('Kết quả tìm kiếm cho "%s" Query', 'mdmedical'); // text for a search results page
								$text['tag']      = esc_html__('Tag bài viết "%s"', 'mdmedical'); // text for a tag page
								$text['author']   = esc_html__('Bài viết bởi %s', 'mdmedical'); // text for an author page
								$text['404']      = esc_html__('Oops! Bài viết không tồn tại', 'mdmedical'); // t

								$page_title = '';
								if(is_home()){
									$page_id = get_option('page_for_posts', true);
									if($page_id){
										$page_title .= get_the_title($page_id );
									}
									else{
										$page_title .= get_bloginfo('name');
									}
								}elseif ( is_category() ) {
									$page_title .= sprintf($text['category'], single_cat_title('', false));
								} elseif( is_tax() ){
									if(is_tax('cat')){
										$page_title .= sprintf($text['tax'], single_cat_title('', false));
									}
									else
									{
										$page_title .= sprintf(single_cat_title('', false));
									}
								}elseif ( is_search() ) {
									$page_title .= sprintf($text['search'], get_search_query());
								} elseif ( is_day() ) {
									$page_title .= sprintf($text['tax'], get_the_time('F jS, Y'));
								} elseif ( is_month() ) {
									$page_title .= sprintf($text['tax'], get_the_time('F, Y'));
								} elseif ( is_year() ) {
									$page_title .= sprintf($text['tax'], get_the_time('Y'));
								} elseif ( is_single()) {
									$page_title .= get_the_title();
								} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
									if(function_exists('is_shop') && is_shop()){
										$page_title .= get_the_title(wc_get_page_id( 'shop' ));
									}
									else{
										$post_type = get_post_type_object(get_post_type());
										$page_title .= $post_type->labels->all_items;
									}
								} elseif ( is_page()) {
									$page_title .= get_the_title();
								}elseif ( is_tag() ) {
									$page_title .= single_tag_title('', false);
								} elseif ( is_author() ) {
									global $author;
									$userdata = get_userdata($author);
									$page_title .= sprintf($text['author'], $userdata->display_name);
								} elseif ( is_404() ) {
									$page_title .= $text['404'];
								}
							
								$tagline = Inwave_Helper::getPostOption('tagline');
						
								if($tagline){
									echo wp_kses_post($tagline); 
								} else {
									echo esc_html($page_title);
								}
								?>
							</h1>
							<?php
							
							?>
						</div>
					</div>
					<?php 
						$show_breadcrums = Inwave_Helper::getPostOption('breadcrumbs', 'breadcrumbs');
						if (!is_page_template( 'page-templates/home-page.php' ) && $show_breadcrums && $show_breadcrums != 'no') {
							get_template_part('blocks/breadcrumbs');
						}
					?>
				</div>
			</div>
		</div>
    </div>
	<?php 
	} ?>
<?php } ?>