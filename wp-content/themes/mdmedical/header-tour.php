<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package inevent
 */

$inwave_theme_option = Inwave_Helper::getConfig();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php esc_attr(bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>
<body id="page-top" <?php body_class(); ?>>
<?php
get_template_part('blocks/canvas', 'menu');

?>

<div class="wrapper st-body">
    <?php
    $header_layout = Inwave_Helper::getPostOption('header_option' , 'header_layout');
    if(!$header_layout){
        $header_layout = 'default';
    }

    if($header_layout != 'none'){
        get_template_part('headers/header', $header_layout);
    }
    ?>
    <?php
    if(function_exists('putRevSlider')){
        $slider = Inwave_Helper::getPostOption('slider');
        if($slider){
            ?>
            <div class="slide-container <?php echo esc_attr($slider)?>">
                <?php putRevSlider($slider); ?>
            </div>
            <?php
        }
    }
    ?>