(function($) {

	const MainMenu = $('nav.main:not(.mobileNav__nav)')
	const MenuItemsWithChildren = MainMenu.find('.menu-item-has-children')
	const MenuLinksWithChildren = MenuItemsWithChildren.find('> a')
	const ButtonHTML = `<button class="sub-menu__toggle"></button>`
	const Submenus = MenuItemsWithChildren.children('.sub-menu')
	const lastLinks = Submenus.find('a:last')

	MenuLinksWithChildren.after(ButtonHTML)

	Submenus.attr({
		'aria-hidden': true
	})

	const Buttons = $('.sub-menu__toggle')
	Buttons.attr({
		'aria-haspopup': true,
		'aria-expanded': false
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

	function submenuToggleHandler() {
		var SubmenuButton = $(this),
				parentListItem = SubmenuButton.parent('.menu-item-has-children'),
				CurrentSubmenu = SubmenuButton.next('.sub-menu')

		parentListItem.toggleClass('activeSubmenu')
		slideSubmenu(CurrentSubmenu)
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
		.on('mouseenter focusin', '.sub-menu', function(e) {
			var Current = $(this)
			Current.attr('data-has-focus', 'true');
		})
		.on('mouseleave focusout', '.sub-menu', function(e) {
			var ActiveSubmenu = $(this)

			setTimeout(function() {
				if (ActiveSubmenu.find(':focus').length) {
					// Still in submenu
				} else {
					ActiveSubmenu.attr('data-has-focus', 'false');
					slideSubmenu(ActiveSubmenu)

				}
			}, 100);
		})

})(jQuery)
