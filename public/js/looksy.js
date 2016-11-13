$(".add-input").change(function() {
	
	var url = $(".add-form .add-input").val();
	var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	
	if(!url_validate.test(url)) {

		$( ".add-input" ).after( "<span class='help-block'>Oooops... you need to enter a valid URL for your Pick.</span>" );
	
	} else {
	   	
	   	var urlEncoded = encodeURIComponent(url);
		
		var requestUrl = 'http://opengraph.io/api/1.0/site/' + urlEncoded;
		
		$.getJSON(requestUrl, function(json) {	
			if(json.hybridGraph.title && json.hybridGraph.image) {
				$('.preview').show();
				$('.title').val(json.hybridGraph.title);
				$('.preview .image').attr('src', json.hybridGraph.image);
			}
		});

		$('.before-add').hide();
		$('h1').replaceWith( "<h1>Edit Pick</h1>" );
	}
});

$(".looksy-menu .search a").click(function(e) {
	e.preventDefault();
  	$(".categories").toggle();
});

/*
$(document).ready(function() {
	$("#selectImage").imagepicker({
		hide_select: true
	});
});
*/