(function($) {

	const MainMenu = $('nav.main')
	const MenuItemsWithChildren = MainMenu.find('.menu-item-has-children')
	const MenuLinksWithChildren = MenuItemsWithChildren.find('> a')
	const ButtonHTML = `<button class="sub-menu__toggle"></button>`
	const Submenus = MenuItemsWithChildren.children('.sub-menu')
	const lastLinks = Submenus.find('a:last')
	var closeSubmenuTimer;


	MenuLinksWithChildren.after(ButtonHTML)
	const Buttons = $('.sub-menu__toggle')

	Buttons.attr({
		'aria-haspopup': true,
		'aria-expanded': false
	})
	Submenus.attr({
		'aria-hidden': true
	})
	function escapeListener(submenu, submenuToggler) {
		submenu.on('keydown', function(keyEvent) {
			if (keyEvent.which == 27) {
				submenuToggler.focus()
			}
		})
	}

	function toggleSubmenuState(CurrentSubmenu) {
		let currentSubmenuButton = CurrentSubmenu.closest('.menu-item-has-children').find('.sub-menu__toggle'),
				newAriaHiddenState = CurrentSubmenu.attr('aria-hidden') === 'true' ? false : true
				newAriaExandedState = currentSubmenuButton.attr('aria-expanded') === 'false' ? true : false

		CurrentSubmenu.attr('aria-hidden', newAriaHiddenState)
		currentSubmenuButton.attr('aria-expanded', newAriaExandedState)
	}

	function slideSubmenu(CurrentSubmenu) {
		CurrentSubmenu.slideToggle(350, 'swing', function() {
			toggleSubmenuState(CurrentSubmenu)
		})
	}

	function openSubmenu(CurrentSubmenu) {
		CurrentSubmenu.slideDown(350, 'swing', function() {
			toggleSubmenuState(CurrentSubmenu)
		})
	}

	function closeSubmenu(CurrentSubmenu) {
		CurrentSubmenu.slideUp(350, 'swing', function() {
			toggleSubmenuState(CurrentSubmenu)
		})
	}

	function submenuToggleHandler() {
		var SubmenuButton = $(this),
				parentListItem = SubmenuButton.parent('.menu-item-has-children'),
				CurrentSubmenu = SubmenuButton.next('.sub-menu')


		var hasOpenSubmenu = Submenus.filter('[aria-hidden="false"]').length == 1 ? true : false
		var openingNewSubmenu = CurrentSubmenu.attr('aria-hidden') == 'true' ? true : false

		if ( hasOpenSubmenu && !openingNewSubmenu ) {
			console.log('CLOSE HERE!')
			closeSubmenu(CurrentSubmenu)
			return
		}
		if ( hasOpenSubmenu && openingNewSubmenu ) {
			let openSubmenu = Submenus.filter('[aria-hidden="false"]')
			openSubmenuButton = openSubmenu.prev('sub-menu__toggle')
			parentListItem.removeClass('activeSubmenu')
			closeSubmenu(openSubmenu)
		}

		parentListItem.addClass('activeSubmenu')
		openSubmenu(CurrentSubmenu)
		escapeListener(CurrentSubmenu, SubmenuButton)
	}

	Buttons.on('click', submenuToggleHandler)

// NOTE: NOT WORKING PROPERLY YET
	// Buttons.on('focusout', function(event) {
	// 	var ariaExpanded = $(this).attr('aria-expanded')
	// 	console.log(ariaExpanded);
	//
	// 	if ( ariaExpanded === true ) {
	// 		var ActiveSubmenu = $(this).next('.sub-menu')
	// 		slideSubmenu(ActiveSubmenu)
	// 	} else {
	// 		console.log('Submenu was not open when Button lost focus');
	// 	}
	// })

	MainMenu
		.on('mouseenter focusin', '.sub-menu', function(event) {
			clearTimeout(closeSubmenuTimer)
			var Current = $(this)
			Current.attr('data-has-focus', 'true');
		})
		.on('mouseleave focusout', '.activeSubmenu', function(event) {
			var parentListItem = $(this)
			var activeSubmenu = parentListItem.find('.sub-menu')
			var parentListItem = activeSubmenu.parent('.menu-item-has-children')

			var currentWidth = event.view.outerWidth
			console.log(currentWidth);
			if (currentWidth > 990) {

				if (event.type == 'mouseleave') {

					closeSubmenuTimer = setTimeout(function() {
						activeSubmenu.attr('data-has-focus', 'false');
						parentListItem.toggleClass('activeSubmenu')
						closeSubmenu(activeSubmenu)
					}, 1000);
				}


				setTimeout(function() {

					// if (ActiveSubmenu.find(':focus').length || parentListItem.find(':focus').length) {
					if (parentListItem.find(':focus').length) {
						// Still in active submenu
						// console.log('still here');
					} else {
						// console.log('left');

						activeSubmenu.attr('data-has-focus', 'false');
						parentListItem.toggleClass('activeSubmenu')
						closeSubmenu(activeSubmenu)

					}
				}, 200);
			}
		})

})(jQuery)
