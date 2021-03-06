<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

get_header(); ?>

	<section  class="section section--padded">
        <h1 class="tx-cnter">Fans of the week</h1>
        <p class="tx-cnter">Please vote for your favourite fans</p>
		<main class="fans-container">

        




			<?php

			$currentPage = ( get_query_var('paged') ) ? get_query_var('paged') : 1;


			/* Start the Loop */
			$args = [ 
				'paged' 				=> $currentPage,
				'posts_per_page'      	=> 5, 
				'post_status' 			=> 'publish',
				'post_type'           	=> 'fans',
				'date_query' 			=> array(
					array(
						'year' 			=> date( 'Y' ),
						'week' 			=> date( 'W' ),
					),
				),
				'meta_query' 			=> array(
					'relation' 		=> 'OR',
					array(
						'key' 		=> '_post_like_count',
						'compare'	=> '>='
					),
					array(
						'key' 		=> '_post_like_count',
						'compare' 	=> 'NOT EXISTS',
						'value'		=> 'null'
					)
				),
				'orderby'				=> 'meta_value_num'
			];
			 
			
			$query = new WP_Query( $args );
			
			
			if ( $query->have_posts() ) :
			
				while ( $query->have_posts() ) :  $query->the_post(); 

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

			
				get_template_part( 'template-parts/content-archive-fans' );

			endwhile; ?>

				<div class="paginate">
					<div class="paginate__inner">
						<?php 
							echo paginate_links(array(
							'total' 	=> $query->max_num_pages,
							'prev_text' => __('&larr;'),
							'next_text' => __('&rarr;'),
							));
						?>
					</div>
				</div>	

		<?php
			wp_reset_postdata();
		endif; ?>

		</main>
	</section>
	
	<!-- <?php $args = array(
	'type'            => 'weekly',
	'limit'           => '',
	'format'          => 'html', 
	'before'          => '',
	'after'           => '',
	'show_post_count' => true,
	'echo'            => 1,
	'order'           => 'DESC',
        'post_type'     => 'fans'
);
wp_get_archives( $args ); ?> -->

<?php
get_footer();
