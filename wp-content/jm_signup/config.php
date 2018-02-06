<?php
extract( shortcode_atts(array(
		'title' 				=> 'Ready to design your own app?',
		'sub_title' 			=> 'Create a free account, login & you are good to go!',
		'submit_button_text'	=> 'Create my account',
		), $atts ) );
Mk_Static_Files::addAssets('jm_signup');
