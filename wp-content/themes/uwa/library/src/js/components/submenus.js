import $ from 'jquery';
window.$ = window.jQuery = $;

(function($) {
  const MainMenu = $('nav.main:not(.mobileNav__nav)')
  const MenuItemsWithChildren = MainMenu.find('.menu-item-has-children')
  const MenuLinksWithChildren = MenuItemsWithChildren.find('> a')
  const ButtonHTML = `<button class="sub-menu__toggle"></button>`
  const Submenus = MenuItemsWithChildren.children('.sub-menu')
  const lastLinks = Submenus.find('a:last')
  console.log(lastLinks);

  const Keys = {
    'TAB': 9,
    'RETURN': 13,
    'ESC': 27,
    'SPACE': 32,
    'PAGEUP': 33,
    'PAGEDOWN': 34,
    'END': 35,
    'HOME': 36,
    'LEFT': 37,
    'UP': 38,
    'RIGHT': 39,
    'DOWN': 40
  }

  MenuLinksWithChildren.after(ButtonHTML)

  lastLinks.keydown(function(event) {
    if (event.keyCode == 9) {
      event.preventDefault();
      // console.log('lastlink keyup fired');
      // console.log($('#menu-item-214'));

      closeSubmenu()
      // Submenu.slideToggle(350, 'swing', function(){ console.log('done');})
    }
  })


  // lastLinks.on('focus', function() {
  //   console.log('focus fired');
  //   lastLinks.keyup(function() {
  //     console.log('keyup fired');
  //     if (event.keyCode == 9) {
  //       event.preventDefault();
  //       // console.log('lastlink keyup fired');
  //       // console.log($('#menu-item-214'));
  //       $('#menu-item-214 a').focus();
  //       closeSubmenu()
  //       // Submenu.slideToggle(350, 'swing', function(){ console.log('done');})
  //     }
  //   })
  // })
  // lastLinks.on('keyup', function(event) {
  //   // console.log($(document.activeElement));
  //   console.log($(this).is(':focus'));
  //   if (event.keyCode == 9) {
  //     event.preventDefault();
  //     console.log('lastlink keyup fired');
  //     console.log($('#menu-item-214'));
  //     $('#menu-item-214 a').focus();
  //     closeSubmenu()
  //     // Submenu.slideToggle(350, 'swing', function(){ console.log('done');})
  //   }
  // })


  const Buttons = $('.sub-menu__toggle')

  // function closeSubmenu(event, currentSubmenu) {
  //   console.log(event);
  //   if (event.which == Keys.TAB) {
  //     currentSubmenu.slideToggle(350, 'swing')
  //   }
  // }

  function closeSubmenu() {
    var currentSubmenu = $('.activeSubmenu')
    var Parent = currentSubmenu.parent('.menu-item-has-children')
    var nextLinkItem = Parent.next('.menu-item')
    var nextLink = nextLinkItem.children('a').first();

    currentSubmenu.slideToggle(350, 'swing', function() {
      currentSubmenu.removeClass('activeSubmenu')
      nextLink.focus();
    })
  }

  function listenForTabbingOut() {  }

  function toggleSubmenus() {
    let Button = $(this)
    let ParentItem = Button.parent('.menu-item-has-children')
    let ParentLink = ParentItem.children('a:first')
    let Submenu = Button.next()
    let Links = Submenu.find('a')
    let lastLink = Submenu.find('a').last()

    Submenu
      .addClass('activeSubmenu')
      .slideToggle(350, 'swing');

    // lastLink.on('keyup', function(e) {
    //   // console.log($(document.activeElement));
    //   if (e.which == Keys.TAB) {
    //     console.log('lastlink keyup fired');
    //     Submenu.slideToggle(350, 'swing', function(){ console.log('done');})
    //
    //   }
    // })
    // lastLink.on('blur', function(originalEvent) {
    //   console.log(originalEvent);
    //   $(this).keyup(function(e) {
    //     console.log(e);
    //     if (e.which == Keys.TAB) {
    //       console.log('lastlink keyup fired');
    //       Submenu.slideToggle(350, 'swing')
    //     }
    //   })
    // })


    // Submenu.on('keydown', function(keyEvent) {
    //
    //   if (keyEvent.which == Keys.ESC) {
    //     Submenu.slideToggle(350, 'swing', function() {
    //       Submenu.removeClass('activeSubmenu')
    //       Button.focus()
    //     })
    //   }
    // })
  }

  Buttons.on('click', toggleSubmenus)

  function handleMenuItemsFocus() {
    var listItem = $(this)
    var subMenu = ''
    var megaMenuSubMenus = ''
    var firstLink = ''
    listItem.addClass('activeFocus')

    // listItem.on('keyup',function(event) {
    //   if (event.keyCode == 40) {
    //
    //     subMenu = listItem.find('.sub-menu').first()
    //     console.log(subMenu);
    //
    //     if (subMenu.attr('id') == 'megamenu') {
    //       megaMenuSubMenus = subMenu.children('.degrees-menu__submenu')
    //       firstLink = megaMenuSubMenus.find('a').first()
    //     } else {
    //       firstLink = subMenu.find('a').first()
    //     }
    //
    //     firstLink.keyup()
    //   }
    // });
  }


  // MenuItemsWithChildren.on('focus', handleMenuItemsFocus)
})(jQuery);
