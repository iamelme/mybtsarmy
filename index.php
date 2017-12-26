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

			<div class="bts owl-carousel">
			
				<?php 

					$args = [ 
						    'posts_per_page'      => 7, 
						    'orderby'             => 'rand', 
						    'post_type'           => 'btsmember'
						];
						 

						$query = new WP_Query( $args );

						
						if ( $query->have_posts() ) :
						 	

						    while ( $query->have_posts() ) :  $query->the_post(); ?>

						
							
								<div class="bts__member item">
									<div class="bts__thumb ">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail('thumbnail'); ?>
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

			<h1 class="section__title section__title--v">Featured Fans</h1>
			
			<div class="featured">
				<?php 

				


				// print_r($obj_fb);

				$args = [ 
					    'posts_per_page'      => 5, 
						'post_type'           => 'fans',
						'date_query' 			=> array(
							array(
								'year' 			=> date( 'Y' ),
								'week' 			=> date( 'W' ),
							),
						),
					    'meta_key' => '_post_like_count',
	    				'orderby' => 'meta_value_num',
	    				'order' => 'DESC'
					];
					 

					$query = new WP_Query( $args );

					
					if ( $query->have_posts() ) :
					 	

					    while ( $query->have_posts() ) :  $query->the_post(); ?>

							<div class="featured__item ">
								<div class="featured__item-inner " style="background: url(<?php the_post_thumbnail_url('full'); ?>) no-repeat <?php echo get_post_meta( $post->ID, 'hor', true) ? get_post_meta( $post->ID, 'hor', true) : 'center' ?> <?php echo get_post_meta( $post->ID, 'ver', true) ? get_post_meta( $post->ID, 'ver', true) : 'center' ?> / cover">
									
								</div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured__link"></a>
							</div>
						

					<?php endwhile;

					wp_reset_postdata();

					endif; ?>

					<div class="featured__item featured__item--unique">
						<div class="featured__item-inner">
							<h2 class="h1 tc-white">
								Share &amp;<br>
								Be Featured <br>
								of the Week.
							</h2>

							<p><strong>SUBMIT A LINK OF YOUR PHOTOS</strong></p>
						</div>
						<a href="<?php echo home_url(); ?>/submit" class="featured__link"></a>
					</div>

			</div>

		</div>
	</section>


	<section class="section section--padded section--stroke">
		<div class="section__inner">

			<h1 class="tc-white tx-cnter">Latest News</h1>
			<p class="tc-white tx-cnter">Something to read</p>
			
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
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<div class="card__thumb " style="background: url(<?php the_post_thumbnail_url('full'); ?>) no-repeat <?php echo get_post_meta( $post->ID, 'hor', true) ? get_post_meta( $post->ID, 'hor', true) : 'center' ?> <?php echo get_post_meta( $post->ID, 'ver', true) ? get_post_meta( $post->ID, 'ver', true) : 'center' ?> / cover">																					
										</div>
									</a>
									<div class="card__content">
										<div class="card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
										<!-- <div class="card__meta">
											<span class="comment"></span>											
										</div> -->
									</div>
								</div>
							</div>

				<?php endwhile;

					wp_reset_postdata();

					endif; 					

				?>

				</div>


				<?php echo $count > 6 ? '<div class="tx-cnter"><a href="" class="btn btn-default">READ MORE</a></div>' : ''; ?>

			</div>

		</div>
	</section>

	

<?php
get_footer();
