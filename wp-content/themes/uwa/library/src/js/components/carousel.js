import $ from 'jquery';
window.$ = window.jQuery = $;
import 'owl.carousel'
// const Keys = {
// 	'TAB': 9,
// 	'RETURN': 13,
// 	'ESC': 27,
// 	'SPACE': 32,
// 	'PAGEUP': 33,
// 	'PAGEDOWN': 34,
// 	'END': 35,
// 	'HOME': 36,
// 	'LEFT': 37,
// 	'UP': 38,
// 	'RIGHT': 39,
// 	'DOWN': 40
// }

(function($) {

	function bindCarouselToElement(Element) {
		Element.owlCarousel({
			// loop: true,
			rewind: true,
			margin: 30,
			nav: false,
			responsive: {
				0: {
					items: 1,
					// nav: true
				},
				800: {
					items: 2
					// nav: false
				},
				1200: {
					items: 3
					// nav: false
				}
			},
			onInitialized: owlSetup,
			onChange: owlChange,
			onChanged: owlChanged
		});

	}
	// const DegreeTypes = $('.degreeType')

	// DegreeTypes.each(function() {
	// 	let Element = this
	// 	console.log('ELEMENT: ', Element);
	// 	bindCarouselToElement(this)
	// });
	if ($('body').hasClass('term-teaching')) {
		bindCarouselToElement($('.med'));
		bindCarouselToElement($('.mat'));
		bindCarouselToElement($('.eds'));
		bindCarouselToElement($('.atc'));
		bindCarouselToElement($('.bachelors'));
		bindCarouselToElement($('.masters'));
		bindCarouselToElement($('.tc'));
	}

	if ($('body').hasClass('term-psychology-counseling')) {

		// bindCarouselToElement($('.med'));
		// bindCarouselToElement($('.mat'));
		// bindCarouselToElement($('.eds'));
		// bindCarouselToElement($('.atc'));
		bindCarouselToElement($('.bachelors'));
		bindCarouselToElement($('.masters'));
		// bindCarouselToElement($('.tc'));
	}

	// $('.med').owlCarousel({
	// 	// loop: true,
	// 	rewind: true,
	// 	margin: 30,
	// 	nav: false,
	// 	responsive: {
	// 		0: {
	// 			items: 1,
	// 			// nav: true
	// 		},
	// 		800: {
	// 			items: 2
	// 			// nav: false
	// 		},
	// 		1200: {
	// 			items: 3
	// 			// nav: false
	// 		}
	// 	},
	// 	onInitialized: owlSetup,
	// 	onChange: owlChange,
	// 	onChanged: owlChanged
	// });

	function owlChange(event) {
		console.log($(document.activeElement));
		// console.log(event);
	}

	function owlChanged(event) {
		// var items = event.item.count; // Number of items
		// var item = event.item.index; // Position of the current item
		// console.log(event);
		// console.log(items);
		// console.log(item);
	}

	function owlSetup(event) {
		// Go to the next item
		const Carousel = $(event.target)
		console.log(Carousel);
		const ControlsHTML = `<div class="controls">
      <span class="owl-prev customPrevBtn" role="button" aria-label="Show Previous Slide">Prev</span>
      <span class="owl-next customNextBtn" role="button" aria-label="Show Next Slide">Next</span>
    </div>`

		Carousel
			.append(ControlsHTML)
		// .attr({
		// 	'aria-live': 'assertive',
		// 	'aria-relevant': 'additions',
		// 	'aria-atomic': 'false'
		// })

		const Items = $('.owl-item')
		const ClonedItems = Carousel.find('.owl-item.cloned')
		const ActiveItems = Carousel.find('.owl-item.active')
		var FirstActiveItem;
		var LastActiveItem;
		const ClonedLinks = ClonedItems.find('a')
		const PrevBtn = Carousel.find('.owl-prev')
		const NextBtn = Carousel.find('.owl-next')



		// console.log(ActiveItems);
		// console.log(LastActiveItem);
		ClonedItems.attr('aria-hidden', 'true')
		ClonedLinks.attr('tabindex', '-1')

		Carousel
			.find('.owl-item')
			.attr('aria-selected', 'false')
			.end()
			.find('.owl-item.active')
			.attr('aria-selected', 'true');

		$('.owl-carousel, .owl-prev, .owl-next').attr('tabindex', '0');


		PrevBtn
			.on('keydown', function(keyEvent) {

				if (keyEvent.which == 9 && keyEvent.shiftKey === true) {
					keyEvent.preventDefault();

					setTimeout(function() {
						Carousel.focus()
					}, 100);
				} else if (keyEvent.which == 13) {
					// keyEvent.preventDefault();
					Carousel.trigger('prev.owl.carousel')
				} else {
					// Act as normal
				}
				// var direction;
				// // var activeElement = $(document.activeElement)
				// // var activeElementID = activeElement.attr('id')
				// // var CarouselID = Carousel.attr('id')
				// console.log(keyEvent);
				// switch (keyEvent.keyCode) {
				//
				// 	case 9:
				// 		if (keyEvent.shiftKey === true) {
				// 			Carousel.focus()
				// 		} else {
				// 			// Should go to Next Button
				// 		}
				// 		break;
				//
				// 	case 13:
				// 		Carousel.trigger('prev.owl.carousel')
				// 		break;
				//
				// 	default:
				// 		direction = false
				// 		break;
				// }

			})
			.on('click', function() {
				Carousel.trigger('prev.owl.carousel');
			})

		NextBtn
			.on('keydown', function(keyEvent) {
				var direction;

				if (keyEvent.which == 13) {
					Carousel.trigger('next.owl.carousel')
				}
			})
			.on('click', function() {
				Carousel.trigger('next.owl.carousel');
			})

		// FirstActiveItem
		// 	.on('keydown', function(keyEvent) {
		// 		if (keyEvent.which == 9 && keyEvent.shiftKey === true) {
		// 			Carousel.trigger('prev.owl.carousel')
		// 		}
		// 	})
		//
		// LastActiveItem
		// 	.on('keydown', function(keyEvent) {
		// 		if (keyEvent.which == KEYS.) {
		// 			Carousel.trigger('next.owl.carousel')
		// 		}
		// 	})

		Carousel
			.on('keydown', function(keyEvent) {
				var direction;
				var activeElement = $(document.activeElement)
				var activeElementID = activeElement.attr('id')
				var CarouselID = Carousel.attr('id')


				if (keyEvent.keyCode == 9 & keyEvent.shiftKey === true) {
					// Do normal behavior
				} else {
					switch (keyEvent.keyCode) {

						case 37:
							Carousel.trigger('prev.owl.carousel');
							break;

						case 39:
							Carousel.trigger('next.owl.carousel');
							break;

						case 13:
							if (activeElementID == CarouselID) {
								Carousel.find('.owl-item.active a').first().focus()
							}
							break;

						case 27:
							if (activeElementID != CarouselID) {
								Carousel.focus()
							}
							break;

						case 9:
							var LastActiveItem = Carousel.find('.owl-item.active').last()
							var LastActiveLink = Carousel.find('.owl-item.active a').last()
							var nextItem = LastActiveItem.next()
							var nextLink = nextItem.find('a')
							// console.log(nextItem);
							if (activeElementID == CarouselID) {
								keyEvent.preventDefault()
								PrevBtn.focus()
							}

							if (activeElement[0] == LastActiveLink[0]) {

								keyEvent.preventDefault()
								Carousel.trigger('next.owl.carousel');

								setTimeout(function() {
									Carousel.find('.owl-item.active a').first().focus()
								}, 350);

							}
							break;

						default:
							direction = false
							break;
					}

				}
				// $('.customNextBtn').click(function() {
				// 	Carousel.trigger('next.owl.carousel');
				// })
				//
				// $('.customPrevBtn').click(function() {
				// 	Carousel.trigger('prev.owl.carousel');
				// })
			})
	}
	$('.owl-next, .owl-prev').text('');
	// $('.cardLink__info').attr({
	// 	'aria-hidden': 'true'
	// })
})(jQuery);
