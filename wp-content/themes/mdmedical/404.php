<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package inevent
 */
get_header(); ?>
<div class="page-content">
    <div class="container">
        <div class="error-404 not-found">
            <p><?php esc_html_e('It looks like nothing was found at this destination. Maybe try one of the links below or a search?', 'mdmedical'); ?></p>
            <?php get_search_form(); ?>
        </div>
        <!-- .error-404 -->
    </div>
</div><!-- .page-content -->
<?php get_footer(); ?>
