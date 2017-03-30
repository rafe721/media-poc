<?php
require("config/db.php");
require("classes/models/Display.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
$usersManager = new DBManager();

$display = new Display;

// $display->setDisplayIdId();
$display->setDisplayName('SampleDisplay');
$display->setLocationId(1);
$display->setCurrentCampaign(1);
// $display->setLastModified();

// Insert trial
echo "Insert: ". $usersManager->addRecord($display) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($display) . "\n";

// Update trial
$display = new Display;
$display->setDisplayId($usersManager->getCount($display));
$display->setDisplayName('UpdatedSampleDisplay');
$display->setLocationId(2);
$display->setCurrentCampaign(2);
// $display->setLastModified();
echo "Update: ". $usersManager->updateRecord($display) . "\n";

// Delete Trial trial
/* $display = new display;
$display->setTypeId(27);
echo "Delete: ". $usersManager->deleteRecord($display) . "\n"; */

// getting record
$display = new Display;
$display->setDisplayId($usersManager->getCount($display));
$display = $usersManager->getRecord($display);
echo "--------------------get Record: --------------------\n";
echo "Display Id: ".$display->getDisplayId()."\n";
echo "Display Name: ".$display->getDisplayName()."\n";
echo "Location: ".$display->getLocationId()."\n";
echo "Current Campaign: ".$display->getCurrentCampaign()."\n";
echo "Last Modified: ".$display->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedDisplayType = $usersManager->getAllRecords(new Display);
echo "Selected users: " . count($selectedDisplayType) . "\n";
foreach($selectedDisplayType as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
	echo "Display Id: ".$value->getDisplayId()."\n";
	echo "Display Name: ".$value->getDisplayName()."\n";
	echo "Location: ".$value->getLocationId()."\n";
	echo "Current Campaign: ".$value->getCurrentCampaign()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
?>