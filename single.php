<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mybtsarmy
 */

get_header(); ?>

<?php setPostViews(get_the_ID()); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			

			
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->


	<section class="section section--grey">
		<div class="section__inner">
			<div class="card">
				<?php $currentID = get_the_ID();

					$args = [
						'posts_per_page'      => 2, 
						'post_type'           => 'post',
						'post__not_in' => array($currentID)
					];

					// Query this by weekly

					$query = new WP_Query( $args );


					if ( $query->have_posts() ) :

						while($query->have_posts()) : $query->the_post(); ?>

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
					wp_reset_query();
					endif; ?>
			</div>
		</div>
	</section>

	<div class="comment">						
		<div class="fb-comments" data-href="<?php echo $current_page; ?>" data-numposts="7" data-width="100%"></div>
	</div>

<?php
get_footer();
