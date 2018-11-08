<?php 
	/* 
	** @package makzine
	** Content
	*/

?>
				<div class="archive-post">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<div class="makzine-archive">
							<figure class="makzine-entry-media">
								<?php if( has_post_thumbnail() ): ?>
									<div class="makzine-thumbnail">
										<a href="<?php the_permalink(); ?>">
							        		<?php the_post_thumbnail('medium',array('class' => 'img-zoom')); ?>
							            </a>
									</div>
								<?php endif; ?>
							</figure>
							
							<div class="makzine-entry-content">
								<div class="makzine-entry-title">
									<?php the_title( '<h3><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h3>' ) ?>
								</div>

								<div class="makzine-post-meta">
								<ul>
									<li>
										<i class="fa fa-calendar"></i> 
										<?php echo get_the_date(__('M d, Y', 'makzine')); ?>
									</li>

									<li>
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
											<i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?>
										</a>
									</li>

									<li>
										<i class="fa fa-folder" aria-hidden="true"></i>
										<?php echo makzine_categories(); ?>
									</li>

									<li>
										<i class="fa fa-comments" aria-hidden="true"></i> 
										<?php comments_number('0', '1', '%'); ?>
									</li>

								</ul>
							</div>

								<div class="makzine-entry-excerpt">
									<?php echo wp_trim_words( get_the_content(), 45, '...' ); ?>
								</div>

								<div class="read-more">
									<a href="<?php the_permalink(); ?>" class="read-more-btn"> Read More <i class="fa fa-angle-double-right"></i></a>
								</div>

							</div>
						</div>

					</article>

				</div>