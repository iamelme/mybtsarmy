<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mybtsarmy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="fb:app_id" content="1223316871103396" />
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php get_template_part( 'inc/icons'); ?>
<div class="wrap">


	<header class="header">
		<div class="header__inner">
			<nav class="main-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav>
		</div>		
	</header>


	<?php if(is_home()) : ?>
		<div class="social social-side">
			<a href="https://www.facebook.com/My-BTS-Army-2104957976393011/" target="_blank" class="social__item" title="Follow Us">
				<svg class="icon icon-facebook">
				<use xlink:href="#icon-facebook"></use>
				</svg>
			</a>
			<a href="" target="_blank" class="social__item" title="Follow Us">
				<svg class="icon icon-twitter">
				<use xlink:href="#icon-twitter"></use>
				</svg>
			</a>
			<a href="" target="_blank" class="social__item" title="Follow Us">
				<svg class="icon icon-instagram">
				<use xlink:href="#icon-instagram"></use>
				</svg>
			</a>		
			
		</div>

	<?php else : ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		t._e = [];
		t.ready = function(f) {
			t._e.push(f);
		};

		return t;
		}(document, "script", "twitter-wjs"));</script>
	<?php endif; ?>
	<div class="">
