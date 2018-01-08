(function($) {
	var noScrollElement = $('body');
	var questionsContainer = $('.questions');
	var questionLinks = questionsContainer.find('a');
	var answersContainer = $('.answers');
	var closeAnswerButton;
	var questionHolder = $('#questionHolder');
	const ButtonHTML = `<button id="answerCloser" name="button"></button>`;

	function setupCloseButton() {
		$(answersContainer).append(ButtonHTML);
		closeAnswerButton = $('#answerCloser');
	}

	function desktopWidthChecker() {
		var viewPortWidth = $(window).width();
		if (viewPortWidth >= 768) {
			return true;
		} else {
			return false;
		}
	}

	function updateQuestion(text) {
		questionHolder.text(text);
	}

	setupCloseButton();

	if (desktopWidthChecker()) {
		questionLinks.first().addClass('active');
		updateQuestion(questionLinks.first().text());
		answersContainer
			.find('[data-id]')
			.first()
			.addClass('active');
		answersContainer.removeClass('fixed, absolute');
	}

	questionLinks.on('click', function(clickEvent) {
		clickEvent.preventDefault();
		questionLinks.removeClass('active');
		answersContainer.find('.active').removeClass('active');

		var currentID = $(this).attr('href');
		var currentTitle = currentID.replace('#', '');

		updateQuestion($(this).text());

		var newAnswer = $('[data-id = "' + currentTitle + '"]');

		answersContainer.addClass('active');
		newAnswer.addClass('active');
		$(this).addClass('active');
		noScrollElement.addClass('activeModal');
		// answersContainer
		//   .find("a[title = ]")
		//   .remove();
	});

	closeAnswerButton.on('click', function(clickEvent) {
		clickEvent.preventDefault();
		answersContainer.find('.active').removeClass('active');
		questionLinks.removeClass('active');
		answersContainer.removeClass('active');
		noScrollElement.removeClass('activeModal');
	});

	if ($('.answers').length && desktopWidthChecker()) {
		// if ( $('.answers').length) {
		// grab the initial top offset of the navheaderigation

		var stickyElement = $('.answers');
		var stickyElementOffsetTop = stickyElement.offset().top;
		var containerWidth = $('.faqWrapper').width();
		var stickyElementHeight = stickyElement.height();
		console.log(stickyElementHeight);

		var width = containerWidth * 0.64;
		// var width = stickyElement.width() + 30

		// the function that decides weather the navigation bar should have "fixed" css position or not
		function makeStickyElementOnScroll(stickyOffset) {
			var scroll_top = $(window).scrollTop(); // the current vertical position from the top
			var nextSectionTop = $('.waiting').offset().top;
			var bottom = nextSectionTop - 215;

			// if user scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
			if (scroll_top > 388) {
				stickyElement.css('width', width);
				stickyElement.addClass('fixed');
			} else {
				stickyElement.removeClass('fixed');
			}

			if (scroll_top > bottom) {
				stickyElement.addClass('absolute');
			} else {
				stickyElement.removeClass('absolute');
			}
		}

		// run the function on load
		makeStickyElementOnScroll(stickyElementOffsetTop);

		// and run it again every time you scroll
		$(window).on('scroll', function() {
			console.log('scrolling');
			makeStickyElementOnScroll(stickyElementOffsetTop);

			if (true) {
			}
		});

		$('body').on('resize', function() {
			if (stickyElement.hasClass('fixed')) {
				stickyElement.removeClass('fixed');
			}
			if (!desktopWidthChecker()) {
				stickyElement.css('width', '64%');
			}
			stickyElementOffsetTop = stickyElement.offset().top;
			width = stickyElement.width() + 30;
			makeStickyElementOnScroll(stickyElementOffsetTop);
		});
	}
})(jQuery);
