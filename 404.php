<?php 
	/* 
	** @package makzine
	** Single Post
	*/

	get_header(); ?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

				<div class="error-wrapper">
					
					<div class="error-content">
						
						<span>404</span>

						<div class="error-info">
							
							<p>The requested page / post was not found on this server or you don't have permission to access.</p>
							
							<div class="home-btn">
								<a href="#">&larr; BACK TO HOME</a>
							</div>
							
						</div>

						<div class="error-recent-posts">

							<div class="recent-posts-entry-title">
								<h3>You May Like: </h3>
								<div class="border-btm"></div>
							</div>
							

							<?php 
			
								$makzine_recent_posts_args = array (
									'post_type'        => 'post',
									'posts_per_page'   => 6,
									'ignore_sticky_posts' => 1,
									'orderby'		   => 'post_date',
									'order'			   => 'DESC'
								);

								$makzine_recent_posts_query = new WP_Query($makzine_recent_posts_args);

								if( $makzine_recent_posts_query->have_posts() ): 

									while ( $makzine_recent_posts_query->have_posts() ): 

										$makzine_recent_posts_query->the_post(); 

										//$posst_ID = get_the_ID();

							?>

								<div class="error-rp-entry-title">

									<a href="<?php the_permalink(); ?>">

										<?php the_title( '<h3>&#187; ', '</h3>' ); ?>

									</a>

								</div>

							<?php 

								endwhile;
									
									endif;

									wp_reset_postdata();
														
							?>


						</div>

					</div>

				</div>

			</div>

			<div class="col-md-4">

				<?php get_sidebar(); ?>

			</div>
		
		</div>

	</div>

	<?php get_footer(); ?>

	

				


			
