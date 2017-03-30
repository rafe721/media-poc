function getDisplayList(){
	var GET_parameters = "action=getDisplayList";
	getDialog(GET_parameters);
	/*document.getElementById('blur').style.display = "block"; */
	$.getScript( "js/MediaScripts.js" )
		.done(function( script, textStatus ) {
		console.log( textStatus );
	})
	.fail(function( jqxhr, settings, exception ) {
		alert("failed: " + exception);
		$( "div.log" ).text( "Triggered ajaxError handler." );
	});

}

function getDialog (parameters){
	$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'index.php?'+parameters, // the url where we want to POST
            // data        : formData, // our data object
            // dataType    : 'json', // what type of data do we expect back from the server
            // encode      : true,
			success     : function (result) {
				$("#display_list").html(result);
				// setTimeout("div_hide()",1000);
			},
			error 		: function (result) {
				// alert(result);
				setTimeout("div_hide()",5000);
			}
        });
}

function removejscssfile(filename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
    if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
        allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
    }
}