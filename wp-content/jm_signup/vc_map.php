<?php

vc_map(array(
    'name'        => __( 'JM Signup', 'mk_framework' ),
    'base'        => 'jm_signup',
    'category'    => __( 'General', 'mk_framework' ),
    'description' => __( 'Signup form for user orchard.', 'mk_framework' ),
    'icon'        => 'icon-mk-image vc_mk_element-icon',
    'params'      => array(
		array(
            "type" => "textfield",
            "heading" => __("Signup title form", "mk_framework") ,
            "param_name" => "title",
            "value" => "Ready to design your own app?",
            "description" => __("", "mk_framework")
        ),
		array(
            "type" => "textfield",
            "heading" => __("Signup sub title form", "mk_framework") ,
            "param_name" => "sub_title",
            "value" => "Create a free account, login & you are good to go!",
            "description" => __("", "mk_framework")
        ),
		array(
            "type" => "textfield",
            "heading" => __("Submit button text", "mk_framework") ,
            "param_name" => "submit_button_text",
            "value" => "Create my account",
            "description" => __("", "mk_framework")
        ),
	)
));