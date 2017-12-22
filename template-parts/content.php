<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mybtsarmy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mybtsarmy' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mybtsarmy' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mybtsarmy_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->



<script>
	'user strict';


	let parentGal = document.querySelectorAll('.gallery');


	parentGal.forEach((el,i)=>{
		let galleryLink = el.getElementsByTagName('a');
		

		function setAttributes(el, attrs) {
			for(var key in attrs) {
				el.setAttribute(key, attrs[key]);
			}
		}


		for(var x = 0; x < galleryLink.length; x++) {

			let galCaption = galleryLink[x].parentNode.nextElementSibling;

			setAttributes(galleryLink[x], {"data-lightbox" : el.id, "data-title" : galCaption != null ? galCaption.innerHTML : ''} );
		}

	});

</script>