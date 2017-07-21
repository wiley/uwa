
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
/* NOTE: NEED TO GET ALL DEGREES AND ADD FILTER FOR THAT */
/* Temporary Fix */
/*.controls {
	background: #c9c9c9;
	z-index: 99999;
	position: fixed;
	bottom: 100px;
}*/


</style>

<script src="/wp-content/themes/uwa/library/src/owl/owl.carousel.min.js"></script>
<script src="/wp-content/themes/uwa/library/src/js/libs/priority-nav.min.js"></script>
<!-- /wp-content/themes/uwa/library/js/libs/mixitup.min.js -->
<script src="<?php echo get_template_directory_uri(); ?>/library/src/js/libs/mixitup.min.js"></script>


<script>
// if ($('#mix-container')) {
// 	var container = $('#mix-container')
// 	var mixer = mixitup(container, {
// 		callbacks: {
// 			onMixStart: function(state, futureState) {
// 			},
// 			onMixEnd: function() {
// 				container
// 					.find('.card:visible:first')
// 					.focus();
// 			}
// 		}
// 	});
// 	if (location.hash) {
//
// 		var hash = location.hash.replace('#', '.')
// 		// if (hash == '.psych') {
// 		// 	hash = '.psychology-human-services'
// 		// }
// 		mixer.filter(hash)
// 	}
// }

//
// if ($('#mix-container')) {
// 	var container = $('#mix-container')
// 	var mixer = mixitup(container, {
// 		callbacks: {
// 			onMixStart: function(state, futureState) {
// 			},
// 			onMixEnd: function() {
// 				container
// 					.find('.card:visible:first')
// 					.focus();
// 			}
// 		}
// 	});
// 	if (location.hash) {
//
// 		var hash = location.hash.replace('#', '.')
// 		// if (hash == '.psych') {
// 		// 	hash = '.psychology-human-services'
// 		// }
// 		mixer.filter(hash)
// 	}
// }
</script>

<script type="text/javascript">
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "buttonFilter".



// On document ready, initialise our code.

$(function(){

  // Initialize buttonFilter code



  // Instantiate MixItUp
	// var container = $('#mix-container')
	// var mixer = mixitup(container, {
	// 	callbacks: {
	// 		onMixStart: function(state, futureState) {
	// 		},
	// 		onMixEnd: function() {
	// 			container
	// 				.find('.card:visible:first')
	// 				.focus();
	// 		}
	// 	}
	// });

if ($('#mix-container').length) {
	var Container = $('#mix-container')
  var mixer = mixitup(Container, {
    controls: {
      enable: false // we won't be needing these
    }
  });




	var buttonFilter = {

	  // Declare any variables we will need as properties of the object

	  $filters: null,
	  $reset: null,
	  groups: [],
	  outputArray: [],
	  outputString: '',

	  // The "init" method will run on document ready and cache any jQuery objects we will need.

	  init: function(){
	    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "buttonFilter" object so that we can share methods and properties between all parts of the object.

	    self.$filters = $('#Filters');
	    self.$reset = $('#Reset');
	    self.$container = $('#Container');

	    self.$filters.find('fieldset').each(function(){
	      self.groups.push({
	        $buttons: $(this).find('.filter'),
	        active: ''
	      });
	    });

	    self.bindHandlers();
	  },

	  // The "bindHandlers" method will listen for whenever a button is clicked.

	  bindHandlers: function(){
	    var self = this;

	    // Handle filter clicks

	    self.$filters.on('click', '.filter', function(e){
	      e.preventDefault();

	      var $button = $(this);

	      // If the button is active, remove the active class, else make active and deactivate others.

	      $button.hasClass('active') ?
	        $button.removeClass('active') :
	        $button.addClass('active').siblings('.filter').removeClass('active');

	      self.parseFilters();
	    });

	    // Handle reset click

	    self.$reset.on('click', function(e){
	      e.preventDefault();

	      self.$filters.find('.filter').removeClass('active');
	      self.$filters.find('.show-all').addClass('active');

	      self.parseFilters();
	    });
	  },

	  // The parseFilters method checks which filters are active in each group:

	  parseFilters: function(){
	    var self = this;

	    // loop through each filter group and grap the active filter from each one.

	    for(var i = 0, group; group = self.groups[i]; i++){
	      group.active = group.$buttons.filter('.active').attr('data-filter') || '';
				console.log(group.active);
	    }

	    self.concatenate();
	  },

	  // The "concatenate" method will crawl through each group, concatenating filters as desired:

	  concatenate: function(){
	    var self = this;

	    self.outputString = ''; // Reset output string

	    for(var i = 0, group; group = self.groups[i]; i++){
	      self.outputString += group.active;
	    }

	    // If the output string is empty, show all rather than none:

	    !self.outputString.length && (self.outputString = 'all');

	    console.log(self.outputString);

	    // ^ we can check the console here to take a look at the filter string that is produced

	    // Send the output string to MixItUp via the 'filter' method:
			mixer.filter(self.outputString)
		  // if(self.$container.mixitup('isLoaded')){
	    // 	self.$container.mixitup('filter', self.outputString);
		  // }
	  }
	};
	buttonFilter.init();
}

});
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
