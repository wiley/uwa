(function($) {

	const MainMenu = $('nav.main:not(.mobileNav__nav)')
	const MenuItemsWithChildren = MainMenu.find('.menu-item-has-children')
	const MenuLinksWithChildren = MenuItemsWithChildren.find('> a')
	const ButtonHTML = `<button class="sub-menu__toggle"></button>`
	const Submenus = MenuItemsWithChildren.children('.sub-menu')
	const lastLinks = Submenus.find('a:last')

	MenuLinksWithChildren
		.after(ButtonHTML)
		.attr('aria-expanded', false)
		.attr('aria-haspopup', true)

	Submenus
		.attr({
			'aria-hidden': 'true'
		})

	const Buttons = $('.sub-menu__toggle')

	function submenuToggleHandler() {
		var SubmenuButton = $(this),
			parentListItem = SubmenuButton.parent('.menu-item-has-children'),
			link = SubmenuButton.prev('a'),
			newAriaExandedState = link.attr('aria-expanded') === 'false' ? true : false,
			CurrentSubmenu = SubmenuButton.next('.sub-menu'),
			newAriaHiddenState = CurrentSubmenu.attr('aria-hidden') === 'true' ? false : true

		link.attr('aria-expanded', newAriaExandedState)
		parentListItem.toggleClass('activeSubmenu')
		CurrentSubmenu
			.slideToggle(350, 'swing')
			.attr('aria-hidden', newAriaHiddenState)

		CurrentSubmenu.on('keydown', function(keyEvent) {
			if (keyEvent.which == 27) {
        SubmenuButton.focus()
			}
		})
	}

	Buttons.on('click', submenuToggleHandler)

	$('#menu-main')
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
					ActiveSubmenu
						.slideToggle(350, 'swing', function() {
							ActiveSubmenu.attr('data-has-focus', 'false');
						});
				}
			}, 100);
		})

})(jQuery)
