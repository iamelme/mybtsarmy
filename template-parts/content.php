<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

?>
<?php global $wp;
$current_page = home_url( $wp->request );  ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post__header">
		<h1 class="tx-cnter"><?php the_title(); ?></h1>
		<div class="post__thumb">
			<img src="<?php echo get_post_meta( $post->ID, '_thumb_f', true); ?>" alt="<?php the_title(); ?>">
		</div>
		<div class="post__heading">
			<div class="post__heading-left">
				
				<div class="meta">			
					<div class="meta__item">
						<?php echo get_avatar( 'elme.delossantos@gmail.com', 40 ); ?> 
						<span> Aejeong </span>	
					</div>							
					<div class="meta__item">
						
						<span> / <?php the_date('M j, Y'); ?></span>
					</div>					
				</div>
			</div>
			<div class="post__heading-right">
								
				<div class="share">
					<div class="url"><span class="url-btn btn btn-purple">Copy</span><span class="url-copied">Copied</span><input type="text" value="<?php echo $current_page; ?>" class="url-input"></div>
					<div class="fb-share-button share__btn" data-href="<?php echo $current_page; ?>" data-layout="button" data-action="share" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_page; ?>&amp;src=sdkpreparse">Share</a></div>

					<a class="twitter-share-button share__btn" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(the_title()) . ' #myBTSarmy'; ?>" data-size="large">Tweet</a>
				</div>
			</div>
		</div>
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


		let parentGal = document.querySelectorAll('.gallery'),
			urlInput = document.querySelector('.url-input'),
			urlBtn = document.querySelector('.url-btn'),
			urlCopied = document.querySelector('.url-copied');

		(function () {
			urlInput.select();
			urlBtn.addEventListener('click', (e) => {		
				urlInput.select();		
				document.execCommand('copy');
				urlCopied.classList.add('active');

				setTimeout(()=>{ 
					urlCopied.classList.remove('active');
				}, 1500);
			});
		}());


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