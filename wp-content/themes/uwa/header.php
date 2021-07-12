<!doctype html>
<html lang="en" class="fonts-loaded">


<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">
   
	<?php // Optimizely script ?>  
	<script src="https://cdn.optimizely.com/public/523170811/s/UWA_Main.js"></script>

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

		<!--  Only load on requestinfo page and single degrees  -->

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.js"></script>


		<?php // end of wordpress head ?>

    <!--  Critical CSS -->
		<?php require_once( 'critical-css-injection.php' ); ?>

		<style media="screen">
			.priority-nav {
				max-height: 98px;
			}
			.subpagesNav.hasSiblingPages > li {
				display: inline-block;
			}
	</style>
		<style media="screen">
		.searchbox__wrapper {
		  position: fixed;
		  top: 0;
		  background: rgba(15, 14, 14, 0.66);
		  padding: 1em;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  z-index: 99999;
		  -webkit-transition: all 0.4s ease;
		  transition: all 0.4s ease;
		  -webkit-transform: translateY(-120%);
		          transform: translateY(-120%);
		  display: -webkit-box;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-pack: center;
		      -ms-flex-pack: center;
		          justify-content: center;
		  -webkit-box-align: center;
		      -ms-flex-align: center;
		          align-items: center;
		  visibility: hidden;
		}
		</style>

		<script>
		    ! function(a) {
		        "use strict";
		        var b = function(b, c, d) {
		            function j(a) {
		                return e.body ? a() : void setTimeout(function() {
		                    j(a)
		                })
		            }

		            function l() {
		                f.addEventListener && f.removeEventListener("load", l), f.media = d || "all"
		            }
		            var g, e = a.document,
		                f = e.createElement("link");
		            if (c) g = c;
		            else {
		                var h = (e.body || e.getElementsByTagName("head")[0]).childNodes;
		                g = h[h.length - 1]
		            }
		            var i = e.styleSheets;
		            f.rel = "stylesheet", f.href = b, f.media = "only x", j(function() {
		                g.parentNode.insertBefore(f, c ? g : g.nextSibling)
		            });
		            var k = function(a) {
		                for (var b = f.href, c = i.length; c--;)
		                    if (i[c].href === b) return a();
		                setTimeout(function() {
		                    k(a)
		                })
		            };
		            return f.addEventListener && f.addEventListener("load", l), f.onloadcssdefined = k, k(l), f
		        };
		        "undefined" != typeof exports ? exports.loadCSS = b : a.loadCSS = b
		    }("undefined" != typeof global ? global : this);
		</script>
		<script>
		    loadCSS("/wp-content/themes/uwa/library/css/build/minified/style.css");
		</script>
		<noscript>
			<link rel="stylesheet" href="/wp-content/themes/uwa/library/css/build/minified/style.css">
		</noscript>

		<link rel="stylesheet" href="/wp-content/themes/uwa/library/css/build/minified/owl.carousel.min.css" />
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/priority-nav.min.js"></script>
	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php
		    global $post;
		    $author_id=$post->post_author;
		?>

		<?php // If is blog page show the progress bar ?>
		<?php if ( is_singular( 'post' ) ) { ?><progress value="0"></progress><?php } ?>

		<!-- <div id="container" class="container"> -->

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div class="wrap secondary-nav__wrapper">
					<?php wp_nav_menu(array(
										 'container' => false,                           // remove nav container
										 'container_class' => 'cf',         // class of container (should you choose to use it)
										 'menu' => __( 'Secondary Menu', 'bonestheme' ),  // nav name
										 'menu_class' => 'nav secondary-left secondary-nav cf',               // adding custom nav class
										 'theme_location' => 'secondary-left',                 // where it's located in the theme
										 'depth' => 0			                               // limit the depth of the nav
					)); ?>
					<?php wp_nav_menu(array(
										 'container' => false,                           // remove nav container
										 'container_class' => 'cf',         // class of container (should you choose to use it)
										 'menu' => __( 'Secondary Menu', 'bonestheme' ),  // nav name
										 'menu_class' => 'nav secondary-right secondary-nav cf',               // adding custom nav class
										 'theme_location' => 'secondary-right',                 // where it's located in the theme
										 'depth' => 0			                               // limit the depth of the nav
					)); ?>
				</div>

			<div class="wrap main-nav__wrap cf">

				<div id="menuTest" class="main-nav">
				<!-- <div class="menuTest"> -->

						<a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img  src="/wp-content/uploads/2017/01/uwa-logo.svg" alt="The University of West Alabama Logo"></a>

						<a href="tel:" class="olcphone olcphone-mobile telephoneLink"><div class="header__button">
							<?php include ('library/images/icons/phone.svg'); ?>
						</div></a>

						<button class="searchbox-trigger header__buton">
							<?php include ('library/images/searchbox-icon.svg'); ?>
						</button>

						<button class="main-nav__trigger button header__button js__menu-trigger">
							<?php include ('library/images/menu-button.svg'); ?>
						</button>
<?php
$menuLocations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)
                                           // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);

$menuID = $menuLocations['main-nav']; // Get the *primary* menu ID

$primaryNav = wp_get_nav_menu_items($menuID);
?>

						<nav class="main header__nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label='Main Menu'>

						  <?php wp_nav_menu(array(
						             'container' => false,                           // remove nav container
						             'container_class' => 'header__menu cf',         // class of container (should you choose to use it)
						             'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
						             'menu_class' => 'nav top-nav cf',
												  // 'walker'         => new Aria_Walker_Nav_Menu(),               // adding custom nav class
						             'theme_location' => 'main-nav',                // where it's located in the theme
												 'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
						             'depth' => 0			                               // limit the depth of the nav
						  )); ?>

						</nav>


					</div>
				</div>

				<?php if ( is_single() && is_singular( array('post', 'career-outcome', 'program-resource', 'infographic', 'guide' ) ) ): ?>
					<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<div class="banner banner--blogPost"<?php echo $featuredImage ? 'style="background-image: url(' . $featuredImage . ')">' : ''; ?>
						<div class="wrap">
							<div class="banner__text">
								<h1 class="banner__heading"><?php the_title(); ?></h1>
								<p class="byline entry-meta vcard">

									<span class="entry-date">Posted <?php echo get_the_date(); ?> by <?php the_author_meta( 'display_name', $author_id ); ?></span>
									<?php if ( is_singular( 'post' ) ) {
										$categories = get_the_category();
										$separator = ', ';
										$output = '';
										if ( ! empty( $categories ) ) {
											echo ' | <span class="entry-categories">';
											foreach( $categories as $category ) {
													$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
											}
											echo trim( $output, $separator );
											echo '</span>';
										} ?>
									<?php } else if ( is_singular( array( 'career-outcome', 'program-resource', 'infographic' ) ) ) {
											$verticals = get_the_terms( $post->ID, 'degree_vertical' );
											$separator = ', ';
											$output = '';
											if ( ! empty( $verticals ) ) {
												echo ' | <span class="entry-categories">';
												foreach( $verticals as $category ) {
														$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
												}
												echo trim( $output, $separator );
												echo '</span>';
											}
									} ?>
								</p>
							</div>
						</div>
					</div>

				<?php else: ?>
					<div class="banner">
						<div class="wrap">

							<?php if ( !is_front_page() && is_page_template( 'scholarship-partnership-single-template.php' ) ): ?>
								<?php $title = get_field('banner_title') ? get_field('banner_title') : get_the_title(); ?>
								<h1 class="banner__heading"><?php echo $title; ?></h1>
							<?php endif; ?>

							<?php if ( !is_front_page() && is_page() && !is_page_template( 'scholarship-partnership-single-template.php' )): ?>
								<h1 class="banner__heading"><?php the_title(); ?></h1>
							<?php endif; ?>

							<!-- Don't load bannger heading for single degrees -->
							<?php if (is_singular('degrees')): ?>
							<?php endif; ?>

							<?php if (is_single() && !is_singular('degrees')): ?>
								<h1 class="banner__heading"><?php the_title(); ?></h1>
							<?php endif; ?>

							<?php if (is_archive() && is_category()): ?>
								<h1 class="banner__heading"><?php the_archive_title(); ?></h1>
							<?php endif; ?>

							<?php if (is_post_type_archive()): ?>
								<h1 class="banner__heading"><?php post_type_archive_title(); ?></h1>
							<?php endif; ?>

							<?php if ( is_tax() ): ?>
								<?php $termID = 'term_' . get_queried_object()->term_id; ?>
								<?php if (get_field('banner_headline', $termID)): ?>
									<h1 class="banner__heading"><?php the_field('banner_headline', $termID); ?></h1>
								<?php endif; ?>
							<?php endif; ?>

							<?php if (get_field('banner_headline') && get_field('banner_headline')): ?>
								<h1 class="banner__heading"><?php the_field('banner_headline'); ?></h1>
							<?php endif; ?>

							<?php if (get_field('banner_button_link') && get_field('banner_button_text')): ?>
								<a href="<?php the_field('banner_button_link'); ?>" class="btn-red banner__link"><?php the_field('banner_button_text'); ?></a>
							<?php endif; ?>

							<?php if ( is_home() ): ?>
								<h1 class="banner__heading">News</h1>
							<?php endif; ?>

							<?php if ( is_search() ): ?>
								<?php
									$search_query = get_search_query();
									$banner_heading = 'Search Results for: ' . $search_query;
								?>
								<h1 class="banner__heading"><?php echo $banner_heading; ?></h1>
							<?php endif; ?>

						</div>
					</div>


				<?php endif; ?>



					<div class="datesBox">
						<h5 class="datesBox__heading"><span>Important Dates</span></h5>

							<div class="datesBox__text">
								<div class="datesBox__flexWrapper">
									<span class="datesBox__register-start">Register by</span>
									<span class="datesBox__dottedLine"></span>
									<span class="datesBox__date"><?php the_field('register_by', 'option'); ?></span>
								</div>

								<div class="datesBox__flexWrapper">
									<span class="datesBox__register-start">to start by</span>
									<span class="datesBox__dottedLine"></span>
									<span class="datesBox__date"><?php the_field('start_by', 'option'); ?></span>
								</div>

							</div>
						<a class="datesBox__cta btn__hollow" target="_blank" href="http://www.uwa.edu/gaapply/">Apply Now</a>
						<a class="datesBox__cta btn__hollow" href="/request-info">Request Info</a>
					</div>


		<?php  ?>



			</header>
