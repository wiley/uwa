
		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="wrap cf">

					<div class="flexWrapper">
						<div class="info flexItem">
							<?php include('library/images/logo-footer.svg'); ?>
							<p class="footer__infoStatement">Your career goals are within reach with an online degree from the University of West Alabama. Experience a personalized education designed to help you achieve your dreams, on your schedule and at an affordable cost.</p>
							<p class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
							<?php the_field('address', 'option') ?>
							<a class="footer__privacy" href="/privacy-policy/">Privacy Policy</a>
						</div>

						<div class="resources flexItem">
							<h5 class="footer__heading">Resources</h5>
							<ul>
								<li><a href="">Admissions</a></li>
								<li><a href="">Tuition & Financial Aid</a></li>
								<li><a href="">About</a></li>
								<li><a href="">Current Students</a></li>
								<li><a href="">Class Access</a></li>
								<li><a href="">UWA.edu</a></li>
								<li><a href="">Apply Now</a></li>
								<li><a href="">Request Info</a></li>
							</ul>
						</div>
						<div class="degrees flexItem">
							<h5 class="footer__heading">Online Degrees</h5>
							<div class="programType flexItem">
								<h6 class="footer__subheading">By Program Type</h6>
								<ul>
									<li><a href="">Bachelor’s Degrees</a></li>
									<li><a href="">Master’s Degrees</a></li>
									<li><a href="">M.AT Degrees</a></li>
									<li><a href="">M.Ed Degrees</a></li>
									<li><a href="">Education Specialist</a></li>
									<li><a href="">Alternative Teaching Certification</a></li>
									<li><a href="">Teaching Certificates</a></li>
								</ul>
							</div>
							<div class="verticals flexItem">
								<h6 class="footer__subheading">By Areas of Study</h6>
								<ul>
									<li><a href="">Business</a></li>
									<li><a href="">Teaching</a></li>
									<li><a href="">Psychology & Counseling</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<nav role="navigation" class="footer__nav">
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
				</nav>
			</footer>

			<div class="mobileNav">
				<a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img  src="/wp-content/uploads/2017/01/uwa-logo.svg" alt="The University of West Alabama Logo"></a>
				<button class="main-nav__trigger button header__button js__menu-trigger" href="#">
					<?php include ('library/images/close-button.svg'); ?>
				</button>
				<nav class="main mobileNav__nav " role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

					<?php wp_nav_menu(array(
										 'container' => false,                           // remove nav container
										 'container_class' => 'header__menu cf',         // class of container (should you choose to use it)
										 'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
										 'menu_class' => 'nav top-nav cf',               // adding custom nav class
										 'theme_location' => 'main-nav',                 // where it's located in the theme
										 'depth' => 0			                               // limit the depth of the nav
					)); ?>

				</nav>
			</div>
		</div>
		<!--  End of #container (Begins in header.php)-->

		<?php // all js scripts are loaded in library/bones.php ?>
		<!-- <script src="/wp-content/themes/uwa/library/js/build/production.min.js" charset="utf-8"></script> -->
		<?php wp_footer(); ?>

        <?php // better font loading with fontfaceobserver ?>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/bower_components/fontfaceobserver/fontfaceobserver.js">
        <script>
        new w.FontFaceObserver( "Source Sans Pro" )
            .check()
                .then( function(){
                        w.document.documentElement.className += " fonts-loaded";
                            });
        </script>
<style media="screen">
/*.requestinfo input, .requestinfo select {
	border: 4px solid transparent;
}
	*:focus {
		border: 4px black dotted !important;
	}*/

</style>

<script src="/wp-content/themes/uwa/library/src/owl/owl.carousel.min.js"></script>
<!-- <script src="/wp-content/themes/uwa/library/src/owl/accessibility.js"></script> -->
<script type="text/javascript">
// $('.owl-carousel').owlCarousel({
// 	loop: true,
// 	margin: 30,
// 	nav: true,
// 	responsive: {
// 		0: {
// 			items: 1,
// 			// nav: true
// 		},
// 		900: {
// 			items: 3
// 			// nav: false
// 		}
// 	}
// 	// onInitialized: owlSetup
// });
//
</script>
	</body>

</html> <!-- end of site. what a ride! -->
