$(".add-form .add").change(function() {
	
	var url = $(".add-form .add").val();
	
	var urlEncoded = encodeURIComponent(url);
	
	var requestUrl = 'http://opengraph.io/api/1.0/site/' + urlEncoded;

	$.getJSON(requestUrl, function(json) {	
		if(json.hybridGraph.title && json.hybridGraph.image) {
			$('.preview').show();
			$('.preview .title').text(json.hybridGraph.title);
			$('.preview img').attr('src', json.hybridGraph.image);
		}
	});   
});

$(".looksy-menu .search a").click(function(e) {
	e.preventDefault();
  	$(".categories").toggle();
});