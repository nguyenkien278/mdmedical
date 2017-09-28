<?php
/**
 * The Template for displaying products in a product category.
 *
 * @author        InwaveThemes
 * @package    InwaveThemes/Inhost
 * @version     1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<div class="product-list">

    <?php do_action('woocommerce_archive_description'); ?>

    <?php if (have_posts()) : ?>
	<div class="toolbar">
            <?php do_action('woocommerce_before_shop_loop'); ?>

		
        <div class="clearfix"></div>
        </div>
       
        <div class="row clearfix">
            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>
            <?php
            //$i = 0;
            while (have_posts()) : the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 product-row-item">
                    <?php wc_get_template_part('content', 'product'); ?>
                    </div>
            <?php endwhile; // end of the loop. ?>
        <?php woocommerce_product_loop_end(); ?>
        </div>
        <?php do_action('woocommerce_after_shop_loop'); ?>

    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

        <?php wc_get_template('loop/no-products-found.php'); ?>

    <?php endif; ?>
</div>