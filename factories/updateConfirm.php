<?php

// require_once('constants.php');

$type = "";
if (isset($_GET["type"])) {
	$type = $_GET["type"]; // populate from GET
}

switch($type) {
	case DISPLAY:
	{
		include("app/display/updateConfirm.php");
	}
	break;
	case MEDIA_ON_DISPLAY:
	{
		echo "Slot Update here";
		include("app/media_on_display/updateConfirm.php");
	}
	break;
	case USER:
	{
		include("services/AddUser.php");
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