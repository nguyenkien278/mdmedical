<?php
function create_post_type_nentang(){
	$labels = array(
		'name' => __('Nền Tảng Khoa Học', 'inwavethemes'),
		'singular_name' => __('Nền Tảng Khoa Học', 'inwavethemes'),
		'add_new' => __('Add New Post', 'inwavethemes'),
		'add_new_item' => __('Add New Post', 'inwavethemes'),
		'edit' => __('Edit', 'inwavethemes'),
		'edit_item' => __('Edit Post', 'inwavethemes'),
		'new_item' => __('New Post', 'inwavethemes'),
		'view' => __('View Post', 'inwavethemes'),
		'view_item' => __('View Post', 'inwavethemes'),
		'search_items' => __('Search Post', 'inwavethemes'),
		'not_found' => __('No Post found', 'inwavethemes'),
		'not_found_in_trash' => __('No Post found in Trash', 'inwavethemes')
	);
	$args = array(
		'labels' => $labels,
		'public' 			=> true,
		'hierarchical' 		=> false,
		'has_archive'		=> false,
		'supports' 			=> array('title', 'editor'),
		'can_export'	 	=> true,
		'rewrite' 			=> array('slug' => ''),
		'query_var' 		=> false,
		'show_in_nav_menus' => true,
		'taxonomies' => array('')
	); 
		
	register_post_type('nentang', $args);

}
add_action('init', 'create_post_type_nentang');

?>
