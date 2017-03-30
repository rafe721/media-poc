<?php
require("config/db.php");
require("classes/models/MediaType.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$mediaType = new MediaType;

//$mediaType->setTypeId();
$mediaType->setTypeName("TypeName");
$mediaType->setFormat("Role Description");
//$mediaType->setLastModified();

// Insert trial
echo "Insert: ". $usersManager->addRecord($mediaType) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($mediaType) . "\n";

// Update trial
$mediaType = new mediaType;
$mediaType->setTypeId($usersManager->getCount($mediaType)/2);
$mediaType->setTypeName("Updated Role");
$mediaType->setFormat("Updated Description");
//$mediaType->setLastModified();
echo "Update: ". $usersManager->updateRecord($mediaType) . "\n";

// Delete Trial trial
/* $mediaType = new mediaType;
$mediaType->setTypeId(27);
echo "Delete: ". $usersManager->deleteRecord($mediaType) . "\n"; */

// getting record
$mediaType = new mediaType;
$mediaType->setTypeId($usersManager->getCount($mediaType));
$aNewUser = $usersManager->getRecord($mediaType);
echo "--------------------get Record: --------------------\n";
echo "TypeId: ".$mediaType->getTypeId()."\n";
echo "TypeName: ".$mediaType->getTypeName()."\n";
echo "Description: ".$mediaType->getFormat()."\n";
echo "Last Modified: ".$mediaType->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedMediaType = $usersManager->getAllRecords(new mediaType);
echo "Selected users: " . count($selectedMediaType) . "\n";
foreach($selectedMediaType as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
  	echo "TypeId: ".$value->getTypeId()."\n";
	echo "TypeName: ".$value->getTypeName()."\n";
	echo "Description: ".$value->getFormat()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
