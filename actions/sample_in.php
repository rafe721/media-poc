<?php

// Display
$display_subfolder = "classes/models/Display.php";
if (file_exists("api/".$display_subfolder)) {
	// if thee client hits index.php
	include_once("api/".$display_subfolder);
} else {
	// Accessing from /actions folder
	include_once("../api/".$display_subfolder);
}

// Media
$media_subfolder = "classes/models/Media.php";
if (file_exists("api/".$media_subfolder)) {
	// if thee client hits index.php
	include_once("api/".$media_subfolder);
} else {
	// Accessing from /actions folder
	include_once("../api/".$media_subfolder);
}

// MediaOnDisplay
$slot_subfolder = "classes/models/MediaOnDisplay.php";
if (file_exists("api/".$slot_subfolder)) {
	// if thee client hits index.php
	include_once("api/".$slot_subfolder);
} else {
	// Accessing from /actions folder
	include_once("../api/".$slot_subfolder);
}

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// initialise a display object
$display = new Display();

if (isset($_GET["reg_code"])) {
	$display->regCode = $_GET["reg_code"]; // populate from GET
} elseif (isset($_POST["reg_code"])) {
	$display->regCode = $_POST["reg_code"]; // populate from POST
}

// 
$status = "online";
if (isset($_GET["status"])) {
	$status = $_GET["status"]; // populate from GET
} elseif (isset($_POST["status"])) {
	$status = $_POST["status"]; // populate from POST
}

// 
$firebase_id = "";
if (isset($_GET["firebase_id"])) {
	$firebase_id = $_GET["firebase_id"]; // populate from GET
} elseif (isset($_POST["firebase_id"])) {
	$firebase_id = $_POST["firebase_id"]; // populate from POST
}

// array for JSON response
$response = array();

$display->read();
if (null == $display->displayId) {
	// empty response
	$response["device_status"] = "Not Registered";
	$response["updates"] = "None";
	$response["firebase_id"] = "Not Registered";
	$response["template"] = array(); // empty array
	$response["slots"] = array(); // empty array
	$response["schedule"] = array(); // empty array
} else {
	// Status & Last Modified should be updated no matter what
	
	/* DEVICE_STATUS */
	$response["device_status"] = "Registered";
	
	// get Records from SLOTS that are last_modified within the last_modified of the display.
	$mediaOnDisplay = new MediaOnDisplay();
	$mediaOnDisplay->displayId = $display->displayId;
	$slotList = $mediaOnDisplay->readSinceReport();
	// get Records from SCHEDULE that are last_modified within the last_modified of the display.
	$scheduleList = array();
	
	/* UPDATES */
	if (0 < count($slotList) ) {
		$response["updates"] = "Available"; // available (or) None
	} else {
		$response["updates"] = "None"; // available (or) None
	}
	
	/* FIREBASE_ID */
	// change the firebase Id if it is different.
	if (null == $display->firebase_id && null == $firebase_id) {
		$response["firebase_id"] = "Not Available";
	} elseif (null != $firebase_id) {
		$display->firebase_id = $firebase_id;
		$response["firebase_id"] = "Updated";
	} else {
		$response["firebase_id"] = "Available";
	}
	
	$response["slot_count"] = $display->slotCount;
	
	/* CAMPAIGN */
	/* response from the CAMPAIGN table; hardcoded from now */
	$campaign = array();
	$campaign["campaign_id"] = "0";
	$campaign["file_name"] = $display->regCode; // filename based on the reg_code
	$response["campaign"] = $campaign; // placebo array
	
	/* SLOTS */
	$slots = array();
	foreach ($slotList as $value) {
		$slot = array();
		// update slot_no and Media Id
		$slot["slot_no"] = $value->slotNo;
		$slot["media_id"] = $value->mediaId;
		
		// get media_name from the 'Media' table
		$media = new Media();
		$media->mediaId = $value->mediaId;
		$media->read();
		$slot["media_name"] = $media->mediaName;
		$slots[] = $slot;
	}
	$response["slots"] = $slots; // empty array
	
	/* SCHEDULE */
	$response["schedule"] = $scheduleList; // will be added as is without iterating.
	
	/* FIREBASE_ID may also be updated */
	/* change to status from Client OR 'ONLINE' */
	if (null != $status) {
		$display->status = $status;
	} else {
		$display->status = "ONLINE";
	}
	/* last Modified - change to current time */
	$display->lastModified = "now()";
	
	$display->update();
	
}

// echoing JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
?>