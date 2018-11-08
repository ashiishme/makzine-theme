<?php 
	/* 
	** @package makzine
	** Sidebar
	*/

	if(!is_active_sidebar('makzine-sidebar')) {
		return;
	}

	?>

	<section id="secondary" class="sidebar-widgets" role="complementary">
		<div class="sidebar">

	<?php

 		dynamic_sidebar('makzine-sidebar'); 


 	?>

 		</div>
 	</section>





					
 