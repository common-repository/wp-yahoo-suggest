jQuery.fn.yahooSuggest = function(opts){

  opts = jQuery.extend(opts);

  opts.source = function(request, response){
    jQuery.ajax({
      url:'http://search.yahooapis.com/WebSearchService/V1/relatedSuggestion?appid=YahooDemo&output=json',
      dataType: 'jsonp',
      data: {
        query: request.term
      },
      success: function( data ) {
        response(jQuery.map(data.ResultSet.Result, function(item) {
          return { value: item }
        }));        
      }
    });  
  };
  
  opts.select = function(e) {
	  jQuery(this).val(e.target.text).parents('form').submit();
  }
  
  return this.each(function(){
    jQuery(this).autocomplete(opts);
  });
  
}
jQuery(function($){
	$('#s').yahooSuggest();
});