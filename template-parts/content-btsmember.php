<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post__header">
		
		<div class="post__thumb">
			<?php the_post_thumbnail( 'medium' ); ?>
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