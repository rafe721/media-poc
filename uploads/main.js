//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent(); // divs instead of fieldsets
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"); // dont need to worry about this
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
			myMap();							
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})

//function to hide Popup
function div_hide(){ 
	document.getElementById('blur').style.display = "none";
	document.getElementById('popupContact').innerHTML = "";
}

function getDisplayList() {
	var GET_parameters = "action=getDisplayList";
	sendAjax(GET_parameters, "#main_content");
	$.getScript( "js/DisplayScripts.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	});

}

function getMediaList() {
	var GET_parameters = "action=getMediaList";
	sendAjax(GET_parameters, "#main_content");
	$.getScript( "js/MediaScripts.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	});

}

/* to load User Details */
function getUserList() {
	var GET_parameters = "action=getUserList";
	sendAjax(GET_parameters, "#main_content");
	$.getScript( "js/UserScripts.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	});

}

function sendAjax (parameters, target){
	$.ajax({
			type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'index.php?'+parameters, // the url where we want to POST
            // data        : formData, // our data object
            // dataType    : 'json', // what type of data do we expect back from the server
            // encode      : true,
			success     : function (result) {
				$(target).html(result);
				// setTimeout("div_hide()",1000);
			},
			error 		: function (result) {
				alert(result);
				setTimeout("div_hide()",5000);
			}
        });
}

/* Open when someone clicks on the span element */
function openNav() {
    document.getElementById("myNav").style.width = "70%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}