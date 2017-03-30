<?php
require("config/db.php");
require("classes/models/Campaign.php");
require("classes/dataSources/DBManager.php");
// require("classes/dataSources/StandardSqlQueryFactory.php");

// simulating Insert User Section
// $usersManager = new UsersManager();
$usersManager = new DBManager();

$campaign = new Campaign;

// $campaign->setCampaignId();
$campaign->setCampaignName('Sample Campaign');
$campaign->setSlotCount(0);
// $campaign->setLastModified();

// Insert trial
echo "Insert: ". $usersManager->addRecord($campaign) . "\n";

// count trial
echo "Count: ". $usersManager->getCount($campaign) . "\n";

// Update trial
$campaign = new campaign;
$campaign->setCampaignId($usersManager->getCount($campaign)/2);
$campaign->setCampaignName("Updated Campaign");
$campaign->setSlotCount(3);
//$campaign->setLastModified();
echo "Update: ". $usersManager->updateRecord($campaign) . "\n";

// Delete Trial trial
/* $campaign = new campaign;
$campaign->setTypeId(27);
echo "Delete: ". $usersManager->deleteRecord($campaign) . "\n"; */

// getting record
$campaign = new campaign;
$campaign->setCampaignId($usersManager->getCount($campaign));
$campaign = $usersManager->getRecord($campaign);
echo "--------------------get Record: --------------------\n";
echo "Campaign Id: ".$campaign->getCampaignId()."\n";
echo "Campaign Name: ".$campaign->getCampaignName()."\n";
echo "Slot Count: ".$campaign->getSlotCount()."\n";
echo "Last Modified: ".$campaign->getLastModified()."\n";
echo "----------------------------------------------------\n";

$selectedCampaign = $usersManager->getAllRecords(new campaign);
echo "Selected users: " . count($selectedCampaign) . "\n";
foreach($selectedCampaign as $key => $value) {
	echo "------------------------------ New --------------------------------- \n";
	echo "Key ".$key."\n";
	echo "----------------------------- Value -------------------------------- \n";
	echo "Campaign Id: ".$value->getCampaignId()."\n";
	echo "Campaign Name: ".$value->getCampaignName()."\n";
	echo "Slot Count: ".$value->getSlotCount()."\n";
	echo "Last Modified: ".$value->getLastModified()."\n";
	echo "------------------------------ old --------------------------------- \n";
}
