<?php get_header(); ?>
<body id="page">
	<?php get_sidebar(); ?>
	<section>
		<?php if(have_posts()): ?>
			<?php while(have_posts()):the_post(); ?>
				<?php the_content(''); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>


</body>
<?php get_footer();?>
