<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>HandySan - Content Management</title>
</head>
<body>
	<!--
	<a href="#cd-nav" class="cd-nav-trigger">
		Menu<span></span>
	</a> -->
	<div class="remodal-bg">
	<div class="wrapper">
		<div class="side_nav">
			<div class="cd_logo">
			</div>
			<div id='flyout_menu'>
				<ul>
				   <li><a href="#" class="load_display">Load Display</a></li>
				   <li><a href="#" class="load_media">Load media</a></a>
					  <ul>
						 <li><a href='#'><span>Product 1</span></a>
							<ul>
							   <li><a href='#'><span>Sub Product</span></a></li>
							   <li><a href='#'><span>Sub Product</span></a></li>
							</ul>
						 </li>
						 <li><a href='#'><span>Product 2</span></a>
							<ul>
							   <li><a href='#'><span>Sub Product</span></a></li>
							   <li><a href='#'><span>Sub Product</span></a></li>
							</ul>
						 </li>
					  </ul>
				   </li>
				   <!-- <li><a href="#" class="load_users">Load users</a></li>
				   <li><a href='#' class="place_holder"><span>placebo</span></a></li> -->
				</ul>
				</div>
		</div>
		<div id="main_content">
			<div class="content_wrapper">
	<div class="content_options">
		<div class="content_title">
			<!-- Might not be necessary -->
		</div>
		<div class="content_search">
			<!-- <a href="#" onclick="showNewDisplayForm('#operation_container')">Add Display</a> -->
			<a href="#" onclick="showNewDisplayForm('#operation_container')">Add Display</a> 
		</div>
		<div class="container" ng-app="myApp" ng-controller="displayCtrl">
			<div class="content_list">
				<ul ng-init="getAll()">
					<li ng-repeat="d in displays">
						<a href="#">{{ d.display_name }}</a>
					</li>
				</ul>
			</div>
		</div> <!-- end container -->
	</div>
	<div class="content_data">
		<!-- more stuff will be loaded here -->
		<div id="operation_container">
		</div>

		<div id="context_content">
		</div>
	</div>
</div>
		</div>
	</div>
	</div>
	
	<div id="blur">
		<!-- Popup div starts here -->
		<div id="popupContact"> 
			
		</div> 
		<!-- Popup div ends here -->
	</div>
	
	<div class="cd-overlay"><!-- shadow layer visible when navigation is visible --></div>
	
<!-- <script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script> -->
<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<script src="js/main.js"></script> <!-- Resource jQuery -->

<script src="js/filedrag.js"></script>
<script src="js/angular.js"></script> <!-- Resource jQuery -->


<!-- app -->
<script type="text/javascript" src="app/app.js"></script>
 
<!-- product -->
<script type="text/javascript" src="app/display/controller.js"></script>

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
		
		$('.place_holder').click(function () {
			alert("nothing for now");
		});
		
		function showSomething(){
			// alert("Hola");
			getDisplayList();
		}
</script>


</body>
</html>