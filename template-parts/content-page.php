<?php 
	/* 
	** @_ackage makzine
	** Page Content
	*/

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-page-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<br>
			<div class="entry-content">
				<?php the_content(); ?>

			</div><!-- .entry-content -->



		</article><!-- #post-## -->
		<div class="clearfix"></div>

		<?php makzine_page_links(); ?>

