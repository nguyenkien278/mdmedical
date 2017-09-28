<?php
/**
 * Created by PhpStorm.
 * User: TruongDX
 * Date: 11/10/2015
 * Time: 11:44 AM
 */

    $inwave_theme_option = Inwave_Helper::getConfig();
    $show_breadcrums = Inwave_Helper::getPostOption('breadcrumbs', 'breadcrumbs');
?>

<?php 
	// $url = 'https://www.youtube.com/watch?v=4Bw105Ck2oI';
	// $trimmed = trim($url, "https://www.youtube.com/watch?v=");
	// var_dump($trimmed);
?>
<footer class="iw-footer">
    <div class="iw-footer-middle">
        <div class="container">
			<div class="container-inner">
				<div class="container-inner2">
					<div class="social-current">
						<span class="social-label"><?php echo __('Theo dõi MDmedical ', 'mdmedical'); ?></span><?php echo inwave_get_social_link(); ?>
					</div>
					<div class="footer-widget-arena">
						<div class="row">
							<?php
							switch($inwave_theme_option['footer_number_widget'])
							{
								case '1':
									dynamic_sidebar('footer-widget-1');
									break;
								case '2':
									echo '<div class="col-lg-6 col-md-6 col-sm-12">';
									dynamic_sidebar('footer-widget-1');
									echo '</div>';
									echo '<div class="col-lg-6 col-md-6 col-sm-12 last">';
									dynamic_sidebar('footer-widget-2');
									echo '</div>';
									break;
								case '3':
									echo '<div class="col-lg-4 col-md-4 col-sm-12">';
									dynamic_sidebar('footer-widget-1');
									echo '</div>';
									echo '<div class="col-lg-4 col-md-4 col-sm-12">';
									dynamic_sidebar('footer-widget-2');
									echo '</div>';
									echo '<div class="col-lg-4 col-md-4 col-sm-12 last">';
									dynamic_sidebar('footer-widget-3');
									echo '</div>';
									break;
								case '4':
									echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
									dynamic_sidebar('footer-widget-1');
									echo '</div>';
									echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
									dynamic_sidebar('footer-widget-2');
									echo '</div>';
									echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
									dynamic_sidebar('footer-widget-3');
									echo '</div>';
									echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 last">';
									dynamic_sidebar('footer-widget-4');
									echo '</div>';
									break;
							}
							?>
						</div>
					</div>
					<div class="iw-copyright">
						<div class="copyright">
							<?php dynamic_sidebar('widget-copyright'); ?>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</footer>
