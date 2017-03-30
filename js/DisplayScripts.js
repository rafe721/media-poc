
function showSlotUpdate(media_id, display_id, slot_no) {
	// alert(displayId + " | " + slotNo);
	var GET_parameters = "action=update_confirm&type=media_on_display&display_id="+display_id+"&slot_no="+slot_no+"&media_id="+media_id;
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+GET_parameters, // the url where we want to POST
		// data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			$('#popupContact').html(result);
			//setTimeout("div_hide()",3000);
		},
		error 		: function (result) {
			$('#popupContact').html(result);
			//setTimeout("div_hide()",5000);
		}
	});
	// alert(GET_parameters);
	$('#blur').css('display', 'block'); 
}

function updateSlot(display_id, slot_no) {
	// alert('here');
	media_id = $('input[type=radio][name=media_id]:checked').val();
	// media_id = $('input[name=media_id]').val();
	if (null == media_id || 'undefined' == media_id) {
		media_id = $('input[type=hidden][name=media_id]').val();	
	}
	alert('Input ' + media_id);
	var GET_parameters = "action=update_info&type=media_on_display&display_id="+display_id+"&slot_no="+slot_no+"&media_id="+media_id;
	//alert(displayId + " " + slotNo);
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+GET_parameters, // the url where we want to POST
		// data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			$('#popupContact').html(result);
			setTimeout("div_hide()",3000);
		},
		error 		: function (result) {
			$('#popupContact').html(result);
			setTimeout("div_hide()",5000);
		}
	});
	// alert(GET_parameters);
	$('#blur').css('display', 'block');  
}

function getDisplay(display_id){
	var GET_parameters = "action=get_info&type=display&display_id="+display_id;
	sendAjax(GET_parameters, "#context_content");
	/*document.getElementById('blur').style.display = "block"; */
	/* $.getScript( "js/MediaScript.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	}); */
	$('.load_media').click(function () {
		getMediaList();
	});
}

function showNewDisplayForm(target) {
	var GET_parameters = "action=get_form&type=display";
	sendAjax(GET_parameters, '#popupContact');
	$('#blur').css('display', 'block');
}

function showUpdateDisplayForm(id, target) {
	var GET_parameters = "action=get_form&type=display&id="+ id;
	sendAjax(GET_parameters, target);
	$('#blur').css('display', 'block');
}

function showDeleteDisplayConfirmation(id, target) {
	var GET_parameters = "action=remove_dialog&type=display&id="+ id;
	sendAjax(GET_parameters, target);
	$('#blur').css('display', 'block');
}

function removeDisplay(id, target) {
	var POST_parameters = "action=remove_info&type=display&id="+ id;
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+POST_parameters, // the url where we want to POST
		// data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			// alert(target);
			$(target).html(result);
			setTimeout("div_hide()",1000);
		},
		error 		: function (result) {
			alert(result);
			setTimeout("div_hide()",5000);
		}
	});
	// getDisplayList();
}

function insertDisplay(target) {
	var POST_parameters = "action=add_info&type=display";
	var formData = {
		'reg_code'		: $('input[name=reg_code]').val(),
		'display_name'	: $('input[name=display_name]').val(),
		// 'location'		: $('input[name=location]').val(),
		'slot_count'    : $('select[name=slot_count]').val()
	};
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+POST_parameters, // the url where we want to POST
		data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			$(target).html(result);
			setTimeout("div_hide()",1000);
		},
		error 		: function (result) {
			alert(result);
			setTimeout("div_hide()",5000);
		}
	});
	// getDisplayList();
}

function updateDisplay(target) {
	var POST_parameters = "action=update_info&type=display";
	var formData = {
		'id'		: $('input[name=id]').val(),
		'reg_code'		: $('input[name=reg_code]').val(),
		'display_name'	: $('input[name=display_name]').val(),
		// 'location'		: $('input[name=location]').val(),
		'slot_count'    : $('select[name=slot_count]').val()
	};
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+POST_parameters, // the url where we want to POST
		data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			$(target).html(result);
			setTimeout("div_hide()",1000);
		},
		error 		: function (result) {
			alert(result);
			setTimeout("div_hide()",5000);
		}
	});
	// getDisplayList();
}