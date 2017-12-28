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

global $wp;
$current_page = home_url( $wp->request );  
$title = get_post_meta( $post->ID, 'seo_title', true);
$desc = get_post_meta( $post->ID, 'meta_desc', true);

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="fb:app_id" content="1223316871103396" />
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php 

	?>


	<title><?php echo $title; ?></title>
	<meta property="og:locale"             content="en_US" />
	<meta property="og:url"                content="<?php echo $current_page; ?>" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="<?php echo $title; ?>" />
	<meta property="og:description"        content="<?php echo $desc; ?>" />
	<meta property="og:image"              content="<?php the_post_thumbnail_url( 'full' ); ?>" />
	<meta property="og:site_name" 		   content="<?php bloginfo( 'name' ); ?>" />
	<meta name="twitter:card" 			   content="summary_large_image" />
	<meta name="twitter:title" 			   content="<?php echo $title; ?>" />
	<meta name="twitter:image" 			   content="<?php the_post_thumbnail_url( 'full' ); ?>" />

	<?php wp_head(); ?>

	

	<?php	if(is_page('submit') ) : ?>
		<script src='https://www.google.com/recaptcha/api.js' async defer></script>	
	<?php	endif;	?>

</head>

<body <?php body_class(); ?>>
<?php get_template_part( 'inc/icons'); ?>
<div class="wrap">


	<header class="header">
		<div class="header__inner">
			<nav class="main-menu menu">
				<?php
					// wp_nav_menu( array(
					// 	'theme_location' => 'menu-1',
					// 	'menu_id'        => 'primary-menu',
					// ) );
				?>

				<div class="menu__inner menu__inner-left">
					<a href="<?php echo home_url(); ?>/fans" class="menu-item">Fans</a>
				</div>
				<div class="menu__inner menu__inner-center">
					<a href="<?php echo home_url(); ?>" class="branding">
						<svg id="bts"  x="0px" y="0px"
							width="80px" height="76.75px" viewBox="0 0 80 76.75" enable-background="new 0 0 80 76.75" xml:space="preserve">
							<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="6.1553" y1="32.0459" x2="6.1553" y2="49.7124">
								<stop offset="0%" stop-color="#ededed">
									<animate attributeName="stop-color" values="#ededed; #999; #ededed" dur="4s" repeatCount="indefinite"></animate>
								</stop>					
								<stop offset="100%" stop-color="#999">
									<animate attributeName="stop-color" values="#999; #ededed; #999" dur="4s" repeatCount="indefinite"></animate>
								</stop>
							</linearGradient>
							<polygon fill="url(#SVGID_1_)" points="7.676,36.886 12.311,36.991 8.61,39.783 9.941,44.221 6.144,41.564 2.333,44.201 
								3.686,39.771 0,36.959 4.634,36.877 6.167,32.504 "/>
							<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="73.8447" y1="32.0459" x2="73.8447" y2="49.7124">
								<stop offset="0%" stop-color="#ededed">
									<animate attributeName="stop-color" values="#ededed; #999; #ededed" dur="4s" repeatCount="indefinite"></animate>
								</stop>					
								<stop offset="100%" stop-color="#999">
									<animate attributeName="stop-color" values="#999; #ededed; #999" dur="4s" repeatCount="indefinite"></animate>
								</stop>
							</linearGradient>
							<polygon fill="url(#SVGID_2_)" points="75.368,36.886 80,36.991 76.299,39.783 77.631,44.221 73.834,41.563 70.023,44.202 
								71.376,39.771 67.689,36.959 72.323,36.878 73.856,32.504 "/>
							<linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="27.1304" y1="1.0313" x2="27.1304" y2="75.6069">
								<stop offset="0%" stop-color="#ededed">
									<animate attributeName="stop-color" values="#ededed; #999; #ededed" dur="4s" repeatCount="indefinite"></animate>
								</stop>					
								<stop offset="100%" stop-color="#999">
									<animate attributeName="stop-color" values="#999; #ededed; #999" dur="4s" repeatCount="indefinite"></animate>
								</stop>
							</linearGradient>
							<polygon fill="url(#SVGID_3_)" points="17.207,68.759 37.054,76.25 37.054,0.476 17.207,17.457 "/>
							<linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="191.6016" y1="1.0313" x2="191.6016" y2="75.6069">
								<stop offset="0%" stop-color="#ededed">
									<animate attributeName="stop-color" values="#ededed; #999; #ededed" dur="4s" repeatCount="indefinite"></animate>
								</stop>					
								<stop offset="100%" stop-color="#999">
									<animate attributeName="stop-color" values="#999; #ededed; #999" dur="4s" repeatCount="indefinite"></animate>
								</stop>
							</linearGradient>
							<polygon fill="url(#SVGID_4_)" points="201.524,68.759 181.678,76.25 181.678,0.476 201.524,17.457 "/>
							<line fill="none" x1="40.218" y1="38.645" x2="40.218" y2="38.081"/>
							<g>
								<linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="51.6016" y1="46.0283" x2="51.6016" y2="55.7028">
									<stop  offset="0" style="stop-color:#A3A3A3"/>
									<stop  offset="1" style="stop-color:#666666"/>
								</linearGradient>
								<polygon fill="#fff" points="41.678,53.445 41.678,55.786 61.524,48.297 61.524,45.956 	"/>
								<linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="51.6016" y1="50.7373" x2="51.6016" y2="60.4128">
									<stop  offset="0" style="stop-color:#A3A3A3"/>
									<stop  offset="1" style="stop-color:#666666"/>
								</linearGradient>
								<polygon fill="#fff" points="61.524,53.007 61.524,50.665 41.678,58.154 41.678,60.496 	"/>
								<linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="51.6016" y1="0.8467" x2="51.6016" y2="50.6479">
									<stop  offset="0" style="stop-color:#A3A3A3"/>
									<stop  offset="1" style="stop-color:#666666"/>
								</linearGradient>
								<polygon fill="#fff" points="61.524,43.588 61.524,17.457 41.678,0.476 41.678,51.077 	"/>
								<linearGradient id="SVGID_8_" gradientUnits="userSpaceOnUse" x1="51.6016" y1="55.5283" x2="51.6016" y2="76.073">
									<stop  offset="0" style="stop-color:#A3A3A3"/>
									<stop  offset="1" style="stop-color:#666666"/>
								</linearGradient>
								<polygon fill="#fff" points="41.678,62.864 41.678,76.25 61.524,68.759 61.524,55.375 	"/>
							</g>
						</svg>				
					</a>
				</div>
				<div class="menu__inner menu__inner-right">
					<a href="<?php echo home_url(); ?>/submit" class="menu-item">Submit</a>
				</div>
				

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

	<?php elseif( !is_page('submit')) : ?>
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
	<div class="wrapper__inner">
