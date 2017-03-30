
function getUser(user_id){
	var GET_parameters = "action=getUser&user_id="+user_id;
	sendAjax(GET_parameters, "#context_content");
	/*document.getElementById('blur').style.display = "block"; */
	/* $.getScript( "js/MediaScript.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	});
	$('.load_media').click(function () {
		getMediaList();
	}); */
}

function showNewUserForm(target) {
	var GET_parameters = "action=get_form&type=user";
	sendAjax(GET_parameters, target);
	
}

function insertUser(target) {
	var POST_parameters = "action=add_info&type=user";
	var formData = {
		'email_id'		: $('input[name=email_id]').val(),
		'password'	: $('input[name=password]').val(),
		'first_name'		: $('input[name=first_name]').val(),
		'second_name'    : $('input[name=second_name]').val()
	};
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+POST_parameters, // the url where we want to POST
		data        : formData, // our data object
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