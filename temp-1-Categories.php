<?php
/**
 * Template Name: 1-Categories
 *
 * Shows all the categories within all the situations
 */
?>
<?php get_header(); ?>
<body <?php body_class(); ?>>
	<div class="container">
			<div class="row">
				<div class="span40 header"></div>
				<div class="span40 poleTop">
					<h3>[What's <span class="g">Right</span>, What's <span class="r">Wrong</span>]</h3>
				</div>
			</div>
			<div class="row">
				<div id="content" class="span40">
					<div class="sidebar span8">
						<?php get_sidebar(); ?>
					</div>
					<div class="main span32">
						<?php if(have_posts()): ?>
							<?php while(have_posts()):the_post(); ?>
								<?php
									the_content('');
									//the list of categories come from functions.php
								?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div><!-- end .cont -->
				</div><!-- end #content -->
			</div><!-- end .row -->
<?php get_footer();?>
