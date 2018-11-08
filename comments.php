<?php 
	/* 
	** @package makzine
	** Comment
	*/

	if (post_password_required()) {
		return;
	}

?>

<div id="comments" class="comments-area">

	<?php 
		if(have_comments()):
	?>

	<div class="comments-list">

					<div class="total-comments">
						<span> <i class="fa fa-comment"> </i> <?php comments_number('', '1 comment', '% comments'); ?> </span>
					</div>

					<div class="border-btm"></div>

					<?php if(get_comment_pages_count() > 1 && get_option('page_comments') ): ?>

						<nav id="comment-nav" class="comment-navigation" role="navigation">
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<div class="old-comments">
										<?php previous_comments_link(esc_html__('&larr; Previous Comments', 'makzine')) ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="new-comments">
										<?php next_comments_link(esc_html__('Next Comments &rarr;', 'makzine')) ?>
										
									</div>
								</div>
							</div>
						</nav>

					<?php endif; ?>

		<ul class="comment-list">
			
			<?php 

			$args = array(
				'max_depth'  	=> 3,
				'style'		 	=> 'ul',
				'callback'		=> 'makzine_comment_lists'

			);

			wp_list_comments($args);

			 ?>

		</ul>

	</div>

	<?php 
		if(!comments_open() && get_comments_number()):

	?>

	<p class="no-comments"><?php esc_html_e('Comments are closed for this post by the author.', 'makzine'); ?></p>

	<?php

		endif;
	 ?>

	<?php
		endif;

		$comments_fields = array(
			'author' => '<div class="row"><div class="col-sm-4">
							<div class="form-group">
							    <input id="author" name="author" type="author" class="form-control" placeholder="Full Name *" value="' . esc_attr($commenter['comment_author']) . '" required />
							</div>
							</div>',

			'email'  => '<div class="col-sm-4">
							<div class="form-group">
							    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address *" value="' . esc_attr($commenter['comment_author_email']) . '" required />
							</div>
							</div>',

			'url'	 => '<div class="col-sm-4">
							<div class="form-group">
							    <input id="url" name="url" type="text" class="form-control" placeholder="Website" value="' . esc_attr($commenter['comment_author_url']) . '" />
							</div>
							</div></div>'

		);

		$comments_args = array(
			'comment_field' => '<div class="form-group">
							    <textarea class="form-control" id="comment" name="comment" placeholder="Your Message *" required></textarea>
								</div>',
			'class_submit'	=> 'comment-btn',
			'label_submit'	=> 'Submit',
			'fields'		=> apply_filters('comment_form_default_fields', $comments_fields)
		);
	 ?>

	<?php comment_form($comments_args); ?>
</div>
