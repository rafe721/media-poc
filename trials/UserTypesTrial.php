<?php
require("config/db.php");
require("classes/models/UserRole.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$userRole = new UserRole;

//$userRole->setRoleId();
$userRole->setRoleName("RoleName");
$userRole->setRoleDescription("Role Description");
//$userRole->setLastModified();

// Insert trial
echo "Insert: ". $usersManager->addRecord($userRole) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($userRole) . "\n";

// Update trial
$userRole = new UserRole;
$userRole->setRoleId($usersManager->getCount($userRole)/2);
$userRole->setRoleName("Updated Role");
$userRole->setRoleDescription("Updated Description");
//$userRole->setLastModified();
echo "Update: ". $usersManager->updateRecord($userRole) . "\n";

// Delete Trial trial
/* $userRole = new userRole;
$userRole->setUserId(27);
echo "Delete: ". $usersManager->deleteRecord($userRole) . "\n"; */

// getting record
$userRole = new UserRole;
$userRole->setRoleId($usersManager->getCount($userRole));
$aNewUser = $usersManager->getRecord($userRole);
echo "--------------------get Record: --------------------\n";
echo "RoleId: ".$userRole->getRoleId()."\n";
echo "RoleName: ".$userRole->getRoleName()."\n";
echo "Description: ".$userRole->getRoleDescription()."\n";
echo "Last Modified: ".$userRole->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedUsers = $usersManager->getAllRecords(new UserRole);
echo "Selected users: " . count($selectedUsers) . "\n";
foreach($selectedUsers as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
  	echo "RoleId: ".$value->getRoleId()."\n";
	echo "RoleName: ".$value->getRoleName()."\n";
	echo "Description: ".$value->getRoleDescription()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
