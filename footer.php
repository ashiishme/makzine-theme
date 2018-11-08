<?php 
	/* 
	** @package makzine
	** Footer
	*/
 ?>

 <footer id="footer-banner">
			<div class="container">
				<div class="row">

					<?php

					if( is_active_sidebar( 'makzine-footer' ) ) {
			    	 if ( !dynamic_sidebar( 'makzine-footer' ) ):
			         	endif;
			 		} 

					?>

				</div>
			</div>
			
		<div class="footer-btm">
			<div class="container">
				<div class="top-links">

					<?php wp_nav_menu(array(

							'theme_location' => 'footer',
							'container'		 => 'ul',
							'menu_class'	 => 'top-link-list',
							'depth'			 => 1,
							'fallback_cb'	 => false

						)); ?>
				
				</div>
				<div class="copyright">
					<span>
						&#169;
						<?php echo date('Y'); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <?php echo esc_html(get_theme_mod('makzine_footer_text')); ?> </a>
						- All Right Reserved 
					</span>
					
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>

</div>

 </body>
 </html>