<?php
global $woocommerce;
if(!isset($cartUrl)){
	$cartUrl = '';
}
if(function_exists('WC')) {
	$cartUrl = WC()->cart->get_cart_url();
}

$inwave_theme_option = Inwave_Helper::getConfig();
$show_search_form = Inwave_Helper::getPostOption('show_search_form', 'show_search_form');
$logo = Inwave_Helper::getPostOption('logo', 'logo');
if (!$logo){
	$logo = get_template_directory_uri().'/assets/images/logo.png';
}
	
$header_contact_link = $inwave_theme_option['header_contact_link'];
if (!$header_contact_link){
	$header_contact_link = home_url().'/contact/';
}
$header_hotline_1 = $inwave_theme_option['header_hotline_1'];
$header_hotline_2 = $inwave_theme_option['header_hotline_2'];

$head_line_arr = array();
if($inwave_theme_option['header-top-desc']){
	$head_line_arr[] = $inwave_theme_option['header-top-desc'];
}
if($inwave_theme_option['header-top-desc-2']){
	$head_line_arr[] = $inwave_theme_option['header-top-desc-2'];
}
if($inwave_theme_option['header-top-desc-3']){
	$head_line_arr[] = $inwave_theme_option['header-top-desc-3'];
}

?>


<div class="header header-default header-default-edition">
	<div class="header-top">
		<div class="container">
			<div class="header-container theme-bg white-color">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php if(!empty($head_line_arr)){ ?>
							<div class="header-top-desc">
								<div class="head_lines">
								<?php foreach($head_line_arr as $key => $head_line){ ?>
									<div class="head_line"><?php echo $head_line; ?></div>
								<?php } ?>
								</div>
							</div>
						<?php 
						} ?>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="top-bar-right">
							<ul>
								<li class="header-search">
									 <form class="search-form-header" method="get" action="<?php echo esc_url( home_url( '/' ) )?>">
										<div class="search-box-header">
											<input type="search" value="<?php echo get_search_query() ?>" name="s" placeholder="<?php echo esc_attr_x( 'Enter your key word', 'placeholder','intravel' );?>" class="top-search">
										</div>
									</form>
									<button class="btn-show-search-form">
										<i class="fa fa-search"></i>
									</button>
								</li>
								<?php if($inwave_theme_option['woocommerce_cart_top_nav']){  ?>
									<li class="shopping-cart dropdown"> 
										<a href="<?php //inwave_check_cart_url(); ?>#" class="cart-icon dropdown-toggle" data-toggle="dropdown"> 
											<i class="fa fa-shopping-cart"></i><?php echo __('Giỏ hàng', 'mdmedical'); ?>
											<?php 
												$style = inwave_count_product() > 0 ? '' : 'style="display:none;"';
											?>
												<span class="number-product" <?php echo $style; ?>><?php echo inwave_count_product(); ?></span>
											<span class="b_caret"></span>
										</a> 
										<div id="mode-mini-cart" class="dropdown-menu">
											<?php echo wc_get_template( 'cart/dropdown-cart.php' ); ?>
										</div>
									</li>
								<?php } ?>
								
								<?php if($inwave_theme_option['show_header_login']){  ?>
									<li class="user">
										<?php if (!is_user_logged_in()){ ?>
											<a class="" href="#" data-toggle="modal" data-target="#loginPopup">
												<?php echo __('Đăng nhập', 'mdmedical'); ?>
											</a>
										<?php } else { 
											$current_user = wp_get_current_user();
										?>
											<span class="">
												<?php 
												echo sprintf(__('<i class="fa fa-user"></i> %s', 'mdmedical'), $current_user -> display_name); 
												?>
											</span>
										
										<?php } ?>
									</li>
									<?php if($inwave_theme_option['show_header_contact']){ ?>
										<?php if (!is_user_logged_in()){ ?>
											<li class="">
												<a class="" href="<?php echo esc_url($header_contact_link); ?>">
													<?php echo __('Liên hệ', 'mdmedical'); ?>
												</a>
											</li>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</ul>
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="header-midder">
		<div class="container">
			<div class="midder-container">
				<button class="off-canvas-open btn-open-menu"><i class="fa fa-bars"></i></button>
				<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<h1 class="logo"> 
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr(bloginfo('name')); ?>"> 
								<img class="main-logo" src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" /> 
							</a> 
						</h1>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="item-right">
							<ul>
								<?php if($inwave_theme_option['show_header_contact']){  ?>
									<li class="btn-header-contact">
										<a class="btn-contact" href="<?php echo esc_url($header_contact_link); ?>">
											<i class="fa fa-user-md"></i><?php echo __('Đặt lịch với bác sĩ', 'mdmedical'); ?>
										</a>
									</li>
								<?php } ?>
								<?php if($header_hotline_1 || $header_hotline_1){  ?>
									<li class="header-hotline">
										<?php if($header_hotline_2){  ?>
											<span class="hotline-number"><?php echo $header_hotline_1; ?></span>
										<?php } ?>
										<?php if($header_hotline_2){  ?>
											<span class="sperator"> - </span><span class="hotline-number"><?php echo $header_hotline_2; ?></span>
										<?php } ?>
									</li>
								<?php } ?>
								
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="header-bottom">
		<div class="container">
			<div class="mainmenu">
				<?php get_template_part('blocks/menu'); ?>
			</div>
		</div>
	</div>
	
</div>

<!--End Header-->