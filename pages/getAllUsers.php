<?php
require("config/db.php");
require("classes/models/User.php");
require("classes/dataSources/DBManager.php");

// simulating Insert User Section
$usersManager = new DBManager();

$selectedUsers = $usersManager->getAllRecords(new User);

?>

<div class="content_wrapper">
	<div class="content_options">
		<div class="content_title">
			<!-- Might not be necessary -->
		</div>
		<div class="content_search">
			<a href="#" onclick="showNewUserForm('#operation_container')">Add User</a>
		</div>
		<div class="content_list">
			<ul>
			<?php foreach($selectedUsers as $key => $value) { ?>
				<li><a href="#" onclick="getUser(<?php echo $value->getUserId(); ?>)"> <?php echo $value->getFirstName(); ?></a> </li>
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="content_data">
		<!-- more stuff will be loaded here -->
		<div id="operation_container">
		</div>

		<div id="context_content">
		</div>
	</div>
</div>
