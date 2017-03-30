<?php
require("config/db.php");
require("classes/models/user.php");
// require("classes/dataSources/UsersManager.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$aUser = new User;
$aUser->setFirstName("Rahul");
$aUser->setLastName("Rahul");
$aUser->setEmailId("anEmailId");
$aUser->setRoleId(1);
$aUser->setUserId(1);
// Insert trial
echo "Insert: ". $usersManager->addRecord($aUser) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($aUser) . "\n";

// Update trial
$aUser = new User;
$aUser->setFirstName("UpdateRahul");
$aUser->setLastName("UpdateRahul");
$aUser->setEmailId("UpdateanEmailId");
$aUser->setRoleId(2);
$aUser->setUserId(1);
echo "Update: ". $usersManager->updateRecord($aUser) . "\n";

// Delete Trial trial
$aUser = new User;
$aUser->setUserId(27);
echo "Delete: ". $usersManager->deleteRecord($aUser) . "\n";

// getting record
$aUser = new User;
$aUser->setUserId(1);
$aNewUser = $usersManager->getRecord($aUser);
echo "--------------------get Record: --------------------\n";
echo "UserId: ".$aNewUser->getUserId()."\n";
echo "First Name: ".$aNewUser->getFirstName(). "\n";
echo "Last Name: ".$aNewUser->getLastName(). "\n";
echo "Email Id: ".$aNewUser->getEmailId(). "\n";
echo "Role Id: ".$aNewUser->getRoleId(). "\n";
echo "Last Modified: ".$aNewUser->getLastModified(). "\n";
echo "----------------------------------------------------\n";

$selectedUsers = $usersManager->getAllRecords(new User);
echo "Selected users: " . count($selectedUsers) . "\n";
foreach($selectedUsers as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
  	echo "UserId: ".$value->getUserId()."\n";
	echo "First Name: ".$value->getFirstName(). "\n";
	echo "Last Name: ".$value->getLastName(). "\n";
	echo "Email Id: ".$value->getEmailId(). "\n";
	echo "Role Id: ".$value->getRoleId(). "\n";
	echo "Last Modified: ".$value->getLastModified(). "\n";
	echo "------------------------------ old --------------------------------- \n";
}
//$numUsers = $usersManager->getCount();

// Simulating Update User Section
/*$aUser = new User;
$aUser->setFirstName("Rahul");
$aUser->setLastName("Update");
$aUser->setEmailId("aName@anEmail.com");
$aUser->setRoleId(1);
$aUser->setUserId($numUsers/2);
	echo "\nUpdate: " .$usersManager->updateRecord($aUser) ."\n";

// Simulating read Single User Data Section
$aNewUser = $usersManager->getRecord($aUser);
echo "UserId: ".$aNewUser->getUserId()."\n";
echo "First Name: ".$aNewUser->getFirstName(). "\n";
echo "Last Name: ".$aNewUser->getLastName(). "\n";
echo "Email Id: ".$aNewUser->getEmailId(). "\n";
echo "Role Id: ".$aNewUser->getRoleId(). "\n";
echo "Last Modified: ".$aNewUser->getLastModified(). "\n";

// Simulating read all Users Section
$selectedUsers = $usersManager->getRecords();
echo "Selected users: " . count($selectedUsers) . "\n";
foreach($selectedUsers as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
  	echo "UserId: ".$value->getUserId()."\n";
	echo "First Name: ".$value->getFirstName(). "\n";
	echo "Last Name: ".$value->getLastName(). "\n";
	echo "Email Id: ".$value->getEmailId(). "\n";
	echo "Role Id: ".$value->getRoleId(). "\n";
	echo "Last Modified: ".$value->getLastModified(). "\n";
	echo "------------------------------ old --------------------------------- \n";
}

// Simulating Delete USer Section
$aUser = new User;
$aUser->setUserId($numUsers);
echo $usersManager->deleteRecord($aUser);

// Printing number of users


echo "Number of users: " . $numUsers;
*/
