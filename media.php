<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" media="all" href="css/animate.css" /> -->
	<!-- general styling -->
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<!-- main Style -->
	<link rel="stylesheet" type="text/css" media="all" href="css/media.css" />
	<!-- Grid View -->
	<link rel="stylesheet" type="text/css" media="all" href="css/imageBrowser.css" />
	<!-- Modal Dialog Box -->
	<link rel="stylesheet" type="text/css" href="assets/modal/modal.css" />
	<!-- FA icons and stuff -->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/menu.css" /> -->
	<script src="assets/NotificationBar/js/modernizr.custom.js"></script> <!-- Modernizr -->
	
	<!-- Resource AngularJS present here to prevent preload directives flicker -->
	<script src="js/angular.js"></script>
  	
	<title>HandySan - Content Management</title>
</head>
<body ng-app="myApp">
	<div ng-controller="mediaCtrl" id="mainController" >
		<div class="content_wrapper" id="main_content">
			<div id="action_bar">
				<div style="display: none;">
				{{ server_response_status }} <br/>
				{{ server_response_Message }} <br/>
				</div>
				<div id="search_area">
					<a id="search_icon"><i class="fa fa-search" style=""></i></a>
					<form name="autoDisplayLoad" style="float: left; ">
						<input type="search" ng-model="display_search" class="display_search" name="display_search" id="display_search" placeholder="Search Media..." ng-change="loadSimilar()" autocomplete="off">
					</form>
				</div>
				<div id="buttons_area">
					<div id="action_button">
						<a href="#" class="add_icon" onclick="openModal('add_media', file_init)"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div id="my-grid-container">
				<div id="my-grid" ng-init="loadSimilar()" class="my-grid">
					<div class="tile" ng-if="media" ng-repeat="d in media">
						<div class="tile_icon">
							<!-- <span class="icon file f-html">html</span> -->
							<i class="fa fa-file" style="color: #d65de8;"></i>
						</div>
						<div class="tile_data">
						<b>{{d.media_name}}</b>
						<p>
							<a href="javascript:void(0)" ng-click="readOne(d.media_id)"><i class="fa fa-fw fa-info"></i></a>
							<a href="javascript:void(0)" ng-click="showChangeModal(d.media_id, d.media_name)"><i class="fa fa-fw fa-pencil"></i></a>
							<a href="javascript:void(0)" ng-click="preview(d.media_id)"><i class="fa fa-fw fa-play"></i></a>
							<a href="javascript:void(0)" ng-click="showRemoveModal(d.media_id, d.media_name)"><i class="fa fa-fw fa-trash"></i></a>
						</p>
						</div>
					</div>
					<div id="no_resilt" ng-if="!media">
						<a href="#" style="text-decoration: none; font-size: 3em; color: white; text-align: center;">There is no media by that name...</a>
					</div>
				</div>
			</div><!-- my grid container -->
			
			<!-- The overlay -->
			<div id="myNav" class="overlay">

				<div class="overlay-header">
					<div class="label_area">
						{{ ui.media_name }}
					</div>
					<div class="action_area">
						<!-- Button to close the overlay navigation -->
						<ul>
							<li><a href="javascript:void(0)" ng-click="closeOverlay()"><i class="fa fa-close"></i></a></li>
							<li><a href="javascript:void(0)" ng-click="showRemoveModal(ui.media_id, ui.media_name)"><i class="fa fa-trash"></i></a></li>
							<li><a href="javascript:void(0)" ng-click="showChangeModal(ui.media_id, ui.media_name)"><i class="fa fa-pencil"></i></a></li>
							<li><a href="javascript:void(0)" ng-click="showChangeModal(ui.media_id, ui.media_name)"><i class="fa fa-download"></i></a></li>
						</ul>
					</div>
				</div>

				<!-- Overlay content -->
				<div class="overlay-content">
					<div class="video_area" width="100%">
						<div ng-if="ui.mime == 'video'"> <!-- if there is no media in this slot -->
							<video ng-if="ui.file_path" style="width:40%; height: 40%;" controls autoplay>
								<source src="{{ui.file_path}}" />
								Your browser does not support the video tag.
							</video>
						</div>
						<div ng-if="ui.mime == 'image'"> <!-- if there is no media in this slot -->
							<img ng-if="ui.file_path" src="{{ui.file_path}}" alt="image" style="width:40%; height: 40%;">
						</div>
					</div>
					<div class="info_area">
						<div class="icon_area">
							<i class="fa fa-file" style="color: #5cb85c;"></i>
						</div>
						<div class="card_area">
							<div class="info_card_x">
								<h5>Display Name</h5>
								<span>{{ ui.media_name }}</span>
							</div>
							<div class="info_card">
								<h5>Extension</h5>
								<span>{{ ui.extension }}</span>
							</div>
							<div ng-if="ui.play_length != 'undetermined'" class="info_card">
								<h5>Play Length</h5>
								<span>{{ ui.play_length }}</span>
							</div>
							<div class="info_card">
								<h5>Uploaded by</h5>
								<span>{{ ui.owner }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div> <!-- Content_wrapper id: main_content -->
		
		<!-- The Modal -->
		<div id="media_editable" class="modal">
			<!-- Modal content -->
			<div class="modal-content modal-width-40">
				<div class="modal-header">
					<span class="close"  ng-click="closeDialog(this)">&times;</span>
					<h2>{{ media_form_title }}</h2>
				</div>
				<div class="modal-body">
					<div class="modal_centered">
						<div class="label_area">
							<label id="form_media_name_label">{{form_media_label}}</label> <br/>
						</div>
						<div id="modal_text_input" class="input_area">
							<input ng-model="form_media_name" id="form_media_name_input" type="text" name="form_media_name" placeholder="Media Name" value=""><br>
						</div>
						<div class="input_area">
							<button type="button" id="btn_change_media" class="next action-button" ng-click="updateMedia(this)">Change</button>
							<button type="button" id="btn_remove_media" class="next action-button" ng-click="removeMedia(this)">Remove</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<!-- <h3>Modal Footer</h3> -->
				</div>
			</div>
		</div>
	
		<!-- The Modal -->
		<div id="add_media" class="modal">
			<!-- Modal content -->
			<div class="modal-content modal-width-80">
				<div class="modal-header">
					<span class="close" onclick="closeModal(this)">&times;</span>
					<h2>Add Media</h2>
				</div>
				<div class="modal-body clearfix">
					<form id="add_media_form" action="index.php?action=add_info&type=media" method="POST" enctype="multipart/form-data">
						<div class="default_upload">
								<div class="action_area" style="width: 100%; float: left">
									<!-- Hidden Elements #START -->
									<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
									<input type="file" id="fileselect" name="fileselect" style="display: none;" />
									<!-- Hidden Elements #END -->
									<input type="text" id="media_name" name="media_name" placeholder="File Alias" />
									<button id="choose_file"><i class="fa fa-plus-square"></i></button>
									<button id="file_upload" style=""><i class="fa fa-upload"></i></button>
								</div>
								
								<div id="messages" class="message_area" style="width: 100%; float: left">
									<p>Status Messages</p>
								</div>
						</div>
						<div id="filedrag">
							<p>or drop files here</p>
						</div>
					</form> 
				</div>
				<div class="modal-footer">
					<!-- <h3>Modal Footer</h3> -->
				</div>
			</div>
		</div>
		
		<!-- The Modal -->
		<div id="view_media" class="modal">
			<!-- Modal content -->
			<div class="modal-content modal-width-40">
				<div class="modal-header">
					<span class="close" onclick="closeModal(this)">&times;</span>
					<h2>{{preview.title}} {{preview.media_name}}</h2>
				</div>
				<div class="modal-body clearfix">
					<div ng-if="preview.path"> <!-- if there is no media in this slot -->
						<video width="100%" height="240" controls autoplay>
							<source src="{{preview.path}}" />
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
				<div class="modal-footer">
					<!-- <h3>Modal Footer</h3> -->
				</div>
			</div>
		</div>
	</div><!-- main_controller -->
	<!-- <script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script> -->
	
	<!-- jQuery -->
	<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	<!-- jQuery easing plugin -->
	<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="assets/NotificationBar/css/notification.css" />
	<script src="assets/NotificationBar/js/classie.js" type="text/javascript"></script>
	<script src="assets/NotificationBar/js/NotificationBar.js" type="text/javascript"></script>
	<script src="assets/modal/modal.js" type="text/javascript"></script>
	<script src="js/prime.js"></script> <!-- Resource jQuery -->


	<!-- <script src="js/filedrag.js"></script> -->

	<!-- app -->
	<script type="text/javascript" src="app/app.js"></script>
 
	<!-- product -->
	<script type="text/javascript" src="app/media/controller.js"></script>

</body>
</html>