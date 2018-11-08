<?php 
	/* 
	** @package makzine
	** Single Page
	*/

	get_header(); ?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

				<?php 

				if(have_posts()):
					
					while(have_posts()) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					endwhile;

				else:

					echo "<p>No Content Found</p>";

				endif;

				?>

			</div>

			<div class="col-md-4">

				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>


	<?php get_footer(); ?>


