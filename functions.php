<?php

// HIDE THE ADMIN BAR
function my_function_admin_bar(){
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


//lsit situations for /situations page
function list_situations_func(){
	$pages = get_pages('parent=2&child_of=2&sort_column=menu_order&title_li=');
	$list='<ul class="situations_list">';
	foreach ($pages as $page) {
		$var = get_post_meta($page->ID,'aka');
		$list.= '<li><a href="'.
				get_permalink($page->ID).'" alt="">'.
				($var[0]!=''? $var[0]:$page->post_title).
				'</a></li>';
	}
	$list.= '</ul>';
	return $list;
}

//list categories of situations shortcode for the /situations/x/ page
function list_categories_func(){
	$page_id= get_the_id();
	$pages = get_pages('parent='.$page_id.'&child_of='.$page_id.'&sort_column=menu_order&title_li=');
	$list='<ul class="categories_list">';
	foreach ($pages as $page) {
		$var = get_post_meta($page->ID,'aka');
		$number_of_comments = get_comments_number($page->ID);
		$list.= '<ul><li>Situation: '.
				'<a class="situation" href="'.
				get_permalink($page->ID).'" alt="">'.
				($var[0]!=''? $var[0]:$page->post_title).
				'</a></li>'.
				'<li class="comment_count">Comments: '.$number_of_comments.'</li>'.
				'</li></ul>';
	}
	$list.= '</ul>';
	return $list;
}

//shortcode to add the .wrong class
function wrong( $atts, $content = null ) {
	return '<div class="wrong"><span>Wrong:</span><p>'.$content.'</p></div>';
}

//shortcode to add the .right class
function right( $atts, $content = null ) {
	return '<div class="right"><span>Right:</span><p>'.$content.'</p></div>';
}

// add the buttons to tinyMCE
function add_button() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ){
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons', 'register_button');
   }
}

// register the buttons for tinyMCE
function register_button($buttons) {
   array_push($buttons, "wrong");
   array_push($buttons, "right");
   return $buttons;
}

//add the plugin to tinyMCE
function add_plugin($plugin_array) {
   $plugin_array['wrong'] = get_bloginfo('template_url').'/customcodes.js';
   $plugin_array['right'] = get_bloginfo('template_url').'/customcodes.js';
   return $plugin_array;
}

// register the shortcodes
function register_shortcodes(){
	add_shortcode('list_situations','list_situations_func');
	add_shortcode('list_categories','list_categories_func');
	add_shortcode('wrong','wrong');
	add_shortcode('right','right');
}


add_action('init','register_shortcodes');
add_action('init','add_button');



//The comments layout
function comment_layout ( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	$location = get_comment_meta(get_comment_ID(),'location',true);

	?>
	<li <?php comment_class(); ?> id="comment-<?php echo $comment->comment_ID; ?>">

		<?php comment_text(); ?>
		<?php echo '<cite>-'.get_comment_author().($location ? ', '.$location : '').'</cite>';?>


	<?php if ($comment->comment_approved == '0') _e("<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'matty') ?>

	</li>
	<?php

} // End comment_layout()


// change the comment form defaults
add_filter( 'comment_form_defaults',	'change_comment_form_defaults');

function change_comment_form_defaults($default) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email ');


	$fields =  array(
		'author' => '<p class="comment-form-author">' .
					'<label for="author">' . 'Name [your name, class, group or organization]' . '</label> ' . ( $req ? '<span class="required">*:</span>' : ':' ) .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . 'Email Address [for notification only, NEVER printed on the site]'. '</label> ' . ( $req ? '<span class="required">*:</span>' : ':' ) .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'location'  => '<p class="comment-form-location"><label for="location">' .'Location [City and State]:'. '</label> '. ( $req ? '<span class="required">*:</span>' : ':' ) .
		            '<input id="location" name="location" type="text" size="30"' . ' /></p>',
	);


	$default=array(
		'fields'=>$fields,
		'label_submit'=>'Submit',
		'logged_in_as'=>'<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_field'=>'<p class="comment-form-comment"><label for="comment">' . _x( 'Add Your Comments Here:', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'comment_notes_before'=>'<p>* required fields</p>',
		'title_reply'=>'',
		'title_reply_to'=>'',
		'cancel_reply_link'=>'',

	);

	return $default;
}


//save the data to the DB
add_action( 'comment_post',	'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	add_comment_meta( $comment_id, 'location', $_POST['location'] );
}

//TODO: add meta box to admin page
// tut is here http://wp.tutsplus.com/tutorials/plugins/how-to-create-custom-wordpress-writemeta-boxes/


