/* Global Variables */
var files; /* to hold file */

/* to hold the notify object */
var notification = null;

function notify(param_message, param_theme = 'default') {
	if (null != notification) { notification.dismiss(); } // remove old notification if present
			
	notification = new NotificationBar({
		message : '<p>'+ param_message +'</p>',
		icon: 'like',
		theme: param_theme,
		layout : 'bar',
		location: 'bottom',
		onClose : function() {
			// bttn.disabled = false;
		}
	});

	notification.show();
}

// getElementById
function $id(id) {
	return document.getElementById(id);
}

	// output information
	function setOutput(msg) {
		var m = $id("messages");
		m.innerHTML = msg;
	}
	
	// output information
	function Output(msg) {
		var m = $id("messages");
		m.innerHTML = msg + m.innerHTML;
	}


	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// file selection
	function FileSelectHandler(e) {
		
		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		files = e.target.files || e.originalEvent.dataTransfer.files;
		
		// if (files[0].type.indexOf('video/') == -1) {
		if (false) {
			notify('Please drop a video file.');
		} else {
			
			$id("media_name").value = files[0].name;
			setOutput(
				"<p>File information: <strong>" + files[0].name +
				"</strong> type: <strong>" + files[0].type +
				"</strong> size: <strong>" + files[0].size +
				"</strong> bytes</p>"
			);
		}
		
	}


	// output file information
	function ParseFile(file) {

		Output(
			"<p>File information: <strong>" + file.name +
			"</strong> type: <strong>" + file.type +
			"</strong> size: <strong>" + file.size +
			"</strong> bytes</p>"
		);

	}
	
	function uploadFile(e) {
		e.preventDefault();
		if (null != files) {
			// notify($id("media_name").value);
			// var $form = $('#addMedia');
			var $form = $('#add_media_form');
			// var fileString = "";
			var aformData = new FormData();
			
			aformData.append('filename', $id("media_name").value);
			
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
					// $('#operation_container').html(result);
					// var resp = $.parseJSON(result);
					// alert(result);
					hide_add_media();
					notify('The File was Added to the system.');
				},
				error 		: function (result) {
					alert(result);
					notify('The System failed to add the media.');
				}
			})// using the done promise callback
			.done(function(data) {
				// alert('done');
			});
			
		} else {
			// alert("you have not selected any file");
			notify('Please select a video file for upload.');
		}
		
	}

	// initialize
	function file_init() {
		var fileselect = $id("fileselect"),
			filedrag = $id("filedrag");
			// submitbutton = $id("submitbutton");
		var $drag = $('#filedrag');// get the form variable 
		var $form = $('#add_media_form');
		var $upload_button = $('#file_upload');
		files = null;
		setOutput('<p>Status Messages</p>');
		
		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);
		
		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
			$drag.css('display', 'block'); // make Drag visible
			
			$drag.on('dragover dragleave', FileDragHover);
			$drag.on('drop', FileSelectHandler);
			$upload_button.on('click', uploadFile);
			$form.on('submit', uploadFile);
		}
		// alert('Hate is a weapon of the weak');
	}

//function to show slot Modal
function show_media(){
	document.getElementById('media').style.display = "block";
	// document.getElementById('popupContact').innerHTML = "";
}


//function to hide slot Modal
function hide_media(){ 
	document.getElementById('media').style.display = "none";
	// document.getElementById('popupContact').innerHTML = "";
}

//function to show slot Modal
function show_add_media(){
	file_init();
	document.getElementById('add_media').style.display = "block";
}


//function to hide slot Modal
function hide_add_media(){ 
	if (null != files) {
		files == null;
		var filename = document.getElementById("media_name");
		filename.value = "";
	}
	// document.getElementById('add_media').style.display = "none";
	closeModalById('add_media');
	angular.element(document.getElementById('mainController')).scope().loadSimilar();
	// document.getElementById('popupContact').innerHTML = "";
}


//function to show slot Modal
function show_slot(){
	document.getElementById('slot').style.display = "block";
	// document.getElementById('popupContact').innerHTML = "";
}


//function to hide slot Modal
function hide_slot(){ 
	document.getElementById('slot').style.display = "none";
	// document.getElementById('popupContact').innerHTML = "";
}

function div_show(){ 
	document.getElementById('blur').style.display = "block";
	// document.getElementById('popupContact').innerHTML = "";
}


//function to hide Popup
function div_hide(){ 
	document.getElementById('blur').style.display = "none";
	// document.getElementById('popupContact').innerHTML = "";
}

function showNotification(){ 
	// show the notification
	
}

function sendAjax(parameters, target){
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