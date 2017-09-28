<?php

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_type_lan_da(){
  //register custom post
	$labels = array(
		'name' => __('Làn Da', 'inwavethemes'),
		'singular_name' => __('Làn Da Post', 'inwavethemes'),
		'add_new' => __('Add New Post', 'inwavethemes'),
		'add_new_item' => __('Add New Làn Da Post', 'inwavethemes'),
		'edit' => __('Edit', 'inwavethemes'),
		'edit_item' => __('Edit Làn Da Post', 'inwavethemes'),
		'new_item' => __('New Post', 'inwavethemes'),
		'view' => __('View Làn Da Post', 'inwavethemes'),
		'view_item' => __('View Làn Da Post', 'inwavethemes'),
		'search_items' => __('Search Làn Da Post', 'inwavethemes'),
		'not_found' => __('No Làn Da Post found', 'inwavethemes'),
		'not_found_in_trash' => __('No Làn Da Post found in Trash', 'inwavethemes')
	);
	$args = array(
		'labels' => $labels,
		'public' 			=> true,
		'hierarchical' 		=> false,
		'has_archive'		=> true,
		'supports' 			=> array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
		'can_export'	 	=> true,
		'rewrite' 			=> array('slug' => 'landa', 'with_front' => true),
		'query_var' 		=> false,
		'show_in_nav_menus' => true,
		'taxonomies' => array('lan_da_categories')
	); 
	register_post_type('lan_da', $args);

  //register landa category
	register_taxonomy(
		'lan_da_categories',
		'lan_da',
		array(
			'hierarchical' => true,
			'label' => 'Danh mục',
			'query_var' => true,
			'show_admin_column' => true,
			'rewrite' => array(
				'slug' => 'landa_category',
				'with_front' => false
			)
		)
	);
	$labels_tag = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
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
	
	/*-- register landa tag --*/
	register_taxonomy('landa_tag','lan_da',array( // post type name here
		'hierarchical' => false,
		'labels' => $labels_tag,
		'show_ui' => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'landa_tag' ),
	));
}


add_action('init', 'create_post_type_lan_da');




?>
