(function($) {

  const FilterButtons = $('.toolbar-filter__label')
  const FilterToolbars = $('.toolbar-filter')
  const Filters = $('.filter')
  const CurrentFilters = $('.filter.active')
  const ActiveFiltersHolder = $('#activeFiltersHolder')
  const Holder = $('#holder')
  const ResetButton = $('#Reset')

  Holder.hide()
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

    let newText = ''
    $(currentFilters).each(function( index ) {

      newText += '- ' + $( this ).text() + '</br>';
    });
    ActiveFiltersHolder.html(newText)
    Holder.fadeIn(500)
    FilterToolbars.removeClass('activeFilter')
    FilterButtons.removeClass('activeFilter')

  }

  function handleReset() {
    Holder.fadeOut(500)
    ActiveFiltersHolder.html()
  }

  ResetButton.on('click', handleReset)
  FilterButtons.on('click', handleFilter)
  Filters.on('click', function() {
    setTimeout(handleFilterSelection, 100)
  })

})(jQuery)
