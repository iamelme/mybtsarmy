<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mybtsarmy
 */

get_header(); ?>

	<section class="section">
		<div class="section__inner">

			<div class="bts owl-carousel">
			
				<?php 
					global $post;



					$args = [ 
							'posts_per_page'      	=> -1, 
							'orderby'             	=> 'rand', 
							'post__not_in'			=> array (get_the_ID()),	
							'post_type'           	=> 'btsmember'
						];
						 

						$query = new WP_Query( $args );

						
						if ( $query->have_posts() ) :
						 	

						    while ( $query->have_posts() ) :  $query->the_post(); ?>

						
							
								<div class="bts__member item">
									<div class="bts__thumb ">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo thumb_size(get_post_meta( $post->ID, '_thumb_m', true), 'b'); ?>" alt="<?php the_title(); ?>">

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

		
		<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				

			endwhile; // End of the loop.
		?>
	</section>



<?php
get_footer();
