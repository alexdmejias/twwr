<?php
/**
 * Template Name: Situations
 *
 * Shows all the situations
 */
?>
<?php get_header(); ?>
			<div class="row">
				<div id="content" class="span40">
					<div class="sidebar span8">
						<?php get_sidebar(); ?>
					</div>
					<div class="cont span32">
						<?php if(have_posts()): ?>
							<?php while(have_posts()):the_post(); ?>
								<?php the_content(''); ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div><!-- end .cont -->
				</div><!-- end #content -->
			</div><!-- end .row -->
<?php get_footer();?>
