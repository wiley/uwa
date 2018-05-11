// import $ from 'jquery';
// window.$ = window.jQuery = $;

(function($) {

  var content = $('#degrees-menu-template').html(),
			NavDegreesItem = $('nav.main .nav-degrees'),
			NavDegreesLink = NavDegreesItem.children('a');

  NavDegreesItem
    .addClass('menu-item-has-children')
    // .attr('tabindex', 0);

  NavDegreesLink.after(content);
  const MegaMenu = $('nav.main:not(.mobileNav__nav) #megamenu');

  MegaMenu.hide()

	// MegaMenu
  //   .attr('id', 'megamenu')

	NavDegreesLink
    .attr('id', 'NavDegreesLink')
    .attr('aria-expanded', false)
    .attr('aria-haspopup', true)
	  .attr('aria-controls', "megamenu")

})(jQuery);
