<?php
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" type="text/css" href="menu.css" />
	<!-- <link rel="stylesheet" href="css/layout.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script>
  	
	<title>HandySan | Sample Style</title>
</head>
<body>
	<a href="#" class="load_display">Load Display</a> <br/>
	<a href="#" class="load_media">Load media</a> <br/>
	<a href="#" class="load_users">Load users</a> <br/>
	<div id="main_content">
	</div>
	
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

<script>
		$('.load_display').click(function () {
			getDisplayList();
		});
		
		$('.load_media').click(function () {
			getMediaList();
		});
		
		$('.load_users').click(function () {
			getUserList();
		});
		
		function showSomething(){
			alert("Hola");
			getDisplayList();
		}
</script>
</body>
</html>
<?php
?>