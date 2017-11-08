<?php
	$labels = array(
		'name' => __('Giải Pháp', 'inwavethemes'),
		'singular_name' => __('Nâng Cấp Làn Da', 'inwavethemes'),
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
		'has_archive'		=> true,
		'supports' 			=> array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
		'can_export'	 	=> true,
		'rewrite' 			=> array('slug' => 'giaiphap', 'with_front' => true),
		'query_var' 		=> false,
		'show_in_nav_menus' => true,
		'taxonomies' => array('')
	); 
		
	register_post_type('giaiphap', $args);
  
	/*------------------------------------*/
	register_taxonomy(
		'giaiphap_category',
		'giaiphap',
		array(
			'hierarchical' => true,
			'label' => 'Danh mục giải pháp',
			'query_var' => true,
			'show_admin_column' => true,
			'rewrite' => array(
				'slug' => 'giaiphaps',
				'with_front' => false
			)
		)
	);

	$labels_tag = array(
		'name' => _x( 'All tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' => __( 'Search Tags' ),
		'popular_items' => __( 'Popular Tags' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove tags' ),
		'choose_from_most_used' => __( 'Choose from the most used tags' ),
		'menu_name' => __( 'Tags' ),
	);
 
	register_taxonomy('giaiphap_tag','giaiphap',array( // post type name here
		'hierarchical' => false,
		'labels' => $labels_tag,
		'show_ui' => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'giaiphap_tag', 'with_front' => true),
	));
  
  
  
  
  
  
  
  
  
  

?>
