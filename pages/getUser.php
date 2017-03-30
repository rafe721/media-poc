<?php
require("config/db.php");
require("classes/models/User.php");
require("classes/dataSources/DBManager.php");

// simulating Insert User Section
$usersManager = new DBManager();
$user_id = "";
if (isset($_GET["user_id"])) {
	$user_id = $_GET["user_id"];
}
$user = new User;
$user->setUserId($user_id);
$user = $usersManager->getRecord($user);
?>
<b>User Details: </b>
<P><?php echo $user->getFirstName(); ?> </p>

<a href="#" class="load_users">Done</a>
