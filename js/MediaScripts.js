var files;

function $id(id) {
	return document.getElementById(id);
}
// file drag hover
function FileDragHover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.target.className = (e.type == "dragover" ? "hover" : "");
}

function uploadFile(e) {
	e.preventDefault();
	if (null != files) {
		
		var $form = $('#addMedia');
		var fileString = "";
		var aformData = new FormData();
		
		aformData.append('filename', $id("Selected_FileName").value);
		
		$.each(files, function(key, value) {
			aformData.append('upload[]', value, value.name);
		});
		
		// process the form
		$.ajax({
			type        :  $form.attr('method'), // define the type of HTTP verb we want to use (POST for our form)
			url         :  $form.attr('action'), // the url where we want to POST
			data        : 	aformData, // our data object
			processData	: false,
			contentType	: false,
			// dataType    : 'json', // what type of data do we expect back from the server
			/* encode          : true, */
			success     : function (result) {
				$('#operation_container').html(result);
				alert(result);	
			},
			error 		: function (result) {
				alert(result);
			}
		})// using the done promise callback
		.done(function(data) {
			alert('done');
		});
		
	} else {
		alert("you have not selected any file");
	}
}

function init(id){
	var fileselect = $id('fileselect');
	var filedrag = $id("filedrag");
	var submitbutton = $id("submitbutton");
	var $drag = $('#filedrag');// get the form variable 
	var $form = $('#upload');
	var $file_upload = $('#file_upload');
	
	// file select
	fileselect.addEventListener("change", FileSelectHandler, false);
	var xhr = new XMLHttpRequest();
	if (xhr.upload) {
		$drag.css('display', 'block'); // make Drag visible
		$drag.on('dragover dragleave', FileDragHover);
		$drag.on('drop', FileSelectHandler);
		
		$form.on('submit', uploadFile);
	} else {
		alert('noooo');
	}
	$file_upload.on('click', uploadFile);
}

// output information
function Output(msg) {
	var m = $id("messages");
	m.innerHTML = msg + m.innerHTML;
}

function ParseFile(file) {
	var filename = $id("Selected_FileName");
	filename.value = file.name;
	Output(
		"<p>File information: <strong>" + file.name +
		"</strong> type: <strong>" + file.type +
		"</strong> size: <strong>" + file.size +
		"</strong> bytes</p>"
	);
}

function FileSelectHandler(e) {
	// cancel event and hover styling
	FileDragHover(e);
		
	files = e.target.files || e.originalEvent.dataTransfer.files;
	
	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		ParseFile(f);
	}
	
}

function getMedia(id){
	var GET_parameters = "action=getMedia&media_id="+id;
	sendAjax(GET_parameters, "#context_content");
}

function showNewMediaForm(target) {
	var GET_parameters = "action=get_form&type=media";
	// sendAjax(GET_parameters, "#popupContact");
	$.ajax({
		type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+GET_parameters, // the url where we want to POST
		// data        : formData, // our data object
		// dataType    : 'json', // what type of data do we expect back from the server
		// encode      : true,
		success     : function (result) {
			$("#popupContact").html(result);
			// setTimeout("div_hide()",1000);
			init();
		},
		error 		: function (result) {
			alert(result);
			setTimeout("div_hide()",5000);
		}
	});
	$('#blur').css('display', 'block');
	
}

function confirmRemoveMedia(id, target) {
	var GET_parameters = "action=remove_dialog&type=media&id="+id;
	sendAjax(GET_parameters, "#popupContact");
	$('#blur').css('display', 'block');
	
}

function insertMedia(target) {
	var POST_parameters = "action=add_info&type=media";
	var formData = {
		'media_name'		: $('input[name=media_name]').val(),
		'media_type'	: $('input[name=media_type]').val(),
		'location'		: $('input[name=location]').val()
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
	
}

function removeMedia(id, target) {
	var POST_parameters = "action=remove_info&type=media&id="+ id;
	// var POST_parameters = "action=remove_info&type=media";
	/* var formData = {
		'media_name'		: $('input[name=media_name]').val(),
		'media_type'	: $('input[name=media_type]').val(),
		'location'		: $('input[name=location]').val()
	}; */
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'index.php?'+POST_parameters, // the url where we want to POST
		// data        : formData, // our data object
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
	
}