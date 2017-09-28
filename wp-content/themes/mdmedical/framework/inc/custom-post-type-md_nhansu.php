<?php
function create_post_type_nhansu(){
	$labels = array(
		'name' => __('Đội Ngũ Nhân Sự', 'inwavethemes'),
		'singular_name' => __('Đội Ngũ Nhân Sự', 'inwavethemes'),
		'add_new' => __('Add New', 'inwavethemes'),
		'add_new_item' => __('Add New', 'inwavethemes'),
		'edit' => __('Edit', 'inwavethemes'),
		'edit_item' => __('Edit', 'inwavethemes'),
		'new_item' => __('Add New', 'inwavethemes'),
		'view' => __('View', 'inwavethemes'),
		'view_item' => __('View', 'inwavethemes'),
		'search_items' => __('Search', 'inwavethemes'),
		'not_found' => __('No Post found', 'inwavethemes'),
		'not_found_in_trash' => __('No Post found in Trash', 'inwavethemes')
	);
	$args = array(
		'labels' => $labels,
		'public' 			=> true,
		'hierarchical' 		=> false,
		'has_archive'		=> true,
		'supports' 			=> array('title', 'editor', 'thumbnail'),
		'can_export'	 	=> true,
		'rewrite' 			=> array('slug' => 'nhansu', 'with_front' => true),
		'query_var' 		=> false,
		'show_in_nav_menus' => true,
		'taxonomies' => array('')
	); 
		
	register_post_type('nhansu', $args);
}
add_action('init', 'create_post_type_nhansu');


  /*------------------------------------*/

add_action( 'admin_init', 'my_admin' );
function my_admin() {
    add_meta_box( 'nhansu_position_meta_box',
        'Vị trí nhân sự',
        'display_nhansu_position_meta_box',
        'nhansu', 'normal', 'high'
    );
}
  
function display_nhansu_position_meta_box($nhansu) {
	// var_dump($nhansu);
    $nhansu_position = esc_html( get_post_meta( $nhansu->ID, 'nhansu_position', true ) );
    ?>
    <table>
        <tr>
            <td style="padding-right:15px;">Vị trí nhân sự</td>
            <td><input style="min-width:250px;" type="text" name="txt_nhansu_position" value="<?php echo $nhansu_position; ?>" /></td>
        </tr>
    </table>
    <?php
}
  
add_action( 'save_post', 'add_nhansu_fields', 10, 2 );
function add_nhansu_fields($post_id) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['txt_nhansu_position'] ) && $_POST['txt_nhansu_position'] != '' ) {
            update_post_meta( $post_id, 'nhansu_position', $_POST['txt_nhansu_position'] );
        }

}


?>
