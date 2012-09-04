<?php get_header('home'); ?>
<body <?php body_class(); ?>>
	<div class="container">
		<div class="row">
			<section id="front-page">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/IMG/home-header-bigblue2.jpg" />
				<ul>
					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=');?>
				</ul>
				<div class="text">
					<?php if(have_posts()): ?>
						<?php while(have_posts()):the_post(); ?>
							<?php the_content(''); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
<?php get_footer('home');?>
