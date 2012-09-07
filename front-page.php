<?php get_header('home'); ?>
<body <?php body_class(); ?>>
	<div class="container">
		<div class="row">
			<section id="front-page" class="span40">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/IMG/home-header-bigblue2.jpg" />
				<div class="row">
					<div class="span22 left">
						<ul>
							<?php wp_list_pages('exclude=13&depth=1&sort_column=menu_order&title_li=');?>
						</ul>
					</div>
					<div class="text span18">
						<?php if(have_posts()): ?>
							<?php while(have_posts()):the_post(); ?>
								<?php the_content(''); ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div> <!-- END .text -->
				</div>
			</section>
		</div>
	<!-- </div> -->
<?php get_footer('home');?>
