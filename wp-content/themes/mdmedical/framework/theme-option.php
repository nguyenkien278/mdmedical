<?php

add_action('init', 'inwave_of_options');

if (!function_exists('inwave_of_options')) {
    function inwave_of_options()
    {
        global $wp_registered_sidebars;
        $sidebar_options[] = 'None';
         $sidebars = $wp_registered_sidebars;
        if (is_array($sidebars) && !empty($sidebars)) {
            foreach ($sidebars as $sidebar) {
                $sidebar_options[] = $sidebar['name'];
            }
        }

        //get slug menu in admin
        $menuArr = array();
        $menus = get_terms('nav_menu');
        foreach ( $menus as $menu ) {
            $menuArr[$menu->slug] = $menu->name;
        }

        //Access the WordPress Categories via an Array
        $of_categories = array();
        $of_categories_obj = get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
            $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
        }

        //Access the WordPress Pages via an Array
        $of_pages = array();
        $of_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($of_pages_obj as $of_page) {
            $of_pages[$of_page->ID] = $of_page->post_name;
        }

        /*-----------------------------------------------------------------------------------*/
        /* TO DO: Add options/functions that use these */
        /*-----------------------------------------------------------------------------------*/
        $google_fonts = inwave_get_googlefonts(false);

        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $inwave_of_options;
        $inwave_of_options = array();

        // GENERAL SETTING
        $inwave_of_options[] = array("name" => esc_html__("General setting", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Show demo setting panel", 'mdmedical'),
            "desc" => esc_html__("Check this box to active the setting panel. This panel should be shown only in demo mode", 'mdmedical'),
            "id" => "show_setting_panel",
            "std" => 0,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Show page heading", 'mdmedical'),
            "desc" => esc_html__("Check this box to show or hide page heading", 'mdmedical'),
            "id" => "show_page_heading",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Show breadcrumbs", 'mdmedical'),
            "desc" => esc_html__("Check to display the breadcrumbs in general. Uncheck to hide them.", 'mdmedical'),
            "id" => "breadcrumbs",
            "std" => 1,
            "type" => "checkbox");
        // $inwave_of_options[] = array("name" => esc_html__("Show preload", 'mdmedical'),
            // "desc" => esc_html__("Check to display the preload page.", 'mdmedical'),
            // "id" => "show_preload",
            // "std" => 0,
            // "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Retina support:", 'mdmedical'),
            "desc" => esc_html__("Each time an image is uploaded, a higher quality version is created and stored with @2x added to the filename in the media upload folder. These @2x images will be loaded with high-resolution screens.", 'mdmedical'),
            "id" => "retina_support",
            "std" => 0,
            "type" => "checkbox");
        
        $inwave_of_options[] = array("name" => esc_html__("Google API", 'mdmedical'),
            "desc" => wp_kses(__('Use for process data from google service. Eg: map, photo, video... To get Google api, you can access via <a href="https://console.developers.google.com/" target="_blank">here</a>.', 'mdmedical'), inwave_allow_tags('a')),
            "id" => "google_api",
            "std" => '',
            "type" => "text");

        $inwave_of_options[] = array(
			"name" => esc_html__("Layout", 'mdmedical'),
            "desc" => esc_html__("Select boxed or wide layout.", 'mdmedical'),
            "id" => "body_layout",
            "std" => "wide",
            "type" => "select",
            "options" => array(
                'boxed' => 'Boxed',
                'wide' => 'Wide',
            ));

        $inwave_of_options[] = array(
			"name" => esc_html__("Sidebar Position", 'mdmedical'),
            "desc" => esc_html__("Select slide bar position", 'mdmedical'),
            "id" => "sidebar_position",
            "std" => "right",
            "type" => "select",
            "options" => array(
                'none' => 'Without Sidebar',
                'right' => 'Right',
                'left' => 'Left',
                'bottom' => 'Bottom'
            ));

        $inwave_of_options[] = array("name" => "Background Image",
            "desc" => esc_html__("Please choose an image or insert an image url to use for the background.", 'mdmedical'),
            "id" => "bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $inwave_of_options[] = array(
			"name" => esc_html__("Background Image Size", 'mdmedical'),
            "desc" => esc_html__("Select background image size.", 'mdmedical'),
            "id" => "bg_size",
            "std" => 'cover',
            "type" => "select",
            "options" => array(
				'auto' => esc_html__('auto', 'mdmedical'), 
				'cover' => esc_html__('cover', 'mdmedical'), 
				'contain' => esc_html__('contain', 'mdmedical')
			)
		);

        $inwave_of_options[] = array(
			"name" => esc_html__("Background Repeat", 'mdmedical'),
            "desc" => esc_html__("Choose how the background image repeats.", 'mdmedical'),
            "id" => "bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array(
				'repeat' => esc_html__('repeat', 'mdmedical'), 
				'repeat-x' => esc_html__('repeat-x', 'mdmedical'), 
				'repeat-y' => esc_html__('repeat-y', 'mdmedical'), 
				'no-repeat' => esc_html__('no-repeat', 'mdmedical')
			)
		);

        $inwave_of_options[] = array("name" => esc_html__("Develop mode", 'mdmedical'),
            "desc" => esc_html__("Check this box to active develop mode. This option should be used only while developing this theme", 'mdmedical'),
            "id" => "develop_mode",
            "std" => 0,
            "type" => "checkbox");

        //TYPO
        $inwave_of_options[] = array(
			"name" => esc_html__("Typography", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array( "name" => esc_html__("Body Font Family", 'mdmedical'),
            "desc" => esc_html__("Select a font family for body text", 'mdmedical'),
            "id" => "f_body",
            "std" => "Poppins",
            "type" => "select",
            "options" => $google_fonts);
        $inwave_of_options[] = array( "name" => esc_html__("Body Font Settings", 'mdmedical'),
            "desc" => esc_html__("Adjust the settings below to load different character sets and types for fonts. More character sets and types equals to slower page load.", 'mdmedical'),
            "id" => "f_body_settings",
            "std" => "300,400,500,600,700,800,900",
            "type" => "text");
        $inwave_of_options[] = array( "name" => esc_html__("Headings Font", 'mdmedical'),
            "desc" => esc_html__("Select a font family for headings", 'mdmedical'),
            "id" => "f_headings",
            "std" => "",
            "type" => "select",
            "options" => $google_fonts);
        $inwave_of_options[] = array( "name" => esc_html__("Headings Font Settings", 'mdmedical'),
            "desc" => esc_html__("Adjust the settings below to load different character sets and types for fonts. More character sets and types equals to slower page load.", 'mdmedical'),
            "id" => "f_headings_settings",
            "std" => "",
            "type" => "text");
        $inwave_of_options[] = array( "name" => esc_html__("Menu Font", 'mdmedical'),
            "desc" => esc_html__("Select a font family for navigation", 'mdmedical'),
            "id" => "f_nav",
            "std" => "",
            "type" => "select",
            "options" => $google_fonts);
        $inwave_of_options[] = array( "name" => esc_html__("Menu Font Settings", 'mdmedical'),
            "desc" => esc_html__("Adjust the settings below to load different character sets and types for fonts. More character sets and types equals to slower page load.", 'mdmedical'),
            "id" => "f_nav_settings",
            "std" => "",
            "type" => "text");
        $inwave_of_options[] = array( "name" => esc_html__("Default Font Size", 'mdmedical'),
            "desc" => esc_html__("Default is 13px", 'mdmedical'),
            "id" => "f_size",
            "std" => "14px",
            "type" => "text"
        );
        $inwave_of_options[] = array( "name" => esc_html__("Default Font Line Height", 'mdmedical'),
            "desc" => esc_html__("Default is 24px", 'mdmedical'),
            "id" => "f_lineheight",
            "std" => "30px",
            "type" => "text",
        );

        // COLOR PRESETS
        $inwave_of_options[] = array("name" => esc_html__("Color presets", 'mdmedical'),
            "type" => "heading"
        );

        $inwave_of_options[] = array("name" => esc_html__("Primary Color", 'mdmedical'),
            "desc" => esc_html__("Controls several items, ex: link hovers, highlights, and more.", 'mdmedical'),
            "id" => "primary_color",
            "std" => "#13a1c5",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Background Color", 'mdmedical'),
            "desc" => esc_html__("Select a background color.", 'mdmedical'),
            "id" => "bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Content Background Color", 'mdmedical'),
            "desc" => esc_html__("Controls the background color of the main content area.", 'mdmedical'),
            "id" => "content_bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Body Text Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of body font.", 'mdmedical'),
            "id" => "body_text_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Link Color", 'mdmedical'),
            "desc" => esc_html__("Controls the color of all text links as well as the '>' in certain areas.", 'mdmedical'),
            "id" => "link_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Blockquote Color", 'mdmedical'),
            "desc" => esc_html__("Controls the color of blockquote.", 'mdmedical'),
            "id" => "blockquote_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array(
			"name" => esc_html__("Color Scheme", 'mdmedical'),
            "desc" => "",
            "id" => "color_pagetitle_breadcrumb",
            "std" => "<h3>".esc_html__('Page Title & Breadcrumb Color', 'mdmedical')."</h3>",
            "icon" => true,
            "position" => "start",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Page Title Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the page title.", 'mdmedical'),
            "id" => "page_title_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Page Title Background Color", 'mdmedical'),
            "desc" => esc_html__("Controls background color of the page title.", 'mdmedical'),
            "id" => "page_title_bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Breadcrumbs Background Color", 'mdmedical'),
            "desc" => esc_html__("Controls the background color of the breadcrumb.", 'mdmedical'),
            "id" => "breadcrumbs_bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Breadcrumbs Border Color", 'mdmedical'),
            "desc" => esc_html__("Controls the Border color of the breadcrumb.", 'mdmedical'),
            "id" => "breadcrumbs_bd_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Breadcrumbs Text Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the breadcrumb font.", 'mdmedical'),
            "id" => "breadcrumbs_text_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Breadcrumbs Link Color", 'mdmedical'),
            "desc" => esc_html__("Controls the link color of the breadcrumb font.", 'mdmedical'),
            "id" => "breadcrumbs_link_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array(
            "position" => "end",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Color Scheme", 'mdmedical'),
            "desc" => "",
            "id" => "color_scheme_header",
            "std" => "<h3>".esc_html__('Header Color', 'mdmedical')."</h3>",
            "icon" => true,
            "position" => "start",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Header Link Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the header link.", 'mdmedical'),
            "id" => "header_link_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Header Sub Link Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the header sub link.", 'mdmedical'),
            "id" => "header_sub_link_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Header Background Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the header background.", 'mdmedical'),
            "id" => "header_bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Header Border Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the header border.", 'mdmedical'),
            "id" => "header_bd_color",
            "std" => "",
            "type" => "color");

        $inwave_of_options[] = array(
            "position" => "end",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Color Scheme", 'mdmedical'),
            "desc" => "",
            "id" => "color_scheme_font",
            "std" => "<h3>".esc_html__('Footer Color', 'mdmedical')."</h3>",
            "icon" => true,
            "position" => "start",
            "type" => "accordion");

        $inwave_of_options[] = array("name" => esc_html__("Footer Background Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the footer background.", 'mdmedical'),
            "id" => "footer_bg_color",
            "std" => "",
            "type" => "color");

        $inwave_of_options[] = array("name" => esc_html__("Footer Border Color", 'mdmedical'),
            "desc" => esc_html__("Select a color for the footer border.", 'mdmedical'),
            "id" => "footer_border_color",
            "std" => "",
            "type" => "color");


        $inwave_of_options[] = array("name" => esc_html__("Footer Headings Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the footer heading font.", 'mdmedical'),
            "id" => "footer_headings_color",
            "std" => "",
            "type" => "color");

        $inwave_of_options[] = array("name" => esc_html__("Footer Font Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the footer font.", 'mdmedical'),
            "id" => "footer_text_color",
            "std" => "#989898",
            "type" => "color");

        $inwave_of_options[] = array("name" => esc_html__("Footer Link Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the footer link font.", 'mdmedical'),
            "id" => "footer_link_color",
            "std" => "#989898",
            "type" => "color");

        $inwave_of_options[] = array(
            "position" => "end",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Color Scheme", 'mdmedical'),
            "desc" => "",
            "id" => "color_copyright",
            "std" => "<h3>".esc_html__('Copyright Color', 'mdmedical')."</h3>",
            "icon" => true,
            "position" => "start",
            "type" => "accordion");
        $inwave_of_options[] = array("name" => esc_html__("Copyright Background Color", 'mdmedical'),
            "desc" => esc_html__("Controls the background color of the copyright section.", 'mdmedical'),
            "id" => "copyright_bg_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Copyright Text Color", 'mdmedical'),
            "desc" => esc_html__("Controls the text color of the breadcrumb font.", 'mdmedical'),
            "id" => "copyright_text_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array("name" => esc_html__("Copyright Link Color", 'mdmedical'),
            "desc" => esc_html__("Controls the link color of the breadcrumb font.", 'mdmedical'),
            "id" => "copyright_link_color",
            "std" => "",
            "type" => "color");
        $inwave_of_options[] = array(
            "position" => "end",
            "type" => "accordion");

        //HEADER OPTIONS
        $inwave_of_options[] = array("name" => esc_html__("Header Options", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Header Info", 'mdmedical'),
            "desc" => "",
            "id" => "header_info_content_options",
            "std" => "<h3>".esc_html__('Header Content Options', 'mdmedical')."</h3>",
            "type" => "info");

        $inwave_of_options[] = array("name" => esc_html__("Select a Header Layout", 'mdmedical'),
            "desc" => "",
            "id" => "header_layout",
            "std" => "default",
            "type" => "images",
            "options" => array(
                "default" => get_template_directory_uri() . "/assets/images/header/default.jpg",
            ));
        // $inwave_of_options[] = array("name" => esc_html__("Sticky Header", 'mdmedical'),
            // "desc" => esc_html__("Check to enable a fixed header when scrolling, uncheck to disable.", 'mdmedical'),
            // "id" => "header_sticky",
            // "std" => '0',
            // "type" => "checkbox");
			
		$inwave_of_options[] = array(
			"name" => esc_html__("Show header login", 'mdmedical'),
            "desc" => esc_html__("Check to show login link on header top menu", 'mdmedical'),
            "id" => "show_header_login",
            "std" => '1',
            "type" => "checkbox"
		);
		
		$inwave_of_options[] = array(
			"name" => esc_html__("Show header contact", 'mdmedical'),
            "desc" => esc_html__("Check to show contact link on header top menu", 'mdmedical'),
            "id" => "show_header_contact",
            "std" => '1',
            "type" => "checkbox"
		);
		$inwave_of_options[] = array(
			"name" => esc_html__("Header contact link", 'mdmedical'),
            "desc" => esc_html__("Header contact link, ex: http://mdmedical.vn/contact/", 'mdmedical'),
            "id" => "header_contact_link",
            "std" => esc_url(home_url())."/contact",
            "type" => "text"
		);
		
		$inwave_of_options[] = array(
			"name" => esc_html__("Hot line 1", 'mdmedical'),
            "desc" => esc_html__("Header hotline 1", 'mdmedical'),
            "id" => "header_hotline_1",
            "std" => '0169 924 6357',
            "type" => "text"
		);
		
		$inwave_of_options[] = array(
			"name" => esc_html__("Hot line 2", 'mdmedical'),
            "desc" => esc_html__("Header hotline 2", 'mdmedical'),
            "id" => "header_hotline_2",
            "std" => '0435 668 168',
            "type" => "text"
		);

        // $inwave_of_options[] = array("name" => esc_html__("Button Search Form in Header", 'mdmedical'),
            // "desc" => esc_html__("Check to enable button search form, uncheck to disable.", 'mdmedical'),
            // "id" => "show_search_form",
            // "std" => '1',
            // "type" => "checkbox");

        $inwave_of_options[] = array(
			"name" => esc_html__("Logo", 'mdmedical'),
            "desc" => esc_html__("Please choose an image file for your logo.", 'mdmedical'),
            "id" => "logo",
            "std" => get_template_directory_uri() . "/assets/images/logo.png",
            "mod" => "",
            "type" => "media");

        // $inwave_of_options[] = array(
            // "name" => esc_html__("Logo Sticky", 'mdmedical'),
            // "desc" => esc_html__("Please choose an image file for your logo sticky.", 'mdmedical'),
            // "id" => "logo_sticky",
           // "std" => get_template_directory_uri() . "/assets/images/logo_sticky.png",
            // "std" => '',
            // "mod" => "",
            // "type" => "media");
        $inwave_of_options[] = array(
			"name" => "Header top description",
            "desc" => "Text will appear on top of header",
            "id" => "header-top-desc",
            "std" => "",
            "mod" => "",
            "type" => "text"
		);
		$inwave_of_options[] = array(
			"name" => esc_html__("Header top description 2", 'mdmedical'),
            "desc" => esc_html__("Header top description 2", 'mdmedical'),
            "id" => "header-top-desc-2",
            "std" => '',
            "type" => "text"
		);
		$inwave_of_options[] = array(
			"name" => esc_html__("Header top description 3", 'mdmedical'),
            "desc" => esc_html__("Header top description 3", 'mdmedical'),
            "id" => "header-top-desc-3",
            "std" => '',
            "type" => "text"
		);

        $inwave_of_options[] = array("name" => esc_html__("Header Info", 'mdmedical'),
            "desc" => "",
            "id" => "header_info_page_title_options",
            "std" => "<h3>".esc_html__("Page Title Bar Options", 'mdmedical')."</h3>",
            "type" => "info");
        $inwave_of_options[] = array("name" => esc_html__("Page Title Height", 'mdmedical'),
            "desc" => esc_html__("In pixels, ex: 10px", 'mdmedical'),
            "id" => "page_title_height",
            "std" => "333px",
            "type" => "text");

        $inwave_of_options[] = array("name" => esc_html__("Page Title Background", 'mdmedical'),
            "desc" => esc_html__("Please choose an image or insert an image url to use for the page title background.", 'mdmedical'),
            "id" => "page_title_bg",
            "std" => '',
            "mod" => "",
            "type" => "media");

        $inwave_of_options[] = array(
			"name" => esc_html__("Background Image Size", 'mdmedical'),
            "desc" => esc_html__("Select Page Title background image size.", 'mdmedical'),
            "id" => "page_title_bg_size",
            "std" => 'cover',
            "type" => "select",
            "options" => array(
				'auto' => esc_html__('auto', 'mdmedical'), 
				'cover' => esc_html__('cover', 'mdmedical'), 
				'contain' => esc_html__('contain', 'mdmedical')
			)
		);
		
		$inwave_of_options[] = array(
			"name" => esc_html__("Background Position", 'mdmedical'),
            "desc" => esc_html__("Select Page Title Background Position.", 'mdmedical'),
            "id" => "page_title_bg_position",
            "std" => 'center top',
            "type" => "select",
            "options" => array(
				'center top' => esc_html__('Center Top', 'mdmedical'), 
				'center center' => esc_html__('Center Center', 'mdmedical'), 
				'center bottom' => esc_html__('Center Bottom', 'mdmedical'),
				'left top' => esc_html__('Left Top', 'mdmedical'),
				'left center' => esc_html__('Left Center', 'mdmedical'),
				'left bottom' => esc_html__('Left Bottom', 'mdmedical'),
				'right top' => esc_html__('Right Top', 'mdmedical'),
				'right center' => esc_html__('Right Center', 'mdmedical'),
				'right bottom' => esc_html__('Right Bottom', 'mdmedical'),
			)
		);

        $inwave_of_options[] = array(
			"name" => esc_html__("Background Repeat", 'mdmedical'),
            "desc" => esc_html__("Choose how the background image repeats.", 'mdmedical'),
            "id" => "page_title_bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array(
				'repeat' => esc_html__('repeat', 'mdmedical'), 
				'repeat-x' => esc_html__('repeat-x', 'mdmedical'), 
				'repeat-y' => esc_html__('repeat-y', 'mdmedical'),
				'no-repeat' => esc_html__('no-repeat', 'mdmedical')
			)
		);

        // FOOTER OPTIONS
        $inwave_of_options[] = array("name" => esc_html__("Footer options", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Footer style", 'mdmedical'),
            "desc" => "",
            "id" => "footer_option",
            "std" => "default",
            "type" => "images",
            "options" => array(
            "default" => get_template_directory_uri() . "/assets/images/footer/default.jpg",
            ));
        $inwave_of_options[] = array("name" => esc_html__("Footer columns", 'mdmedical'),
            "id" => "footer_number_widget",
            "std" => "4",
            "type" => "select",
            "options" => array(
                '4' => '4',
                '3' => '3',
                '2' => '2',
                '1' => '1',
            ));
		
		$inwave_of_options[] = array(
			"name" => esc_html__("Zotabox embed code", 'mdmedical'),
            "desc" => esc_html__("Enter your script code from Zotabox to enable live facebook .", 'mdmedical'),
            "id" => "embed-code-zotabox",
            "std" => '',
            "type" => "textarea"
		);

        // $inwave_of_options[] = array("name" => esc_html__("Background Image For Footer Area", 'mdmedical'),
            // "desc" => esc_html__("Please choose an image or insert an image url to use for the footer widget area background.", 'mdmedical'),
            // "id" => "footer_bg_image",
            // "std" => "",
            // "mod" => "",
            // "type" => "media");

        // $inwave_of_options[] = array("name" => esc_html__("Background Image Size", 'mdmedical'),
            // "desc" => esc_html__("Select Footer background image size.", 'mdmedical'),
            // "id" => "footer_bg_size",
            // "std" => 'cover',
            // "type" => "select",
            // "options" => array('auto' => esc_html__('auto', 'mdmedical'), 'cover' => esc_html__('cover', 'mdmedical'), 'contain' => esc_html__('contain', 'mdmedical')));

        // $inwave_of_options[] = array("name" => esc_html__("Background Repeat", 'mdmedical'),
            // "desc" => esc_html__("Choose how the background image repeats.", 'mdmedical'),
            // "id" => "footer_bg_repeat",
            // "std" => "",
            // "type" => "select",
            // "options" => array('repeat' => esc_html__('repeat', 'mdmedical'), 'repeat-x' => esc_html__('repeat-x', 'mdmedical'), 'repeat-y' => esc_html__('repeat-y', 'mdmedical'), 'no-repeat' => esc_html__('no-repeat', 'mdmedical')));
		
		// $inwave_of_options[] = array(
			// "name" => esc_html__("Show back to top button", 'mdmedical'),
            // "desc" => esc_html__("Check the box to show back to top at bottom.", 'mdmedical'),
            // "id" => "back_to_top",
            // "std" => 1,
            // "type" => "checkbox"
		// );

        //CUSTOM SIDEBAR
        $inwave_of_options[] = array("name" => esc_html__("Custom Sidebar", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Custom Sidebar", 'mdmedical'),
            "desc" => esc_html__("Custom sidebar", 'mdmedical'),
            "id" => "custom_sidebar",
            "type" => "addoption",
            'option_label' => esc_html__('Sidebar', 'mdmedical'),
            'add_btn_text' => esc_html__('Add New Sidebar', 'mdmedical')
        );

        // SHOP OPTIONS
        $inwave_of_options[] = array("name" => esc_html__("Shop options", 'mdmedical'),
            "type" => "heading");

        $inwave_of_options[] = array("name" => esc_html__("Show Woocommerce Cart Icon in Top Navigation", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the Cart icon & Cart widget, uncheck to disable.", 'mdmedical'),
            "id" => "woocommerce_cart_top_nav",
            "std" => 1,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Show Quick View Button", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the quick view button on product image.", 'mdmedical'),
            "id" => "woocommerce_quickview",
            "std" => 0,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Quick View Effect", 'mdmedical'),
            "desc" => esc_html__("Select effect of the quick view box.", 'mdmedical'),
            "id" => "woocommerce_quickview_effect",
            "std" => 'fadein',
            "type" => "select",
            "options" => array(
                'fadein' => esc_html__('Fadein', 'mdmedical'),
                'slide' => esc_html__('Slide', 'mdmedical'),
                'newspaper' => esc_html__('Newspaper', 'mdmedical'),
                'fall' => esc_html__('Fall', 'mdmedical'),
                'sidefall' => esc_html__('Side Fall', 'mdmedical'),
                'blur' => esc_html__('Blur', 'mdmedical'),
                'flip' => esc_html__('Flip', 'mdmedical'),
                'sign' => esc_html__('Sign', 'mdmedical'),
                'superscaled' => esc_html__('Super Scaled', 'mdmedical'),
                'slit' => esc_html__('Slit', 'mdmedical'),
                'rotate' => esc_html__('Rotate', 'mdmedical'),
                'letmein' => esc_html__('Letmein', 'mdmedical'),
                'makeway' => esc_html__('Makeway', 'mdmedical'),
                'slip' => esc_html__('Slip', 'mdmedical')
            ));
        // $inwave_of_options[] = array("name" => esc_html__("Shop column", 'mdmedical'),
            // "desc" => esc_html__("Column in shop page.", 'mdmedical'),
            // "id" => "woocommerce_shop_column",
            // "std" => '3',
            // "type" => "select",
            // "options" => array(
                // '3' => '3',
                // '4' => '4',
            // ));
        // $inwave_of_options[] = array("name" => esc_html__("Product Listing Layout", 'mdmedical'),
            // "desc" => esc_html__("Select the layout for product listing page. Please logout to clean the old session", 'mdmedical'),
            // "id" => "product_listing_layout",
            // "std" => "wide",
            // "type" => "select",
            // "options" => array(
                // 'grid' => 'Grid',
                // 'row' => 'Row'
            // ));
        $inwave_of_options[] = array("name" => esc_html__("Troubleshooting", 'mdmedical'),
            "desc" => wp_kses(__("Woocommerce jquery cookie fix<br> Read more: <a href='http://docs.woothemes.com/document/jquery-cookie-fails-to-load/'>jquery-cookie-fails-to-load</a>", 'mdmedical'), inwave_allow_tags(array('br', 'a'))),
            "id" => "fix_woo_jquerycookie",
            "std" => 0,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Blog", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Blog Listing", 'mdmedical'),
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3>".esc_html__("Blog Listing", 'mdmedical')."</h3>",
            "icon" => true,
            "type" => "info");
        $inwave_of_options[] = array("name" => esc_html__("Post Category Title", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the post category title in each post.", 'mdmedical'),
            "id" => "blog_category_title_listing",
            "std" => 1,
            "type" => "checkbox");
		$inwave_of_options[] = array("name" => esc_html__("Show Post Tags", 'mdmedical'),
            "desc" => esc_html__("Check the box to display blog post tags.", 'mdmedical'),
            "id" => "show_post_tag",
            "std" => 1,
            "type" => "checkbox");
		$inwave_of_options[] = array("name" => esc_html__("Show Post Date", 'mdmedical'),
            "desc" => esc_html__("Check the box to display blog post date.", 'mdmedical'),
            "id" => "show_post_date",
            "std" => 1,
            "type" => "checkbox");
		$inwave_of_options[] = array("name" => esc_html__("Show Post Author", 'mdmedical'),
            "desc" => esc_html__("Check the box to display blog post author.", 'mdmedical'),
            "id" => "show_post_author",
            "std" => 1,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Show Post Comment", 'mdmedical'),
            "desc" => esc_html__("Check the box to display blog post comment.", 'mdmedical'),
            "id" => "show_post_comment",
            "std" => 1,
            "type" => "checkbox");
        $inwave_of_options[] = array(
			"name" => esc_html__("Social Sharing Box", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the social sharing box in blog listing", 'mdmedical'),
            "id" => "social_sharing_box_category",
            "std" => 0,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Blog Single Post", 'mdmedical'),
            "desc" => "",
            "id" => "blog_single_post",
            "std" => "<h3>".esc_html__("Blog Single Post", 'mdmedical')."</h3>",
            "icon" => true,
            "position" => "start",
            "type" => "accordion");

        $inwave_of_options[] = array("name" => esc_html__("Featured Image on Single Post Page", 'mdmedical'),
            "desc" => esc_html__("Check the box to display featured images on single post pages.", 'mdmedical'),
            "id" => "featured_images_single",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Post Title", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the post title that goes below the featured images.", 'mdmedical'),
            "id" => "blog_post_title",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Post Category Title", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the post category title that goes below the featured images.", 'mdmedical'),
            "id" => "blog_category_title",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Show Author Info", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the author info in the post.", 'mdmedical'),
            "id" => "author_info",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Related Posts", 'mdmedical'),
            "desc" => esc_html__("Check the box to display related posts.", 'mdmedical'),
            "id" => "related_posts",
            "std" => 1,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Social Sharing Box", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the social sharing box.", 'mdmedical'),
            "id" => "social_sharing_box",
            "std" => 1,
            "type" => "checkbox");
        $inwave_of_options[] = array("name" => esc_html__("Entry footer", 'mdmedical'),
            "desc" => esc_html__("Check the box to display the tags and edit link (admin only).", 'mdmedical'),
            "id" => "entry_footer",
            "std" => 0,
            "type" => "checkbox");
        $inwave_of_options[] = array(
            "position" => "end",
            "type" => "accordion");

        //SOCIAL MEDIA
        $inwave_of_options[] = array("name" => esc_html__("Social Media", 'mdmedical'),
            "type" => "heading"
        );
        $inwave_of_options[] = array("name" => esc_html__("Social Sharing", 'mdmedical'),
            "desc" => "",
            "id" => "social_sharing",
            "std" => "<h3>".esc_html__("Social Sharing", 'mdmedical')."</h3>",
            "type" => "info");
        $inwave_of_options[] = array("name" => esc_html__("Facebook", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the facebook sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_facebook",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Twitter", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the twitter sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_twitter",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("LinkedIn", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the linkedin sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_linkedin",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Google Plus", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the g+ sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_google",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Tumblr", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the tumblr sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_tumblr",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Pinterest", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the pinterest sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_pinterest",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array("name" => esc_html__("Email", 'mdmedical'),
            "desc" => esc_html__("Check the box to show the email sharing icon in blog, woocommerce and portfolio detail page.", 'mdmedical'),
            "id" => "sharing_email",
            "std" => 1,
            "type" => "checkbox");

        $inwave_of_options[] = array(
            "name" => esc_html__("Social Link Configs", 'mdmedical'),
            "desc" => "",
            "id" => "social_link_configs",
            "std" => '<h3>'.esc_html__("Social Link Configs", 'mdmedical').'</h3>',
            "type" => "info",
        );
        $inwave_of_options[] = array("name" => esc_html__("Social links", 'mdmedical'),
            "desc" => wp_kses(__("Add new social links. Awesome icon You can get at <a target='_blank' href='https://fortawesome.github.io/Font-Awesome/'>here</a>", 'mdmedical'), inwave_allow_tags('a')),
            "id" => "social_links",
            "std" => "",
            "type" => "social_link"
        );

        // IMPORT EXPORT
        // $inwave_of_options[] = array("name" => esc_html__("Import Demo", 'mdmedical'),
            // "type" => "heading"
        // );
        // $inwave_of_options[] = array("name" => esc_html__("Import Demo Content", 'mdmedical'),
            // "desc" => wp_kses(__("We recommend you to <a href='https://wordpress.org/plugins/wordpress-reset/' target='_blank'>reset data</a>  & clean wp-content/uploads before import to prevent duplicate content!", 'mdmedical'), inwave_allow_tags('a')),
            // "id" => "demo_data",
            // "std" => admin_url('themes.php?page=optionsframework') . "&import_data_content=true",
            // "btntext" => esc_html__('Import Demo Content', 'mdmedical'),
            // "type" => "import_button");

        // BACKUP OPTIONS
        // $inwave_of_options[] = array("name" => esc_html__("Backup Options", 'mdmedical'),
            // "type" => "heading"
        // );
        // $inwave_of_options[] = array("name" => esc_html__("Backup and Restore Options", 'mdmedical'),
            // "id" => "of_backup",
            // "std" => "",
            // "type" => "backup",
            // "desc" => esc_html__('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'mdmedical'),
        // );

        // $inwave_of_options[] = array("name" => esc_html__("Transfer Theme Options Data", 'mdmedical'),
            // "id" => "of_transfer",
            // "std" => "",
            // "type" => "transfer",
            // "desc" => esc_html__('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'mdmedical'),
        // );

    }//End function: inwave_of_options()
}//End chack if function exists: inwave_of_options()
?>
