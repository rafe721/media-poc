<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
/* if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, A Minimum of PHP 5.3.7 is needed");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
} */

// include the configs / constants for the database connection
// require_once("config/db.php");
include("constants.php");

// Check for the action
$action = "";
if (isset($_GET["action"])) {
	$action = $_GET["action"]; // populate from GET
} elseif (isset($_POST["action"])) {
	$action = $_POST["action"]; // populate from POST
}

$message = "";

// user logged in.. check for actions to be taken..
switch ($action) {
	case "checkin": {
		include("actions/sample_in.php");
		exit();
	}
	case "getDisplayList": {
		include("pages/getAllDisplays.php");
		exit();
	}
	case "getMediaList": {
		include("pages/getAllMedia.php");
		exit();
	}
	case "getMedia": {
		include("pages/getMedia.php");
		exit();
	}
	case "get_data": {
		include("factories/forms.php");
		exit();
	}
	case "get_info": {
		include("factories/getInfo.php");
		exit();
	}
	case "get_form": {
		include("factories/forms.php");
		exit();
	}
	case "add_info": {
		include("factories/addInfo.php");
		exit();
	}
	case "update_confirm": {
		include("factories/updateConfirm.php");
		exit();
	}
	case "update_info": {
		include("factories/updateInfo.php");
		exit();
	}
	case "remove_dialog": {
		include("factories/removeForm.php");
		exit();
	}
	case "remove_info": {
		include("factories/removeInfo.php");
		exit();
	}
	break;
	default:
		echo "Action: ".$action."<br/>";
}

/* if no action is to be taken, determine which page is to be navigated to.  */
$page = "";
if (isset($_GET["p"])) {
	$page = $_GET["p"];
}
$tab = "";
if (isset($_GET["tab"])) {
	$tab = $_GET["tab"];
}

switch ($page) {
	case "dashboard": {
			include("pages/trial.php");
		} // dashboard block ends
		break;
	case "display_status": {
		include("pages/trial.php");
		} // display_status block ends
		break;
	default:
		include("pages/main.php");
		echo "page";

}
