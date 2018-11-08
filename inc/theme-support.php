<?php 
	/* 
	** @package makzine
	** theme support
	*/

	// Makzine Setup

	function makzine_theme_setup() {


	add_theme_support('title-tag');

		// HTML5 features
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

	// post formats

	add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

	// featured image

	add_theme_support( 'post-thumbnails' ); 

	// custom logo
	
	$defaults = array(
	        'height'      => 90,
	        'width'       => 240,
	        'flex-height' => true,
	        'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $defaults );

	register_nav_menu('primary', 'Primary Menu');
	register_nav_menu('footer', 'Footer Menu');

	add_theme_support( 'automatic-feed-links' );

	add_theme_support('custom-header');

	add_theme_support('custom-background');

	add_editor_style( 'css/editor-style.css' );


	}

	add_action('after_setup_theme', 'makzine_theme_setup');


	// Security
	function makzine_wp_rm_v() {
		return '';
	}

	add_filter('the_generator', 'makzine_wp_rm_v');

	if ( ! isset( $content_width ) ) {
	$content_width = 900;

	function makzine_page_links() {

		$args = array (
		    'before'            => '<div class="page-links"><span class="page-link-text">' . __( 'More pages:  ', 'makzine' ) . '</span>',
		    'after'             => '</div>',
		    'link_before'       => '<span class="page-link">',
		    'link_after'        => '</span>',
		    'next_or_number'    => 'next',
		    'separator'         => ' | ',
		    'nextpagelink'      => __( 'Next &rarr;', 'makzine' ),
		    'previouspagelink'  => __( '&larr; Previous', 'makzine' ),
		);
		 
		return wp_link_pages( $args );
	}
}

	// Widgets Area
	function makzine_widgets_area() {

		if(function_exists('register_sidebar'))

		register_sidebar(
			array(
				'name' => esc_html__('Header Social Area', 'makzine'),
				'id'   => 'makzine-header-social',
				'description' => 'Add makzine header social icon widget to this section',
				'before_widget' => '<section id="%1$s" class="makzine-widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '',
				'after_title'  => ''
			)
		);

		register_sidebar(
			array(
				'name' => esc_html__('Homepage Featured Area', 'makzine'),
				'id'   => 'makzine-homepage-featured',
				'description' => 'Add homepage featured post widget in this section.',
				'before_widget' => '<section id="%1$s" class="featured-post %2$s">',
				'after_widget' => '</section>',
				'before_title' => '',
				'after_title'  => ''
			)
		);

		register_sidebar(
			array(
				'name' => esc_html__('Homepage Category Area', 'makzine'),
				'id'   => 'makzine-homepage-content',
				'description' => 'Add multiple category post widgets in this section',
				'before_widget' => '<section id="%1$s" class="makzine-widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="section-widget-title">
									<h3 class="cat-title">',
				'after_title'  => ' </h3>
								   </div>'
			)
		);
		
		register_sidebar(
			array(
				'name' => esc_html__('Sidebar', 'makzine'),
				'id'   => 'makzine-sidebar',
				'description' => 'Sidebar Widgets Area',
				'before_widget' => '<section id="%1$s" class="makzine-widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="sidebar-widget-title">
									<h3 class="wdgt-title">
									  <span>',
				'after_title'  => '</span>
									</h3>
									</div>'
			)
		);

		register_sidebar(
			array(
				'name' => esc_html__('Footer', 'makzine'),
				'id'   => 'makzine-footer',
				'description' => 'Footer Widgets Area',
				'before_widget' => '<section id="%1$s" class="makzine-widget col-md-4 lr %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="footer-widget-title">
										<h3> <span class="footer-title">',
				'after_title'  => '</span></h3>
									</div>'
			)
		);



	}

	add_action('widgets_init', 'makzine_widgets_area');


	// Customization

	function makzine_customization($wp_customize) {

		$wp_customize->add_section('makzine_theme_options_section', array(
			'title'    => __('Theme Options', 'makzine'),
			'priority' => 30,
		));

		// Primary Color

		$wp_customize->add_setting('makzine_primary_color', array(
			'default'   => '#2c3e50',
			'transport' => 'refresh',
			'sanitize_callback' => 'esc_attr'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'makzine_primary_color', array(
			'label'    => __('Primary Color', 'makzine'),
			'section'  => 'makzine_theme_options_section', 
			'settings' =>  'makzine_primary_color',
		)));


		// Secondary Color

		$wp_customize->add_setting('makzine_secondary_color', array(
			'default'   => '#34495e',
			'transport' => 'refresh',
			'sanitize_callback' => 'esc_attr'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'makzine_secondary_color', array(
			'label' 	=> __('Secondary Color', 'makzine'),
			'section'   => 'makzine_theme_options_section', 
			'settings'  =>  'makzine_secondary_color',
		)));

		// Related Posts

		$wp_customize->add_setting('makzine_related_posts', array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'esc_attr'
		));

		$wp_customize->add_control( 'makzine_related_posts', array(
			'label' 	=> __('Related Posts', 'makzine'),
			'description' => __('Input number of posts to show in related post widget. Leave blank to disable related post.', 'makzine'),
			'section'   => 'makzine_theme_options_section', 
			'settings'  =>  'makzine_related_posts',
			'type'		=> ''
		));


		// Footer Text

		$wp_customize->add_setting('makzine_footer_text', array(
			'default'   => 'Makzine',
			'transport' => 'refresh',
			'sanitize_callback' => 'esc_html'
		));

		$wp_customize->add_control( 'makzine_footer_text', array(
			'label' 	=> __('Footer Text', 'makzine'),
			'description' => __('Change your footer text.', 'makzine'),
			'section'   => 'makzine_theme_options_section', 
			'settings'  =>  'makzine_footer_text',
			'type'		=> 'input'
		));



	}

	add_action('customize_register', 'makzine_customization');

	function makzine_color() { 

		$primaryColor = get_theme_mod('makzine_primary_color');
		$secondaryColor = get_theme_mod('makzine_secondary_color');
		?>

		<style type="text/css">
			
			/* Primary */

			.site-social ul li {
			  background: <?php echo $primaryColor; ?>;
			 }

			 .navbar-default {
  				background-color: <?php echo $primaryColor; ?>;
			 }

			 .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
			    background: <?php echo $primaryColor; ?>;
			 }

			 .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
			 	background: <?php echo $primaryColor; ?>
			 }

			 .dropdown-menu {
			 	background: <?php echo $primaryColor; ?>
			 }

			 .makzine-search-title h3 {
			  color: <?php echo $primaryColor; ?>; 
			}

			.read-more-btn {
			  background-color: <?php echo $primaryColor; ?>;
			  border: 1px solid <?php echo $primaryColor; ?>;
			}

			.read-more-btn:hover {
			  border: 1px solid <?php echo $primaryColor; ?>;
			  color: <?php echo $primaryColor; ?>;
			}	

			.post-paginate li span.current {
			  border: 1px solid <?php echo $primaryColor; ?>;
			  color: <?php echo $primaryColor; ?>;
			}

			.post-paginate li a {
			  background: <?php echo $primaryColor; ?>;
			}

			.cat-count {
  			  background: <?php echo $primaryColor; ?>;
  			}

			/* Secondary */

			.brand {
			  background: <?php echo $secondaryColor; ?>;
			 }

			 .navbar-default .navbar-nav>.open>a,
			 .navbar-default .navbar-nav>.open>a:hover,
			  .navbar-default .navbar-nav>.open>a:focus,
			  .navbar-default .navbar-nav > li > a:hover,
			.navbar-default .navbar-nav > li > a:focus {
			  background-color: <?php echo $secondaryColor; ?>; 
			}

			.navbar-default .navbar-nav > .active > a,
			.navbar-default .navbar-nav > .active > a:hover,
			.navbar-default .navbar-nav > .active > a:focus {
			  background-color: <?php echo $secondaryColor; ?>; 
			}

			.navbar-default .navbar-nav .open .dropdown-menu>.active>a,
		   .navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus,
		   .navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover {
		    background: <?php echo $secondaryColor; ?>;
		   }

		   .dropdown-menu li a:hover {
			  background: <?php echo $secondaryColor; ?>;
			}

			.cat-title .full-title {
			  color: <?php echo $secondaryColor; ?>;
			  border-left: 5px solid <?php echo $secondaryColor; ?>;
			 }

			  .view-more {
			  color: <?php echo $secondaryColor; ?>;
			 }

			 .cat-tag span {
			  background: <?php echo $secondaryColor; ?>;
			 }

			 .wdgt-title span {
			  color: <?php echo $secondaryColor; ?>;
			  border-left: 5px solid <?php echo $secondaryColor; ?>;
			 }

			 .subscribe-btn {
			  background: <?php echo $secondaryColor; ?>;
			}

			.subscribe-btn:hover {
			  background: <?php echo $secondaryColor; ?>;
			  border-color: <?php echo $secondaryColor; ?>;
			}

			.single-post-category {
			  background: <?php echo $secondaryColor; ?>;
			}

			.archive-title {
			  background: <?php echo $secondaryColor; ?>;
			 }

			 input.comment-btn {
			  background: <?php echo $secondaryColor; ?>;
			}

			.dropdown-menu li a:hover, .dropdown-submenu li a:hover {
			  background: <?php echo $secondaryColor; ?>;
			}

			.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
			  background: <?php echo $secondaryColor; ?>;
			}

			.navbar-default .navbar-nav .open .dropdown-menu>.active>a,
			   .navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus,
			   .navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover {
			    background: <?php echo $secondaryColor; ?>;
			   }

			.form-group .form-control.header-search {
  				background-color: <?php echo $secondaryColor; ?>;
  			}

  			.widget_categories ul li {
			  background: <?php echo $secondaryColor; ?>;
			}

			input.search-submit {
			  background: <?php echo $secondaryColor; ?>;
			}

			.current_page_item {
			  background: <?php echo $secondaryColor; ?>;
			 }

			  .footer-widget-title h3 span {
    			border-left: 5px solid <?php echo $secondaryColor; ?>;
    		}


		</style>

	<?php }

	add_action('wp_head', 'makzine_color');

	




	function makzine_post_views($postID) {
		$metaKey = 'makzine_post_views';
		$postViews = get_post_meta($postID, $metaKey, true);
		$count = (empty($postViews) ? '0' : $postViews);
		$count++;

		update_post_meta($postID, $metaKey, $count);

	}

	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	function makzine_categories() {
		$categories = get_the_category();
		$item = 1;
		$output = '';

		if (!empty($categories)):
			foreach ($categories as $category) :
				if($item > 1): $output .= ', '; endif;
				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( $category->name ) .'">' . esc_html( $category->name ) . '</a>';
				$item++;
			endforeach;
		endif;

		return $output;
			
		
	}

	function makzine_comment_lists($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' : ?>

            <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">

            <div class="back-link">< ?php comment_author_link(); ?></div>

        <?php break;

        default : ?>

            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

	            <article <?php comment_class(); ?> class="comment">
	 
		            <div class="comment-body">

			            <div class="comment-author vcard">
			            <?php echo get_avatar( $comment, 64 ); ?>

			            </div>

			            <div class="comment-metadata clearfix">

			            	<span class="author-name"><?php comment_author(); ?></span>


				            <div class="comment-meta">

				            <time <?php comment_time( 'c' ); ?> class="comment-time">
				            <span class="date">
				            <?php comment_date(); ?>
				            </span>
				            <span class="time">
				            <?php comment_time(); ?>
				            </span>
				            </time>

				        	</div>

			            </div>

			            <div class="comment-text">
				            <?php comment_text(); ?>
				        </div>

		            </div>
	 
		            <footer class="comment-footer">
		         
			            <div class="reply"><?php 
			            comment_reply_link( array_merge( $args, array( 
			            'reply_text' => 'Reply', 
			            'depth' => $depth,
			            'max_depth' => $args['max_depth']
			            ) ) ); ?>
			            </div>

		            </footer>
	 
	            </article>

    <?php

        break;
    endswitch;

	}


	function makzine_comment_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;

		return $fields;
		}
		add_filter( 'comment_form_fields', 'makzine_comment_fields' );

		function makzine_categories_list( $links ) {
		
		$links = str_replace('</a> (', '</a> <span class="cat-count">', $links);
		$links = str_replace(')', '</span>', $links);
		
		return $links;
	
	}
	
	add_filter( 'wp_list_categories', 'makzine_categories_list' );

	function makzine_pagination() {

		the_posts_pagination( array( 

			'mid_size' => 2,
			'prev_text' => __( '&larr; Previous', 'makzine' ),
	    	'next_text' => __( 'Next &rarr;', 'makzine' )

    	) );

	}

?>
