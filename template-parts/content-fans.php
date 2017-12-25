

<?php global $wp;
$current_page = home_url( $wp->request );  ?>



	




	<section class="section">
		<div class="">



			<div class="main">
				<div class="content">
					
					<div class="fan">
						<div class="fan__thumb">
							<?php the_post_thumbnail('full'); ?>	
							
						</div>

						<div class="overlay">
							<span class="fan__love">
								<?php echo get_simple_likes_button( get_the_ID() ); ?>
							</span>
						</div>
						
					</div>

					<div class="clx">
						<div class="fan__heading">
							<div class="fan__heading-left">
								<?php the_title(); ?>
								

								<div class="meta">							
									<div class="meta__item">
										<svg class="icon icon-calendar"><use xlink:href="#icon-calendar"></use></svg>
										<span><?php the_date(); ?></span>
									</div>
									<div class="meta__item">
										<svg class="icon icon-eye"><use xlink:href="#icon-eye"></use></svg>
										<span><?php echo getPostViews(get_the_ID()); ?>	views</span>
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
						
						
					</div>	

					<div class="clx fans-other">
						<h2 class="t">Other fans</h2>
						<div class="related">
							
							<?php $currentID = get_the_ID();

								$args = [
									'posts_per_page'      => 4, 
									'post_type'           => 'fans',
									'post__not_in' => array($currentID)
								];

								// Query this by weekly

								$query = new WP_Query( $args );

								
								if ( $query->have_posts() ) :

									while($query->have_posts()) : $query->the_post(); ?>

									<div class="fans__thumb">
										<div class="fans__thumb--inner" style="background: url(<?php the_post_thumbnail_url('full'); ?>) no-repeat <?php echo get_post_meta( $post->ID, 'hor', true) ? get_post_meta( $post->ID, 'hor', true) : 'center' ?> <?php echo get_post_meta( $post->ID, 'ver', true) ? get_post_meta( $post->ID, 'ver', true) : 'center' ?> / cover">
											<div class="overlay">
												<div><?php the_title(); ?></div>
												<svg class="icon icon-eye"><use xlink:href="#icon-eye"></use></svg>
												<span class="view-count"><?php echo getPostViews(get_the_ID()); ?>	views</span>
												<?php echo get_simple_likes_button( get_the_ID() ); ?>
											</div>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="fans__thumb--link"></a>
										</div>
									</div>


							<?php endwhile;
							wp_reset_query();
								endif; ?>
						</div>
					</div>
				</div>
				<aside class="sidebar">
					<div class="info">
						<?php the_content(); ?>
					</div>
					<div class="comment">
						
						<p><strong>Please be respectful to all :)</strong></p>
						<div class="fb-comments" data-href="<?php echo $current_page; ?>" data-numposts="7" data-width="100%"></div>
					</div>
					
				</aside>
			</div>

				

			
			


			

		</div>
	</section>
