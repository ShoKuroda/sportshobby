jQuery(document).ready(function($){
	$('#suggest').ajaxSuggest(
		'/items/ajax_search',
		{'database':0,'limit':0}
	)
});

$(function(){
	$(".middle_menu li").hover(function(){
		$("> ul:not(:animated)" , this).animate({
			width : "toggle",
			opacity : "toggle"
		}, 200 );
	},
	function(){$("> ul" , this).hide("slow");});
	
});
