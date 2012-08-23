<?php

// HIDE THE ADMIN BAR
function my_function_admin_bar(){
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

function list_situations_func(){
	$pages = get_pages('parent=2&child_of=2&sort_column=menu_order&title_li=');
	$list='<ul class="situations_list">';
	// echo '<ul class="situations_list">';
	foreach ($pages as $page) {
		$var = get_post_meta($page->ID,'aka');
		$list.= '<li><a href="';
		$list.= get_permalink($page->ID).'" alt="">';
		if($var[0]!=''){
			$list.= $var[0];
		} else {
			$list.= $page->post_title;
		}
		$list.= '</a></li>';
	}
	$list.= '</ul>';
	return $list;
}

function register_shortcodes(){
	add_shortcode('list_situations','list_situations_func');
}
add_action('init','register_shortcodes');

?>
