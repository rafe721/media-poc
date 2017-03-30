<?php

$type = "";
if (isset($_GET["type"])) {
	$type = $_GET["type"]; // populate from GET
}

switch($type) {
	case DISPLAY:
	{
		include("app/display/read.php");
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
		include("app/media/read.php");
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