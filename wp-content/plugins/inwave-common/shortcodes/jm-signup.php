<?php

/*
 * @package MDmedical
 * @version 1.0.0
 * @created June 21, 2017
 * @author KienNguyen
 * @email kien.nguyen@jmango360.com
 * @website http://jmango360.com
 * @copyright Copyright (c) 2017 jMango360. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of slider
 *
 * @developer kiennb
 */
if (!class_exists('Inwave_JM_Signup')) {

    class Inwave_JM_Signup extends Inwave_Shortcode{

        protected $name = 'inwave_jm_signup';
		
        function init_params(){	
            return array(
                "name" => __("JM Signup to test", 'inwavethemes'),
                "base" => $this->name,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Register user on orchard", "inwavethemes"),
                "params" => array(
                    
					array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
        }

        // Shortcode handler function for list
        function init_shortcode($atts, $content = null) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( $this->name, $atts ) : $atts;

            $output = $class = $css = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
				'css' => '',
            ), $atts));

        
		$class .= ' '. vc_shortcode_custom_css_class( $css);
		ob_start();
			wp_enqueue_style('kien_boostrap-css', plugins_url(). '/inwave-common/assets/js/jm-signup/kien_boostrap.css', '1.0', true);
			wp_enqueue_style('validationEngine.jquery-css', plugins_url(). '/inwave-common/assets/js/jm-signup/validationEngine.jquery.css', '1.0', true);
			wp_enqueue_style('signup-css', plugins_url(). '/inwave-common/assets/js/jm-signup/signup.css', '1.0', true);
			wp_enqueue_script('google-client', 'https://apis.google.com/js/client.js', '1.0', true);
			wp_enqueue_script('sha1.min-js', plugins_url(). '/inwave-common/assets/js/jm-signup/sha1.min.js', '1.0', true);
			wp_enqueue_script('base64.min-js', plugins_url(). '/inwave-common/assets/js/jm-signup/base64.min.js', '1.0', true);
			wp_enqueue_script('jquery.validationEngine-js', plugins_url(). '/inwave-common/assets/js/jm-signup/jquery.validationEngine.js', '1.0', true);
			wp_enqueue_script('jquery.validationEngine-en-js', plugins_url(). '/inwave-common/assets/js/jm-signup/jquery.validationEngine-en.js', '1.0', true);
			wp_enqueue_script('const-js', plugins_url(). '/inwave-common/assets/js/jm-signup/const.js', '1.0', true);
			wp_enqueue_script('signup-js', plugins_url(). '/inwave-common/assets/js/jm-signup/signup.js', '1.0', true);
			
			// var_dump(get_template_directory_uri());
			?>
		
				<div class="signup-user-orchard">
					<div class="title-block">
						<h3 class="title">Ready to design your own app?</h3>
						<div class="sub-title">Create a free account, login & you are good to go!</div>
					</div>
					<form id="jmango360-signup-form">
						<div class="ajax-error"></div>
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="text" name="" id="jmango360_account_firstname" value="" placeholder="First Name" class="form-control validate[required]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="text" name="" id="jmango360_account_lastname" value="" placeholder="Last Name" class="form-control validate[required]" />
								</div>
							</div>	
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="email" name="" id="jmango360_account_email" value="" placeholder="Email" class="form-control validate[required, custom[email]]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="password" name="" id="jmango360_account_password" value="" placeholder="Password" class="form-control validate[required, minSize[6]]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="password" name="" id="" value="" placeholder="Confirm Password" class="form-control validate[required, equals[jmango360_account_password]]" />
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-field form-submit">
									<input type="submit" class="btn-submit" value="Create my account" />
								</div>
							</div>
						</div>
                  </form>
				</div>
			<?php 
			
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}
new Inwave_JM_Signup;
