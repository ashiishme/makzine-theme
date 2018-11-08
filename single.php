<?php 
	/* 
	** @package makzine
	** Single Post
	*/

	get_header(); ?>


	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

				<div class="single-article">

				<?php  

					if(have_posts()): 

						while(have_posts()): the_post(); 

							makzine_post_views(get_the_ID());

							get_template_part('template-parts/content-single', get_post_format() );

							if (comments_open()):
						
								comments_template();

							endif;

						endwhile;

				endif;

				?>
				</div>

			</div>


			<div class="col-md-4">

				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>


	<?php get_footer(); ?>