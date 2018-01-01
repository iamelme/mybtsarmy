<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mybtsarmy
 */

?>

	</div>

	<footer class="footer">
		<div class="social ">
			<a href="https://www.facebook.com/My-BTS-Army-2104957976393011/" class="social__item" target="_blank">
				<svg class="icon icon-facebook">
				  <use xlink:href="#icon-facebook"></use>
				</svg>
			</a>
			<a href="https://twitter.com/mybtsarmytweet" class="social__item" target="_blank">
				<svg class="icon icon-twitter">
				  <use xlink:href="#icon-twitter"></use>
				</svg>
			</a>
			<a href="" class="social__item" target="_blank">
				<svg class="icon icon-instagram">
				  <use xlink:href="#icon-instagram"></use>
				</svg>
			</a>		
			
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

<?php if(is_front_page() || is_home() || is_singular( 'btsmember' )) :
	
	$itemNum = 7;

	if(is_singular( 'btsmember' )) {
		$itemNum = 6;
	}
	
?>
	

<script>

		document.addEventListener('DOMContentLoaded', (function(){
			'user strict';			

			$('.owl-carousel').owlCarousel({
			    margin: 10,
			    responsive : {
				    0 : {
			       		items: 2,
			       		autoplay: true,
			       		autoplayTimeout: 2300
				    },
				    480 : {
				        items: 3,
				        autoplay: true,
			       		autoplayTimeout: 2300
				    },
				    768 : {
				       	items: <?php echo $itemNum; ?>,
				    }
				}
			});
			


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


		})() );
	</script>
<?php endif; ?>
</body>
</html>
