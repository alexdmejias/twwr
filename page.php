<?php get_header(); ?>
<body>
	<?php get_sidebar(); ?>
	<div id="content">
		<?php if(have_posts()): ?>
		<?php while(have_posts()):the_post(); ?>
			<?php the_content(''); ?>
		<?php endwhile; ?>
	<?php endif; ?>


</body>
<?php get_footer();?>
