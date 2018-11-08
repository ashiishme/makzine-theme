<?php 
	/* 
	** @package makzine
	** Makzine About Us
	*/

class Makzine_About_Us extends WP_Widget {
	
	function __construct() {
		
		$options = array(
			'classname' => 'makzine-about-us',
			'description' => 'Makzine About Us',
		);

		parent::__construct('makzine_about_us', 'Makzine About Us', $options);

	}

	// back end
	public function form($instance) {
		
		$title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

		$description = ( !empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '' );



		?>

		 <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'makzine' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'makzine' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text"><?php echo $description; ?></textarea>
        </p>

		<?php

	}

	//update widget
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
        $instance[ 'description' ] = ( !empty( $new_instance[ 'description' ] ) ? strip_tags( $new_instance[ 'description' ] ) : '' );        
        return $instance;
    }

	//front end
	public function widget($args, $instance) {

		

		echo $args['before_widget']; 

		?>

					<?php
                        if( !empty( $instance[ 'title' ] ) ):

                        	

                            echo $args[ 'before_title' ];

                            ?>

                            <?php echo apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base ); ?>

                            <?php

                            echo $args[ 'after_title' ];
                                        
                        endif; 
                    ?>

					<div class="footer-widget-content">

						<p>

							<?php echo $instance[ 'description' ]; ?>

						</p>
							
					</div>
	

				

		<?php

		 echo $args[ 'after_widget' ];


	}

}

function makzine_about() {
	register_widget('Makzine_About_Us');
}

add_action('widgets_init', 'makzine_about');

