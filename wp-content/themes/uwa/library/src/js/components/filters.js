(function($) {

  const FilterButtons = $('.toolbar-filter__label')
  const FilterToolbars = $('.toolbar-filter')
  const Filters = $('.filter')
  const CurrentFilters = $('.filter.active')


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

  function closeFilter() {

  }

  function handleFilterSelection() {
    let currentFilters = Filters.filter('.active')
    console.log(currentFilters);
    FilterToolbars.removeClass('activeFilter')
    FilterButtons.removeClass('activeFilter')

  }


  FilterButtons.on('click', handleFilter)
  Filters.on('click', function() {
    setTimeout(handleFilterSelection, 100)
  })
  // Filters.on('click', handleFilterSelection)
})(jQuery)
