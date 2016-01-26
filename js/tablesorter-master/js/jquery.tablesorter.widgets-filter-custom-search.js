// *** Filter search type function arguments ***
// data.filter = filter input value for a column; iFilter = same as filter, except lowercase
// data.exact = table cell text (or parsed data, if column parser enabled)
// data.iExact = same as exact, except lowercase

// search for a match from the beginning of a string
// "^l" matches "lion" but not "koala"
$.tablesorter.filter.types.start = function( config, data ) {
  if ( /^\^/.test( data.iFilter ) ) {
    return data.iExact.indexOf( data.iFilter.substring(1) ) === 0;
  }
  return null;
};

// search for a match at the end of a string
// "a$" matches "Llama" but not "aardvark"
$.tablesorter.filter.types.end = function( config, data ) {
  if ( /\$$/.test( data.iFilter ) ) {
    var filter = data.iFilter,
      filterLength = filter.length - 1,
      removedSymbol = filter.substring(0, filterLength),
      exactLength = data.iExact.length;
    return data.iExact.lastIndexOf(removedSymbol) + filterLength === exactLength;
  }
  return null;
};

$(function() {

  $('#filters').tablesorter({
    theme: 'blue',
    widgets: ['zebra', 'filter'],
    widgetOptions: {
      filter_reset: '.reset'
    }
  });

  // External search
  // buttons set up like this:
  // <button type="button" class="search" data-filter-column="4" data-filter-text="2?%">Saved Search</button>
  $('button').click(function(){
    var $t = $(this),
      col = $t.data('filter-column'), // zero-based index
      filter = [];

    filter[col] = $t.text(); // text to add to filter
    $('#filters').trigger('search', [ filter ]);
    return false;
  });

});