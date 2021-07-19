<!DOCTYPE html>
<!--[if lt IE 9 ]> <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js ie9 lt-ie10" ><![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True"/>
		<meta name="MobileOptimized" content="320"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f"/>
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png"/>
    <meta name="theme-color" content="#121212"/>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<style>
		<?php /* include 'library/css/build/minified/lp-critical.css'; */ ?>
		</style>

		<?php wp_head(); ?>
		<?php /*<script>!function(a){"use strict";var b=function(b,c,d){function j(a){return e.body?a():void setTimeout(function(){j(a)})}function l(){f.addEventListener&&f.removeEventListener("load",l),f.media=d||"all"}var g,e=a.document,f=e.createElement("link");if(c)g=c;else{var h=(e.body||e.getElementsByTagName("head")[0]).childNodes;g=h[h.length-1]}var i=e.styleSheets;f.rel="stylesheet",f.href=b,f.media="only x",j(function(){g.parentNode.insertBefore(f,c?g:g.nextSibling)});var k=function(a){for(var b=f.href,c=i.length;c--;)if(i[c].href===b)return a();setTimeout(function(){k(a)})};return f.addEventListener&&f.addEventListener("load",l),f.onloadcssdefined=k,k(l),f};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);</script>
		<script>loadCSS( "/wp-content/themes/uwa/library/css/build/minified/lp-style.css" );</script>
<noscript><link rel="stylesheet" href="/wp-content/themes/uwa/library/css/build/minified/lp-style.css"></noscript> */ ?>
<link rel="stylesheet" href="/wp-content/themes/uwa/library/css/build/minified/lp-style.css">


	</head>

	<body <?php body_class(); ?> itemtype="http://schema.org/WebPage" itemscope>


		<div class="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<?php
					$image = get_field('banner_image');
					$url = $image['url'];
				?>

				<div class="banner" style="background-image: url(<?php echo $url; ?>);">

					<div class="wrap">

						<div class="mobile-nav">
							<a role="button" class="mobile-nav__link ppcphone" href="tel:8444056365"><span><img src="/wp-content/themes/uwa/library/images/icon-phone.svg" role="presentation" alt=""></span> (844) 405-6365</a>
							<a class="mobile-nav__link scroll" href="#step-form"><span>Request Info</span></a>
						</div>

							<h1 class="logo header__logo" itemscope itemtype="http://schema.org/Organization"><img src="<?php the_field('logo', 'option'); ?>" alt="UWA Online"></h1>
							<div class="banner__text">
								<h2><?php the_field('banner_heading'); ?></h2>
							</div>

					</div>

				</div>

				<a role="button" aria-label="Click to speak to an advisor now" class="tel-link ppcphone" href="tel:8444056365"><img src="/wp-content/themes/uwa/library/images/icon-phone.svg" role="presentation" alt=""><span id="speakNowText"> Speak to an advisor now</span> (844) 405-6365</a>

				<?php the_field('form_script'); ?>

			</header>
