<!DOCTYPE html>
<!--[if lt IE 9 ]> <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js ie9 lt-ie10" ><![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<link rel="stylesheet" href="/wp-content/themes/uwa/library/css/build/minified/lp-style.css">

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div class="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div class="banner" style="background-image: url(<?php the_field('banner_image'); ?>);">

					<div class="mobile-nav">
						<a class="mobile-nav__link" href="tel:<?php echo str_replace(' ', '', get_field('phone_number', 'option')); ?>"><span><img src="/wp-content/themes/uwa/library/images/icon-phone.svg" role="presentation" alt=""></span> <?php the_field('phone_number', 'option'); ?></a>
						<a class="mobile-nav__link scroll" href="#step-form"><span>Request Info</span></a>
					</div>

						<h1 class="logo header__logo" itemscope itemtype="http://schema.org/Organization"><img src="<?php the_field('logo', 'option'); ?>" alt="UWA Online"></h1>
						<h2><?php the_field('banner_heading'); ?></h2>

				</div>

				<a class="tel-link" href="tel:<?php echo str_replace(' ', '', get_field('phone_number', 'option')); ?>"><img src="/wp-content/themes/uwa/library/images/icon-phone.svg" role="presentation" alt=""><span> Speak to an advisor now</span> <?php the_field('phone_number', 'option'); ?></a>

				<?php the_field('form_script'); ?>

			</header>
