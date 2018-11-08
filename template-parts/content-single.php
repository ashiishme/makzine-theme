<?php 
	/* 
	** @package makzine
	** Standard Post
	*/

	global $post;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="makzine-single-entry-media">
		<?php if( has_post_thumbnail() ): ?>
			<div class="single-entry-thumb">
				<?php the_post_thumbnail('medium',array('class' => 'single-thumb')); ?>
			</div>
		<?php endif; ?>
	</figure>

	<header class="single-entry-header">
		<?php the_title('<h1 class="single-entry-title">', '</h1>'); ?>
	</header>

	<div class="makzine-post-meta">
		<ul>
			<li>
				<i class="fa fa-calendar"></i> 
				<?php echo get_the_date(__('M d, Y', 'makzine')); ?>
			</li>

			<li>
				<i class="fa fa-folder" aria-hidden="true"></i>
				<?php echo makzine_categories(); ?>
			</li>

			<li>
				<i class="fa fa-comments" aria-hidden="true"></i> 
				<?php comments_number('0', '1', '%'); ?>
			</li>

		</ul>
	</div>

	<div class="post-content">
		<?php the_content(); ?>
	</div>

</article>

		<?php makzine_page_links(); ?>

<br>

	

	<div class="post-tags">
	
		<div class="tag-list">
				<?php
				if(get_the_tag_list()) {
				    echo get_the_tag_list('<ul><li><i class="fa fa-tag"></i> ','</li><li><i class="fa fa-tag"></i> ','</li></ul>');
				}
				?>
		</div>
	</div>
				
	<div class="border-btm"></div>
	
	<br>

	<div class="about-author-wrapper">

		<?php 

			$author_id = get_the_author_meta('ID');

			$author_img = get_avatar($author_id);

			$author_name = get_the_author_meta('display_name');

			$auhtor_info = get_the_author_meta('description');

		 ?>

		<h5><strong> About Author: </strong></h5>

		<div class="single-post-author clearfix">

			<div class="col-sm-12">

			<div class="col-sm-2 author-card">
				<figure class="author-media">
					<?php echo $author_img; ?>
				</figure>

			</div>

			<div class="col-sm-10 author-info">

				<div class="author-name">
					<span><?php echo $author_name; ?></span>
				</div>

				
				<p><?php echo $auhtor_info; ?></p>


				
			</div>
			</div>
		</div>
	</div>

	<?php 

	$categories = get_the_category($post->ID);

	if($categories) {
		
		$category_ids = array();

		foreach ($categories as $category) {

			$category_ids[] = $category->term_id;

		}

		$enable_related_post = number_format_i18n(get_theme_mod('makzine_related_posts'));

		if(empty($enable_related_post) || $enable_related_post == 0) {
			return;
		}

	}


		$makzine_related_posts_args = array (
            'post_type'        => 'post',
            'posts_per_page'   => $enable_related_post,
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID)
        );


		$makzine_related_posts_query = new WP_Query($makzine_related_posts_args);


	 ?>

	<div class="related-post clearfix">

		<div class="related-post-title">

			<div class="section-widget-title">
				
				<h3 class="cat-title"><soan class="full-title">Related Posts</soan></h3>

			</div>

		</div>

		<div class="col-sm-12">

		<div class="row">


			<?php 
	
				if( $makzine_related_posts_query->have_posts() ): 

					while ( $makzine_related_posts_query->have_posts() ): 

						$makzine_related_posts_query->the_post(); 

			?>
				<div class="related-post-item col-sm-4 clearfix">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if( has_post_thumbnail() ): ?>

						<figure class="makzine-entry-media">
								<div class="makzine-recent-thumb">
									<a href="<?php the_permalink(); ?>">
										      <?php the_post_thumbnail('medium',array('class' => 'img-zoom')); ?>
										        </a>
								</div>
						</figure>

						<?php endif; ?>
										
						<div class="makzine-entry-content">

							<div class="makzine-entry-title">
								<?php the_title( '<h4><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h4>' ) ?>
							</div>

							

						</div>

					</article>

				</div>


		<?php 

			endwhile;

		endif;

		wp_reset_postdata();

		?>

		</div>

	</div>

	</div>

