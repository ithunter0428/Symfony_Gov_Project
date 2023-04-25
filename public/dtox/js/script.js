//scroll to top

$(function(){
	
	$('.scroll a[href^=#]').click(function() {
		var speed = 500;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$('html, body').animate({ scrollTop: position }, speed, 'swing');
		return false;
	});
	
	
	$('.mem_history td .h_content').hide();
	$('.mem_history td span').click(function() {
		if($('.mem_history td .h_content').is(':visible')) {
			$('.mem_history td .h_content').slideUp(300);
			$('.mem_history td span').removeClass("active");
			$('.mem_history td span').addClass("icon");
		} else {
			$('.mem_history td .h_content').slideDown(300);
			$('.mem_history td span').removeClass("icon");
			$('.mem_history td span').addClass("active");
		}
	});
	
	
	//pig fix
	//$(".pngfix").fixPng();
	
});