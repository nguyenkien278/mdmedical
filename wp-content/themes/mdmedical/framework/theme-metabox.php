<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category ARIVA
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'inwave_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function inwave_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'inwave_';

    $sideBars = array();
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $sideBars[$sidebar['id']] = ucwords( $sidebar['name'] );
    }

    $menuArr = array();
    $menuArr[''] = 'Default';
    $menus = get_terms('nav_menu');
    foreach ( $menus as $menu ) {
        $menuArr[$menu->slug] = $menu->name;
    }

    /**
     * Metabox to be displayed on a single page ID
     */

    $meta_boxes['page_metas'] = array(
        'id'         => 'page_metas',
        'title'      => esc_html__( 'Page Options', 'mdmedical' ),
        'pages'      => array( 'page' ), // Post type
        'context'    => 'side',
        'priority'   => 'low',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'    => esc_html__('Main Color', 'mdmedical'),
                'id'      => $prefix . 'main_color',
                'type'    => 'colorpicker',
                'default' => '',
            ),
            array(
                'name'    => esc_html__('Background Color Page', 'mdmedical'),
                'id'      => $prefix . 'background_color_page',
                'type'    => 'colorpicker',
                'default' => '',
            ),
            // array(
                // 'name'    => esc_html__('Select Revolution Slider', 'mdmedical'),
                // 'id'      => $prefix . 'slider',
                // 'type'    => 'select',
                // 'options' => Inwave_Helper::getRevoSlider(),
                // 'default' => '',
            // ),
            // array(
                // 'name'    => esc_html__( 'Show preload', 'mdmedical' ),
                // 'id'      => $prefix . 'show_preload',
                // 'type'    => 'select',
                // 'options' => array(
                    // '' => esc_html__( 'Default', 'mdmedical' ),
                    // 'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    // 'no'     => esc_html__( 'No', 'mdmedical' ),
                // ),
            // ),
            array(
                'name' => esc_html__( 'Extra class', 'mdmedical' ),
                'desc' => esc_html__( 'Add extra class for page content', 'mdmedical' ),
                'default' => '',
                'id' => $prefix . 'page_class',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Header Options', 'mdmedical' ),
                'id'   => $prefix . 'header_options_title',
                'type' => 'title',
            ),
            // array(
                // 'name'    => esc_html__( 'Header style', 'mdmedical' ),
                // 'id'      => $prefix . 'header_option',
                // 'type'    => 'select',
                // 'options' => array(
					// '' => esc_html__( 'Default', 'mdmedical' ),
					// 'none'   => esc_html__( 'None', 'mdmedical' ),
					// 'default'   => esc_html__( 'Header Style 1', 'mdmedical' ),
					// 'v2'     => esc_html__( 'Header Style 2', 'mdmedical' ),
					// 'v3'     => esc_html__( 'Header Style 3', 'mdmedical' ),
					// 'v4'     => esc_html__( 'Header Style 4', 'mdmedical' ),
                // ),
            // ),
            array(
                'name'    => esc_html__( 'Sticky Header', 'mdmedical' ),
                'id'      => $prefix . 'header_sticky',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            // array(
                // 'name'    => esc_html__( 'Button Search Form in Header', 'mdmedical' ),
                // 'id'      => $prefix . 'show_search_form',
                // 'type'    => 'select',
                // 'options' => array(
                        // '' => esc_html__( 'Default', 'mdmedical' ),
                        // 'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                        // 'no'     => esc_html__( 'No', 'mdmedical' ),
                // ),
            // ),
            // array(
                // 'name' => esc_html__( 'Change logo', 'mdmedical' ),
                // 'id'   => $prefix . 'logo',
                // 'type' => 'file',
            // ),
            // array(
                // 'name' => esc_html__( 'Change logo sticky', 'mdmedical' ),
                // 'id'   => $prefix . 'logo_sticky',
                // 'type' => 'file',
            // ),
            array(
                'name' => esc_html__( 'Page Heading Options', 'mdmedical' ),
                'id'   => $prefix . 'page_heading_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Show page heading', 'mdmedical' ),
                'id'      => $prefix . 'show_pageheading',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                "name" => esc_html__("Tagline", 'mdmedical'),
                "desc" => esc_html__("Tagline for page heading", 'mdmedical'),
                "id" => $prefix . "tagline",
                "type" => "text"),
            array(
                'name' => esc_html__( 'Page heading background', 'mdmedical' ),
                'id'   => $prefix . 'pageheading_bg',
                'type' => 'file',
            ),
            array(
                'name'    => esc_html__( 'Show page breadcrumb', 'mdmedical' ),
                'id'      => $prefix . 'breadcrumbs',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                'name' => esc_html__( 'Sidebar Options', 'mdmedical' ),
                'id'   => $prefix . 'sidebar_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Sidebar Position', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'none'   => esc_html__( 'Without Sidebar', 'mdmedical' ),
                    'right'     => esc_html__( 'Right', 'mdmedical' ),
                    'left'     => esc_html__( 'Left', 'mdmedical' ),
                    'bottom'     => esc_html__( 'Bottom', 'mdmedical' ),
                ),
            ),
            array(
                'name'    => esc_html__( 'Sidebar', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_name',
                'type'    => 'select',
                'options' => $sideBars,
            ),
            array(
                'name'    => esc_html__( 'Primary Menu', 'mdmedical' ),
                'id'      => $prefix . 'primary_menu',
                'type'    => 'select',
                'options' => $menuArr,
            ),
            // array(
                // 'name' => esc_html__( 'Footer Options', 'mdmedical' ),
                // 'id'   => $prefix . 'footer_options_title',
                // 'type' => 'title',
            // ),
            // array(
                // 'name'    => esc_html__( 'Footer style', 'mdmedical' ),
                // 'id'      => $prefix . 'footer_option',
                // 'type'    => 'select',
                // 'options' => array(
                // ''        => esc_html__( 'Default', 'mdmedical' ),
                // 'default' => esc_html__( 'Footer version 1', 'mdmedical' ),
                // ),
            // ),
            // array(
                // 'name' => esc_html__( 'Change background footer', 'mdmedical' ),
                // 'id'   => $prefix . 'footer-background',
                // 'type' => 'file',
            // ),
        )
    );

    $meta_boxes['post_metas'] = array(
        'id'         => 'post_metas',
        'title'      => esc_html__( 'Post Options', 'mdmedical' ),
        'pages'      => array( 'post'), // Post type
        'context'    => 'side',
        'priority'   => 'low',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => esc_html__( 'Extra class', 'mdmedical' ),
                'desc' => esc_html__( 'Add extra class for page content', 'mdmedical' ),
                'default' => '',
                'id' => $prefix . 'page_class',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Heading Options', 'mdmedical' ),
                'id'   => $prefix . 'page_heading_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Show page heading', 'mdmedical' ),
                'id'      => $prefix . 'show_pageheading',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                "name" => esc_html__("Tagline", 'mdmedical'),
                "desc" => esc_html__("Tagline for page heading", 'mdmedical'),
                "id" => $prefix . "tagline",
                "type" => "text"),
            array(
                'name' => esc_html__( 'Page heading background', 'mdmedical' ),
                'id'   => $prefix . 'pageheading_bg',
                'type' => 'file',
            ),
            array(
                'name'    => esc_html__( 'Show page breadcrumb', 'mdmedical' ),
                'id'      => $prefix . 'breadcrumbs',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                'name' => esc_html__( 'Sidebar Options', 'mdmedical' ),
                'id'   => $prefix . 'sidebar_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Sidebar Position', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'none'   => esc_html__( 'Without Sidebar', 'mdmedical' ),
                    'right'     => esc_html__( 'Right', 'mdmedical' ),
                    'left'     => esc_html__( 'Left', 'mdmedical' ),
                    'bottom'     => esc_html__( 'Bottom', 'mdmedical' ),
                ),
            ),
            array(
                'name'    => esc_html__( 'Sidebar', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_name',
                'type'    => 'select',
                'options' => $sideBars,
                'default' => 'sidebar-default'
            ),
        )
    );

    $meta_boxes['product_metas'] = array(
        'id'         => 'product_metas',
        'title'      => esc_html__( 'Product Options', 'mdmedical' ),
        'pages'      => array( 'product', 'lan_da', 'giaiphap'), // Post type
        'context'    => 'side',
        'priority'   => 'low',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => esc_html__( 'Extra class', 'mdmedical' ),
                'desc' => esc_html__( 'Add extra class for page content', 'mdmedical' ),
                'default' => '',
                'id' => $prefix . 'page_class',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Heading Options', 'mdmedical' ),
                'id'   => $prefix . 'page_heading_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Show page heading', 'mdmedical' ),
                'id'      => $prefix . 'show_pageheading',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                "name" => esc_html__("Tagline", 'mdmedical'),
                "desc" => esc_html__("Tagline for page heading", 'mdmedical'),
                "id" => $prefix . "tagline",
                "type" => "text"),
            array(
                'name' => esc_html__( 'Page heading background', 'mdmedical' ),
                'id'   => $prefix . 'pageheading_bg',
                'type' => 'file',
            ),
            array(
                'name'    => esc_html__( 'Show page breadcrumb', 'mdmedical' ),
                'id'      => $prefix . 'breadcrumbs',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    'no'     => esc_html__( 'No', 'mdmedical' ),
                ),
            ),
            array(
                'name' => esc_html__( 'Sidebar Options', 'mdmedical' ),
                'id'   => $prefix . 'sidebar_options_title',
                'type' => 'title',
            ),
            array(
                'name'    => esc_html__( 'Sidebar Position', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    '' => esc_html__( 'Default', 'mdmedical' ),
                    'none'   => esc_html__( 'Without Sidebar', 'mdmedical' ),
                    'right'     => esc_html__( 'Right', 'mdmedical' ),
                    'left'     => esc_html__( 'Left', 'mdmedical' ),
                    'bottom'     => esc_html__( 'Bottom', 'mdmedical' ),
                ),
            ),
            array(
                'name'    => esc_html__( 'Sidebar', 'mdmedical' ),
                'id'      => $prefix . 'sidebar_name',
                'type'    => 'select',
                'options' => $sideBars,
                'default' => 'sidebar-woocommerce'
            ),
        )
    );

    // $meta_boxes['tour_metas'] = array(
        // 'id'         => 'tour_metas',
        // 'title'      => esc_html__( 'Post Options', 'mdmedical' ),
        // 'pages'      => array( 'tour' ), // Post type
        // 'context'    => 'side',
        // 'priority'   => 'low',
        // 'show_names' => true, // Show field names on the left
        // 'fields'     => array(
            // array(
                // 'name' => esc_html__( 'Extra class', 'mdmedical' ),
                // 'desc' => esc_html__( 'Add extra class for page content', 'mdmedical' ),
                // 'default' => '',
                // 'id' => $prefix . 'page_class',
                // 'type' => 'text',
            // ),
            // array(
                // 'name'    => esc_html__( 'Show page breadcrumb', 'mdmedical' ),
                // 'id'      => $prefix . 'breadcrumbs',
                // 'type'    => 'select',
                // 'options' => array(
                    // '' => esc_html__( 'Default', 'mdmedical' ),
                    // 'yes'   => esc_html__( 'Yes', 'mdmedical' ),
                    // 'no'     => esc_html__( 'No', 'mdmedical' ),
                // ),
            // ),
            // array(
                // 'name' => esc_html__( 'Sidebar Options', 'mdmedical' ),
                // 'id'   => $prefix . 'sidebar_options_title',
                // 'type' => 'title',
            // ),
            // array(
                // 'name'    => esc_html__( 'Sidebar Position', 'mdmedical' ),
                // 'id'      => $prefix . 'sidebar_position',
                // 'type'    => 'select',
                // 'options' => array(
                    // '' => esc_html__( 'Default', 'mdmedical' ),
                    // 'none'   => esc_html__( 'Without Sidebar', 'mdmedical' ),
                    // 'right'     => esc_html__( 'Right', 'mdmedical' ),
                    // 'left'     => esc_html__( 'Left', 'mdmedical' ),
                    // 'bottom'     => esc_html__( 'Bottom', 'mdmedical' ),
                // ),
            // ),
            // array(
                // 'name'    => esc_html__( 'Sidebar', 'mdmedical' ),
                // 'id'      => $prefix . 'sidebar_name',
                // 'type'    => 'select',
                // 'options' => $sideBars,
                // 'default' => 'sidebar-tours-detail'
            // ),
        // )
    // );

    return $meta_boxes;
}