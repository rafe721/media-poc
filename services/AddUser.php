<?php

require("config/db.php");
require("classes/models/User.php");
require("classes/dataSources/DBManager.php");

$email_id = "";
if (isset($_POST["email_id"])) {
	$email_id = $_POST["email_id"]; // populate from GET
}
 
$passsword = "";
if (isset($_POST["password"])) {
	$passsword = $_POST["password"]; // populate from GET
}
$first_name = "";
if (isset($_POST["first_name"])) {
	$first_name = $_POST["first_name"]; // populate from GET
}
$second_name = "";
if (isset($_POST["second_name"])) {
	$second_name = $_POST["second_name"]; // populate from GET
}

$usersManager = new DBManager();

$aUser = new User;
$aUser->setFirstName($first_name);
$aUser->setLastName($second_name);
$aUser->setEmailId($email_id);
$aUser->setRoleId(1);
$aUser->setUserId(1);
// Insert trial
if ($usersManager->addRecord($aUser) == 0) {
	echo "User Added Successfully:<br/>";
}
else {
	echo "User Added not Successfully:<br/>";
}

