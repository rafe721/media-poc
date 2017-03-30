<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/styles.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/menu.css" /> -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>HandySan - Content Management</title>
</head>
<body ng-app="myApp" ng-controller="displayCtrl">
	<!--
	<a href="#cd-nav" class="cd-nav-trigger">
		Menu<span></span>
	</a> -->
	<div class="wrapper">
		<div class="side_nav">
			<div class="cd_logo">
			</div>
			<div id='flyout_menu'>
				<ul>
				   <li><a href="#" class="load_display">Load Display</a></li>
				   <li><a href="#" class="load_media">Load media</a></a>
				   </li>
				   <!-- <li><a href="#" class="load_users">Load users</a></li>
				   <li><a href='#' class="place_holder"><span>placebo</span></a></li> -->
				</ul>
				</div>
		</div>
		<div id="main_content">
			<!-- <div class="content_wrapper" ng-app="myApp" ng-controller="displayCtrl"> -->
			<div class="content_wrapper">
				<div class="content_options">
					<div class="content_title">
						<!-- Might not be necessary -->
						{{ server_response_status }} <br/>
						{{ server_response_Message }} <br/>
						<form name="autoDisplayLoad">
							<input type="text" ng-model="display_search" name="display_search" id="display_search" placeholder="Search Displays..." ng-change="loadSimilar()">
						</form>
					</div>
					<div class="content_search">
						<!-- <a href="#" onclick="showNewDisplayForm('#operation_container')">Add Display</a> -->
						<a href="#" ng-click="popCreateform()">Add Display</a> 
					</div>
					<div class="container">
						<div class="content_list">
							<ul ng-init="getAll()">
								<li ng-if="displays" ng-repeat="d in displays">
									<a href="#" ng-click="readOne(d.display_id)">{{ d.display_name }}</a>
								</li>
								<li ng-if="!displays">
									<a href="#" >No Results</a>
								</li>
							</ul>
						</div>
					</div> <!-- end container -->
				</div>
				<div class="content_data">
				<!-- The overlay -->
					<div id="myNav" class="overlay">

						<!-- Button to close the overlay navigation -->
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

						<!-- Overlay content -->
						<div class="overlay-content">
							<a href="#" ng-click="popUpdateform()">Change Details</a>
							<a href="#" ng-click="popRemoveform()">Remove</a>
							<b>Display Name: </b>{{ ui.display_name }} <br/>
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
				</div>
			</div>
		</div>
	</div>
	
	<div id="blur" class="modal-overlay">
		<!-- Popup div starts here -->
		<div id="popupContact"> 
			<form action="" id="msform">
				<fieldset class="dialog">
				<h3>{{ display_form_title }}</h3>
					<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
					<input ng-model="form_reg_code" type="text" name="reg_code" placeholder="Registration Code" value=""><br>
					<input ng-model="form_display_name" type="text" name="display_name" placeholder="Display name" value=""><br>
					<select ng-model="form_slot_count" ng-options="slot for slot in available_slots" name="slot_count">
					</select>
					<button type="button" id="btn_add_display" class="next action-button" ng-click="createDisplay()">Add Display</button>
					<button type="button" id="btn_update_display" class="next action-button" ng-click="updateDisplay()">Update Display</button>
					<button type="button" id="btn_remove_display" class="next action-button" ng-click="removeDisplay()">Remove</button>
				</fieldset>
			</form> 
		</div> 
		<!-- Popup div ends here -->
	</div>
	
	<div id="slot" class="modal-overlay">
		<!-- Popup div starts here -->
		<div id="popupContact"> 
			<form action="" id="msform">
				<fieldset class="dialog">
				<h3>{{ slot_form_title }}</h3>
					<img src="popup_close.png" id="close" ng-click="clearSlotModal()"> <!-- Close button -->
					<div id="slot_loading">Loading...</div>
					{{ ui.display_id }}
					{{ slot_form_slot_no }}
					{{ slot_media_id }}
					<div id="media_select" class="grid_Group">
						<label ng-repeat="sm in slot_media">
							<input type="radio" ng-model="$parent.slot_media_id" name="slot_media_id" value="{{sm.media_id}}"/ >
							{{sm.media_name}}
						</label>
					</div>
					<button type="button" id="btn_add_slot" class="next action-button" ng-click="modifySlotData()">Add</button>
					<button type="button" id="btn_clear_slot" class="next action-button" ng-click="modifySlotData()">Clear</button>
					<button type="button" id="btn_swap_slot" class="next action-button" ng-click="modifySlotData()">Swap</button>
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