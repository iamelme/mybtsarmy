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

	<?php 
		// $obj_fb = json_decode( file_get_contents( 'http://graph.facebook.com/?id='.get_permalink() ) );
		// $comment_fb = $obj_fb->shares;
		// update_post_meta($post->ID, 'fb_likes', $comment_fb, false); 

		// print_r($obj_fb);


	?>


		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			

		endwhile; // End of the loop.
		?>



<?php
get_footer();
