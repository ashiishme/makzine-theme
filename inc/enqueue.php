<?php 
	/* 
	** @package makzine
	** enqueue
	*/

	function makzine_load_assets() {

		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto|Lato|Abril+Fatface', array(), null );

		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all');
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/css/font-awesome.min.css');
		wp_enqueue_style('makzine', get_template_directory_uri() . '/css/makzine.css', array(), '1.0.0', 'all');

		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', 'true');
		wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', 'true');
	}

	add_action('wp_enqueue_scripts', 'makzine_load_assets');



 ?>