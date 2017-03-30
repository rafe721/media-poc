<?php

require("config/db.php");
require("classes/models/Display.php");
require("classes/dataSources/DBManager.php");

$address_line = "";
if (isset($_POST["address_line"])) {
	$address_line = $_POST["reg_code"]; // populate from GET
}

$suburb = "";
if (isset($_POST["suburb"])) {
	$suburb = $_POST["suburb"]; // populate from GET
}

$locationManager = new MediaTypeManager();

$location = new Location;
$location->setAddressLine($address_line);
$location->setSuburb($suburb);
$location->setCity($city);
$location->setPostcode($postcode);
$location->setCountry($country);

$locationManager->addLocation($location);

echo "Display Added Successfully:<br/>";
