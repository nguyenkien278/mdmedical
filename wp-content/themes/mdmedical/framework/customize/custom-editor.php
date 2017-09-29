<?php 
function ratb_tiny_mce_buttons_rearrange_list(){
	
	return $mce_buttons = array( 
			'formatselect',		// Dropdown list with block formats to apply to selection.
			'bold',				// Applies the bold format to the current selection.
			'italic',			// Applies the italic format to the current selection.
			'underline',		// Applies the underline format to the current selection.
			'bullist',			// Formats the current selection as a bullet list.
			'numlist',			// Formats the current selection as a numbered list.
			'blockquote',		// Applies block quote format to the current block level element.
			'hr',				// Inserts a horizontal rule into the editor.
			'alignleft',		// Left aligns the current block or image.
			'aligncenter',		// Left aligns the current block or image.
			'alignright',		// Right aligns the current block or image.
			'alignjustify',		// Full aligns the current block or image.
			'link',				// Creates/Edits links within the editor.
			'unlink',			// Removes links from the current selection.
			'wp_more',			// Inserts the <!-- more --> tag.
			'spellchecker',		// ???
			'wp_adv',			// Toggles the second toolbar on/off.
			'dfw' 				// Distraction-free mode on/off.
		);
		
}

function ratb_tiny_mce_buttons_2_rearrange_list(){
	
	return $mce_buttons_2 = array( 
			'strikethrough',	// Applies strike though format to the current selection.
			'forecolor',		// Applies foreground/text color to selection.
			'pastetext',		// Toggles plain text pasting mode on/off.
			'removeformat',		// Removes the formatting from the current selection.
			'charmap',			// Inserts custom characters into the editor.
			'outdent',			// Outdents the current list item or block element.
			'indent',			// Indents the current list item or block element.
			'undo',				// Undoes the last operation.
			'redo',				// Redoes the last undoed operation.
			'wp_help'			// Opens the help.
		);
		
}

function ratb_tiny_mce_buttons_rearrange( $buttons_array ){
	
	$mce_buttons = ratb_tiny_mce_buttons_rearrange_list();
	
	//Keep extra buttons by comparing two buttons lines
	$mce_buttons_2 = ratb_tiny_mce_buttons_2_rearrange_list();
	foreach( $buttons_array as $button ){
		if( !in_array( $button, $mce_buttons ) && !in_array( $button, $mce_buttons_2 ) ){
			array_push( $mce_buttons, $button );
		}
	}
	
	return $mce_buttons;
	
}

function ratb_tiny_mce_buttons_2_rearrange( $buttons_array ){	
	
	$mce_buttons_2 = ratb_tiny_mce_buttons_2_rearrange_list();

	//Keep extra buttons by comparing two buttons lines
	$mce_buttons = ratb_tiny_mce_buttons_rearrange_list();
	foreach( $buttons_array as $button ){
		if( !in_array( $button, $mce_buttons_2 ) && !in_array( $button, $mce_buttons ) ){
			array_push( $mce_buttons_2, $button );
		}
	}
	
	return $mce_buttons_2;
	
}

add_filter( 'mce_buttons', 'ratb_tiny_mce_buttons_rearrange', 5 );
add_filter( 'mce_buttons_2', 'ratb_tiny_mce_buttons_2_rearrange', 5 );	








function remove_update_notifications($value){

    if ( isset($value ) && is_object( $value )){
        unset($value->response['watu/watu.php']);
        unset($value->response['js_composer/js_composer.php']);
        unset($value->response['woocommerce-product-tabs/woocommerce-product-tabs.php']);
        unset($value->response['contact-form-7/contact-form-7.php']);
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );










?>















