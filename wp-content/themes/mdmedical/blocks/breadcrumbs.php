<div class="breadcrumbs-wrap">
    <div class="">
<?php
/* === OPTIONS === */
// $text['home']     = esc_html__('Home', 'mdmedical'); // text for the 'Home' link
// $text['category'] = esc_html__('Archive by Category "%s"', 'mdmedical'); // text for a category page
// $text['tax'] 	  = esc_html__('Archive for "%s"', 'mdmedical'); // text for a taxonomy page
// $text['search']   = esc_html__('Search Results for "%s" Query', 'mdmedical'); // text for a search results page
// $text['tag']      = esc_html__('Posts Tagged "%s"', 'mdmedical'); // text for a tag page
// $text['author']   = esc_html__('Articles Posted by %s', 'mdmedical'); // text for an author page
// $text['404']      = esc_html__('Error 404', 'mdmedical'); // text for the 404 page

$text['home']     = esc_html__('Trang chủ', 'mdmedical'); // text for the 'Home' link
$text['category'] = esc_html__('%s', 'mdmedical'); // text for a category page
$text['tax'] 	  = esc_html__('%s', 'mdmedical'); // text for a taxonomy page
$text['search']   = esc_html__('Kết quả tìm kiếm cho "%s" Query', 'mdmedical'); // text for a search results page
$text['tag']      = esc_html__('Tag bài viết "%s"', 'mdmedical'); // text for a tag page
$text['author']   = esc_html__('Bài viết bởi %s', 'mdmedical'); // text for an author page
$text['404']      = esc_html__('Error 404', 'mdmedical'); // text for the 404 page

$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
$delimiter   = ''; // delimiter between crumbs
$before      = '<li class="current">'; // tag before the current crumb
$after       = '</li>'; // tag after the current crumb
/* === END OF OPTIONS === */

global $post;

$homeLink = home_url('/');
$linkBefore = '<li>';
// $linkAfter = '&nbsp;/&nbsp;&nbsp;</li>';
$linkAfter = '</li>';
$linkAttr = '';
$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

if ( is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumbs"><li><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></li></ul>';

} else {

    echo '<ul class="breadcrumbs"><li><a href="' . esc_url($homeLink) . '">' . $text['home'] . '   ' . '</a></li>' . $delimiter;

    if(is_home()){
        echo wp_kses_post($before . get_the_title( get_option('page_for_posts', true) ) . $after);
    }elseif ( is_category() ) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) {
            $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo wp_kses_post($cats);
        }
        echo wp_kses_post($before . sprintf($text['category'], single_cat_title('', false)) . $after);

    } elseif( is_tax() ){
        $thisCat = get_category(get_query_var('cat'), false);
        if (!is_a($thisCat, 'WP_Error') && $thisCat->parent != 0) {
            $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo wp_kses_post($cats);
        }
        echo wp_kses_post($before . sprintf($text['tax'], single_cat_title('', false)) . $after);

    }elseif ( is_search() ) {
        echo wp_kses_post($before . sprintf($text['search'], get_search_query()) . $after);

    } elseif ( is_day() ) {
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
        echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
        echo wp_kses_post($before . get_the_time('d') . $after);

    } elseif ( is_month() ) {
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
        echo wp_kses_post($before . get_the_time('F') . $after);

    } elseif ( is_year() ) {
        echo wp_kses_post($before . get_the_time('Y') . $after);

    } elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
            if(function_exists('is_product') && is_product()){
                printf($link, get_permalink(wc_get_page_id( 'shop' )) . '/', get_the_title(wc_get_page_id( 'shop' )));
            }else{
                if ((get_post_type() != ('nentang') && (get_post_type()!='nangcap') && (get_post_type()!='lan_da') && (get_post_type()!='giaiphap'))) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $homeLink . $slug['slug'] . '/', $post_type->labels->all_items);
				}
            }

            if ($showCurrent == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);
        } else {
            $cat = get_the_category(); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo wp_kses_post($cats);
            if ($showCurrent == 1) echo wp_kses_post($before . get_the_title() . $after);
        }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        if(function_exists('is_shop') && is_shop()){
            echo wp_kses_post($before . get_the_title(wc_get_page_id( 'shop' )) . $after);
        }else{
            $post_type = get_post_type_object(get_post_type());
            echo wp_kses_post($before . $post_type->labels->singular_name . $after);
        }
    } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo wp_kses_post($cats);
        printf($link, get_permalink($parent), $parent->post_title);
        if ($showCurrent == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

    } elseif ( is_page() && !$post->post_parent ) {
        if ($showCurrent == 1) echo wp_kses_post($before . get_the_title() . $after);

    } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo wp_kses_post($breadcrumbs[$i]);
            if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
        }
        if ($showCurrent == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

    } elseif ( is_tag() ) {
        echo wp_kses_post($before . sprintf($text['tag'], single_tag_title('', false)) . $after);

    } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        echo wp_kses_post($before . sprintf($text['author'], $userdata->display_name) . $after);

    } elseif ( is_404() ) {
        echo wp_kses_post($before . $text['404'] . $after);
    }

    if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo '<li>' . esc_html__('Page', 'mdmedical') . ' ' . get_query_var('paged') . '</li>';
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul>';
}
?>
    </div>
</div>
