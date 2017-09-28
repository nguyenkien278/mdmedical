<?php
/**
 * intravel functions and definitions
 *
 * @package intravel
 */

 /* Theme option famework */
require_once get_template_directory().'/framework/customize/custom_field_woocomerce.php';
 
/* Theme option famework */
require_once get_template_directory().'/framework/theme-option.php';

require_once get_template_directory() . '/framework/option-framework/inof.php';

/* Require helper function */
require_once get_template_directory() . '/framework/inc/helper.php';

/* Require importer function */
// require_once get_template_directory() . '/framework/importer/importer.php';

/* Custom nav */

require_once get_template_directory().'/framework/customize/fb.desc.php';
require_once get_template_directory().'/framework/customize/editor-term-description.php';
require_once get_template_directory().'/framework/customize/custom-editor.php';
require_once get_template_directory().'/framework/inc/custom-nav.php';

/* Customizer theme */
require_once get_template_directory() . '/framework/inc/customizer.php';
require_once get_template_directory() . '/framework/inc/custom-post-type-jm_skin.php';
require_once get_template_directory() . '/framework/inc/custom-post-type-md_nentang.php';
require_once get_template_directory() . '/framework/inc/custom-post-type-md_nangcap.php';
require_once get_template_directory() . '/framework/inc/custom-post-type-md_giaiphap.php';
require_once get_template_directory() . '/framework/inc/custom-post-type-md_nhansu.php';

/* Template tags */
require_once get_template_directory() . '/framework/inc/template-tags.php';

/* Require Custom functions that act independently of the theme templates */
require_once get_template_directory() . '/framework/inc/extras.php';

/* Require custom widgets */
require_once get_template_directory() . '/framework/widgets/sort.php';
require_once get_template_directory() . '/framework/widgets/contact.php';
require_once get_template_directory() . '/framework/widgets/subscribe.php';
require_once get_template_directory() . '/framework/widgets/recent-comment.php';
require_once get_template_directory() . '/framework/widgets/recent-post.php';
require_once get_template_directory() . '/framework/widgets/recent-post-footer.php';
require_once get_template_directory() . '/framework/widgets/product-slide.php';

/* Implement the woocommerce template. */
require_once get_template_directory() . '/framework/inc/woocommerce.php';

/* TGM plugin activation. */
// require_once get_template_directory() . '/framework/inc/class-tgm-plugin-activation.php';

//framework
// require_once get_template_directory().'/framework/theme-plugin-load.php';

require_once get_template_directory().'/framework/theme-function.php';

require_once get_template_directory().'/framework/theme-register.php';

require_once get_template_directory().'/framework/theme-support.php';

require_once get_template_directory().'/framework/theme-style-script.php';

require_once get_template_directory() . '/framework/theme-metabox.php';

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );