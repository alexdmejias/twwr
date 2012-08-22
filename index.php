<?php get_header(); ?>
<body class="blue-bg">
	<section id="front-page">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/IMG/home-header-bigblue2.jpg" />
		<ul>
			<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=');?>
		</ul>
		<?php if(have_posts()): ?>
			<?php while(have_posts()):the_post(); ?>
				<?php the_content(''); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>
</body>
<?php get_footer();?>
