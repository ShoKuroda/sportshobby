/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.screenshotPreview = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' width='300px' />"+ c +"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	screenshotPreview();
});


$(function(){
	$("#shk_info").click(function(){
		$("#used_disp").hide("slow");
		$("#new_disp").hide("slow");
		$("#shk_disp").show("slow");
		$("#shk_info").css("border-bottom","#8dc70a solid 8px");
		$("#info").css("border-bottom","solid 6px #8dc70a");
		$("#used_info").css("border-bottom","#8dc70a solid 0px");
		$("#new_info").css("border-bottom","#8dc70a solid 0px");
	});
	
	$("#new_info").click(function(){
		$("#shk_disp").hide("slow");
		$("#used_disp").hide("slow");
		$("#new_disp").show("slow");
		$("#new_info").css("border-bottom","#1073C7 solid 8px");
		$("#info").css("border-bottom","solid 6px #1073C7");
		$("#shk_info").css("border-bottom","#1073C7 solid 0px");
		$("#used_info").css("border-bottom","#1073C7 solid 0px");
	});
	
	$("#used_info").click(function(){
		$("#shk_disp").hide("slow");
		$("#new_disp").hide("slow");
		$("#used_disp").show("slow");
		$("#used_info").css("border-bottom","#C71010 solid 8px");
		$("#info").css("border-bottom","solid 6px #C71010");
		$("#shk_info").css("border-bottom","#C71010 solid 0px");
		$("#new_info").css("border-bottom","#C71010 solid 0px");

	});
});

$(document).ready(function() {
	$.featureList(
		$("#tabs tr td"),
		$("#output li"), {
			start_item:0
		}
	);
});