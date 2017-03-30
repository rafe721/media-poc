<?php 

require_once("config/db.php");
require_once("classes/models/Media.php");
require_once("classes/models/MediaOnDisplay.php");
require_once("classes/dataSources/DBManager.php");

/* Get Media_id from request if available */
$media_id = 0; // media in the UI
if (isset($_GET["media_id"])) {
	$media_id = $_GET["media_id"]; // populate from POST
} elseif (isset($_POST["media_id"])) {
	$media_id = $_POST["media_id"]; // populate from GET
}

/* Get display_id from _GET if available */
$display_id = 0;
if (isset($_GET["display_id"])) {
	$display_id = $_GET["display_id"]; // populate from POST
} elseif (isset($_POST["display_id"])) {
	$display_id = $_POST["display_id"]; // populate from GET
}

/* Get Media_id from _GET if available */
$slot_no = 0;
if (isset($_GET["slot_no"])) {
	$slot_no = $_GET["slot_no"]; // populate from POST
} elseif (isset($_POST["slot_no"])) {
	$slot_no = $_POST["slot_no"]; // populate from GET
}

$slot = new MediaOnDisplay( $media_id, $display_id, $slot_no);
$slot->readMedia();

$selectedMedia = "";
$button = "<button type=\"button\" onclick=\"updateSlot(".$slot->displayId.", ". $slot->slotNo.");\" class=\"next action-button\">Swap</button>";
$hidden = "<input type=\"text\" name=\"media_id\" value=\"".$media_id."\"></input>";
// if $media_id is 0 but $slot->mediaId is not empty; 
if ($media_id == 0 && $slot->mediaId == 0) { // add new media
	// get list of media
	// simulating Insert User Section
	$usersManager = new DBManager();
	$selectedMedia = $usersManager->getAllRecords(new Media);
	
	$button = "<button type=\"button\" onclick=\"updateSlot(".$slot->displayId.", ". $slot->slotNo.");\" class=\"next action-button\">Add</button>";
} elseif ($media_id == 0) { // Media in request is 0 but the system has something; User is requesting a Clear 
	// no need to load media list
	$hidden = "<input type=\"hidden\" name=\"media_id\" value=\"".$media_id."\"></input>";
	$button = "<button type=\"button\" onclick=\"updateSlot( ".$slot->displayId.", ". $slot->slotNo.");\" class=\"next action-button\">Clear</button>";	
} else { // There is a media ID in the request as well as in the system; The user is requesting a SWAP i.e. change of media in a particular slot.
	// get list of media
	// simulating Insert User Section
	$usersManager = new DBManager();
	$selectedMedia = $usersManager->getAllRecords(new Media);
}
if ("" != $selectedMedia) {
	foreach($selectedMedia as $key => $value) {
		$id = $value->getMediaId();
		$name = $value->getMediaName();
		$hidden .= "<input type=\"radio\" name=\"media_id\" value=\"".$id."\"><a href=\"#\" onclick=\"\">".$value->getMediaName()."<br/>";
	}
}

?>
<form action="" id="msform">
	<fieldset class="dialog">
		<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
		<?php 
			echo $hidden;
			echo "Media No: ".$media_id. "<br/>";
			echo "Slot No: ".$slot_no. "<br/>";
			echo "Display Id: ".$display_id. "<br/>"; 
			// get available media and 
			echo $button;
			?>
	</fieldset>
</form> 