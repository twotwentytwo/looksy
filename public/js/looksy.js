/*

$(".add-input").change(function() {

	// get the input field 
	var url = $(".add-input").val();

	// validate to see if the input is a URL or not
	var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

	// if it's not a URL
	if(!url_validate.test(url)) {

		// print an error message
		$(".help-block").show();
	
	// if it is a URL, go and get the metadata
	} else {
	   	
	   	var urlEncoded = encodeURIComponent(url);
		var requestUrl = 'https://opengraph.io/api/1.0/site/' + urlEncoded;

		$.getJSON(requestUrl, function(json) {	

			console.log(json.hybridGraph.title);
			console.log(json.hybridGraph.image);

			if(json.hybridGraph.title && json.hybridGraph.image) {
				$('.preview').show();
				$('.title').val(json.hybridGraph.title);
				$('.preview .image').attr('src', json.hybridGraph.image);
			}
		});

		// then hide the input field
		$('.before-add').hide();

		// and change the title of the page
		$('h1').replaceWith( "<h1>Edit Pick</h1>" );
	}
});

*/

if("serviceWorker" in navigator) {
  navigator.serviceWorker.register('/js/service-worker.js').then(function(registration) {
    console.log('Yay!');
  }).catch(function(error) {
    console.log('boo!', error);
  });
}

$(".looksy-menu .search a").click(function(e) {
	e.preventDefault();
  	$(".categories").toggle();
});