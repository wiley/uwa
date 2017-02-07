		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="wrap cf">

					<img src="/wp-content/uploads/2017/01/footer__uwa-logo.svg" alt="UWA Online Logo">
					<p class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <a href="/privacy-policy/" target="_blank">Privacy Policy</a></p>

				</div>

			</footer>

		</div>

		<?php
		if( have_rows('modal') ):

				while ( have_rows('modal') ) : the_row();

				$modalId = get_sub_field('modal_id');
				$modalContent = get_sub_field('modal_content'); ?>

					<div id="js-modal-<?php echo $modalId; ?>" class="modal" aria-hidden="true" role="dialog" aria-labbeledby="js-modal-<?php echo $modalId; ?>__header">
						<div class="focusguard-top" tabindex="0"></div>
						<div class="modal__content" role="document" tabindex="0">
							<button aria-label="Close Modal Window" class="js-modal__close">&times; Close</button>
							<?php echo $modalContent; ?>
						</div>
						<div class="focusguard-bottom" tabindex="0"></div>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>




		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>


				<script type="text/javascript">
					WebFontConfig = {
						google: { families: [ 'Open+Sans:400,400i,700,700i' ] }
					};
					(function() {
						var wf = document.createElement('script');
						wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
						wf.type = 'text/javascript';
						wf.async = 'true';
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(wf, s);
					})();
				</script>


<script type="text/javascript">
jQuery(document).ready(function($) {

	(function () {
		function escapeListener () {
		  $(document).on('keyup',function(event) {
		      if (event.keyCode == 27) {
		        // $('.prev-overlay').toggleClass('active');
		      }
		  });
		}

		$('#item_id').on('blur', function() {
			console.log('blurred');
			// $('.block1 .formError').remove()
			// $(document).on('keydown',function(event) {
		  //     if (event.keyCode == 9) {
		  //       event.preventDefault();
			// 			console.log('Worked!');
		  //     }
		  // });
		})


	})();


	(function () {
		var modalToggle = $('.js-modal');
		var closeButton = '';
		var focusGuardTop = '';
		var focusGuardBottom = '';
		var modalWindowID = '';
		var modalWindow  = '';
		var lastToggleClicked = '';

		function escapeListener () {
		  $(document).on('keyup',function(event) {
		      if (event.keyCode == 27) {
		        closeModal();
		      }
		  });
		}

		function clickToCloseModal() {
			$(window).click(function(event) {
				if (event.target == modalWindow[0]) {
					closeModal();
				}
			});
		}

		function openModal (e) {
			e.preventDefault();
			lastToggleClicked = $(this)[0];
			console.log(lastToggleClicked);
			modalWindowID = '#' + $(this).data( "modal" ); // get target modal
			modalWindow = $(modalWindowID);
			var modalContent = $(modalWindowID).find('.modal__content');
			focusGuardTop = $(modalWindowID).find('.focusguard-top');
			focusGuardBottom = $(modalWindowID).find('.focusguard-bottom');
			closeButton = $(modalWindowID).find('.js-modal__close');


			modalWindow.addClass('open').attr("aria-hidden","false");
			modalContent.focus();
			escapeListener();

			focusGuardBottom.on('focus', function() {
				modalContent.focus();
			})

			focusGuardTop.on('focus', function() {
		    closeButton.focus();
		  })

			closeButton.click(closeModal);
		}



		function closeModal () {
			$('.modal.open').removeClass('open');
			console.log(lastToggleClicked[0]);
			lastToggleClicked.focus();
			resetVars();
		}

		function resetVars() {
			modalFirstFocus = '';
			modalLastItem = '';
			modalClose = '';
			modalWindow = '';
			modalContent = '';
			modalWindowID = '';
			focusGuardTop = '';
			focusGuardBottom = '';
			closeButton = '';
			// lastToggleClicked = '';
		}

		clickToCloseModal();
		modalToggle.click(openModal);

	})();

}); /* end of as page load scripts */

</script>



	</body>

</html> <!-- end of site. what a ride! -->
