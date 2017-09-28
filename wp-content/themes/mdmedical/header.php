<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php esc_attr(bloginfo('charset')); ?>">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>
<body id="page-top" <?php body_class(); ?>>
<?php
$show_preload = Inwave_Helper::getPostOption('show_preload' , 'show_preload');
if($show_preload && $show_preload != 'no'){
    echo '<div class="se-pre-con"></div>';
}
?>
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
        if(!is_page_template( 'page-templates/home-page.php' )){
            get_template_part('blocks/page', 'heading');
        }
    ?>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
