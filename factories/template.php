<?php

$type = "";
if (isset($_GET["type"])) {
	$type = $_GET["type"]; // populate from GET
}

switch($type) {
	case DISPLAY:
	{
		// stuff
	}
	break;
	case USER:
	{
		// stuff
	}
	break;
	case LOCATION:
	{
		// stuff
	}
	break;
	case MEDIA:
	{
		// stuff
	}
	break;
	default:
		// stuff
}

?>