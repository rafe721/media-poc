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
		include("rendering/AddDisplayForm.php");
		// stuff
	}
	break;
	case USER:
	{
		include("rendering/AddUserForm.php");
		// stuff
	}
	break;
	case USER_ROLE:
	{
		include("rendering/AddUserRoleForm.php");
		// stuff
	}
	break;
	case LOCATION:
	{
		include("rendering/AddLocationForm.php");
		// stuff
	}
	break;
	case MEDIA:
	{
		include("rendering/AddMediaForm.php");
		// stuff
	}
	break;
	case MEDIA_TYPE:
	{
		include("rendering/AddMediaTypeForm.php");
		// stuff
	}
	break;
	default:
		// stuff
}

?>