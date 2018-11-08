<?php 
	/* 
	** @package makzine
	** Makzine Recent Posts
	*/

class Makzine_Recent_Posts extends WP_Widget {
	
	function __construct() {
		
		$options = array(
			'classname' => 'makzine-recent-posts',
			'description' => 'Makzine Recent Posts',
		);

		parent::__construct('makzine_recent_posts', 'Makzine Recent Posts', $options);

	}

	// back end
	public function form($instance) {
		
		$title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
        $posts_per_page = ( !empty( $instance[ 'posts_per_page' ] ) ? absint($instance[ 'posts_per_page' ] ) : 6  );

		?>

		 <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'makzine' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php _e( 'Number of posts to show:', 'makzine' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="number" value="<?php echo $posts_per_page; ?>" />

        </p>

		<?php

	}

	//update widget
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
        $instance[ 'posts_per_page' ] = ( !empty( $new_instance[ 'posts_per_page' ] ) ? absint( strip_tags( $new_instance[ 'posts_per_page' ] ) ): 0 );
        
        return $instance;
    }

	//front end
	public function widget($args, $instance) {

		$posts_per_page = absint( $instance[ 'posts_per_page' ] );

		// large thumb

        $makzine_recent_posts_lg_args = array (
            'post_type'        => 'post',
            'posts_per_page'   => 1,
            'orderby' 		   => 'post_date',
	        'order'			   => 'DESC'
        );

		$makzine_recent_posts_lg_query = new WP_Query($makzine_recent_posts_lg_args);

		echo $args['before_widget']; 

		?>
		
				<div class="sidebar-widget-three">

					<?php
                        if( !empty( $instance[ 'title' ] ) ):

                        	

                            echo $args[ 'before_title' ];

                            ?>

                            <?php echo apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base ); ?>

                            <?php

                            echo $args[ 'after_title' ];
                                        
                        endif; 
                    ?>

					<div class="recent-post">

						<div class="rp-container">

							<?php 

							// large thumb

								if( $makzine_recent_posts_lg_query->have_posts() ): 

									while ( $makzine_recent_posts_lg_query->have_posts() ): 

										$makzine_recent_posts_lg_query->the_post(); 

										$posst_ID = get_the_ID();

							?>


							<article class="rp-entry-post clearfix">

								<?php if( has_post_thumbnail() ):
                          	
                          	 		$url = wp_get_attachment_url( get_post_thumbnail_id($makzine_recent_posts_lg_query->ID) ); 

                          	 	?>

									<figure class="rp-entry-media">

										<a href="<?php the_permalink(); ?>">

											<img class="img-res img-zoom" src="<?php echo $url; ?>">

										

										</a>

									</figure>

									<?php endif; ?>

									<div class="rp-entry-title">

										<a href="<?php the_permalink(); ?>">

											<?php the_title( '<h2>', '</h2>' ); ?>

										</a>

									</div>

									<div class="post-meta">
										<span class="posted-on">
											<i class="fa fa-calendar" aria-hidden="true"></i>
											<?php echo get_the_date(__('M d, Y', 'makzine')); ?>
										</span>
									</div>
									
							</article>

							<?php 

								endwhile;
							endif;

							wp_reset_postdata();
							
							?>



							<?php 

							$per_page = $posts_per_page - 1;

							 $makzine_recent_posts_sm_args = array (
						            'post_type'        => 'post',
						            'posts_per_page'   => $per_page,
						            'orderby'		   => 'post_date',
						            'offset'		   => 1,
							        'order'			   => 'DESC'
						        );

								$makzine_recent_posts_sm_query = new WP_Query($makzine_recent_posts_sm_args);

							// small thumb

								if( $makzine_recent_posts_sm_query->have_posts() ): 

									while ( $makzine_recent_posts_sm_query->have_posts() ): 

										$makzine_recent_posts_sm_query->the_post(); 

										$posst_ID = get_the_ID();

							?>

							<article class="pp-entry-post clearfix">

								<?php if( has_post_thumbnail() ):
                          	
                          	 		$url = wp_get_attachment_url( get_post_thumbnail_id($makzine_recent_posts_sm_query->ID) ); 

                          	 	?>

									<figure class="pp-entry-media">

										<a href="<?php the_permalink(); ?>">

											<img class="img-res img-zoom" src="<?php echo $url; ?>">

										

										</a>

									</figure>

									<?php endif; ?>

									<div class="pp-entry-title">

										<a href="<?php the_permalink(); ?>">

											<?php the_title( '<h2>', '</h2>' ); ?>

										</a>

									</div>

									<div class="post-meta">
										<span class="posted-on">
											<i class="fa fa-calendar" aria-hidden="true"></i> 
											<?php echo get_the_date(__('M d, Y', 'makzine')); ?>
										</span>
									</div>
									
							</article>

							<?php 

								endwhile;
							endif;

							wp_reset_postdata();
							
							?>

						</div>

					</div>

				</div>
	

				

		<?php

		 echo $args[ 'after_widget' ];


	}

}

add_action('widgets_init', function() {
	register_widget('Makzine_Recent_Posts');
} );

