<?php 
	/* 
	** @package makzine
	** index
	*/

	 get_header(); ?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

					<?php 
	
						if(have_posts()):

							while(have_posts()) : the_post(); 

							get_template_part('template-parts/content');
					?>

				

				<div class="border-btm"></div>

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