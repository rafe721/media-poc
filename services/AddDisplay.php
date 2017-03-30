<?php

	require_once("config/db.php");
	require_once("classes/models/Display.php");
	require_once("classes/models/MediaOnDisplay.php");
	require_once("classes/dataSources/DBManager.php");

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
	$display->setRegCode($reg_code);
	$display->setDisplayName($displayName);
	$display->setSlotCount($slotCount);
	// $display->setCurrentCampaign(1);
	// $display->setLastModified();
	echo $display->getRegCode(). "<br/>";
	echo $display->getDisplayName(). "<br/>";
	echo $display->getSlotCount(). "<br/>";
	echo $usersManager->addRecord($display). "<br/>";


	echo "Display Added Successfully:<br/>";
