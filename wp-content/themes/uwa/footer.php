<?php
	$menu_name = 'footer-links';
	$locations = get_nav_menu_locations();
	// print_r($locations);
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	// print_r($menu);
	$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
?>

<?php
	$degreeAreasTaxonomy = 'degree_vertical';
	$degreeAreas = get_terms( $degreeAreasTaxonomy, $args = array(
		'hide_empty' => false, // do not hide empty terms
	));
?>

<?php

	$degreeLevels = get_terms([
	    'taxonomy'     => 'degree_level',
	    'hide_empty'   => false,
	    'meta_key'		 => 'menu_order',
	    'orderby'			 => 'meta_value',
	    'order'				 => 'ASC'
	]);

?>

<div class="searchbox__wrapper">
	<div class="searchbox__innerwrapper">
		<div class="focusguard-top" tabindex="0" aria-hidden="true"></div>
		<button class="searchbox__close-button searchbox__toggle" aria-label="Close Form Window" type="button" name="closeForm"></button>
		<h4 class="form__heading">Search</h4>
		<?php get_search_form(); ?>
	</div>
</div>

		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="wrap cf">

					<div class="flexWrapper">
						<div class="info flexItem">
							<?php
							// logo footer
							$image = get_field('footer_logo', 'option');
							if( !empty($image) ): ?>
								<img style="height:60px;width:auto;max-width:300px;" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr(empty($image['alt'])?$image['alt']:''); ?>"/>

							<?php
							else:
								include('library/images/logo-footer.svg');
							endif; //logo footer

							// footer info statement
							$statement = get_field('footer_info_statement', 'option');
							if( !empty($statement ) ): ?>

								<p class="footer__infoStatement"><?php echo $statement; ?></p>

							<?php
							else: ?>
								<p class="footer__infoStatement">Your career goals are within reach with an online degree from the University of West Alabama. Experience a personalized education designed to help you achieve your dreams, on your schedule and at an affordable cost.</p>
							<?php endif; //footer info statement ?>

							<p class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
							<?php (get_field('address', 'option')) ? the_field('address', 'option') : "Livingston, Alabama 35470"; ?>
							<?php
								if (get_field('phone_number', 'option')) : ?>
								<a href="tel:<?php echo preg_replace('/\D+/', '',get_field('phone_number', 'option')) ?>" class="telephoneLink olcphone"><?php the_field('phone_number', 'option') ?></a>
							<?php
								else: ?>
									<a class="telephoneLink olcphone" href="tel:8443616034">(844) 361-6034</a>
							<?php
								endif; ?>
								<nav class="social-links" aria-label="social-links">
								<?php
								if (have_rows('school_social_links', 'option')) :
									while (have_rows('school_social_links', 'option')) : the_row();
										$network = get_sub_field('network');
										$url = get_sub_field('url'); ?>
										<a href="<?php echo $url ?>" target="_blank" aria-label="vwu online on <?php echo $network['label'] ?> - opens in new tab" class="<?php echo strtolower($network['label']); ?>"><i class="fa fa-<?php echo $network['value'] ?>" aria-hidden="true"></i></a>
									<?php
									endwhile;
								endif; ?>
							</nav>
							<?php
							//Privacy Policy
							$footer_link = get_field('footer_privacy_policy_link', 'option');
							if ($footer_link) :
								$link_url = $footer_link['url'];
								$link_title = $footer_link['title'];
								$link_target = $footer_link['target'] ? $footer_link['target'] : '_self';
							?>
								<a class="footer__privacy" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"> <?php echo esc_html($link_title); ?> </a>
							<?php else : ?>
								<a class="footer__privacy" href="https://policies.edusites.net/privacyus/" target="_blank">Privacy Policy</a>
							<?php endif; // Privacy Policy ?> |
							<?php
							// Terms and Conditions
							$footer_link = get_field('footer_terms_conditions_link', 'option');
							if ($footer_link) :
								$link_url = $footer_link['url'];
								$link_title = $footer_link['title'];
								$link_target = $footer_link['target'] ? $footer_link['target'] : '_self';
							?>
								<a class="footer__privacy" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"> <?php echo esc_html($link_title); ?> </a>
							<?php
							else : ?>
								<a class="footer__privacy" href="https://policies.edusites.net/terms-of-use-us/" target="_blank">Terms and Conditions</a>
							<?php
							endif; //  Terms and Conditions	?>
						</div>

						<div class="resources flexItem">
							<h5 class="footer__heading">Resources</h5>
							<ul>
								<?php foreach ($menuitems as $item): ?>
									<?php
										$url = $item->url;
										$title = $item->title;
									?>
					          <li><a href="<?php echo esc_url( $url ); ?>"><?php echo $title; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="degrees flexItem">
							<h5 class="footer__heading">Online Degrees</h5>
							<div class="programType flexItem">
								<h6 class="footer__subheading">By Program Type</h6>
								<ul>
									<?php foreach ($degreeLevels as $degreeLevel ): ?>
					          <?php
					            $url = get_term_link( $degreeLevel );
					            $name = $degreeLevel->name;
											$slug = $degreeLevel->slug;
					          ?>
					          <?php if ($slug !== 'teaching-certificates'): ?>
					          	<li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
					          <?php endif; ?>
					        <?php endforeach; ?>
								</ul>
							</div>
							<div class="verticals flexItem">
								<h6 class="footer__subheading">By Area of Study</h6>
								<ul>
									<?php foreach ($degreeAreas as $degreeArea ): ?>
					          <?php
					            $url = get_term_link( $degreeArea );
											$name = $degreeArea->name;
					            $slug = $degreeArea->slug;
					          ?>
										<?php if ($slug === 'business' || $slug === 'psychology-counseling' || $slug === 'teaching'): ?>
											<li><a href="<?php echo esc_url( $url ); ?>"><?php echo $name; ?></a></li>
										<?php endif; ?>

					        <?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>




				<!-- <nav role="navigation" class="footer__nav">
					<?php wp_nav_menu(array(
						'container' => '',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
						'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
						'menu_class' => 'nav footer__menu cf',            // adding custom nav class
						'theme_location' => 'footer-links',             // where it's located in the theme
						'before' => '',                                 // before the menu
						'after' => '',                                  // after the menu
						'link_before' => '',                            // before each link
						'link_after' => '',                             // after each link
						'depth' => 0,                                   // limit the depth of the nav
						'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
					)); ?>
				</nav> -->
			</footer>

			<div class="mobileNav">
				<a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img  src="/wp-content/uploads/2017/01/uwa-logo.svg" alt="The University of West Alabama Logo"></a>
				<button class="main-nav__trigger button header__button js__menu-trigger" href="#">
					<?php include ('library/images/close-button.svg'); ?>
				</button>
				<nav class="main mobileNav__nav " role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="header menu">

					<?php wp_nav_menu(array(
										 'container' => false,                           // remove nav container
										 'container_class' => 'header__menu cf',         // class of container (should you choose to use it)
										 'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
										 'menu_class' => 'nav top-nav cf',               // adding custom nav class
										 'theme_location' => 'main-nav',                 // where it's located in the theme
										 'depth' => 0			                               // limit the depth of the nav
					)); ?>

				</nav>
				<hr class="navSplit">
				<nav class="mobileNav__nav secondary-nav__wrapper" aria-label="secondary-menu">
					<?php wp_nav_menu(array(
										 'container' => false,                           // remove nav container
										 'container_class' => 'cf',         // class of container (should you choose to use it)
										 'menu' => __( 'Secondary Menu', 'bonestheme' ),  // nav name
										 'menu_class' => 'nav secondary-nav cf',               // adding custom nav class
										 'theme_location' => 'secondary',                 // where it's located in the theme
										 'depth' => 0			                               // limit the depth of the nav
					)); ?>
				</nav>
			</div>

		</div>
		<!--  End of #container (Begins in header.php)-->

		<?php wp_footer(); ?>

        <?php // better font loading with fontfaceobserver ?>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/build/fontfaceobserver.js">
        <script>
        new w.FontFaceObserver( "Source Sans Pro" )
            .check()
                .then( function(){
                        w.document.documentElement.className += " fonts-loaded";
                            });
        </script>


<!-- <script async="async" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/owl.carousel.min.js"></script> -->

<script>
	$('a[href^="http://uwa.edu"]').attr('target','_blank');
</script>


<script type="text/javascript">
	$('input.search-field').val('');

	if ( $('body').hasClass('search-no-results') ) {
		$(".intro")
			.append($('.searchbox__innerwrapper').clone()
			.css({
				'opacity': 0
			})
			.delay(500)
			.animate({'opacity': 1}, 'slow'));
	}
</script>

<script type="text/javascript">
	var nav = priorityNav.init({
		mainNavWrapper: ".intro__subNav", // mainnav wrapper selector (must be direct parent from mainNav)
		mainNav: ".subpagesNav",
		breakPoint: 0,
		navDropdownLabel: ""
	});
</script>
	</body>

</html> <!-- end of site. what a ride! -->
