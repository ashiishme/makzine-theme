<?php 
	/* 
	** @package makzine
	** Header
	*/
 ?>

 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>
 <head>
 	<meta charset="<?php bloginfo('charset'); ?>">
 	<meta name="description" content="<?php bloginfo('description'); ?>">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if(is_singular() && pings_open(get_queried_object() ) ): ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php endif; ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
 	<?php wp_head(); ?>

    <style type="text/css">
			
			.custom-header-image {
				background: url(<?php header_image(); ?>);
				background-position: center;
			}

	</style>


 </head>
 <body <?php body_class(); ?>>

 	<div id="main">

	<header id="header-banner">
	
		<div class="brand <?php if(has_header_image()) { echo 'custom-header-image'; } ?>">

			<div class="container">

				<div class="site-branding navbar-left">
						<?php 

							$logo_id = get_theme_mod( 'custom_logo' );
							$logo_url = wp_get_attachment_image_src( $logo_id , 'full' );

							if ( has_custom_logo() ) { ?> 

							    <div class="site-img"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="logo-img" src="<?php echo esc_url( $logo_url[0] ); ?>"></a></div>

							<?php

							} else { ?>

								<div class="site-text">

								<?php

								if ( is_front_page() || is_archive() ) { ?>

								   <h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <?php bloginfo( 'name' ); ?> </a></h1>
								   
								<?php } else { ?>

									<p class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <?php bloginfo( 'name' ); ?> </a></p>

								<?php } ?>
 
								    <p class="site-description"> <?php bloginfo( 'description' ); ?> </p>

								    </div>

							<?php }

						?>

					</div>

					<div class="site-social navbar-right">

						<?php

							if( is_active_sidebar( 'makzine-header-social' ) ) {
					    	 if ( !dynamic_sidebar( 'makzine-header-social' ) ):
					         	endif;
					 		} 

						?>

					</div>

			</div>

		</div>
	
		<nav class="navbar navbar-default" role="navigation">

			<div class="container">
				
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">

					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dropdown-box-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				
				<span class="collapsed-bar-item navbar-toggle collapsed">
						<a class="search-icon" href="javascript:void(0)"><i class="fa fa-search"></i></a>
					</span>
					<span class="collapsed-bar-item mb-search-input hidden-sm hidden-md hidden-lg">
						<form role="search" method="get" action="<?php echo home_url('/'); ?>" class="navbar-form navbar-left">
						<div class="form-group search-box">
						<input type="search" class="form-control header-search" placeholder="Search.." value="<?php echo get_search_query(); ?>" name="s" title="search">
					</div>
				</form>
					</span>

					
					
					
				</div>

				<div class="row">
				
				<div class="collapse navbar-collapse pad" id="dropdown-box-1">
				

					<?php


					 wp_nav_menu( array(

							'theme_location' => 'primary',
							'container'		 => 'ul',
							'menu_class'	 => 'nav navbar-nav',
							'walker'         => new Walker_Nav_Primary_Menu(),
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',

							)); 


					 ?>

					<div class="nav navbar-nav navbar-right hidden-xs">

					<form role="search" method="get" action="<?php echo home_url('/'); ?>" class="navbar-form navbar-left">
						<div class="form-group search-box">
							<input type="search" class="form-control header-search" placeholder="Search.." value="<?php echo get_search_query(); ?>" name="s" title="search">
						</div>
							<a class="search-icon" href="javascript:void(0)"><i class="fa fa-search"> </i></a>
					</form>

					</div>
					
				</div>
			</div>
				
			</div>
		</nav>
		
	</header>
 