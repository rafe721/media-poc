<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" media="all" href="css/animate.css" /> -->
	<link rel="stylesheet" type="text/css" media="all" href="css/media.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/imageBrowser.css" />
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/menu.css" /> -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>HandySan - Content Management</title>
</head>
<body ng-app="myApp" ng-controller="mediaCtrl">
	<div class="content_wrapper">
		<div id=Search>
				{{ server_response_status }} <br/>
				{{ server_response_Message }} <br/>
			<form name="autoDisplayLoad">
				<input type="text" ng-model="display_search" class="display_search" name="display_search" id="display_search" placeholder="Search Displays..." ng-change="loadSimilar()">
			</form>
		</div>
		<div id="grid-container">
			<div id="grid" ng-init="getAll()" class="grid">
				<figure class="effect-kira pulse" ng-if="media" ng-repeat="d in media">
					<!-- <img src="img/17.jpg" alt="img17"/> -->
					<figcaption>
						<h2>{{d.media_name}}</h2>
						<p>
							<a href="#" ng-click="readOne(d.media_id)"><i class="fa fa-fw fa-exclamation-circle"></i></a>
							<a href="#" ng-click="showChangeModal(d.media_id, d.media_name)"><i class="fa fa-fw fa-edit"></i></a>
							<a href="#" ng-click="preview(d.media_id)"><i class="fa fa-fw fa-play"></i></a>
							<a href="#" ng-click="showRemoveModal(d.media_id, d.media_name)"><i class="fa fa-fw fa-trash"></i></a>
						</p>
					</figcaption>			
				</figure>
				<!--<div id="media_tile" ng-if="media" ng-repeat="d in media">
					<a href="#" ng-click="readOne(d.media_id)">Info</a>
					<a href="#" ng-click="showChangeModal(d.media_id, d.media_name)">Change</a>
					<a href="#" ng-click="preview(d.media_id)">Preview</a>
					<a href="#" ng-click="showRemoveModal(d.media_id, d.media_name)">Remove</a>
					<b>{{ d.media_name }}</b>
				</div> -->
				<div id="media_tile" ng-if="!media">
					<a href="#" >No Results</a>
				</div>
			</div>
		</div>
		<!-- The overlay -->
		<div id="myNav" class="overlay">

			<!-- Button to close the overlay navigation -->
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

			<!-- Overlay content -->
			<div class="overlay-content">
				<a href="#" ng-click="popUpdateform()">Change</a>
				<a href="#" ng-click="popRemoveform()">Remove</a>
				<b>Display Name: </b>{{ ui.media_name }} <br/>
				<b>Reg Code: </b>{{ ui.reg_code }} <br/>
				<b>Number of slots: </b>{{ ui.slot_count }} <br/>
				<div class="slot_container">
					<div class="display_slots" ng-repeat="s in ui.slots">
						<div ng-if="!s.media_id"> <!-- if there is no media in this slot -->
							<a href="#" ng-click="showAddSlotDialog(s.slot_no)">Add</a> |
							<b>Empty Slot</b>
						</div>
						<div ng-if="s.media_id"> <!-- if there is media in this slot -->
							<a href="#" ng-click="showClearSlotDialog(s.slot_no)">Clear</a> |
							<a href="#" ng-click="showSwapSlotDialog(s.slot_no, s.media_id)">Swap</a> | 
							<a href="#" ng-click="showSlotPreview(s.slot_no, s.media_id)">Preview</a> |
							<b>{{ s.media_name}}</b>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div> <!-- Content_wrapper -->
	
	<div id="media" class="modal-overlay">
		<!-- Popup div starts here -->
		<div id="popupContact"> 
			<form action="" id="msform">
				<fieldset class="dialog">
				<h3>{{ media_form_title }}</h3>
					<img src="popup_close.png" id="close" ng-click="hideMediaModal()"> <!-- Close button -->
					<label id="form_media_name_label">{{form_media_name}}</label>
					<input ng-model="form_media_name" id="form_media_name_input" type="text" name="form_media_name" placeholder="Media Name" value=""><br>
					
					<button type="button" id="btn_change_media" class="next action-button" ng-click="updateMedia()">Change</button>
					<button type="button" id="btn_remove_media" class="next action-button" ng-click="removeMedia()">Remove</button>
				</fieldset>
			</form> 
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

<script src="js/prime.js"></script> <!-- Resource jQuery -->

<script src="js/filedrag.js"></script>
<script src="js/angular.js"></script> <!-- Resource jQuery -->


<!-- app -->
<script type="text/javascript" src="app/app.js"></script>
 
<!-- product -->
<script type="text/javascript" src="app/media/controller.js"></script>

</body>
</html>