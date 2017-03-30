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
		include("rendering/removeDisplayForm.php");
	}
	break;
	case MEDIA:
	{
		include("rendering/removeMediaForm.php");
	}
	break;
	case USER_ROLE:
	{
		include("services/AddUserRole.php");
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