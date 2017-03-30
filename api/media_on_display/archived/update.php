<?php

require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

$id = "";
if (isset($_POST["id"])) {
	$id = $_POST["id"]; // populate from GET
}

$reg_code = "";
if (isset($_POST["reg_code"])) {
	$reg_code = $_POST["reg_code"]; // populate from GET
}
 
$displayName = "";
if (isset($_POST["display_name"])) {
	$displayName = $_POST["display_name"]; // populate from GET
}
$locationId = "";
if (isset($_POST["location"])) {
	$locationId = (int) $_POST["location"]; // populate from GET
}
$slotCount = 0;
if (isset($_POST["slot_count"])) {
	$slotCount = $_POST["slot_count"]; // populate from GET
}

$usersManager = new DBManager();

$display = new Display;
$display->setDisplayId($id);
$display->setRegCode($reg_code);
$display->setDisplayName($displayName);
$display->setSlotCount($slotCount);
echo $display->getDisplayId(). "<br/>";
echo $display->getRegCode(). "<br/>";
echo $display->getDisplayName(). "<br/>";
echo $display->getSlotCount(). "<br/>";
// echo $usersManager->updateRecord($display). "<br/>";
echo $display->update();


echo "Display updated...<br/>";
