<?php 
	/* 
	** @package makzine
	**Template Name: Front page
	*/

	get_header();
            
			 if( is_active_sidebar( 'makzine-homepage-featured' ) ) {
			     if ( !dynamic_sidebar( 'makzine-homepage-featured' ) ):
			         endif;
			 } 

?>

	<div id="main-content">

		<div class="container">

			<div class="col-md-8">

				<?php

					if( is_active_sidebar( 'makzine-homepage-content' ) ) {
			    	 if ( !dynamic_sidebar( 'makzine-homepage-content' ) ):
			         	endif;
			 		} 

				?>


			</div>

			<div class="col-md-4">

				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>
            

	<?php get_footer() ?>