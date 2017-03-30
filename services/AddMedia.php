<?php

require("config/db.php");
require("classes/models/Media.php");
require("classes/dataSources/DBManager.php");

$media_name = "";
if (isset($_POST["media_name"])) {
	$media_name = $_POST["media_name"]; // populate from GET
}
 
$media_type = "";
if (isset($_POST["media_type"])) {
	$displayName = $_POST["media_type"]; // populate from GET
}
$locationId = "";
if (isset($_POST["location"])) {
	$locationId = (int) $_POST["location"]; // populate from GET
}

$usersManager = new DBManager();

$media = new Media;
$media->setMediaName($media_name);
$media->setTypeId($media_type);
$media->setLocationId($locationId);
// $display->setLastModified();
$usersManager->addRecord($media);


echo "Display Added Successfully:<br/>";
