<?php get_header(); ?>
<body>
	<img src="<?php bloginfo('stylesheet_directory'); ?>/IMG/home-header-bigblue2.jpg" />
	<ul><?php wp_list_pages('depth=1&sort_column=menu_order&title_li=');?></ul>
	<div id="content">
		<?php if(have_posts()): ?>
		<?php while(have_posts()):the_post(); ?>
			<?php the_content(''); ?>
		<?php endwhile; ?>
	<?php endif; ?>


</body>
<?php get_footer();?>
