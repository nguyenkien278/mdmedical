<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package inEvent
 */
 $inwave_theme_option = Inwave_Helper::getConfig();
// $show_breadcrums = Inwave_Helper::getPostOption('breadcrumbs', 'breadcrumbs');
// if (!is_page_template( 'page-templates/home-page.php' ) && $show_breadcrums && $show_breadcrums != 'no') {
    // get_template_part('blocks/breadcrumbs');
// }
$footer_layout = Inwave_Helper::getPostOption('footer_option', 'footer_option');
$footer_layout = $footer_layout ? $footer_layout : 'default';
get_template_part('footer/footer', $footer_layout);
?>
</div> <!--end .content-wrapper -->
<?php wp_footer(); ?>
<?php if(($inwave_theme_option['show_header_login']) && (!is_user_logged_in())){ ?>
	<div id="loginPopup" class="loginPopup modal fade" role="dialog">
		<div class="modal-dialog"> 
			<div class="modal-content">
				<button type="button" class="btn-close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<div class="title-group">
					<h3 class="title">Login</h3>
				</div>
				<div class="jm-login-form">
					<?php 
						$args = array(
							'echo'           => true,
							'remember'       => true,
							'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
							'form_id'        => 'loginform',
							'id_username'    => 'user_login',
							'id_password'    => 'user_pass',
							'id_remember'    => 'rememberme',
							'id_submit'      => 'btn-submit',
							'label_username' => __( 'Username' ),
							'label_password' => __( 'Password' ),
							'label_remember' => __( 'Remember Me' ),
							'label_log_in'   => __( 'Log In' ),
							'value_username' => '',
							'value_remember' => false
						);
					?>
				<?php wp_login_form( $args ); ?> 
				
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php if($inwave_theme_option['embed-code-zotabox']){ 
	echo '<script type="text/javascript">'.$inwave_theme_option['embed-code-zotabox'].'</script>';
}
?>
</body>
</html>
