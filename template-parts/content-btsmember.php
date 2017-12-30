<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post__header">
		
		<div class="post__thumb">
			<img src="<?php echo get_post_meta( $post->ID, '_thumb_m', true); ?>" alt="<?php the_title(); ?>">
		</div>
		<h1 class="tx-cnter t-light"><?php the_title(); ?></h1>
		
	</header>

	<div class="post__content">
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

		?>

		<div class="comment">			
			<div class="fb-comments" data-href="<?php echo $current_page; ?>" data-numposts="7" data-width="100%"></div>
		</div>
	</div>


	


</article>


<script>
	(function () {
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
	}());
	

	


</script>