<?php

	wp_enqueue_style('kien_boostrap-css', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/kien_boostrap.css', '1.0', true);
	wp_enqueue_style('validationEngine.jquery-css', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/validationEngine.jquery.css', '1.0', true);
	wp_enqueue_style('signup-css', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/signup.css', '1.0', true);
	wp_enqueue_script('google-client', 'https://apis.google.com/js/client.js', '1.0', true);
	wp_enqueue_script('sha1.min-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/sha1.min.js', '1.0', true);
	wp_enqueue_script('base64.min-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/base64.min.js', '1.0', true);
	wp_enqueue_script('jquery.validationEngine-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/jquery.validationEngine.js', '1.0', true);
	wp_enqueue_script('jquery.validationEngine-en-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/jquery.validationEngine-en.js', '1.0', true);
	wp_enqueue_script('const-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/const.js', '1.0', true);
	wp_enqueue_script('signup-js', get_template_directory_uri(). '/components/shortcodes/jm_signup/asset/signup.js', '1.0', true);


?>

				<div class="signup-user-orchard">
					<div class="title-block">
						<h3 class="title"><?php esc_html_e( 'Ready to design your own app?', 'mk_framework' ); ?></h3>
						<div class="sub-title"><?php esc_html_e( 'Create a free account, login & you are good to go!', 'mk_framework' ); ?></div>
					</div>
					<form id="jmango360-signup-form">
						<div class="ajax-error"></div>
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="text" name="" id="jmango360_account_firstname" value="" placeholder="<?php esc_html_e( 'First Name', 'mk_framework' ); ?>" class="form-control validate[required]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="text" name="" id="jmango360_account_lastname" value="" placeholder="<?php esc_html_e( 'Last Name', 'mk_framework' ); ?>" class="form-control validate[required]" />
								</div>
							</div>	
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="email" name="" id="jmango360_account_email" value="" placeholder="<?php esc_html_e( 'Email', 'mk_framework' ); ?>" class="form-control validate[required, custom[email]]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="password" name="" id="jmango360_account_password" value="" placeholder="<?php esc_html_e( 'Password', 'mk_framework' ); ?>" class="form-control validate[required, minSize[6]]" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-field">
									<input type="password" name="" id="" value="" placeholder="<?php esc_html_e( 'Confirm Password', 'mk_framework' ); ?>" class="form-control validate[required, equals[jmango360_account_password]]" />
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-field form-submit">
									<input type="submit" class="btn-submit" value="<?php esc_html_e( 'Create my account', 'mk_framework' ); ?>" />
								</div>
							</div>
						</div>
                  </form>
				</div>













