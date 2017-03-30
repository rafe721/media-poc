<?php
require("config/db.php");
require("classes/models/Media.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$media = new Media;

// $media->setMediaId();
$media->setMediaName("Sample Media Name");
$media->setTypeId(1);
$media->setLocationId(1);
//$media->setLastModified('');

// Insert trial
echo "Insert: ". $usersManager->addRecord($media) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($media) . "\n";

// Update trial
$media = new Media;
$media->setMediaId($usersManager->getCount($media)/2);
$media->setMediaName("Updated Sample Media");
$media->setTypeId(2);
$media->setLocationId(2);
//$media->setLastModified();
echo "Update: ". $usersManager->updateRecord($media) . "\n";

// Delete Trial trial
/* $media = new media;
$media->setTypeId(27);
echo "Delete: ". $usersManager->deleteRecord($media) . "\n"; */

// getting record
$media = new Media;
$media->setMediaId($usersManager->getCount($media));
$media = $usersManager->getRecord($media);
echo "--------------------get Record: --------------------\n";
echo "Media Id: ".$media->getMediaId()."\n";
echo "Media Name: ".$media->getMediaName()."\n";
echo "Type Id: ".$media->getTypeId()."\n";
echo "LocationId: ".$media->getLocationId()."\n";
echo "Last Modified: ".$media->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedMediaType = $usersManager->getAllRecords(new Media);
echo "Selected users: " . count($selectedMediaType) . "\n";
foreach($selectedMediaType as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
	echo "Media Id: ".$value->getMediaId()."\n";
	echo "Media Name: ".$value->getMediaName()."\n";
	echo "Type Id: ".$value->getTypeId()."\n";
	echo "LocationId: ".$value->getLocationId()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
