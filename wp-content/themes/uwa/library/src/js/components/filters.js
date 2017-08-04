(function($) {

  const FilterButtons = $('.toolbar-filter__label')
  const FilterToolbars = $('.toolbar-filter')

  function handleFilter() {
    let currentFilterButton = $(this)
    let currentFilter = currentFilterButton.next('.toolbar-filter')

    if (currentFilterButton.hasClass('activeFilter')) {
      currentFilter.removeClass('activeFilter')
      currentFilterButton.removeClass('activeFilter')
    } else {

      FilterButtons.removeClass('activeFilter')
      FilterToolbars.removeClass('activeFilter')
      currentFilter.toggleClass('activeFilter')
      currentFilterButton.toggleClass('activeFilter')
    }
  }

  FilterButtons.on('click', handleFilter)

})(jQuery)
