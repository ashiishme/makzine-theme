<?php 
	/* 
	** @package makzine
	** Featured Post Widget
	*/

class Makzine_Featured_Widget extends WP_Widget {
	
	function __construct() {
		
		$options = array(
			'classname' => 'makzine-featured-widget',
			'description' => 'Makzine homepage featured posts',
		);

		parent::__construct('makzine_featured', 'Makzine Homepage Featured Post', $options);

	}

	// back end
	public function form($instance) {

		$post_category = ( !empty( $instance[ 'post_category' ] ) ? $instance[ 'post_category' ] : 'Select Category' );

		?>

		<p>
            <label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e( 'Category:', 'makzine' )?></label>

            <select id="<?php echo $this->get_field_id('post_category'); ?>" name="<?php echo $this->get_field_name('post_category'); ?>">
                <?php 
                $slider_categories = get_terms('category', array('hide_empty' => false));
                foreach ( $slider_categories as $slider_category ) {
                    $selected = ( $slider_category->term_id == esc_attr( $post_category ) ) ? ' selected = "selected" ' : '';
                    $option = '<option '.$selected .'value="' . $slider_category->term_id;
                    $option = $option .'">';
                    $option = $option .$slider_category->name;
                    $option = $option .'</option>';
                    echo $option;
                }
            
                ?>
                
            </select>
        </p>

		<?php

	}

	//update widget
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance[ 'post_category' ] = ( !empty( $new_instance[ 'post_category' ] ) ? strip_tags( $new_instance[ 'post_category' ] ) : '' );
        
        return $instance;
    }

	//front end
	public function widget($args, $instance) {

		$cat = $instance[ 'post_category' ];

		// large thumb

        $featured_large_args = array (
            'post_type'        => 'post',
            'posts_per_page'   => 1,
	        'cat'              => $cat
        );

		$featured_large_query = new WP_Query($featured_large_args);

		echo $args['before_widget']; 

		?>
		
		<div class="container">
			<div class="feature-posts">

				<?php 

					// large thumb

						if( $featured_large_query->have_posts() ): 

							while ( $featured_large_query->have_posts() ): $featured_large_query->the_post(); 

						?>

				<div class="col-md-8">
					
					<div class="featured-container">

						<article class="featured-post-item">

							<?php if( has_post_thumbnail() ) {
                          	
                          	 $url = wp_get_attachment_url( get_post_thumbnail_id($featured_large_query->ID) ); ?>

							<figure class="featured-media">
								<a href="<?php the_permalink(); ?>">
									<img class="featured-thumb ft-lg-rect img-zoom" src="<?php echo $url; ?>">
									
								</a>
							</figure>

							<?php  } else { ?>

								<figure class="featured-media">
								<a href="<?php the_permalink(); ?>">
									<img class="featured-thumb ft-lg-rect img-zoom" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAEsCAMAAAACZbH6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozODEwMDA3ODJEQzUxMUU4QkU1REI1QkU0QzM5NDRFNSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDozODEwMDA3OTJEQzUxMUU4QkU1REI1QkU0QzM5NDRFNSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjM4MTAwMDc2MkRDNTExRThCRTVEQjVCRTRDMzk0NEU1IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjM4MTAwMDc3MkRDNTExRThCRTVEQjVCRTRDMzk0NEU1Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+k9jq8QAAADBQTFRFWmRj////mZuc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">
									
								</a>
							</figure>

							
							<?php }  ?>


							<div class="ft-post-content">
								<div class="ft-post-title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title( '<h3 class="featured-entry-title">', '</h3>' ); ?>
										<!-- <h3>Google And Motorola Planning A New Nexsus Phone</h3> -->
									</a>
								</div>

								<div class="ft-post-meta">
									<!-- <span> <i class="fa fa-clock-o"></i> May 15, 2018 </span>
									<span> <i class="fa fa-user"></i> Ashish Yadav </span> -->
									<a href="<?php echo esc_url(get_category_link($cat)); ?>">
										<span class="ft-cat"> <?php echo get_cat_name($cat); ?> </span>
									</a>
								</div>
							</div>
						</article>

						
					</div>

				</div>	

				<?php

					endwhile;
					endif;

				?>

				<?php 

				 $featured_small_args = array (
		            'post_type'        => 'post',
		            'posts_per_page'   => 4,
		            'offset'		   => 1,
			        'cat'              => $cat
			    );

				$featured_small_query = new WP_Query($featured_small_args);

				?>	

				<?php 

				// small thumb

						if( $featured_small_query->have_posts() ): 

							while ( $featured_small_query->have_posts() ): $featured_small_query->the_post(); 

						?>

				<div class="col-md-4">
					
					<div class="feature-container">

						

						<article class="featured-post-item">

							<?php if( has_post_thumbnail() ) {
                          	
                          	 $url = wp_get_attachment_url( get_post_thumbnail_id($featured_large_query->ID) ); ?>

							<figure class="featured-media">
								<a href="<?php the_permalink(); ?>">
									<img class="featured-thumb ft-sm-rect img-zoom" src="<?php echo $url; ?>">
									
								</a>
							</figure>

							<?php } else { ?>

							<figure class="featured-media">
								<a href="<?php the_permalink(); ?>">
									<img class="featured-thumb ft-sm-rect img-zoom" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAEsCAMAAAACZbH6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozODEwMDA3ODJEQzUxMUU4QkU1REI1QkU0QzM5NDRFNSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDozODEwMDA3OTJEQzUxMUU4QkU1REI1QkU0QzM5NDRFNSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjM4MTAwMDc2MkRDNTExRThCRTVEQjVCRTRDMzk0NEU1IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjM4MTAwMDc3MkRDNTExRThCRTVEQjVCRTRDMzk0NEU1Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+k9jq8QAAADBQTFRFWmRj////mZuc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">
									
								</a>
							</figure>

							<?php } ?>

							<div class="ft-post-content">
								<div class="ft-post-title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title( '<h3 class="featured-entry-title">', '</h3>' ); ?>
									</a>
								</div>

								<div class="ft-post-meta">
									<!-- <span> <i class="fa fa-clock-o"></i> May 15, 2018 </span>
									<span> <i class="fa fa-user"></i> Ashish Yadav </span> -->
									<a href="<?php echo esc_url(get_category_link($cat)); ?>">
										<span class="ft-cat"> <?php echo get_cat_name($cat); ?> </span>
									</a>
								</div>
							</div>

						</article>

						

					</div>

				</div>

				<?php

					endwhile;
					endif;

					wp_reset_postdata();

					?>

			</div>
		</div>

		<?php

		 echo $args[ 'after_widget' ];


	}

}

add_action('widgets_init', function() {
	register_widget('Makzine_Featured_Widget');
} );

