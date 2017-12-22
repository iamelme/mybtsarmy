<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

get_header(); ?>

	<section class="section">
		<div class="section__inner">

			<div class="bts">
			
				<?php 

					$args = [ 
						    'posts_per_page'      => 7, 
						    'orderby'             => 'rand', 
						    'post_type'           => 'btsmember'
						];
						 

						$query = new WP_Query( $args );

						
						if ( $query->have_posts() ) :
						 	

						    while ( $query->have_posts() ) :  $query->the_post(); ?>

						
							
								<div class="bts__member">
									<div class="bts__thumb ">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
										
									</div>
									<div class="bts__name">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_title(); ?>
										</a>
									</div>
								</div>
							


						<?php endwhile;

						wp_reset_postdata();

						endif; ?>
			</div>

		</div>
	</section>

	<section class="section section--padded">
		<div class="section__inner section__inner2">

			<h1 class="section__title section__title--v">Featured</h1>
			
			<div class="featured">
				<?php 

				


				print_r($obj_fb);

				$args = [ 
					    'posts_per_page'      => 5, 
					    'post_type'           => 'fans',
					    'meta_key' => 'fb_likes',
	    				'orderby' => 'meta_value_num',
	    				'order' => 'DESC'
					];
					 

					$query = new WP_Query( $args );

					
					if ( $query->have_posts() ) :
					 	

					    while ( $query->have_posts() ) :  $query->the_post(); ?>

						
		
						
							<div class="featured__item ">
								<div class="featured__item-inner imgTarget" data-hor="<?php echo $hor = get_post_meta( $post->ID, 'hor', true); ?>" data-ver="<?php echo $ver = get_post_meta( $post->ID, 'ver', true); ?>">
									<?php the_post_thumbnail(null, array('class' => 'imgSrc')); ?>	
								</div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured__link"></a>
							</div>
						


					<?php endwhile;

					wp_reset_postdata();

					endif; ?>

					<div class="featured__item featured__item--unique">
						<div class="featured__item-inner">
							<h2 class="h1 tx-c-white">
								Share &amp;<br>
								Be Featured <br>
								of the Week.
							</h2>

							<p><strong>SUBMIT A LINK OF YOUR PHOTOS OR VIDEOS</strong></p>
						</div>
						<a href="" class="featured__link"></a>
					</div>

			</div>

		</div>
	</section>


	<section class="section section--padded section--stroke">
		<div class="section__inner">
			
			<div class="card">
				<?php 

				$args = [ 
					    'posts_per_page'      => 6, 
					    'post_type'           => 'post',
					];
					 

					$query = new WP_Query( $args );


					$count = 0;

					
					if ( $query->have_posts() ) :
					 	

					    while ( $query->have_posts() ) :  $query->the_post(); ?>
							

							<?php $count++; ?>
	
							<div class="card__item">
								<div class="card__item--inner">
									<div class="card__thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
									<div class="card__content">
										<div class="card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
										<div class="card__meta">
											<span class="date"><?php the_date('M j, Y'); ?></span>
											<span class="comment"></span>
											<span class="views">
												<?php echo getPostViews(get_the_ID()); ?>															
											</span>
										</div>
									</div>
								</div>
							</div>

				<?php endwhile;

					wp_reset_postdata();

					endif; 


					echo $count > 6 ? '<a href="" class="btn btn-white-o">View More</a>' : '';

				?>

				</div>

			</div>

		</div>
	</section>

	<script>

		let imgTarget = document.getElementsByClassName("imgTarget"),
			imgSrc = document.getElementsByClassName("imgSrc");

		function setBackground(from, to, option){
				Array.prototype.map.call(from, (el, idx) => {

					if(typeof(from) != 'undefined' && from != null) {

						let hor = to[idx].dataset.hor !== "" ? to[idx].dataset.hor : 'center',
							ver = to[idx].dataset.ver !== "" ? to[idx].dataset.ver : 'center';

						to[idx].style.background = "url(" + el.src + ") " + ver + " " + hor + " / cover no-repeat";
						if(option == "none") {
							el.style.display = "none"; } 
						else { 
							el.style.opacity = 0;
						}
					}
				});				
			}

			setBackground(imgSrc, imgTarget, "none");

	</script>

<?php
get_footer();
