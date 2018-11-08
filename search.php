<?php 
	/* 
	** @package makzine
	** Search Results
	*/
 ?>

<?php get_header() ?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

					<?php 
	
						if(have_posts()):

							$totalResults = new WP_Query("s=$s&showposts=0&post_type=post");

					?>
				<br>
				<div class="search-details">
					<span><?php echo 'About ' . $totalResults->found_posts.' results'; ?></span>
				</div>

				<?php

				while($totalResults->have_posts()) : $totalResults->the_post(); ?>

				<div class="search-list">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<div class="makzine-search">
							
							<div class="makzine-search-content">
								<div class="makzine-search-title">
									<?php the_title( '<h3><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h3>' ) ?>
								</div>

								<div class="makzine-search-meta">
								<ul>
									<li>
										<i class="fa fa-calendar"></i> 
										<?php echo get_the_date('M d, Y'); ?>
									</li>

									<li>
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
											<i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?>
										</a>
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

								<div class="makzine-search-excerpt">
									<?php echo wp_trim_words( get_the_content(), 30, '...' ); ?>
								</div>

							</div>
						</div>

					</article>

				</div>
				
			<?php 

				endwhile;

				?>
				<div class="post-paginate">
					<?php makzine_pagination(); ?>
				</div>
				<?php

				endif;


			 ?>


			</div>

			<div class="col-md-4">

				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>

		

	

<?php get_footer(); ?>