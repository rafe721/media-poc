<?php

require("config/db.php");
require("classes/models/UserRole.php");
require("classes/dataSources/UserRoleManager.php");

$role_name = "";
if (isset($_POST["role_name"])) {
	$email_id = $_POST["role_name"]; // populate from GET
}

$description = "";
if (isset($_POST["description"])) {
	$description = $_POST["description"]; // populate from GET
}

$userRoleManager = new UserRoleManager;

$aUserRole = new UserRole;
$aUserRole->setRoleName($role_name);
$aUserRole->setLastName($description);
// Insert trial
if ($userRoleManager->addRecord($aUserRole) == 0) {
	echo "UserRole  Added Successfully:<br/>";
}
else {
	echo "UserRole Added not Successfully:<br/>";
}

