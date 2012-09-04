<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) {
		echo "This post is password protected. Enter the password to view comments.";
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h3><?php comments_number('No Comments', 'One Comment', 'Comments' );?></h3>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ul class="commentlist">
		<?php //comment layout is in functions.php ?>
		<?php wp_list_comments('callback=comment_layout'); ?>
	</ul>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>
<?php //comment form is in functions.php ?>
<?php comment_form();?>

<?php endif; ?>
