<?php

	require_once("config/db.php");
	require_once("classes/models/Display.php");
	require_once("classes/models/MediaOnDisplay.php");
	include_once("classes/dataSources/DBManager.php");

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
	$display->regCode = $reg_code;
	$display->displayName = $displayName;
	$display->slotCount = $slotCount;
	
	echo $display->regCode. "<br/>";
	echo $display->displayName. "<br/>";
	echo $display->slotCount. "<br/>";
	echo $display->create(). "<br/>";
	$display->displayId;
	$display->updateSlots();
	
	/* $slots = 1;
	while ($slots <= $display->getSlotCount()) {
		$mediaArray = (new MediaOnDisplay( 0, $display->displayId, $slots))->create(); // as no media is created yet
		echo $mediaArray.": <br/>";
		$slots++;
	} */
	
	echo "Display Added Successfully:<br/>";
