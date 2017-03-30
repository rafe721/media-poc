<?php
require("config/db.php");
require("classes/models/MediaOnCampaign.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$mediaOnCampaign = new MediaOnCampaign;

$mediaOnCampaign->setCampaignId(1);
$mediaOnCampaign->setMediaId($usersManager->getCount($mediaOnCampaign));
$mediaOnCampaign->setSlotNo($usersManager->getCount($mediaOnCampaign)+1);
//$mediaOnCampaign->setLastModified();

// Insert trial
echo "Insert: ". $usersManager->addRecord($mediaOnCampaign) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($mediaOnCampaign) . "\n";

// Update trial
$mediaOnCampaign = new mediaOnCampaign;
$mediaOnCampaign->setCampaignId(1);
$mediaOnCampaign->setMediaId($usersManager->getCount($mediaOnCampaign) - 2);
$mediaOnCampaign->setSlotNo($usersManager->getCount($mediaOnCampaign) - 1);
$mediaOnCampaign->setStatus("ARCHIVED");
echo "Update: ". $usersManager->updateRecord($mediaOnCampaign) . "\n";

// Delete Trial trial
/* $mediaOnCampaign = new mediaOnCampaign;
$mediaOnCampaign->setTypeId(27);
echo "Delete: ". $usersManager->deleteRecord($mediaOnCampaign) . "\n"; */

// getting record
$mediaOnCampaign = new mediaOnCampaign;
$mediaOnCampaign->setCampaignId(1);
$mediaOnCampaign->setSlotNo ($usersManager->getCount($mediaOnCampaign)-1);
$mediaOnCampaign = $usersManager->getRecord($mediaOnCampaign);
echo "--------------------get Record: --------------------\n";
echo "CampaignId: ".$mediaOnCampaign->getCampaignId()."\n";
echo "MediaId: ".$mediaOnCampaign->getMediaId()."\n";
echo "SlotNo: ".$mediaOnCampaign->getSlotNo()."\n";
echo "Status: ".$mediaOnCampaign->getStatus()."\n";
echo "Last Modified: ".$mediaOnCampaign->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedMediaOnCampaign = $usersManager->getAllRecords($mediaOnCampaign);
echo "Selected users: " . count($selectedMediaOnCampaign) . "\n";
foreach($selectedMediaOnCampaign as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
  	echo "CampaignId: ".$value->getCampaignId()."\n";
	echo "MediaId: ".$value->getMediaId()."\n";
	echo "SlotNo: ".$value->getSlotNo()."\n";
	echo "Status: ".$value->getStatus()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
