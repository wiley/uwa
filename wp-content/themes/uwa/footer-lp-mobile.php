
		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="wrap cf">

					<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="/wp-content/uploads/2017/01/footer__uwa-logo.svg" alt="UWA Online Logo">
					<p class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> | <a href="https://policies.edusites.net/privacyus/" target="_blank">Privacy Policy</a> | <a href="https://policies.edusites.net/terms-of-use-us/" target="_blank">Terms and Conditions</a> | <a class="ppcphone" href="tel:8444056365"> (844) 405-6365</a></p>
  				<div class="focusguard-bottom" tabindex="0" aria-hidden="true"></div>
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

		<?php if ( get_field('custom_js') ): ?>
			<script><?php the_field('custom_js'); ?></script>
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

	// (function() {
	//
	// 	var block1 = $('.block1'),
	// 			block2 = $('.block2'),
	// 			nextButton = block1.find('.next'),
	// 			previousButton = block2.find('.next'),
	// 			fieldsForBlock1 = block1.find('input, select'),
	// 			fieldsForBlock2 = block2.find('input'),
	// 			firstInputBlock1 = $(block1).find('input, select').first(), //Finds first form element inside block1 whether it is a select menu or an text input
	// 			firstInputBlock2 = $(block2).find('input').first(),
	//       formFocusGuardBottom = $('form').find('.focusguard-bottom');
	//
	//
	// 	function runInvalidFunc(fieldsToProcess) {
	// 		fieldsToProcess.each(function(index, element) {
	//
	//
	//       if (element != $('#item_id')[0]) {
	//
	//         $(element).one('blur', function(event) {
	//   				if (  ( $(this).val() === '' ) || ( $(this).hasClass('error') )  )   {
	//   					$(this).addClass('error')
	//   						.attr("aria-invalid", "true")
	//               .focus();
	//
	//               if ($(this)[0].id == 'first_name') {
	//                 $('#firstNameError').html('Please fill in your name');
	//                 $('#firstNameError').attr('aria-hidden', 'false');
	//               }
	//
	//               if ($(this)[0].id == 'last_name') {
	//                 $('#lastNameError').html('Please fill in name');
	//                 $('#lastNameError').attr('aria-hidden', 'false');
	//               }
	//
	//   				}
	//         });
	//       }
	//
	// 			$(element).blur(function() {
	// 				if ($(this).val() !== '' && $(this).attr('aria-invalid', "true")) {
	//
	// 					$(this).attr('aria-invalid', "false");
	// 				}
	// 			});
	// 		//   $(element).blur(function() {
	// 		//     if ( $(this).val() == '' ) {
	// 		 //
	// 		//       $(this).addClass('error')
	// 		//       .attr("aria-invalid", "true")
	// 		//       .focus();
	// 		 //
	// 		//     } else if (  $(this).attr('aria-invalid', "true")  ) {
	// 		 //
	// 		//         $(this).attr('aria-invalid', "false")
	// 		//         console.log('aria not longer invalid')
	// 		//     }
	// 		//  });
	// 	});
	//  }
	//
	// 	function checkBlock1Inputs(clickEvent) {
	// 		// console.log('FIREDDDD');
	// 		clickEvent.preventDefault();
	//
	// 		fieldsForBlock1.each(function(index, element) {
	// 			// console.log($(this).val());
	// 			if ( $(this).val() === '' ) {
	//
	// 				$(this).addClass('error')
	// 				.attr("aria-invalid", "true")
	// 				.focus();
	//
	// 			} else {
	// 				// Do nothing
	// 			}
	// 			checkForInvalidInputsBlock1(fieldsForBlock1);
	// 		});
	// 	}
	//
	// 	function checkForInvalidInputsBlock1(inputs) {
	// 		var invalidInputs = inputs.filter('.error').length;
	//
	// 		if (invalidInputs == 0) {
	// 			console.log('ALL INPUTS SEEN AS VALID');
	// 			block1.addClass('hidden').removeClass('show');
	// 			block2.addClass('show').removeClass('hidden')
	//       updatePromptText('Please fill out some basic contact information.');
	// 			firstInputBlock2.focus();
	// 		}
	// 	}
	//
	// 	function toggleClasses() {
	// 		block1.toggleClass('show hidden');
	// 		block2.toggleClass('show hidden');
	//     $('.prev-overlay').toggleClass('active');
	// 	}
	//
	//   $('.prev-overlay').on('click', function(e) {
	//     e.preventDefault();
	//     toggleClasses();
	//   });
	//
	// 	function proceedToNextStep() {
	// 		nextButton.click(checkBlock1Inputs);
	// 	}
	//
	//   function updatePromptText(textForFormPrompt) {
	//     $('.step-form__prompt').text(textForFormPrompt);
	//   }
	//
	// 	function returnToPreviousStep() {
	// 		previousButton.click(function() {
	// 			toggleClasses();
	// 			firstInputBlock1.focus();
	//       updatePromptText('What degree are you interested in?');
	// 		});
	// 	}
	//
	//   function exitFormOnTabbing() {
	//     formFocusGuardBottom.on('focus', function() {
	//       block1.toggleClass('show hidden');
	//       block2.toggleClass('show hidden');
	//       updatePromptText('What degree are you interested in?');
	//       $('.prev-overlay').toggleClass('active');
	//       $('.js-modal').first().focus();
	//     })
	//   }
	//
	//   previousButton.keyup(function(e) {
	//     if (e.which == 13) {
	//       previousButton.click();
	//       firstInputBlock1.focus();
	//     }
	// 	});
	//
	//   function escapeListener () {
	//     $(document).on('keyup',function(event) {
	//         if (event.keyCode == 27 && block2.hasClass('show')) {
	//           block1.toggleClass('show hidden');
	//       		block2.toggleClass('show hidden');
	//           updatePromptText('What degree are you interested in?');
	//           $('.prev-overlay').toggleClass('active');
	//           console.log(nextButton);
	//           nextButton.focus();
	//         }
	//     });
	//   }
	//
	//   escapeListener();
	// 	runInvalidFunc(fieldsForBlock1);
	// 	runInvalidFunc(fieldsForBlock2);
	// 	proceedToNextStep();
	// 	returnToPreviousStep();
	//   exitFormOnTabbing();
	//
	// 	nextButton.keypress(function(e) {
	// 		if (e.which == 13) {
	//       nextButton.click();
	// 			firstInputBlock2.focus();
	// 		}
	// 	});
	//
	// })();
	//


	(function () {
		function escapeListener () {
		  $(document).on('keyup',function(event) {
		      if (event.keyCode == 27) {
		        // $('.prev-overlay').toggleClass('active');
		      }
		  });
		}

	})();


	(function () {
		var body = $('body');
		var modalToggle = $('.js-modal');
		var closeButton = '';
		var focusGuardTop = '';
		var focusGuardBottom = '';
		var modalWindowID = '';
		var modalWindow  = '';
		var lastToggleClicked = '';
		var footerFocusGuardBottom = $('.footer').find('.focusguard-bottom');

		function escapeListener () {
		  $(document).on('keyup',function(event) {
		      if (event.keyCode == 27) {
		        closeModal();
		      }
		  });
		}

		function returnTabbingToTop () {
			footerFocusGuardBottom.on('focus', function() {
				$('.header .tel-link').focus();
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

			// body.toggleClass('no-scroll');
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
			// body.toggleClass('no-scroll');
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

		returnTabbingToTop();
		clickToCloseModal();
		modalToggle.click(openModal);


		// FORM
		var fname = $('#first_name');
		var lname = $('#last_name');


		fname.on('blur', function() {
			// alert('fired');
			if ( $(this).hasClass('error') ) {
				$('#firstNameError')
					.html('Please fill in this required field')
					.addClass('error')
					.attr('aria-hidden', 'false');
			} else {
				$('#firstNameError')
					.html('Field is now valid')
					.attr('aria-hidden', 'true');
					setTimeout(function(){
						$('#firstNameError').removeClass('error');
					}, 1500);
			}
		});


		lname.on('blur', function() {
			// alert('fired');
			if ( $(this).hasClass('error') ) {
				$('#lastNameError')
					.html('Please fill in required field')
					.addClass('error')
					.attr('aria-hidden', 'false');
			} else {
				$('#lastNameError')
					.html('Field is now valid')
					.attr('aria-hidden', 'true');
					setTimeout(function(){
						$('#lastNameError').removeClass('error');
					}, 1500);
			}
		});

		function nameValidationCheck(field) {
			if ( field.hasClass('error') ) {
				field
					.html('Please fill in required field')
					.addClass('error')
					.attr('aria-hidden', 'false');
			} else {
				field
					.html('Field is now valid')
					.attr('aria-hidden', 'true')
					.removeClass('error');
			}
		}


		// lname.on('blur', nameValidationCheck($(this)));


	})();

}); /* end of as page load scripts */

</script>



	</body>

</html> <!-- end of site. what a ride! -->
