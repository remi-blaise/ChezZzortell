jQuery(function($){
	animated_arrow = $('#animated_arrow');
	w = $(window);
	
	animated_arrow.click(function(event){
		event.preventDefault();
		var n = w.height();
		$('html, body').animate({ scrollTop: n }, 1000);
	});
	
	w.scroll(function(){
		animated_arrow.css('display', 'none');
	});
});
