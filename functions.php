<?php

// HIDE THE ADMIN BAR
function my_function_admin_bar(){
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');




?>
