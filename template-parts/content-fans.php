
<?php global $wp;
$current_page = home_url( $wp->request );  ?>




	




	<section class="section">
		<div class="">

			


			



			<!-- <div class="meta">
				<div class="share">
					<div class="fb-like share__btn" data-href="<?php echo $current_page; ?>" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>

					<a class="twitter-share-button share__btn" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(the_title()) . ' #myBTSarmy'; ?>" data-size="large">Tweet</a>
				</div>

				<div><?php echo getPostViews(get_the_ID()); ?>	</div>
			</div> -->


			<div class="main">
				<div class="content">
					
					<div class="fan">
						<div class="fan__thumb">
							<?php the_post_thumbnail(); ?>	
							
						</div>

						
						
					</div>

					<div class="">
						<div class="fan__heading">
							<div class="fan__heading-left">
								<?php the_title(); ?>
								<?php echo get_simple_likes_button( get_the_ID() ); ?>

								<div class="meta">								
									<div class="meta__item">
										<?php the_date(); ?>
									</div>
									<div class="meta__item">
										<?php echo getPostViews(get_the_ID()); ?>	views
									</div>
								</div>
							</div>

							<div class="fan__heading-right">
								<div class="share">
									<div class="fb-share-button share__btn" data-href="<?php echo $current_page; ?>" data-layout="button" data-action="share" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_page; ?>&amp;src=sdkpreparse">Share</a></div>

									<a class="twitter-share-button share__btn" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(the_title()) . ' #myBTSarmy'; ?>" data-size="large">Tweet</a>
								</div>
							</div>
						</div>	
						<?php the_content(); ?>
						
					</div>	
				</div>
				<aside class="sidebar">

					<div class="comment">
						<div class="fb-comments" data-href="<?php echo $current_page; ?>" data-numposts="7" data-width="100%"></div>
					</div>
					
				</aside>
			</div>

				

			
			<h2 class="t">Other fans</h2>
			<div class="related">
				
				<?php $currentID = get_the_ID();

					$args = ['posts_per_page'      => 5, 
							'post_type'           => 'fans',
							'post__not_in' => array($currentID)
					];

					// Query this by weekly

					$query = new WP_Query( $args );

					
					if ( $query->have_posts() ) :

						while($query->have_posts()) : $query->the_post(); ?>

						<div class="fans__thumb">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail('medium'); ?>	
								<div><?php the_title(); ?></div>
								<?php echo getPostViews(get_the_ID()); ?>
							</a>
						</div>


				<?php endwhile;
					endif; ?>
			</div>


			

		</div>
	</section>