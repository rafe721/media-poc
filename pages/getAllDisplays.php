<?php
require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

// simulating Insert User Section
$usersManager = new DBManager();

// $selectedDisplayType = $usersManager->getAllRecords(new Display);
$selectedDisplayType = (new Display())->readAll();

?>
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
