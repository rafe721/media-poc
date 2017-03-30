<?php

$type = "";
if (isset($_GET["type"])) {
	$type = $_GET["type"]; // populate from GET
}

$id = "";
if (isset($_GET["id"])) {
	$id = $_GET["id"]; // populate from GET
}

switch($type) {
	case DISPLAY:
	{
		include("app/display/remove.php");
	}
	break;
	case MEDIA:
	{
		include("app/media/remove.php");
	}
	break;
	case MEDIA_ON_DISPLAY:
	{
		include("app/media_on_display/remove.php");
	}
	break;
	case LOCATION:
	{
		include("services/addLocation.php");
	}
	break;
	case MEDIA:
	{
		include("services/addMedia.php");
	}
	break;
	case MEDIA_TYPE:
	{
		include("services/AddMediaType.php");
	}
	break;
	default:
		// stuff
}

?>