(function($) {

  const Filters = $('.toolbar-filter__label')

  function handleFilter() {
    let currentFilter = $(this).next('.toolbar-filter')
    currentFilter.toggleClass('activeFilter')
  }

  Filters.on('click', handleFilter)

})(jQuery)
