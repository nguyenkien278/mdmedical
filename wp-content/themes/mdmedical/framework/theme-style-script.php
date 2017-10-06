<?php
/**
 * This file is used to load javascript and stylesheet function
 */
if(!function_exists( 'inwave_fonts_url' )) {
    function inwave_fonts_url()
    {
        $font_families = array();

        $f_body = Inwave_Helper::getPostOption('f_body', 'f_body');
        $f_body_settings = Inwave_Helper::getPostOption('f_body_settings', 'f_body_settings');
        if ($f_body) {
            $font_families[] = $f_body . ':' . $f_body_settings;
        }

        $f_nav = Inwave_Helper::getPostOption('f_nav', 'f_nav');
        $f_nav_settings = Inwave_Helper::getPostOption('f_nav_settings', 'f_nav_settings');
        if ($f_nav) {
            $font_families[] = $f_nav . ':' . $f_nav_settings;
        }

        $f_headings = Inwave_Helper::getPostOption('f_headings', 'f_headings');
        $f_headings_settings = Inwave_Helper::getPostOption('f_headings_settings', 'f_headings_settings');
        if ($f_headings) {
            $font_families[] = $f_headings . ':' . $f_headings_settings;
        }

        $font_families[] = 'Poppins:400,300,500,600,700';
        $font_families[] = 'Lato:400,900italic,900,700,300';
        $font_families[] = 'Montserrat:400,700';
        $font_families[] = 'Merriweather:400,300,300italic,400italic,700,900';
        $font_families[] = 'Playfair+Display:400,400italic,700,700italic,900,900italic';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

        return $fonts_url;
    }
}

/**
 * Enqueue scripts and styles.
 */
if( !function_exists( 'inwave_scripts' ) ) {
    function inwave_scripts()
    {
        global $inwave_theme_option;

        $theme_info = wp_get_theme();
        $template = get_template();

        /* Load css*/
		wp_enqueue_style('jquery.fancybox-css', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.css', array(), $theme_info->get('Version'));
		
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), $theme_info->get('Version'));
        wp_enqueue_style('select2', get_template_directory_uri() . '/assets/css/select2.css', array(), $theme_info->get('Version'));
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome/font-awesome.min.css', array(), $theme_info->get('Version'));
        wp_enqueue_style('font-ionicons', get_template_directory_uri() . '/assets/fonts/ionicons/ionicons.min.css', array(), $theme_info->get('Version'));
        wp_enqueue_style($template.'-fonts', inwave_fonts_url(), array(), $theme_info->get('Version'));
		wp_enqueue_style('jquery.datetimepicker-css', get_template_directory_uri() . '/assets/css/jquery.datetimepicker.min.css', array(), $theme_info->get('Version'));
        wp_register_style('custombox', get_template_directory_uri() . '/assets/css/custombox.min.css', array(), $theme_info->get('Version'));
        wp_enqueue_style('rating', get_template_directory_uri() . '/assets/css/rating.css', array(), $theme_info->get('Version'));
        wp_register_style('barrating-fontawesome-stars', get_template_directory_uri() . '/assets/css/fontawesome-stars.css', array(), $theme_info->get('Version'));
        // wp_register_style('scrollbar', get_template_directory_uri() . '/assets/css/jquery.mCustomScrollbar.min.css', array(), $theme_info->get('Version'));

        // wp_register_style('flex-slider', get_template_directory_uri() . '/assets/css/flexslider.css', array(), $theme_info->get('Version'));

        
        wp_register_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), $theme_info->get('Version'));
        wp_register_style('owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.css', array(), $theme_info->get('Version'));
        wp_register_style('owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css', array(), $theme_info->get('Version'));

        wp_enqueue_style($template.'-woocommece', get_template_directory_uri() . '/assets/css/woocommece.css', array(), $theme_info->get('Version'));

        // Don't load css3 effect in mobile device
        if (!wp_is_mobile()) {
            if (!(isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'])) {
                wp_enqueue_style('animation', get_template_directory_uri() . '/assets/css/animation.css', array(), $theme_info->get('Version'));
            }
        }
        /** Theme style */
        if(is_child_theme()){
            wp_enqueue_style( $template.'-parent-style', get_template_directory_uri(). '/style.css' );
            if(is_rtl()){
                wp_enqueue_style( $template.'-parent-rtl-style', get_template_directory_uri(). '/rtl.css' );
            }
        }
        wp_enqueue_style($template.'-style', get_stylesheet_uri());

        /** custom css */
        wp_enqueue_style($template.'-custom', Inwave_Customizer::getColorFileUrl(), array(), $theme_info->get('Version'));

        /* Load js*/
        if ($inwave_theme_option['fix_woo_jquerycookie']) {
            wp_register_script('jquery-cookie', get_template_directory_uri() . '/assets/js/jquery-cookie-min.js', array('jquery'), $theme_info->get('Version'), true);
        }
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), $theme_info->get('Version'), true);
        wp_register_script('custombox', get_template_directory_uri() . '/assets/js/custombox.min.js', array(), $theme_info->get('Version'), true);
        if(function_exists('is_woocommerce') && is_woocommerce()){
            wp_enqueue_style('custombox');
            wp_enqueue_script('custombox');
        }
		
		wp_enqueue_script('jquery.fancybox-js', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.js', array(), $theme_info->get('Version'));
        wp_enqueue_script('jquery.datetimepicker', get_template_directory_uri() . '/assets/js/jquery.datetimepicker.full.min.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_script('select2', get_template_directory_uri() . '/assets/js/select2.full.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_script('jquery-fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array(), $theme_info->get('Version'), true);
        wp_register_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('owl-theme');
        wp_enqueue_style('owl-transitions');
        wp_enqueue_script('owl-carousel');
		
		wp_enqueue_script('jquery.enscroll.min', get_template_directory_uri() . '/assets/js/jquery.enscroll.min.js', array(), $theme_info->get('Version'), true);
		wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/waypoints.js', array(), $theme_info->get('Version'), true);
        wp_register_script('flex-slider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_script('rating', get_template_directory_uri() . '/assets/js/rating.js', array(), $theme_info->get('Version'), true);
        wp_register_script('barrating', get_template_directory_uri() . '/assets/js/jquery.barrating.min.js', array(), $theme_info->get('Version'), true);
        wp_register_script('isotope.pkgd.min', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), $theme_info->get('Version'), false);
        wp_register_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.js', array(), $theme_info->get('Version'), false);
		wp_register_script('filtering', get_template_directory_uri() . '/assets/js/filtering.js', array(), $theme_info->get('Version'), false);
        wp_register_script('scrollbar', get_template_directory_uri() . '/assets/js/jquery.mCustomScrollbar.concat.min.js', array(), $theme_info->get('Version'), true);
        wp_register_script('jquery-parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_script($template.'-template', get_template_directory_uri() . '/assets/js/template.js', array(), $theme_info->get('Version'), true);
        wp_localize_script($template.'-template', 'inwaveCfg', array('siteUrl' => admin_url(), 'themeUrl' => get_template_directory_uri(), 'baseUrl' => site_url(), 'ajaxUrl' => admin_url('admin-ajax.php')));
        if ($inwave_theme_option['retina_support']) {
            wp_enqueue_script('retina_js', get_template_directory_uri() . '/assets/js/retina.min.js', array(), $theme_info->get('Version'), true);
        }
        wp_enqueue_script('jquery-nav', get_template_directory_uri() . '/assets/js/jquery.nav.js', array(), $theme_info->get('Version'), true);
        $changeHash = (isset($inwave_theme_option['nav-hashtags']) && $inwave_theme_option['nav-hashtags']) ? 1 : 0;
        $scrollOffset = (isset($inwave_theme_option['scroll_offset']) && $inwave_theme_option['scroll_offset']) ? $inwave_theme_option['scroll_offset'] : 0;
        wp_localize_script( $template.'-template', 'inwaveNavSetting', array( 'scrollOffset' => $scrollOffset, 'hashTag' => $changeHash) );

        /** load panel */
        wp_enqueue_script("jquery-effects-core");
        if ($inwave_theme_option['show_setting_panel']) {
            wp_enqueue_script($template.'-panel-settings', get_template_directory_uri() . '/assets/js/panel-settings.js', array(), $theme_info->get('Version'), true);

            if(!function_exists('WP_Filesystem')){
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }

            WP_Filesystem();

            global $wp_filesystem;

            wp_localize_script($template.'-panel-settings', 'inwavePanelSettings' , array(
                'theme' => get_template(),
                'color' => INWAVE_MAIN_COLOR,
                'color_css' => $wp_filesystem->get_contents(get_template_directory() .'/assets/css/color.css'),
                'default_settings' => array(
                    'mainColor' => $inwave_theme_option['primary_color'],
                    'layout' => $inwave_theme_option['body_layout'],
                    'bgColor' => $inwave_theme_option['bg_color'],
                )
            ));
        }

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script('navgoco', get_template_directory_uri() . '/assets/js/jquery.navgoco.js', array(), $theme_info->get('Version'), true);
        wp_enqueue_script('off-canvas', get_template_directory_uri() . '/assets/js/off-canvas.js', array(), $theme_info->get('Version'), true);
    }

    add_action('wp_enqueue_scripts', 'inwave_scripts');
}

/**
 * Admin Enqueue scripts and styles.
 */
if( !function_exists( 'inwave_admin_scripts' ) ) {
    function inwave_admin_scripts()
    {
        $theme_info = wp_get_theme();

        /*Load css*/
        wp_enqueue_style('lightbook-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), $theme_info->get('Version'));

        /*Load js*/
		/*Load js*/
        wp_enqueue_media();
        wp_enqueue_script('custom-templage-admin', get_template_directory_uri() . '/assets/js/admin-template.js', array(), $theme_info->get('Version'), true);
    }

    add_action('admin_enqueue_scripts', 'inwave_admin_scripts');
}

/**
 * Load theme custom css
 */
if(!function_exists('inwave_custom_css')){

    /*
     * get css custom
    */
    function inwave_custom_css()
    {

        global $inwave_theme_option;

        $css = array();

        $f_body = Inwave_Helper::getPostOption('f_body', 'f_body');
        if($f_body){
           $css[] = 'html body{font-family:'.$f_body.'}';
        }

        $f_nav = Inwave_Helper::getPostOption('f_nav', 'f_nav');
        if($f_nav){
           $css[] = '.iw-nav-menu{font-family:'.$f_nav.'}';
        }

        $f_headings = Inwave_Helper::getPostOption('f_headings', 'f_headings');
        if($f_headings){
           $css[] = 'h1,h2,h3,h4,h5,h6{font-family:'.$f_headings.'}';
        }

        $f_size = Inwave_Helper::getPostOption('f_size', 'f_size');
        if($f_size){
           $css[] = 'html body{font-size:'.$f_size.'}';
        }

        $f_lineheight = Inwave_Helper::getPostOption('f_lineheight', 'f_lineheight');
        if($f_lineheight){
           $css[] = 'html body{line-height:'.$f_lineheight.'}';
        }

        //body background
        if($inwave_theme_option['body_layout']) {
            if ($inwave_theme_option['bg_color']) {
                if ($inwave_theme_option['bg_image']) {
                   $css[] = 'body.page{background-color:' . $inwave_theme_option['bg_color'] . '}';
                } else {
                   $css[] = 'body.page{background:' . $inwave_theme_option['bg_color'] . '}';
                }
            }

            if ($inwave_theme_option['bg_image']) {
               $css[] = 'body{background-image:url(' . $inwave_theme_option['bg_image'] . ')';
                if ($inwave_theme_option['bg_size']) {
                   $css[] = 'background-size: '.$inwave_theme_option['bg_size'].';';
                }
                if ($inwave_theme_option['bg_repeat']) {
                   $css[] = 'background-repeat:' . $inwave_theme_option['bg_repeat'] . ';';
                }
               $css[] = '}';
            }
        }
        //header bg
        if($inwave_theme_option['header_link_color']){
           $css[] = '.header-default .iw-main-menu .iw-nav-menu li a{color:'.$inwave_theme_option['header_link_color'].'!important}';
        }
        if($inwave_theme_option['header_sub_link_color']){
           $css[] = '.header .iw-main-menu .iw-nav-menu li .sub-menu li a{color:'.$inwave_theme_option['header_link_color'].'!important}';
        }
        if($inwave_theme_option['header_bg_color']){
           $css[] = '.header-default.clone{background-color:'.$inwave_theme_option['header_bg_color'].'!important}';
        }

        if($inwave_theme_option['header_bd_color']){
           $css[] = '.header .iw-main-menu .iw-nav-menu li .sub-menu li{border-color:'.$inwave_theme_option['header_bd_color'].'!important}';
        }

        //content bg
        $bg_color_page = Inwave_Helper::getPostOption('background_color_page', 'content_bg_color');
        if($bg_color_page){
            $css[] = 'body .wrapper{background-color:'.$bg_color_page.'!important}';
        }
        
        //footer bg
        if($inwave_theme_option['footer_bg_color']){
           $css[] = '.iw-footer.iw-footer-default {background:'.$inwave_theme_option['footer_bg_color'].'!important}';
        }

        if($inwave_theme_option['footer_border_color']){
           $css[] = '.iw-footer-default .footer-widget-contact p, .iw-footer.iw-footer-default .widget li, .iw-footer.iw-footer-default{border-color:'.$inwave_theme_option['footer_border_color'].'!important}';
        }

        //body color
        if($inwave_theme_option['body_text_color']){
           $css[] = 'html body{color:'.$inwave_theme_option['body_text_color'].'}';
        }
        if($inwave_theme_option['link_color']){
           $css[] = 'a{color:'.$inwave_theme_option['link_color'].'}';
        }

        if($inwave_theme_option['page_title_color']){
           $css[] = 'body .page-title, body .page-title h1{color:'.$inwave_theme_option['page_title_color'].'}';
        }
        if($inwave_theme_option['page_title_bg_color']){
           $css[] = 'body .page-title{background-color:'.$inwave_theme_option['page_title_bg_color'].'}';
        }
        if($inwave_theme_option['breadcrumbs_bd_color']){
          $css[] = '.breadcrumbs{border-color:'.$inwave_theme_option['breadcrumbs_bd_color'].' !important}';
        }
        if($inwave_theme_option['breadcrumbs_bg_color']){
          $css[] = '.breadcrumbs{background-color:'.$inwave_theme_option['breadcrumbs_bg_color'].' !important}';
        }
        if($inwave_theme_option['breadcrumbs_text_color']){
          $css[] = '.breadcrumbs{color:'.$inwave_theme_option['breadcrumbs_text_color'].' !important}';
        }
        if($inwave_theme_option['breadcrumbs_link_color']){
           $css[] = '.breadcrumbs ul li a{color:'.$inwave_theme_option['breadcrumbs_link_color'].' !important}';
        }
        if($inwave_theme_option['blockquote_color']){
           $css[] = '.contents-main blockquote{color:'.$inwave_theme_option['blockquote_color'].'}';
        }
        if($inwave_theme_option['footer_headings_color']){
           $css[] = '.iw-footer-default .widget .widget-title{color:'.$inwave_theme_option['footer_headings_color'].' !important}';
        }
        if($inwave_theme_option['footer_text_color']){
           $css[] = '.iw-footer-default{color:'.$inwave_theme_option['footer_text_color'].'}';
        }
        if($inwave_theme_option['footer_link_color']){
           $css[] = '.iw-footer.iw-footer-default a, .iw-footer.iw-footer-default .widget li a{color:'.$inwave_theme_option['footer_link_color'].'}';
        }

        if($inwave_theme_option['page_title_height']){
           $css[] ='.page-heading .container-inner{height:'.$inwave_theme_option['page_title_height'].'}';
        }

        $bg_page_heading = Inwave_Helper::getPostOption('pageheading_bg', 'page_title_bg');
        if($bg_page_heading){
           $css[] = '.page-heading .container-inner{background-image:url('.$bg_page_heading.')!important;';
            if($inwave_theme_option['page_title_bg_size']){
                $css[] = 'background-size: '.$inwave_theme_option['page_title_bg_size'].';';
            }
            if($inwave_theme_option['page_title_bg_repeat']){
                $css[] = 'background-repeat:'.$inwave_theme_option['page_title_bg_repeat'].';';
            }
			if($inwave_theme_option['page_title_bg_position']){
                $css[] = 'background-position:'.$inwave_theme_option['page_title_bg_position'].';';
            }
           $css[] = '}';
        }
        $show_page_heading = Inwave_Helper::getPostOption('show_pageheading', 'show_page_heading');
        if(!is_page_template( 'page-templates/home-page.php' ) && (!$show_page_heading || $show_page_heading == 'no') && $bg_page_heading){
            $css[] = '.header{background-image:url('.$bg_page_heading.')!important;';
            if($inwave_theme_option['page_title_bg_size']){
                $css[] = 'background-size: '.$inwave_theme_option['page_title_bg_size'].';';
            }
            if($inwave_theme_option['page_title_bg_repeat']){
                $css[] = 'background-repeat:'.$inwave_theme_option['page_title_bg_repeat'].';';
            }
            $css[] = '}';
            $css[] = '.absolute-header{position: static};';
        }

        //footer widget
        $footer_bg_image = Inwave_Helper::getPostOption('footer-background', 'footer_bg_image');
        if($footer_bg_image){

           $css[] = '.iw-footer-default, .iw-footer-v2, .iw-footer-v3 .footer-content,  .iw-footer-v4 .copy-right{background-image:url('.$footer_bg_image.')!important;';
            if($inwave_theme_option['footer_bg_size']){
                $css[] = 'background-size: '.$inwave_theme_option['footer_bg_size'].';';
            }
            if($inwave_theme_option['footer_bg_repeat']){
                $css[] = 'background-repeat:'.$inwave_theme_option['page_title_bg_repeat'].';';
            }
           $css[] = '}';
        }

        //copy right
        if($inwave_theme_option['copyright_bg_color']){
            $css[] = 'body .copy-right{background-color:'.$inwave_theme_option['copyright_bg_color'].'}';
        }
        if($inwave_theme_option['copyright_text_color']){
            $css[] = 'body .copy-right{color:'.$inwave_theme_option['copyright_text_color'].'}';
        }
        if($inwave_theme_option['copyright_link_color']){
            $css[] = '.copy-right{color:'.$inwave_theme_option['copyright_link_color'].' !important}';
        }


        // Background for Body page
        $bgColor = Inwave_Helper::getPanelSetting('bgColor');
        if ($bgColor) {
            if (strpos($bgColor, '#') === 0) {
                $css[] = 'body.page{background:' . $bgColor . '}'."\n";
            } else {
                $css[] = 'body.page{background:url(' . $bgColor . ')}'."\n";
            }
        }

        $template = get_template();
        wp_add_inline_style( $template.'-style', implode('', $css) );
    }

    add_action('wp_enqueue_scripts', 'inwave_custom_css');
}