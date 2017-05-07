$(".looksy-menu .search a").click(function(e) {
	e.preventDefault();
  	$(".categories").toggle();
  	$(".looksy-menu").toggleClass('categories-on');
});

$(".cold-start .got-it").click(function(e) {
	e.preventDefault();
	$(".page-1").toggle();
  	$(".page-2").toggle();
  	
});

$(".cold-start .ok-great").click(function(e) {
	e.preventDefault();
	$(".page-2").toggle();
  	$(".page-3").toggle();
  	$("body").addClass('ended');
  	
});