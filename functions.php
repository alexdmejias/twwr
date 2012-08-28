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

function list_categories_func(){
	$page_id= get_the_id();
	$pages = get_pages('parent='.$page_id.'&child_of='.$page_id.'&sort_column=menu_order&title_li=');
	$list='<ul class="categories_list">';
	foreach ($pages as $page) {
		$var = get_post_meta($page->ID,'aka');
		$number_of_comments = get_comments_number($page->ID);
		$list.= '<ul><li>Situation: ';
		$list.= '<a class="situation" href="';
		$list.= get_permalink($page->ID).'" alt="">';
		if($var[0]!=''){
			$list.= $var[0];
		} else {
			$list.= $page->post_title;
		}
		$list.='</a></li>';
		$list.='<li class="comment_count">Comments: '.$number_of_comments.'</li>';
		$list.= '</li></ul>';
	}
	$list.= '</ul>';
	return $list;
}

function wrong( $atts, $content = null ) {
	return '<div class="wrong">'.$content.'</div>';
}
function right( $atts, $content = null ) {
	return '<div class="right">'.$content.'</div>';
}

function add_button() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ){
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons', 'register_button');
   }
}


function register_button($buttons) {
   array_push($buttons, "wrong");
   array_push($buttons, "right");
   return $buttons;
}


function add_plugin($plugin_array) {
   $plugin_array['wrong'] = get_bloginfo('template_url').'/customcodes.js';
   $plugin_array['right'] = get_bloginfo('template_url').'/customcodes.js';
   return $plugin_array;
}

function register_shortcodes(){
	add_shortcode('list_situations','list_situations_func');
	add_shortcode('list_categories','list_categories_func');
	add_shortcode('wrong','wrong');
	add_shortcode('right','right');
}

add_action('init','register_shortcodes');
add_action('init','add_button');

add_editor_style('style.css');


