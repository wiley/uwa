/*
 * Put all your regular jQuery in here.
*/


// import 'owl.carousel/dist/assets/owl.carousel.css';
import $ from 'jquery';
window.$ = window.jQuery = $;
import './components/megaMenu'
import './components/submenus'
import './components/carousel'


// import 'imports?jQuery=jquery!owl.carousel';



jQuery(document).ready(function($) {
  function desktopWidthChecker() {
    var viewPortWidth = $( window ).width();
    if (viewPortWidth >= 768) {
      return true
    } else {
      return false
    }
  }

    (function () {


      if ( $('.answers').length && desktopWidthChecker()) {
          // grab the initial top offset of the navheaderigation
          var stickyElement = $('.answers')
          var stickyElementOffsetTop = stickyElement.offset().top;
          var width = stickyElement.width() + 30



          // the function that decides weather the navigation bar should have "fixed" css position or not
          var makeStickyElementOnScroll = function(stickyOffset) {

              var scroll_top = $(window).scrollTop(); // the current vertical position from the top
              // console.log(scroll_top);

              // if user scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
              if (scroll_top > stickyOffset) {
                  stickyElement.css("width", width);
                  stickyElement.addClass('fixed');
                  // $('#header').css("margin-top", stickyElement.height());
              } else {
                  stickyElement.removeClass('fixed');
                  // $('#header').css("margin-top", 0);
                  stickyElement.css("width", '48%');
              }
          };

          // run the function on load
          makeStickyElementOnScroll(stickyElementOffsetTop);

          // and run it again every time you scroll
          $(window).on('scroll', function() {
              makeStickyElementOnScroll(stickyElementOffsetTop);
          });

          $(window).on('resize', function() {
              if ( stickyElement.hasClass('fixed') ) {
                  // stickyElement.removeClass('fixed');
              }
              stickyElementOffsetTop = stickyElement.offset().top;
              width = stickyElement.width() + 30
              makeStickyElementOnScroll(stickyElementOffsetTop);
          });
      }
    })();

  // COURSE DETAILS ACCORDION
  (function () {
    var buttons = $('.accord-header button');

    buttons.on('click', function() {
      var content = $(this).parent().next();
      var state = $(this).attr('aria-expanded') === 'false' ? true : false;
      $(this).attr('aria-expanded', state);

      content
        .attr('aria-hidden', !state)
        .slideToggle();
    });
  })();


    // $('.owl-item.cloned').remove();
    $('.accordion .accord').on("click", function(){
        if($(this).hasClass('active')){
           $(this).removeClass('active');
        }else{
            $('.accordion .accord').removeClass('active');
            $(this).addClass("active");
        }
    });


    // faq
    (function() {
      var body = $('body')
      var questionsContainer = $('.questions')
      var questionLinks = questionsContainer.find('a')
      var answersContainer = $('.answers')
      var closeAnswerButton = $('#answerCloser')

      if (desktopWidthChecker()) {
        questionLinks.first().addClass('active')
        answersContainer.find('[data-id]').first().addClass('active')
      }

      questionLinks.on('click', function(clickEvent) {
        clickEvent.preventDefault();
        questionLinks.removeClass('active')
        answersContainer.find('.active').removeClass('active')


        var currentID = $(this).attr('href')
        var currentTitle = currentID.replace("#","")
        var newAnswer = $('[data-id = "' + currentTitle + '"]')
        console.log(newAnswer);
        body.addClass('active')
        answersContainer.addClass('active')
        newAnswer.addClass('active')
        $(this).addClass('active')
        // answersContainer
        //   .find("a[title = ]")
        //   .remove();
      })

      closeAnswerButton.on('click', function(clickEvent) {
        clickEvent.preventDefault();

        body.removeClass('active')
        questionLinks.removeClass('active')
        answersContainer.removeClass('active')
        answersContainer.find('.active').removeClass('active')
      })

      // questionsContainer.on('click', handleContentView)
    })()

    // Pullquote functionality so the content is not repeated
   $(function() {
      $('span.pullquote').each(function() {
        var $parentParagraph = $(this).parent('p');
        $parentParagraph.css('position', 'relative');
        $(this).clone()
          .addClass('pulledquote')
          .prependTo($parentParagraph);
      });
    });

    // Making social share links pop up in new window
    function windowPopup(url, width, height) {
      // Calculate the position of the popup so it’s centered on the screen.
      var left = (screen.width / 2) - (width / 2),
          top = (screen.height / 2) - (height / 2);

      window.open(
        url,
        "",
        "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left
      );
    }

    $(".social-link").on("click", function(e) {
      e.preventDefault();

      windowPopup($(this).attr("href"), 500, 300);
    });

    // Remove Select menu error classs on load
    $(window).load(function() {
        $('.requestinfo select').removeClass('error');
    });

    // Mobile Nav Trigger


		// Modal Stuff
		// $('.js-modal').on('click', function(e) {
		// 	var modalWindow = $(this).data( "modal" ); // get target modal
    //
		// 	e.preventDefault();
		// 	$('#'+modalWindow).toggleClass( 'open' ).attr("aria-hidden","false"); // toggle class
		// 	$('body').toggleClass("no-scroll"); // set body to no scroll
		// 	$(".container").attr("tabindex","-1"); // change tab index of main content
		// 	// var modalHeading = $('.modal.open h3').text();
    //   var modalHeading = $('.modal.open h3');
    //   modalHeading = modalHeading[0];
		// 	// modalHeading.focus();
    //
    //
		//  });
    //
		// $('.js-modal__close').on('click', function(e) {
		// 	e.preventDefault();
		// 	$('.modal.open').removeClass('open');
		// 	$('body').toggleClass("no-scroll");
		// });


		// Smooth Scroll Links
		$(function() {
			$('a[href*="#"]:not([href="#"]).scroll').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
		});



}); /* end of as page load scripts */

(function( $ ) {
  $('.js__menu-trigger').on('click', function(e) {
      e.preventDefault();

      $('body').toggleClass('mobileNav--active')
      $('.mobileNav').toggleClass('visible');
      $('.mobileNav__nav').find('a').first().focus();
  });
})( jQuery );

(function( $ ) {
  var Buttons = $('.infoTabs__buttons button'),
      ContentWrapper = $('.infoTabs__contentWrapper'),
      tabPanels = $('.infoTabs__content'),
      firstTabPanel = tabPanels.first();

  firstTabPanel.attr('aria-hidden', false)
  tabPanels.not(firstTabPanel).attr('aria-hidden', true)

  Buttons.on('click', function(event) {
    var id = $(this).attr('id')
    Buttons
      .removeClass('active')
      .attr('aria-selected', false)

    $(this).addClass('active').attr('aria-selected', true);

    ContentWrapper
      .find('.infoTabs__content')
      .removeClass('active')
      .attr('aria-hidden', true);

    ContentWrapper
      .find(`.${id}`)
      .addClass('active')
      .attr('aria-hidden', false);
  });
})( jQuery );


(function( $ ) {
  var Form = $('.requestinfo'),
			FormWrapper = $('.form__wrapper'),
			requestInfoBtn = $('.requestInfo'),
			closeButton = FormWrapper.find('.form__toggle'),
			formFocusGuardTop = FormWrapper.find('.focusguard-top'),
			formFocusGuardBottom = FormWrapper.find('.focusguard-bottom'),
			firstFormElement = Form.find(':input:not([type=hidden])').first();

	function openForm() {
		FormWrapper.addClass('active');
		firstFormElement.focus();
	}

	function closeForm() {
		FormWrapper.removeClass('active');
		requestInfoBtn.focus();
	}

	function handleTabbingBack() {
		var lastFormElement = Form.find(':input:enabled:not([type=hidden], :disabled)').last();
		lastFormElement.focus();
	}

	function handleTabbingFwd() {
		closeButton.focus();
	}

	function escapeListener () {
		FormWrapper.on('keyup',function(event) {
			if (event.keyCode == 27) {
				closeForm();
			}
		});
	}
	escapeListener();

	requestInfoBtn.on('click', openForm);
	closeButton.on('click', closeForm);
	formFocusGuardTop.on('focus', handleTabbingBack);
	formFocusGuardBottom.on('focus', handleTabbingFwd);

})( jQuery );
