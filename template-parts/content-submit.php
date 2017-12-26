
<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="section__title   t1 t-cnter">', '</h1>' ); ?>
	</header>

	<div class="page__content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mybtsarmy' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<div class="message"></div>
	<div class="form-container">
		
		<form id="user-post" class="form">

			<?php //wp_nonce_field( basename( __FILE__ ), 'user-submitted-inquiry'); ?>

			<div class="form__group">						
				<input type="text" name="user-name" id="user-name"  class="important form__control">
				<label class="form__label" for="user-name">Name</label>
			</div>
			<div class="form__group">
				<input type="email" name="user-email" id="user-email"  class="important form__control">
				<label class="form__label" for="user-email">E-mail</label>
			</div>

			<div class="form__group">
				<input type="text" name="user-link" id="user-link"  class="important form__control form_links" placeholder="https://www.facebook.com/your-photo">
				<label class="form__label" for="user-link">Link (Facebook, Twitter or Instagram only)</label>
			</div>
			
			<div class="form__group">
				<textarea name="user-message" id="user-message" cols="30" class="important form__control form__control-textarea"></textarea>
				<label class="form__label" for="user-message">Description</label>				
			</div>
			

			<div class="form__group">
				<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LccYT4UAAAAAOtNvtfc-5P0sFN4nFTMhaF9jth1"></div>
			</div>
			
			<div class="tx-cnter">
				<input type="submit" id="user-submit-btn" class="btn btn-purple" value="Submit" disabled>
			</div>
		</form>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->



<script>
	'use strict';

	let formLabel = document.querySelectorAll('.form__label'),
		formCtrl = document.querySelectorAll('.form__control');

	formCtrl.forEach((e)=>{

		if(e.value.length !== 0) {
			e.nextElementSibling.classList.add("active");
		} else {
			e.nextElementSibling.classList.remove("active");
		}
			

		e.addEventListener('input', () => {
			// let labelTarget = e.getAttribute('for');
			
			// e.classList.add("active");
			// alert("wew");
			e.nextElementSibling.classList.add("active");
		});
	});


</script>

