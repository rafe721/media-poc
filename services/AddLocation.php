<?php

require("config/db.php");
require("classes/models/Location.php");
require("classes/dataSources/LocationManager.php");

$address_line = "";
if (isset($_POST["address_line"])) {
	$address_line = $_POST["reg_code"]; // populate from GET
}
 
$suburb = "";
if (isset($_POST["suburb"])) {
	$suburb = $_POST["suburb"]; // populate from GET
}
$city = "";
if (isset($_POST["city"])) {
	$city = (int) $_POST["city"]; // populate from GET
}

$postcode = "";
if (isset($_POST["postcode"])) {
	$postcode = $_POST["postcode"]; // populate from GET
}

$country = "";
if (isset($_POST["country"])) {
	$country = $_POST["country"]; // populate from GET
}

$locationManager = new LocationManager();

$location = new Location;
$location->setAddressLine($address_line);
$location->setSuburb($suburb);
$location->setCity($city);
$location->setPostcode($postcode);
$location->setCountry($country);

$locationManager->addLocation($location);

echo "Display Added Successfully:<br/>";
