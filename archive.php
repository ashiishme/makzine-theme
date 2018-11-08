
<?php 
	/* 
	** @package makzine
	** Archive
	*/
 ?>

<?php get_header(); ?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

					<?php 
	
						if(have_posts()):

					?>

				<header class="archive-header">
					<?php 

						$archive_title = get_the_archive_title();

					 	$customized_title = preg_replace("([:])", " -", $archive_title);

					 	echo '<h4><span class="archive-title">' . $customized_title . '</span> </h4>';

					 ?>
				</header>

				<?php

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