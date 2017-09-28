<?php
/**
 * The template for displaying Category pages
 * @package inevent
 */

get_header();

?>
<div class="page-content archive-landa">
    <div class="main-content">
        <div class="container">
            
                <div class="blog-content blog-listing">
                    <?php if ( have_posts() ) : ?>
                        <?php while (have_posts()) : the_post();
                            get_template_part( 'content', get_post_format() );
                        endwhile; // end of the loop. ?>
                        <?php get_template_part( '/blocks/paging'); ?>
                    <?php else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content', 'none' );
                    endif;?>
                </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
