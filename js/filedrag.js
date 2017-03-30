/*
filedrag.js - HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
(function() {
	
	// var files;


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

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f);
		}

	}


	// output file information
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
	
	function uploadFile(e) {
		// prevent form from submitting the normal way
		e.preventDefault();
		
		/*var submittionString = '';
		for (var i = 0, f; f = files[i]; i++) {
			submittionString += f.name + ', ';
		} */
		
		var $form = $('#upload'); // get form ID
		
		var aformData = new FormData();
		aformData.append('reg_code', 'Gestapo');
		
		// get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'reg_code'              : 'Gestapo',
            'display_name'          : 'gestapo',
        };
		$.each(files, function(key, value) {
			aformData.append('upload[]', value, value.name);
		});
		
		alert($form.attr('method'));

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
				alert(result);	
			},
			error 		: function (result) {
				alert(result);
			}
        })// using the done promise callback
		.done(function(data) {
			alert('done');
        });
	}


	// initialize
	function Init() {
		// alert('initialisation');

		var fileselect = $id("fileselect"),
			filedrag = $id("filedrag"),
			submitbutton = $id("submitbutton");
			var $drag = $('#filedrag');// get the form variable 
			var $form = $('#upload');

		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			// file drop
			/* filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false); */
			/* filedrag.addEventListener("drop", FileSelectHandler, false);  */
			/* filedrag.style.display = "block"; */
			
			$drag.css('display', 'block'); // make Drag visible
			
			$drag.on('dragover dragleave', FileDragHover);
			$drag.on('drop', FileSelectHandler);
			$form.on('submit', uploadFile);
			

			// remove submit button
			// submitbutton.style.display = "none";
		}

	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}


})();