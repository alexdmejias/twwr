<nav>
	<ul>
		<?php wp_list_pages('depth=2&sort_column=menu_order&title_li=');?>
		<li><?php wp_loginout(); ?></li>
		<li><?php wp_register(); ?></li>
	</ul>
</nav>