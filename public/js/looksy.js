$(".add-form .add").change(function() {
	
	var url = $(".add-form .add").val();
	
	var urlEncoded = encodeURIComponent(url);
	
	var requestUrl = 'http://opengraph.io/api/1.0/site/' + urlEncoded;

	$.getJSON(requestUrl, function(json) {	
		
		//$('.preview .explainer').hide();
		$('.preview').show();
		//$('.preview .title').show();
		$('.preview .title').text(json.hybridGraph.title);
		$('.preview img').attr('src', json.hybridGraph.image);
	});   
});